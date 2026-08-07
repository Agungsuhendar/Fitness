<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PosTransaction;
use App\Models\PosTransactionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPosController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureSeedProducts();

        $category = $request->input('category', 'all');
        $q = trim($request->input('q'));

        $query = Product::where('is_active', true);
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        if ($q) {
            $query->where(function($b) use ($q) {
                $b->where('name', 'like', "%{$q}%")
                  ->orWhere('code', 'like', "%{$q}%");
            });
        }

        $products = $query->orderBy('name')->get();
        $categories = Product::select('category')->distinct()->pluck('category');

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

                // Deduct stock & Record Inventory Log
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

            $transaction = PosTransaction::create([
                'invoice_number' => $invNo,
                'member_name' => $validated['member_name'] ?: 'Pelanggan Umum (Guest)',
                'member_phone' => $validated['member_phone'] ?: '-',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'pay_amount' => $payAmount,
                'change_amount' => $changeAmount,
                'payment_method' => $validated['payment_method'],
                'transacted_at' => now(),
            ]);

            foreach ($itemsData as $item) {
                $item['pos_transaction_id'] = $transaction->id;
                PosTransactionItem::create($item);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi POS Kasir BERHASIL! Struk kuitansi tercetak.',
                'transaction' => $transaction->load('items'),
                'receipt_url' => route('admin.pos.receipt', $transaction->id),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showReceipt($id)
    {
        $transaction = PosTransaction::with('items')->findOrFail($id);
        return view('admin.pos.receipt', compact('transaction'));
    }

    public function productsIndex()
    {
        $this->ensureSeedProducts();
        $products = Product::orderBy('category')->orderBy('name')->get();
        return view('admin.pos.products', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:products,code',
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($validated);
        return redirect()->route('admin.pos.products')->with('success', 'Produk POS berhasil ditambahkan!');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);
        return redirect()->route('admin.pos.products')->with('success', 'Produk POS berhasil diperbarui!');
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
