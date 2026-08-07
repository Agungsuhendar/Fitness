<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminInventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::orderByDesc('created_at')->paginate(20);
        $products = Product::orderBy('name')->get();

        return view('admin.inventory_log.index', compact('logs', 'products'));
    }

    public function storeRestock(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::findOrFail($validated['product_id']);
            $prevStock = $product->stock;
            $product->stock = $prevStock + $validated['qty'];
            $product->save();

            InventoryLog::create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'type' => 'in',
                'qty' => $validated['qty'],
                'previous_stock' => $prevStock,
                'current_stock' => $product->stock,
                'notes' => $validated['notes'] ?: 'Restok Suplemen / Barang Tambahan Supplier',
                'created_by' => auth()->user()->name ?? 'Admin',
            ]);

            DB::commit();

            return redirect()->route('admin.inventory-log.index')
                ->with('success', 'Restok barang "' . $product->name . '" sebanyak ' . $validated['qty'] . ' unit BERHASIL DITAMBAHKAN!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses restok stok: ' . $e->getMessage());
        }
    }
}
