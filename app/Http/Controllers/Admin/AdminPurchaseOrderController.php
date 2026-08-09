<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Product;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        PurchaseOrder::ensureTable();

        $status = $request->input('status', 'all');
        $q = trim($request->input('q'));

        $query = PurchaseOrder::with('items')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($q) {
            $query->where(function($b) use ($q) {
                $b->where('po_number', 'like', "%{$q}%")
                  ->orWhere('supplier_name', 'like', "%{$q}%")
                  ->orWhere('supplier_phone', 'like', "%{$q}%");
            });
        }

        $purchaseOrders = $query->paginate(15);

        // Optimized Single-Query PO Metrics
        $poMetrics = DB::table('purchase_orders')
            ->selectRaw('
                COUNT(*) as total_count,
                COUNT(CASE WHEN status IN ("draft", "sent") THEN 1 END) as pending_count,
                COUNT(CASE WHEN status = "received" THEN 1 END) as received_count,
                SUM(CASE WHEN status = "received" THEN total_amount ELSE 0 END) as total_received_amount
            ')
            ->first();

        $totalPoCount = (int)($poMetrics->total_count ?? 0);
        $pendingCount = (int)($poMetrics->pending_count ?? 0);
        $receivedCount = (int)($poMetrics->received_count ?? 0);
        $totalPoAmount = (float)($poMetrics->total_received_amount ?? 0);

        return view('admin.purchase_orders.index', compact(
            'purchaseOrders', 'status', 'q',
            'totalPoCount', 'pendingCount', 'receivedCount', 'totalPoAmount'
        ));
    }

    public function create()
    {
        PurchaseOrder::ensureTable();
        \App\Models\Supplier::ensureTable();

        $products = Product::where('is_active', true)->orderBy('name')->get();
        $suppliers = \App\Models\Supplier::where('is_active', true)->orderBy('name')->get();
        $nextPoNo = 'PO-FL-' . date('Ym') . '-' . str_pad((PurchaseOrder::max('id') ?: 0) + 1, 4, '0', STR_PAD_LEFT);

        return view('admin.purchase_orders.create', compact('products', 'suppliers', 'nextPoNo'));
    }

    public function storeSupplier(Request $request)
    {
        \App\Models\Supplier::ensureTable();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:100',
            'address' => 'nullable|string',
        ]);

        $supplier = \App\Models\Supplier::firstOrCreate(
            ['name' => $validated['name']],
            [
                'phone' => $validated['phone'] ?? null,
                'email' => $validated['email'] ?? null,
                'address' => $validated['address'] ?? null,
                'is_active' => true,
            ]
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'supplier' => $supplier]);
        }

        return redirect()->back()->with('success', 'Suplier baru ' . $supplier->name . ' berhasil ditambahkan!');
    }

    public function store(Request $request)
    {
        PurchaseOrder::ensureTable();

        $validated = $request->validate([
            'po_number' => 'required|string|unique:purchase_orders,po_number',
            'supplier_name' => 'required|string|max:255',
            'supplier_phone' => 'nullable|string|max:50',
            'order_date' => 'required|date',
            'expected_delivery_date' => 'nullable|date',
            'payment_status' => 'required|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.qty_ordered' => 'required|integer|min:1',
            'items.*.cost_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = 0;
            $itemsToCreate = [];

            foreach ($validated['items'] as $row) {
                $product = Product::findOrFail($row['product_id']);
                $qty = (int)$row['qty_ordered'];
                $cost = (float)$row['cost_price'];
                $subtotal = $qty * $cost;
                $totalAmount += $subtotal;

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'qty_ordered' => $qty,
                    'qty_received' => 0,
                    'cost_price' => $cost,
                    'subtotal' => $subtotal,
                ];
            }

            $po = PurchaseOrder::create([
                'po_number' => $validated['po_number'],
                'supplier_name' => $validated['supplier_name'],
                'supplier_phone' => $validated['supplier_phone'] ?? null,
                'order_date' => $validated['order_date'],
                'expected_delivery_date' => $validated['expected_delivery_date'] ?? null,
                'status' => 'sent',
                'payment_status' => $validated['payment_status'],
                'total_amount' => $totalAmount,
                'notes' => $validated['notes'] ?? null,
                'created_by' => auth()->user()->name ?? 'Admin Studio',
            ]);

            // Auto save/update supplier in database
            \App\Models\Supplier::firstOrCreate(
                ['name' => $validated['supplier_name']],
                ['phone' => $validated['supplier_phone'] ?? null, 'is_active' => true]
            );

            foreach ($itemsToCreate as $item) {
                $item['purchase_order_id'] = $po->id;
                PurchaseOrderItem::create($item);
            }

            DB::commit();
            return redirect()->route('admin.purchase-orders.show', $po->id)->with('success', 'Surat Pesanan PO Supplier berhasil diterbitkan!');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menerbitkan PO: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        PurchaseOrder::ensureTable();
        $po = PurchaseOrder::with('items.product')->findOrFail($id);
        return view('admin.purchase_orders.show', compact('po'));
    }

    /**
     * Audit Goods Receipt (Terima Barang Supplier) - Partial & Reject Support & Replacement Goods
     */
    public function receiveGoods(Request $request, $id)
    {
        PurchaseOrder::ensureTable();
        $po = PurchaseOrder::with('items')->findOrFail($id);

        if ($po->status === 'received' || $po->status === 'cancelled') {
            return redirect()->back()->with('error', 'PO Supplier ini sudah 100% selesai sempurna atau dibatalkan.');
        }

        $itemsData = $request->input('items', []);
        $receiptNotes = trim($request->input('receipt_notes'));

        DB::beginTransaction();
        try {
            $totalOrderedPo = 0;
            $totalReceivedPo = 0;
            $totalRejectedPo = 0;

            foreach ($po->items as $item) {
                $itemInput = $itemsData[$item->id] ?? null;
                
                $qtyRemaining = max(0, $item->qty_ordered - $item->qty_received);
                $defaultSuggest = $qtyRemaining > 0 ? $qtyRemaining : ($item->qty_rejected ?? 0);

                $qtyNowReceived = isset($itemInput['qty_received']) ? (int)$itemInput['qty_received'] : $defaultSuggest;
                $qtyNowRejected = isset($itemInput['qty_rejected']) ? (int)$itemInput['qty_rejected'] : 0;
                $rejectReason = isset($itemInput['reject_reason']) ? trim($itemInput['reject_reason']) : null;

                $qtyNowReceived = max(0, $qtyNowReceived);
                $qtyNowRejected = max(0, $qtyNowRejected);

                $product = Product::find($item->product_id);
                if ($product && $qtyNowReceived > 0) {
                    $prevStock = $product->stock;
                    $prevHpp = $product->cost_price;

                    // Recalculate HPP using Moving Average formula & add stock
                    $newHpp = $product->recalculateMovingAverageHpp($qtyNowReceived, $item->cost_price);

                    $logNote = "Penerimaan PO " . $po->po_number . " (" . $qtyNowReceived . " Pcs diterima";
                    if ($po->status === 'received_with_reject') {
                        $logNote .= " [Barang Pengganti Retur Supplier]";
                    }
                    if ($qtyNowRejected > 0) {
                        $logNote .= ", " . $qtyNowRejected . " Pcs ditolak: " . ($rejectReason ?: 'Rusak');
                    }
                    $logNote .= ") - HPP: Rp " . number_format($prevHpp,0,',','.') . " -> Rp " . number_format($newHpp,0,',','.');

                    // Record in Inventory Audit Log
                    InventoryLog::create([
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'type' => 'in',
                        'qty' => $qtyNowReceived,
                        'previous_stock' => $prevStock,
                        'current_stock' => $product->stock,
                        'notes' => $logNote,
                        'created_by' => auth()->user()->name ?? 'Admin Studio',
                    ]);
                }

                $newCumulativeReceived = $item->qty_received + $qtyNowReceived;
                $newCumulativeRejected = max(0, ($item->qty_rejected ?? 0) - $qtyNowReceived + $qtyNowRejected);

                $item->update([
                    'qty_received' => $newCumulativeReceived,
                    'qty_rejected' => $newCumulativeRejected,
                    'reject_reason' => $rejectReason ?: $item->reject_reason,
                ]);

                $totalOrderedPo += $item->qty_ordered;
                $totalReceivedPo += $newCumulativeReceived;
                $totalRejectedPo += $newCumulativeRejected;
            }

            // Determine PO status
            if ($totalReceivedPo >= $totalOrderedPo && $totalRejectedPo == 0) {
                $po->status = 'received';
            } else if (($totalReceivedPo + $totalRejectedPo) >= $totalOrderedPo && $totalRejectedPo > 0) {
                $po->status = 'received_with_reject';
            } else if ($totalReceivedPo > 0 || $totalRejectedPo > 0) {
                $po->status = 'partial';
            }

            if ($receiptNotes) {
                $po->notes = ($po->notes ? $po->notes . "\n" : "") . "[Audited " . date('Y-m-d H:i') . "]: " . $receiptNotes;
            }

            $po->received_at = now();
            $po->save();

            DB::commit();

            $statusText = $po->status === 'received' ? 'FULL RECEIVED (Selesai 100% Sempurna)' : ($po->status === 'received_with_reject' ? 'RECEIVED WITH REJECT (Selesai Ada Retur)' : 'PARTIAL RECEIVED (Diterima Sebagian)');
            return redirect()->route('admin.purchase-orders.show', $po->id)->with('success', 'Penerimaan Barang PO berhasil di-audit! Status PO: ' . $statusText . '. Stok & HPP Moving Average diperbarui.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses audit penerimaan barang: ' . $e->getMessage());
        }
    }
}
