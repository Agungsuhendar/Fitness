@extends('admin.layout')

@section('title', 'Dokumen PO ' . $po->po_number . ' - Admin FitLife Center')
@section('header_title', 'Surat Pesanan Pembelian (Purchase Order)')

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
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;" class="no-print">
        <div>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📄 Dokumen Surat Purchase Order (PO)
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                No. PO: <strong style="color: #84cc16;">{{ $po->po_number }}</strong> • Diterbitkan oleh: {{ $po->created_by ?: 'Admin Studio' }}
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            @if($po->status !== 'received' && $po->status !== 'cancelled')
            <button type="button" onclick="openReceiveGoodsModal()" class="btn glow-btn" style="background: {{ $po->status === 'received_with_reject' ? 'linear-gradient(135deg, #f97316 0%, #ea580c 100%)' : 'linear-gradient(135deg, #84cc16 0%, #22c55e 100%)' }}; color: {{ $po->status === 'received_with_reject' ? '#ffffff' : '#060907' }} !important; border: none; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 20px {{ $po->status === 'received_with_reject' ? 'rgba(249, 115, 22, 0.4)' : 'rgba(132, 204, 22, 0.4)' }};">
                @if($po->status === 'received_with_reject')
                    <i class="fa-solid fa-rotate-left"></i> 🔁 TERIMA BARANG PENGGANTI RETUR (REPLACEMENT)
                @else
                    <i class="fa-solid fa-box-open"></i> 📥 AUDIT &amp; TERIMA BARANG (PARTIAL / REJECT)
                @endif
            </button>
            @endif

            <button onclick="window.print()" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; cursor: pointer;">
                🖨️ Cetak Dokumen PO
            </button>

            <a href="{{ route('admin.purchase-orders.index') }}" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; text-decoration: none;">
                ← Kembali
            </a>
        </div>
    </div>

    <!-- Official PO Sheet -->
    <div style="background: #ffffff; color: #0f172a; border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 25px 50px rgba(0,0,0,0.8);" id="poDocumentSheet">
        
        <!-- Document Header -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #e2e8f0; padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <h2 style="font-size: 1.6rem; font-weight: 900; color: #0f172a; font-family: 'Outfit', sans-serif; margin: 0 0 0.25rem;">
                    FITLIFE CENTER YOGYAKARTA
                </h2>
                <div style="font-size: 0.85rem; color: #64748b; line-height: 1.4;">
                    Pusat Kebugaran &amp; Studio POS Kasir Terpadu<br>
                    Jl. Kaliurang KM 5.5 No. 12, Sleman, DIY • Telp/WA: 0812-3456-7890
                </div>
            </div>

            <div style="text-align: right;">
                <span style="font-size: 1.6rem; font-weight: 900; color: #16a34a; font-family: 'Outfit', sans-serif; display: block;">
                    SURAT PURCHASE ORDER
                </span>
                <span style="font-size: 1rem; font-weight: 900; font-family: monospace; color: #0284c7;">
                    NO: {{ $po->po_number }}
                </span>
            </div>
        </div>

        <!-- Supplier & Delivery Meta Info -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.75rem;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 1.15rem; border-radius: 1rem;">
                <span style="font-size: 0.75rem; color: #64748b; font-weight: 800; text-transform: uppercase; display: block; margin-bottom: 0.35rem;">KEPADA VENDOR / SUPPLIER:</span>
                <div style="font-size: 1.1rem; font-weight: 900; color: #0f172a;">{{ $po->supplier_name }}</div>
                <div style="font-size: 0.85rem; color: #475569;">No. Kontak: {{ $po->supplier_phone ?: '-' }}</div>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 1.15rem; border-radius: 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 800; text-transform: uppercase; display: block;">TGL PEMESANAN:</span>
                    <strong style="color: #0f172a; font-size: 0.95rem;">{{ $po->order_date ? $po->order_date->format('d M Y') : '-' }}</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 800; text-transform: uppercase; display: block;">STATUS PENERIMAAN:</span>
                    @if($po->status === 'received')
                        <strong style="color: #16a34a; font-size: 0.95rem;">🟢 FULL RECEIVED (100% SEMPURNA)</strong>
                    @elseif($po->status === 'received_with_reject')
                        <strong style="color: #ea580c; font-size: 0.95rem;">🟠 RECEIVED WITH REJECT (ADA RETUR/BARANG RUSAK)</strong>
                    @elseif($po->status === 'partial')
                        <strong style="color: #0284c7; font-size: 0.95rem;">🔵 PARTIAL RECEIVED (SEBAGIAN)</strong>
                    @else
                        <strong style="color: #eab308; font-size: 0.95rem;">⏳ PROSES PENGIRIMAN</strong>
                    @endif
                </div>
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 800; text-transform: uppercase; display: block;">STATUS PEMBAYARAN:</span>
                    <strong style="color: {{ $po->payment_status === 'paid' ? '#16a34a' : '#dc2626' }}; font-size: 0.95rem; text-transform: uppercase;">{{ $po->payment_status }}</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 800; text-transform: uppercase; display: block;">DIBUAT OLEH:</span>
                    <strong style="color: #0f172a; font-size: 0.95rem;">{{ $po->created_by ?: 'Admin Studio' }}</strong>
                </div>
            </div>
        </div>

        @if($po->notes)
        <div style="background: #fffbebfb; border: 1px solid #fef08a; padding: 1rem; border-radius: 0.85rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #854d0e;">
            <strong>📝 Catatan PO / Log Audit Penerimaan:</strong><br>
            {!! nl2br(e($po->notes)) !!}
        </div>
        @endif

        <!-- Items Table -->
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem; margin-bottom: 1.5rem;">
            <thead>
                <tr style="background: #f1f5f9; border-bottom: 2px solid #cbd5e1; color: #334155; font-size: 0.8rem; text-transform: uppercase;">
                    <th style="padding: 0.85rem 1rem;">No.</th>
                    <th style="padding: 0.85rem 1rem;">Nama Produk Kasir</th>
                    <th style="padding: 0.85rem 1rem; text-align: center;">Qty Dipesan</th>
                    <th style="padding: 0.85rem 1rem; text-align: center;">Qty Diterima</th>
                    <th style="padding: 0.85rem 1rem; text-align: center;">Qty Ditolak/Rusak</th>
                    <th style="padding: 0.85rem 1rem; text-align: right;">Harga Modal HPP (Rp)</th>
                    <th style="padding: 0.85rem 1rem; text-align: right;">Subtotal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($po->items as $index => $item)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 0.85rem 1rem; font-weight: 800;">{{ $index + 1 }}</td>
                    <td style="padding: 0.85rem 1rem; font-weight: 800; color: #0f172a;">
                        {{ $item->product_name }}
                        @if($item->reject_reason)
                            <div style="font-size: 0.75rem; color: #dc2626; margin-top: 0.2rem;">⚠️ Alasan Reject: {{ $item->reject_reason }}</div>
                        @endif
                    </td>
                    <td style="padding: 0.85rem 1rem; text-align: center; font-weight: 800;">{{ $item->qty_ordered }} Pcs</td>
                    <td style="padding: 0.85rem 1rem; text-align: center; font-weight: 900; color: {{ $item->qty_received > 0 ? '#16a34a' : '#64748b' }};">
                        {{ $item->qty_received }} Pcs
                    </td>
                    <td style="padding: 0.85rem 1rem; text-align: center; font-weight: 900; color: {{ ($item->qty_rejected ?? 0) > 0 ? '#dc2626' : '#94a3b8' }};">
                        {{ $item->qty_rejected ?? 0 }} Pcs
                    </td>
                    <td style="padding: 0.85rem 1rem; text-align: right;">Rp {{ number_format($item->cost_price, 0, ',', '.') }}</td>
                    <td style="padding: 0.85rem 1rem; text-align: right; font-weight: 900; color: #0f172a;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background: #f8fafc; border-top: 2px solid #cbd5e1;">
                    <td colspan="6" style="padding: 1rem; text-align: right; font-weight: 900; font-size: 1rem;">TOTAL NILAI PURCHASE ORDER:</td>
                    <td style="padding: 1rem; text-align: right; font-weight: 900; font-size: 1.25rem; color: #16a34a;">
                        Rp {{ number_format($po->total_amount, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Signature Section -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem; text-align: center; font-size: 0.85rem;">
            <div>
                <p style="margin-bottom: 4rem; color: #64748b;">Disetujui Oleh (Supplier / Vendor):</p>
                <div style="font-weight: 900; color: #0f172a; text-decoration: underline;">( {{ $po->supplier_name }} )</div>
            </div>
            <div>
                <p style="margin-bottom: 4rem; color: #64748b;">Pemohon (Manajer Studio FitLife):</p>
                <div style="font-weight: 900; color: #0f172a; text-decoration: underline;">( {{ $po->created_by ?: 'Admin Studio' }} )</div>
            </div>
        </div>

    </div>

</div>

<!-- Modal Audit Penerimaan Barang (Goods Receipt Audit with Partial & Reject) -->
<div class="modal fade" id="receiveGoodsModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85);">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.25rem; color: white;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-size: 1.15rem; font-weight: 900; color: #ffffff; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-boxes-packing" style="color: #84cc16;"></i> Audit Penerimaan Barang Physical &amp; Verifikasi Stok POS
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeReceiveGoodsModal()"></button>
            </div>
            <form action="{{ route('admin.purchase-orders.receive', $po->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div style="background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); padding: 0.85rem 1.15rem; border-radius: 0.85rem; margin-bottom: 1.25rem; font-size: 0.825rem; color: #38bdf8;">
                        ℹ️ <strong>Standar Audit Penerimaan:</strong> Masukkan jumlah fisik barang yang diterima dengan baik hari ini. Jika ada barang rusak/bocor/expired, masukkan di kolom <strong>Qty Reject</strong> beserta alasannya.
                    </div>

                    <div style="overflow-x: auto; margin-bottom: 1.25rem;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;">
                            <thead>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.75rem; text-transform: uppercase;">
                                    <th style="padding: 0.75rem;">Nama Barang</th>
                                    <th style="padding: 0.75rem; text-align: center;">Dipesan</th>
                                    <th style="padding: 0.75rem; text-align: center;">Sudah Diterima</th>
                                    <th style="padding: 0.75rem; width: 140px;">Qty Diterima Hari Ini</th>
                                    <th style="padding: 0.75rem; width: 130px;">Qty Rusak / Reject</th>
                                    <th style="padding: 0.75rem;">Alasan Reject (Opsional)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($po->items as $item)
                                @php
                                    $remaining = max(0, $item->qty_ordered - $item->qty_received);
                                    $defaultSuggest = $remaining > 0 ? $remaining : ($item->qty_rejected ?? 0);
                                @endphp
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td style="padding: 0.75rem; font-weight: 800; color: #ffffff;">
                                        {{ $item->product_name }}
                                        <div style="font-size: 0.75rem; color: #84cc16;">Modal HPP: Rp {{ number_format($item->cost_price, 0, ',', '.') }}</div>
                                    </td>
                                    <td style="padding: 0.75rem; text-align: center; font-weight: 800; color: #38bdf8;">{{ $item->qty_ordered }} Pcs</td>
                                    <td style="padding: 0.75rem; text-align: center; font-weight: 800; color: #94a3b8;">{{ $item->qty_received }} Pcs</td>
                                    <td style="padding: 0.75rem;">
                                        <input type="number" name="items[{{ $item->id }}][qty_received]" id="recv_qty_{{ $item->id }}" value="{{ $defaultSuggest }}" readonly class="form-control bg-dark text-white border-secondary fw-bold" style="color: #84cc16 !important; background: #142118 !important; cursor: not-allowed;" required>
                                    </td>
                                    <td style="padding: 0.75rem;">
                                        <input type="number" name="items[{{ $item->id }}][qty_rejected]" id="rej_qty_{{ $item->id }}" value="0" min="0" max="{{ $defaultSuggest }}" oninput="autoAdjustReceivedQty({{ $item->id }}, {{ $defaultSuggest }})" class="form-control bg-dark text-white border-secondary fw-bold" style="color: #f87171 !important;" placeholder="0">
                                    </td>
                                    <td style="padding: 0.75rem;">
                                        <input type="text" name="items[{{ $item->id }}][reject_reason]" placeholder="e.g. Botol bocor / Kemasan pecah" class="form-control bg-dark text-white border-secondary" style="font-size: 0.8rem;">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">CATATAN SURAT JALAN KURIR / VERIFIKASI KASIR</label>
                        <textarea name="receipt_notes" rows="2" placeholder="e.g. Diterima oleh Kasir Maya jam 14.00 WIB. No. Surat Jalan Kurir SJ-88912..." class="form-control bg-dark text-white border-secondary"></textarea>
                    </div>
                </div>

                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" onclick="closeReceiveGoodsModal()" style="border-radius: 0.65rem; font-weight: 700;">Batal</button>
                    <button type="submit" class="btn btn-lime" style="border-radius: 0.65rem; font-weight: 900; padding: 0.5rem 1.35rem;">
                        <i class="fa-solid fa-check-circle"></i> Verifikasi &amp; Masukkan Stok Ke Kasir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function autoAdjustReceivedQty(itemId, maxVal) {
    const rejEl = document.getElementById('rej_qty_' + itemId);
    const recvEl = document.getElementById('recv_qty_' + itemId);
    if (rejEl && recvEl) {
        let rej = parseInt(rejEl.value) || 0;
        if (rej < 0) rej = 0;
        if (rej > maxVal) {
            rej = maxVal;
            rejEl.value = maxVal;
        }
        recvEl.value = Math.max(0, maxVal - rej);
    }
}

function openReceiveGoodsModal() {
    const modalEl = document.getElementById('receiveGoodsModal');
    if (modalEl) {
        modalEl.classList.add('show');
        modalEl.style.display = 'block';
    }
}

function closeReceiveGoodsModal() {
    const modalEl = document.getElementById('receiveGoodsModal');
    if (modalEl) {
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
    }
}
</script>

<style>
@media print {
    .no-print, header, nav, sidebar, footer {
        display: none !important;
    }
    body {
        background: white !important;
        color: black !important;
    }
    #poDocumentSheet {
        box-shadow: none !important;
        padding: 0 !important;
    }
}
</style>
@endsection
