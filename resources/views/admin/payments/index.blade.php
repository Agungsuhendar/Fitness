@extends('layouts.app')

@section('title', 'Dashboard Approval Pembayaran Admin & Kasir | FitLife Center Yogyakarta')
@section('meta_description', 'Gerbang persetujuan verifikasi pembayaran bukti transfer bank / QRIS kasir FitLife Center Yogyakarta.')

@section('content')
<!-- Admin Payments Header Banner -->
<section style="padding: 3.5rem 0 2.5rem; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.35rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; margin-bottom: 0.75rem;">
                    <i class="fa-solid fa-shield-check"></i>
                    <span>PAYMENT APPROVAL GATEKEEPER</span>
                </div>
                <h1 style="font-size: 2.2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem;">
                    Dashboard Approval Pembayaran &amp; Kasir
                </h1>
                <p style="color: #94a3b8; font-size: 0.95rem; margin: 0;">
                    Verifikasi bukti transfer bank / QRIS member, atur status lunas (APPROVE), dan terbitkan e-Kuitansi resmi.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Main Section -->
<section style="background: #060907; padding: 3rem 0 6rem; color: white;">
    <div class="container">
        
        <!-- Metrics Cards -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;" class="grid-2">
            <div style="background: #0d1310; border: 1.5px solid rgba(132,204,22,0.4); border-radius: 1.25rem; padding: 1.5rem;">
                <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800;">TOTAL OMSET LUNAS (VERIFIED)</span>
                <div style="font-size: 2rem; font-weight: 900; color: #84cc16; margin-top: 0.25rem; font-family: 'Outfit', sans-serif;">
                    Rp {{ number_format($stats->total_verified_revenue, 0, ',', '.') }}
                </div>
                <span style="font-size: 0.75rem; color: #94a3b8;">● Tercatat Kasir Studio</span>
            </div>

            <div style="background: #0d1310; border: 1.5px solid rgba(251, 191, 36, 0.4); border-radius: 1.25rem; padding: 1.5rem;">
                <span style="font-size: 0.75rem; color: #fbbf24; font-weight: 800;">MENUNGGU VERIFIKASI (PENDING)</span>
                <div style="font-size: 2rem; font-weight: 900; color: #fbbf24; margin-top: 0.25rem;">
                    {{ $stats->pending_count }} Transaksi
                </div>
                <span style="font-size: 0.75rem; color: #fbbf24;">● Perlu Tindakan Approval</span>
            </div>

            <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.5rem;">
                <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 800;">TRANSAKSI APPROVED</span>
                <div style="font-size: 2rem; font-weight: 900; color: #38bdf8; margin-top: 0.25rem;">
                    {{ $stats->approved_count }} Pembayaran
                </div>
                <span style="font-size: 0.75rem; color: #38bdf8;">● Member Aktif VIP</span>
            </div>
        </div>

        <!-- Payments Table -->
        <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.35rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0;">
                    <i class="fa-solid fa-receipt" style="color: #84cc16;"></i> Antrean Verifikasi Pembayaran Member
                </h3>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.04); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                            <th style="padding: 0.85rem 1rem;">ID / NO INVOICE</th>
                            <th style="padding: 0.85rem 1rem;">MEMBER &amp; PAKET</th>
                            <th style="padding: 0.85rem 1rem;">TOTAL NETTO</th>
                            <th style="padding: 0.85rem 1rem;">METODE</th>
                            <th style="padding: 0.85rem 1rem;">STATUS</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">APPROVAL KASIR</th>
                        </tr>
                    </thead>
                    <tbody style="color: #cbd5e1;">
                        @foreach($payments as $pay)
                        <tr id="payRow-{{ $pay->id }}" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1rem 1rem;">
                                <div style="font-family: monospace; font-weight: 800; color: #84cc16;">{{ $pay->inv_number }}</div>
                                <div style="font-size: 0.725rem; color: #94a3b8;">{{ $pay->date }}</div>
                            </td>
                            <td style="padding: 1rem 1rem;">
                                <div style="font-weight: 900; color: white;">{{ $pay->member_name }}</div>
                                <div style="font-size: 0.8rem; color: #94a3b8;">{{ $pay->package }}</div>
                            </td>
                            <td style="padding: 1rem 1rem; font-family: monospace; font-weight: 900; color: #84cc16; font-size: 1rem;">
                                Rp {{ number_format($pay->amount, 0, ',', '.') }}
                                <div style="font-size: 0.7rem; color: #cbd5e1;">Voucher: {{ $pay->promo }}</div>
                            </td>
                            <td style="padding: 1rem 1rem; font-size: 0.825rem;">
                                {{ $pay->method }}
                            </td>
                            <td style="padding: 1rem 1rem;" id="statusBadge-{{ $pay->id }}">
                                @if(str_contains($pay->status, 'APPROVED'))
                                    <span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px;">
                                        ✔ {{ $pay->status }}
                                    </span>
                                @else
                                    <span style="background: rgba(251, 191, 36, 0.2); color: #fbbf24; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px;">
                                        ⏳ {{ $pay->status }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1rem; text-align: right;">
                                <div style="display: flex; gap: 0.4rem; justify-content: flex-end; flex-wrap: wrap;">
                                    <a href="{{ route('invoice.show', ['id' => 'FL-MBR-7782']) }}" target="_blank" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.15); padding: 0.4rem 0.75rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; text-decoration: none;">
                                        📄 Invoice
                                    </a>
                                    
                                    @if(!str_contains($pay->status, 'APPROVED'))
                                    <button type="button" onclick="approvePaymentAction('{{ $pay->id }}')" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.4rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 900; cursor: pointer; box-shadow: 0 0 10px rgba(132,204,22,0.4);">
                                        ✅ APPROVE
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>

<script>
    function approvePaymentAction(payId) {
        if (!confirm('Apakah Anda yakin telah mengecek mutasi dan mengonfirmasi LUNAS pembayaran ini?')) return;

        fetch('/admin/payments/' + payId + '/approve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            const badge = document.getElementById('statusBadge-' + payId);
            if (badge) {
                badge.innerHTML = '<span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px;">✔ LUNAS (APPROVED)</span>';
            }
        });
    }
</script>
@endsection
