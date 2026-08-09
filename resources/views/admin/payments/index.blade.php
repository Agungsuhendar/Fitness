@extends('admin.layout')

@section('title', 'Dashboard Approval Pembayaran Admin & Kasir | FitLife Center Yogyakarta')
@section('header_title', 'Dashboard Approval Pembayaran & Kasir')

@section('admin_content')
<div style="width: 100%;">
    
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
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #ffffff; margin: 0; font-family: 'Outfit', sans-serif;">
                    Riwayat Transaksi &amp; Antrean Verifikasi
                </h3>
                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0.2rem 0 0;">
                    Kelola verifikasi bukti transfer bank / QRIS member, atur status lunas (APPROVE), dan terbitkan e-Kuitansi resmi.
                </p>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.8rem; text-transform: uppercase;">
                        <th style="padding: 1rem;">ID / Invoice</th>
                        <th style="padding: 1rem;">Member</th>
                        <th style="padding: 1rem;">Paket FitLife</th>
                        <th style="padding: 1rem;">Nominal</th>
                        <th style="padding: 1rem;">Metode</th>
                        <th style="padding: 1rem;">Tanggal</th>
                        <th style="padding: 1rem;">Status</th>
                        <th style="padding: 1rem; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $pay)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem; font-weight: 800; color: #84cc16;">
                            {{ $pay->inv_number }}
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 800; color: #ffffff;">{{ $pay->member_name }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ $pay->phone }}</div>
                        </td>
                        <td style="padding: 1rem; color: #e2e8f0;">
                            {{ $pay->package }}
                        </td>
                        <td style="padding: 1rem; font-weight: 900; color: #ffffff;">
                            Rp {{ number_format($pay->amount, 0, ',', '.') }}
                        </td>
                        <td style="padding: 1rem; font-size: 0.8rem; color: #cbd5e1;">
                            <span style="background: rgba(255,255,255,0.08); padding: 0.25rem 0.6rem; border-radius: 6px;">{{ $pay->method }}</span>
                        </td>
                        <td style="padding: 1rem; font-size: 0.8rem; color: #94a3b8;">
                            {{ $pay->date }}
                        </td>
                        <td style="padding: 1rem;" id="statusBadge-{{ $pay->id }}">
                            @if(str_contains(strtolower($pay->status), 'lunas') || str_contains(strtolower($pay->status), 'approved'))
                                <span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px;">✔ LUNAS (APPROVED)</span>
                            @else
                                <span style="background: rgba(251, 191, 36, 0.2); color: #fbbf24; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px;">⏳ MENUNGGU VERIFIKASI</span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('invoice.show', ['id' => $pay->id]) }}" target="_blank" style="background: rgba(255,255,255,0.1); color: #ffffff; border: none; padding: 0.4rem 0.75rem; border-radius: 8px; font-size: 0.8rem; text-decoration: none; font-weight: 700;">
                                    <i class="fa-solid fa-file-invoice"></i> Kuitansi
                                </a>

                                @if(!str_contains(strtolower($pay->status), 'lunas') && !str_contains(strtolower($pay->status), 'approved'))
                                <button onclick="approvePayment('{{ $pay->id }}')" style="background: #84cc16; color: #060907; border: none; padding: 0.4rem 0.85rem; border-radius: 8px; font-weight: 900; font-size: 0.8rem; cursor: pointer;">
                                    <i class="fa-solid fa-circle-check"></i> APPROVE
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

<script>
    function approvePayment(payId) {
        if (!confirm('Apakah Anda yakin ingin menyetujui (APPROVE) pembayaran ID ' + payId + '? Status member akan otomatis diaktifkan dan kuota sesi ditambahkan.')) {
            return;
        }

        fetch('/admin/payments/' + payId + '/approve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            speakAnnouncement('Pembayaran ' + payId + ' Berhasil Di-Approve. Kuota Sesi Member Telah Ditambahkan.');
            alert(data.message);
            const badge = document.getElementById('statusBadge-' + payId);
            if (badge) {
                badge.innerHTML = '<span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px;">✔ LUNAS (APPROVED)</span>';
            }
        });
    }

    function speakAnnouncement(text) {
        if (!('speechSynthesis' in window)) return;
        window.speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 1.0;
        utterance.pitch = 1.0;

        const voices = window.speechSynthesis.getVoices();
        const idVoice = voices.find(v => v.lang.includes('id') || v.lang.includes('ID'));
        if (idVoice) utterance.voice = idVoice;

        window.speechSynthesis.speak(utterance);
    }
</script>
@endsection
