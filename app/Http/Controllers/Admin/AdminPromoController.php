<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class AdminPromoController extends Controller
{
    public function index()
    {
        $promos = PromoCode::orderByDesc('created_at')->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'title' => 'required|string|max:255',
            'type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'max_uses' => 'required|integer|min:1',
            'expires_at' => 'nullable|date',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        PromoCode::create($validated);

        return redirect()->route('admin.promos.index')
            ->with('success', 'Kode Promo Voucher "' . $validated['code'] . '" BERHASIL DITAMBAHKAN!');
    }

    public function destroy($id)
    {
        $promo = PromoCode::findOrFail($id);
        $code = $promo->code;
        $promo->delete();

        return redirect()->route('admin.promos.index')
            ->with('success', 'Voucher Promo "' . $code . '" telah dihapus.');
    }
}
