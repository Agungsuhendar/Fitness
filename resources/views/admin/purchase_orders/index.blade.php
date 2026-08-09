@extends('admin.layout')

@section('title', 'Surat Pesanan PO Supplier - Admin FitLife Center')
@section('header_title', 'Sistem Purchase Order (PO) & Penerimaan Barang Supplier')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(34, 197, 94, 0.15); border: 1.5px solid #4ade80; color: #4ade80; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 1rem 1.25rem; background: rgba(239, 68, 68, 0.15); border: 1.5px solid #ef4444; color: #fca5a5; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <!-- Header Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🚚 Sistem Purchase Order (PO) Supplier
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Terbitkan pesanan pembelian barang ke vendor, audit penerimaan barang, &amp; otomatisasi Moving Average HPP Modal.
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <a href="{{ route('admin.purchase-orders.create') }}" class="btn" style="background: var(--brand-lime, #84cc16); color: #060907; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; box-shadow: 0 0 20px rgba(132, 204, 22, 0.35);">
                <i class="fa-solid fa-plus-circle"></i> + Terbitkan PO Baru
            </a>

            <a href="{{ route('admin.pos.products') }}" class="btn" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1.5px solid #38bdf8; border-radius: 99px; font-weight: 900; text-decoration: none; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-boxes-stacked"></i> Lihat Katalog Produk
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">TOTAL PO DITERBITKAN</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($totalPoCount) }} Dokumen
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #eab308; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #eab308; font-weight: 800; text-transform: uppercase;">PO PENDING / PROSES</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($pendingCount) }} Pesanan
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">PO SELESAI (TERIMA BARANG)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($receivedCount) }} Pesanan
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #38bdf8; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">TOTAL NILAI PEMBELIAN</span>
            <div style="font-size: 1.45rem; font-weight: 900; color: #38bdf8; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($totalPoAmount, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <!-- PO Table -->
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.775rem; text-transform: uppercase;">
                        <th style="padding: 1rem;">No. PO</th>
                        <th style="padding: 1rem;">Supplier / Vendor</th>
                        <th style="padding: 1rem;">Tgl Pesan</th>
                        <th style="padding: 1rem;">Total Nilai (Rp)</th>
                        <th style="padding: 1rem;">Status PO</th>
                        <th style="padding: 1rem;">Status Bayar</th>
                        <th style="padding: 1rem; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchaseOrders as $po)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem;">
                            <a href="{{ route('admin.purchase-orders.show', $po->id) }}" style="font-weight: 900; font-family: monospace; color: #84cc16; font-size: 0.9rem; text-decoration: none;">
                                {{ $po->po_number }}
                            </a>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 800; color: #ffffff;">{{ $po->supplier_name }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ $po->supplier_phone ?: '-' }}</div>
                        </td>
                        <td style="padding: 1rem; color: #cbd5e1; font-size: 0.85rem;">
                            {{ $po->order_date ? $po->order_date->format('d M Y') : '-' }}
                        </td>
                        <td style="padding: 1rem; font-weight: 900; color: #38bdf8;">
                            Rp {{ number_format($po->total_amount, 0, ',', '.') }}
                        </td>
                        <td style="padding: 1rem;">
                            @if($po->status === 'received')
                                <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid #84cc16;">
                                    🟢 Full Received (Selesai 100%)
                                </span>
                            @elseif($po->status === 'received_with_reject')
                                <span style="background: rgba(234, 88, 12, 0.15); color: #f97316; font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid #f97316;">
                                    🟠 Received (Ada Retur/Rusak)
                                </span>
                            @elseif($po->status === 'partial')
                                <span style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid #38bdf8;">
                                    🔵 Partial (Diterima Sebagian)
                                </span>
                            @else
                                <span style="background: rgba(234, 179, 8, 0.15); color: #eab308; font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid #eab308;">
                                    ⏳ Dalam Pengiriman
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
                            <span style="background: {{ $po->payment_status === 'paid' ? 'rgba(34, 197, 94, 0.15)' : 'rgba(239, 68, 68, 0.15)' }}; color: {{ $po->payment_status === 'paid' ? '#4ade80' : '#f87171' }}; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid {{ $po->payment_status === 'paid' ? '#4ade80' : '#f87171' }}; text-transform: uppercase;">
                                {{ $po->payment_status }}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: right;">
                            <a href="{{ route('admin.purchase-orders.show', $po->id) }}" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.4rem 0.85rem; border-radius: 8px; font-weight: 800; font-size: 0.775rem; text-decoration: none;">
                                📄 Rincian PO &amp; Audit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding: 2.5rem; text-align: center; color: #94a3b8;">
                            Belum ada dokumen PO Supplier diterbitkan. Klik <strong>+ Terbitkan PO Baru</strong> di atas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
