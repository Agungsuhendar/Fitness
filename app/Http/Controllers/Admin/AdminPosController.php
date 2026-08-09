<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use App\Models\InventoryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminPosController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureSeedProducts();

        $category = $request->input('category', 'all');
        $q = trim($request->input('q'));

        // Fetch all active products for instant client-side filtering (prevents page reloads in Fullscreen mode)
        $products = Product::where('is_active', true)->orderBy('name')->get();
        $categories = Product::where('is_active', true)->select('category')->distinct()->pluck('category');

        $recentTransactions = PosTransaction::with('items')->latest()->take(10)->get();

        return view('admin.pos.index', compact('products', 'categories', 'category', 'q', 'recentTransactions'));
    }

    public function searchMembers(Request $request)
    {
        $q = trim($request->input('q'));
        if (!$q) return response()->json([]);

        $members = User::where(function($b) use ($q) {
            $b->where('name', 'like', "%{$q}%")
              ->orWhere('email', 'like', "%{$q}%")
              ->orWhere('phone', 'like', "%{$q}%")
              ->orWhere('member_card_id', 'like', "%{$q}%");
        })->take(8)->get(['id', 'name', 'phone', 'email', 'member_card_id', 'remaining_sessions']);

        return response()->json($members);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'member_name' => 'nullable|string|max:255',
            'member_phone' => 'nullable|string|max:50',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'pay_amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $invNo = 'POS-FL-' . date('Ymd') . '-' . rand(1000, 9999);
            $subtotal = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $qty = (int) $item['qty'];
                $itemSubtotal = $product->price * $qty;
                $subtotal += $itemSubtotal;

                // Deduct stock & Record Inventory Log ONLY IF is_track_stock is true
                $isTracked = isset($product->is_track_stock) ? $product->is_track_stock : ($product->category !== 'Tiket Harian');

                if ($isTracked) {
                    if ($product->stock < $qty) {
                        throw new \Exception("Stok produk '" . $product->name . "' tidak mencukupi (Tersisa: " . $product->stock . " " . ($product->unit ?: 'Pcs') . ")");
                    }

                    $prevStock = $product->stock;
                    $product->stock = max(0, $prevStock - $qty);
                    $product->save();

                    \App\Models\InventoryLog::create([
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'type' => 'out',
                        'qty' => $qty,
                        'previous_stock' => $prevStock,
                        'current_stock' => $product->stock,
                        'notes' => 'Penjualan POS Kasir Invoice ' . $invNo,
                        'created_by' => auth()->user()->name ?? 'Kasir Studio',
                    ]);
                }

                $itemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'qty' => $qty,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $discount = (float) ($validated['discount'] ?? 0);
            $total = max(0, $subtotal - $discount);
            $payAmount = (float) $validated['pay_amount'];
            $changeAmount = max(0, $payAmount - $total);

            try {
                if (!\Illuminate\Support\Facades\Schema::hasColumn('pos_transactions', 'payment_status')) {
                    \Illuminate\Support\Facades\Schema::table('pos_transactions', function ($table) {
                        $table->string('payment_status', 50)->default('paid')->nullable();
                    });
                }
            } catch (\Throwable $t) {}

            $isQris = str_contains(strtolower($validated['payment_method']), 'qris') || str_contains(strtolower($validated['payment_method']), 'ipaymu');
            $paymentStatus = $isQris ? 'pending' : 'paid';

            $transaction = PosTransaction::create([
                'invoice_number' => $invNo,
                'member_name' => $validated['member_name'] ?? 'Pelanggan UMUM',
                'member_phone' => $validated['member_phone'] ?? '-',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'payment_method' => $validated['payment_method'],
                'pay_amount' => $payAmount,
                'change_amount' => $changeAmount,
                'payment_status' => $paymentStatus,
                'created_by' => auth()->user()->name ?? 'Kasir Studio',
                'transacted_at' => now(),
            ]);

            foreach ($itemsData as $row) {
                $row['pos_transaction_id'] = $transaction->id;
                PosTransactionItem::create($row);
            }

            // If QRIS or online payment selected, generate iPaymu QRIS link
            $qrisData = null;
            if ($isQris) {
                try {
                    $va = \App\Models\Setting::get('ipaymu_va', '0000002447990145');
                    $apiKey = \App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
                    $isProd = \App\Models\Setting::get('ipaymu_is_production', '0') == '1';
                    $baseUrl = $isProd ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';
                    $endpoint = $baseUrl . '/api/v2/payment/direct';

                    $memberName = $validated['member_name'] ?? 'Pelanggan UMUM';
                    $memberPhone = preg_replace('/[^0-9]/', '', $validated['member_phone'] ?? '08123456789');

                    $body = [
                        'name' => $memberName,
                        'phone' => $memberPhone ?: '08123456789',
                        'email' => 'kasir@fitlifehub.site.je',
                        'amount' => (int) $total,
                        'notifyUrl' => url('/api/ipaymu/webhook'),
                        'paymentMethod' => 'qris',
                        'paymentChannel' => 'qris',
                        'feeDirection' => 'MERCHANT',
                        'referenceId' => $invNo,
                        'product' => ['Penjualan POS Kasir #' . $invNo],
                        'qty' => [1],
                        'price' => [(int) $total],
                    ];

                    $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                    $bodyHash = strtolower(hash('sha256', $jsonBody));
                    $timestamp = date('YmdHis');
                    $stringToSign = "POST:" . $va . ":" . $bodyHash . ":" . $apiKey;
                    $signature = hash_hmac('sha256', $stringToSign, $apiKey);

                    $response = \Illuminate\Support\Facades\Http::withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'va' => $va,
                        'signature' => $signature,
                        'timestamp' => $timestamp,
                    ])->post($endpoint, $body);

                    if ($response->successful()) {
                        $resData = $response->json();
                        if (isset($resData['Data'])) {
                            $qrisData = [
                                'qr_image' => $resData['Data']['QrImage'] ?? null,
                                'payment_url' => $resData['Data']['Url'] ?? null,
                                'qr_string' => $resData['Data']['QrString'] ?? null,
                            ];
                        }
                    }
                } catch (\Throwable $t) {}

                // Fallback QRIS display URL if API offline or sandbox credentials
                if (!$qrisData || empty($qrisData['qr_image'])) {
                    $qrisData = [
                        'qr_image' => 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode('https://fitlifehub.site.je/invoice/' . $invNo),
                        'payment_url' => url('/invoice/' . $invNo),
                        'qr_string' => 'IPAYMU-QRIS-' . $invNo,
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $isQris ? 'Menunggu Pelunasan Pembayaran QRIS iPaymu...' : 'Transaksi POS Kasir Berhasil!',
                'transaction_id' => $transaction->id,
                'invoice_number' => $invNo,
                'payment_status' => $paymentStatus,
                'change_amount' => $changeAmount,
                'payment_method' => $validated['payment_method'],
                'total_amount' => $total,
                'qris_data' => $qrisData,
                'receipt_url' => route('admin.pos.receipt', $transaction->id),
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkTransactionStatus($id)
    {
        $transaction = PosTransaction::findOrFail($id);

        if ($transaction->payment_status === 'pending') {
            try {
                $va = \App\Models\Setting::get('ipaymu_va', '0000002447990145');
                $apiKey = \App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
                $isProd = \App\Models\Setting::get('ipaymu_is_production', '0') == '1';
                $baseUrl = $isProd ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';
                $endpoint = $baseUrl . '/api/v2/transaction';

                $body = ['transactionId' => $transaction->invoice_number];
                $jsonBody = json_encode($body);
                $bodyHash = strtolower(hash('sha256', $jsonBody));
                $timestamp = date('YmdHis');
                $stringToSign = "POST:" . $va . ":" . $bodyHash . ":" . $apiKey;
                $signature = hash_hmac('sha256', $stringToSign, $apiKey);

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'va' => $va,
                    'signature' => $signature,
                    'timestamp' => $timestamp,
                ])->post($endpoint, $body);

                if ($response->successful()) {
                    $res = $response->json();
                    if (isset($res['Data']['Status']) && ($res['Data']['Status'] == 1 || strtolower($res['Data']['StatusName'] ?? '') === 'berhasil')) {
                        $transaction->payment_status = 'paid';
                        $transaction->save();
                    }
                }
            } catch (\Throwable $t) {}
        }

        $isPaid = ($transaction->payment_status === 'paid' || $transaction->payment_status === 'settlement' || empty($transaction->payment_status));

        return response()->json([
            'success' => true,
            'payment_status' => $transaction->payment_status ?: 'paid',
            'is_paid' => $isPaid,
            'invoice_number' => $transaction->invoice_number,
        ]);
    }

    public function showReceipt($id)
    {
        $transaction = PosTransaction::with('items')->findOrFail($id);
        return view('admin.pos.receipt', compact('transaction'));
    }

    public function productsIndex()
    {
        $this->ensureSeedProducts();

        // Optimized Single-Query SQL Aggregates (Fast database-level calculation)
        $metrics = DB::table('products')
            ->where('is_active', true)
            ->selectRaw('
                SUM(CASE WHEN COALESCE(is_track_stock, 1) = 1 THEN stock * COALESCE(cost_price, 0) ELSE 0 END) as total_asset_value,
                SUM(CASE WHEN COALESCE(is_track_stock, 1) = 1 THEN stock * price ELSE 0 END) as total_potential_revenue,
                COUNT(CASE WHEN COALESCE(is_track_stock, 1) = 1 AND stock <= 5 THEN 1 END) as low_stock_count
            ')
            ->first();

        $totalAssetValue = (float)($metrics->total_asset_value ?? 0);
        $totalPotentialRevenue = (float)($metrics->total_potential_revenue ?? 0);
        $totalPotentialProfit = max(0, $totalPotentialRevenue - $totalAssetValue);
        $lowStockCount = (int)($metrics->low_stock_count ?? 0);

        // Fetch products using indexed sort
        $products = Product::where('is_active', true)->orderBy('category')->orderBy('name')->get();

        // Fast Pending PO Count Query
        $pendingPoCount = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('purchase_orders')) {
                $pendingPoCount = DB::table('purchase_orders')->whereIn('status', ['draft', 'sent'])->count();
            }
        } catch (\Throwable $t) {}

        return view('admin.pos.products', compact(
            'products', 'totalAssetValue', 'totalPotentialRevenue',
            'totalPotentialProfit', 'lowStockCount', 'pendingPoCount'
        ));
    }

    public function printBarcodeLabel($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.pos.barcode_print', compact('product'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'code' => 'nullable|string|unique:products,code',
            'barcode' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:5120',
            'description' => 'nullable|string',
        ]);

        if (empty($validated['code'])) {
            $nextId = (Product::max('id') ?: 0) + 1;
            $validated['code'] = 'PRD-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
        if (empty($validated['barcode'])) {
            $validated['barcode'] = $validated['code'];
        }
        if (empty($validated['unit'])) {
            $validated['unit'] = 'Pcs';
        }
        if (empty($validated['cost_price'])) {
            $validated['cost_price'] = 0;
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $uploadDir = public_path('uploads/products');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = 'prod_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $validated['image'] = '/uploads/products/' . $fileName;
        }

        unset($validated['image_file']);
        Product::create($validated);
        return redirect()->route('admin.pos.products')->with('success', 'Produk POS standar berhasil ditambahkan!');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'code' => 'required|string|max:100|unique:products,code,' . $product->id,
            'barcode' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:5120',
            'description' => 'nullable|string',
        ]);

        if (empty($validated['barcode'])) {
            $validated['barcode'] = $validated['code'];
        }
        if (!isset($validated['stock'])) {
            $validated['stock'] = $product->stock;
        }
        if (!isset($validated['cost_price'])) {
            $validated['cost_price'] = $product->cost_price;
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $uploadDir = public_path('uploads/products');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = 'prod_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $validated['image'] = '/uploads/products/' . $fileName;
        }

        unset($validated['image_file']);
        if ($request->has('is_track_stock')) {
            $validated['is_track_stock'] = (bool)$request->input('is_track_stock');
        }
        $product->update($validated);
        return redirect()->route('admin.pos.products')->with('success', 'Data produk "' . $product->name . '" berhasil diperbarui!');
    }

    /**
     * Stock Opname Adjustment Audit
     */
    public function stockOpname(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'new_stock' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ]);

        $prevStock = $product->stock;
        $newStock = (int)$validated['new_stock'];
        $diff = $newStock - $prevStock;

        $product->stock = $newStock;
        $product->save();

        // Record Inventory Log
        InventoryLog::create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'type' => $diff >= 0 ? 'in' : 'out',
            'qty' => abs($diff),
            'previous_stock' => $prevStock,
            'current_stock' => $newStock,
            'notes' => "Stock Opname Studio (" . ($diff >= 0 ? "+".$diff : $diff) . " Pcs) - Alasan: " . $validated['reason'],
            'created_by' => auth()->user()->name ?? 'Admin Studio',
        ]);

        return redirect()->back()->with('success', 'Stock Opname "' . $product->name . '" berhasil diperbarui! Stok dari ' . $prevStock . ' Pcs menjadi ' . $newStock . ' Pcs.');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_active' => false]);
        return redirect()->route('admin.pos.products')->with('success', 'Produk "' . $product->name . '" berhasil dihapus dari katalog!');
    }

    private function ensureSeedProducts()
    {
        if (Product::count() === 0) {
            $defaultProducts = [
                ['code' => 'SUP-01', 'name' => 'Whey Protein Isolate 1 Scoop (Shake)', 'category' => 'Suplemen & Minuman', 'price' => 25000, 'stock' => 100],
                ['code' => 'SUP-02', 'name' => 'Creatine Monohydrate 5g (Pre-Workout)', 'category' => 'Suplemen & Minuman', 'price' => 15000, 'stock' => 100],
                ['code' => 'DRK-01', 'name' => 'Air Mineral Aqua 600ml', 'category' => 'Suplemen & Minuman', 'price' => 5000, 'stock' => 200],
                ['code' => 'DRK-02', 'name' => 'Pocari Sweat Isotonik 500ml', 'category' => 'Suplemen & Minuman', 'price' => 10000, 'stock' => 150],
                ['code' => 'TKT-01', 'name' => 'Tiket Masuk Gym Harian (Drop-In Non-Member)', 'category' => 'Tiket Harian', 'price' => 35000, 'stock' => 999],
                ['code' => 'TKT-02', 'name' => 'Tiket Kolam Renang Harian', 'category' => 'Tiket Harian', 'price' => 25000, 'stock' => 999],
                ['code' => 'ACC-01', 'name' => 'Sewa Handuk Gym Steril', 'category' => 'Perlengkapan & Sewa', 'price' => 10000, 'stock' => 50],
                ['code' => 'ACC-02', 'name' => 'Shaker Bottle FitLife 700ml', 'category' => 'Perlengkapan & Sewa', 'price' => 65000, 'stock' => 30],
                ['code' => 'ACC-03', 'name' => 'Kacamata Renang Anti-Fog', 'category' => 'Perlengkapan & Sewa', 'price' => 85000, 'stock' => 20],
            ];

            foreach ($defaultProducts as $p) {
                Product::create($p);
            }
        }
    }
}
