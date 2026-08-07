@extends('admin.layout')

@section('title', 'Kartu Stok & Mutasi Barang POS - Admin FitLife Center')
@section('header_title', 'Kartu Stok & Audit Mutasi Barang Toko POS')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.35rem; color: #0f172a; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📦 Kartu Stok &amp; Log Mutasi Barang POS Kasir
            </h3>
            <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                Audit riwayat barang masuk dari supplier &amp; barang keluar terpotong otomatis dari penjualan kasir.
            </p>
        </div>
    </div>

    <!-- Restock Form Box -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <h4 style="font-size: 1.05rem; color: #03045e; margin-bottom: 1rem; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-boxes-packing" style="color: #0284c7;"></i> + Form Input Restok Barang Masuk (Supplier)
        </h4>

        <form action="{{ route('admin.inventory-log.restock') }}" method="POST" style="display: grid; grid-template-columns: 2fr 1fr 3fr auto; gap: 1rem; align-items: end;">
            @csrf
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">PILIH PRODUK / BARANG *</label>
                <select name="product_id" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->name }} (Stok Saat Ini: {{ $prod->stock }} unit)</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">JUMLAH RESTOK (+QTY) *</label>
                <input type="number" name="qty" placeholder="e.g. 24" required min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">CATATAN / SUPPLIER / NO. SURAT JALAN</label>
                <input type="text" name="notes" placeholder="e.g. Pembelian Restok Whey Protein dari PT Optimum Nutrition" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; font-weight: 900; padding: 0.65rem 1.25rem;">
                    + Input Restok
                </button>
            </div>
        </form>
    </div>

    <!-- Inventory Logs Table -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569;">
                        <th style="padding: 0.85rem 1rem;">WAKTU &amp; DIBUAT OLEH</th>
                        <th style="padding: 0.85rem 1rem;">NAMA PRODUK</th>
                        <th style="padding: 0.85rem 1rem;">JENIS MUTASI</th>
                        <th style="padding: 0.85rem 1rem;">QTY</th>
                        <th style="padding: 0.85rem 1rem;">STOK SEBELUM → SESUDAH</th>
                        <th style="padding: 0.85rem 1rem;">CATATAN KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 0.85rem 1rem;">
                            <div style="font-weight: 800; color: #0f172a;">{{ $log->created_at->format('d M Y, H:i') }}</div>
                            <div style="font-size: 0.75rem; color: #64748b;">Oleh: {{ $log->created_by }}</div>
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: #0284c7;">
                            📦 {{ $log->product_name }}
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            @if($log->type === 'in')
                                <span style="background: #dcfce7; color: #166534; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                                    🟢 BARANG MASUK (RESTOK)
                                </span>
                            @elseif($log->type === 'out')
                                <span style="background: #fee2e2; color: #991b1b; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                                    🔴 BARANG KELUAR (KASIR POS)
                                </span>
                            @else
                                <span style="background: #e0f2fe; color: #0369a1; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                                    🔵 AUDIT PENYESUAIAN
                                </span>
                            @endif
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; font-size: 0.95rem; color: {{ $log->type === 'in' ? '#16a34a' : '#ef4444' }};">
                            {{ $log->type === 'in' ? '+' : '-' }}{{ $log->qty }} Unit
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 800; font-family: monospace;">
                            {{ $log->previous_stock }} → <span style="color: #0284c7; font-weight: 900;">{{ $log->current_stock }}</span>
                        </td>
                        <td style="padding: 0.85rem 1rem; font-size: 0.8rem; color: #475569;">
                            {{ $log->notes }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.25rem;">
            {{ $logs->links() }}
        </div>
    </div>

</div>
@endsection
