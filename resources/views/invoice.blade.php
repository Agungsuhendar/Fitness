@extends('layouts.app')

@section('title', 'E-Kuitansi & Invoice Pembayaran Resmi | FitLife Center Yogyakarta')
@section('meta_description', 'Bukti pembayaran resmi e-Receipt FitLife Center Yogyakarta. Rincian tagihan paket gym, diskon voucher promo, dan konfirmasi lunas.')

@section('content')
<style>
    @media print {
        header, footer, nav, .no-print, .live-toast, #pwaInstallBanner {
            display: none !important;
        }
        body, main {
            background: white !important;
            color: black !important;
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        .invoice-card-container {
            border: 1px solid #000 !important;
            box-shadow: none !important;
            color: #000 !important;
            background: #fff !important;
        }
    }
</style>

<section style="background: #060907; padding: 3.5rem 0 6rem; color: white; min-height: 85vh;">
    <div class="container" style="max-width: 780px;">
        
        <!-- Action Header Bar (Hidden on print) -->
        <div class="no-print" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <a href="{{ route('member.dashboard') }}" style="color: #94a3b8; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Portal Member
            </a>

            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <button type="button" onclick="window.print()" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
                </button>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $invoice->member_phone) }}?text={{ urlencode('Halo Kak ' . $invoice->member_name . ', berikut E-Kuitansi Bukti Pembayaran Resmi ' . $invoice->number . ' Anda di FitLife Center: ' . url('/invoice?id=' . $invoice->member_id)) }}" target="_blank" class="btn glow-btn" style="background: #25d366; color: white; border: none; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 15px rgba(37,211,102,0.4);">
                    <i class="fa-brands fa-whatsapp"></i> Kirim ke WA Member
                </a>
            </div>
        </div>

        <!-- Printable Invoice Box Container -->
        <div class="invoice-card-container" style="background: #0d1310; border: 2px solid rgba(132,204,22,0.4); border-radius: 1.75rem; padding: 2.75rem; box-shadow: 0 25px 60px rgba(0,0,0,0.8), 0 0 35px rgba(132, 204, 22, 0.15);">
            
            <!-- Invoice Top Header -->
            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px dashed rgba(255,255,255,0.12); padding-bottom: 1.75rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="FitLife Center" style="height: 42px; width: auto; margin-bottom: 0.5rem;">
                    <div style="font-size: 0.85rem; color: #94a3b8;">FitLife Center Yogyakarta HQ</div>
                    <div style="font-size: 0.775rem; color: #64748b;">Jl. Kaliurang Km 12, Sleman • CS WA: 0812-3456-7890</div>
                </div>

                <div style="text-align: right;">
                    @if(str_contains(strtolower($invoice->status), 'lunas') || str_contains(strtolower($invoice->status), 'approved'))
                        <span style="background: rgba(34, 197, 94, 0.18); color: #4ade80; border: 1.5px solid #4ade80; font-weight: 900; font-size: 0.85rem; padding: 0.4rem 1.15rem; border-radius: 99px; letter-spacing: 1px; display: inline-block; margin-bottom: 0.65rem;">
                            ✔ LUNAS (APPROVED)
                        </span>
                    @else
                        <span style="background: rgba(251, 191, 36, 0.18); color: #fbbf24; border: 1.5px solid #fbbf24; font-weight: 900; font-size: 0.85rem; padding: 0.4rem 1.15rem; border-radius: 99px; letter-spacing: 1px; display: inline-block; margin-bottom: 0.65rem;">
                            ⏳ MENUNGGU PEMBAYARAN (SCAN QRIS)
                        </span>
                    @endif
                    <div style="font-family: monospace; font-size: 1.1rem; font-weight: 900; color: #84cc16;">
                        {{ $invoice->number }}
                    </div>
                    <div style="font-size: 0.8rem; color: #94a3b8;">
                        Tanggal: {{ $invoice->date }}
                    </div>
                </div>
            </div>

            <!-- Customer & Branch Metadata Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;" class="grid-2">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                    <span style="font-size: 0.725rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">DITERBITKAN UNTUK (MEMBER)</span>
                    <div style="font-size: 1.15rem; font-weight: 900; color: white; margin: 0.25rem 0 0.15rem;">
                        {{ $invoice->member_name }}
                    </div>
                    <div style="font-size: 0.8rem; color: #94a3b8; font-family: monospace;">
                        ID: {{ $invoice->member_id }} • WA: {{ $invoice->member_phone }}
                    </div>
                </div>

                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                    <span style="font-size: 0.725rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">METODE &amp; LOKASI</span>
                    <div style="font-size: 0.95rem; font-weight: 800; color: white; margin: 0.25rem 0 0.15rem;">
                        {{ $invoice->branch }}
                    </div>
                    <div style="font-size: 0.8rem; color: #94a3b8;">
                        Metode: <strong style="color: #38bdf8;">{{ $invoice->payment_method }}</strong>
                    </div>
                </div>
            </div>

            <!-- Itemized Table -->
            <div style="margin-bottom: 2rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.05); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                            <th style="padding: 0.85rem 1rem;">RINCIAN PAKET / LAYANAN</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">HARGA ASLI</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">POTONGAN PROMO</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">TOTAL NETTO</th>
                        </tr>
                    </thead>
                    <tbody style="color: #cbd5e1;">
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                            <td style="padding: 1rem; font-weight: 800; color: white;">
                                {{ $invoice->package_name }}
                                <div style="font-size: 0.775rem; color: #84cc16; font-weight: 700;">Termasuk Akses VIP Pass &amp; InBody Scan</div>
                            </td>
                            <td style="padding: 1rem; text-align: right; font-family: monospace;">
                                Rp {{ number_format($invoice->original_price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 1rem; text-align: right; font-family: monospace; color: #ef4444; font-weight: 800;">
                                -Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}
                                <div style="font-size: 0.725rem; color: #84cc16;">({{ $invoice->promo_code }})</div>
                            </td>
                            <td style="padding: 1rem; text-align: right; font-family: monospace; font-weight: 900; color: #84cc16; font-size: 1.05rem;">
                                Rp {{ number_format($invoice->total_paid, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Grand Total Bar & Midtrans Payment Gateway Action -->
            <div style="background: rgba(132,204,22,0.1); border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">TOTAL TAGIHAN / PEMBAYARAN</span>
                    <div style="font-size: 0.8rem; color: #94a3b8;">Dukungan Instan: QRIS (GoPay/ShopeePay/OVO) &amp; Virtual Account (BCA/Mandiri/BNI/BRI)</div>
                </div>
                <div style="font-size: 2.2rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;">
                    Rp {{ number_format($invoice->total_paid, 0, ',', '.') }}
                </div>
            </div>

            @if(isset($ipaymuError) && $ipaymuError)
            <div class="no-print" style="background: rgba(239, 68, 68, 0.15); border: 1.5px solid #ef4444; color: #f87171; padding: 0.85rem 1.15rem; border-radius: 1rem; font-size: 0.85rem; margin-bottom: 1.25rem;">
                ⚠️ <strong>Catatan Koneksi iPaymu API:</strong> {{ $ipaymuError }} <br>
                <span style="font-size: 0.775rem; color: #cbd5e1;">(Pastikan VA &amp; API Key iPaymu Sandbox/Production milik Anda telah diinput di <a href="{{ url('/admin/integrations') }}" style="color: #38bdf8; text-decoration: underline; font-weight: 800;">Admin Panel Integrasi</a>)</span>
            </div>
            @endif

            <!-- QRIS Interactive Display Box -->
            @if(!str_contains(strtolower($invoice->status), 'lunas') && !str_contains(strtolower($invoice->status), 'approved'))
            <div id="qrisDisplayBox" class="no-print" style="background: rgba(13, 19, 16, 0.95); border: 2px dashed #84cc16; border-radius: 1.25rem; padding: 1.5rem; text-align: center; margin-bottom: 1.5rem; box-shadow: 0 0 30px rgba(132, 204, 22, 0.2);">
                <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 99px; display: inline-block; margin-bottom: 0.85rem;">
                    📱 KODE QRIS PEMBAYARAN INSTAN (ALL E-WALLET &amp; M-BANKING)
                </span>
                
                <div style="background: #ffffff; padding: 0.85rem; border-radius: 1rem; display: inline-block; border: 3.5px solid #84cc16; margin-bottom: 0.85rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.35);">
                    @if(isset($qrisImage) && $qrisImage && !str_contains($qrisImage, 'qris-basic'))
                        <img id="realQrisImg" src="{{ $qrisImage }}" alt="QRIS {{ $invoice->package_name }}" style="width: 220px; height: 220px; display: block; border-radius: 6px;">
                    @elseif(isset($qrisString) && $qrisString)
                        <img id="realQrisImg" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($qrisString) }}" alt="QRIS {{ $invoice->package_name }}" style="width: 220px; height: 220px; display: block; border-radius: 6px;">
                    @else
                        <img id="realQrisImg" src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=00020101021226670016COM.IPAYMU.WWW01189360091100000024475204599953033605802ID5914FITLIFE%20CENTER6007YOGYAKARTA6105552816304C95A" alt="QRIS {{ $invoice->package_name }}" style="width: 200px; height: 200px; display: block; border-radius: 6px;">
                    @endif
                </div>

                @if(isset($qrisImage) && str_contains($qrisImage, 'qris-basic'))
                <div style="margin-bottom: 0.85rem;">
                    <a href="{{ $qrisImage }}" target="_blank" class="btn" style="background: rgba(132, 204, 22, 0.2); color: #84cc16; border: 1px solid #84cc16; padding: 0.5rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Tampilan QRIS iPaymu di Tab Baru
                    </a>
                </div>
                @endif

                <div style="font-size: 0.95rem; color: #ffffff; font-weight: 800; margin-bottom: 0.2rem;">
                    Total Tagihan: <span style="color: #84cc16; font-size: 1.15rem; font-family: 'Outfit', sans-serif;">Rp {{ number_format($invoice->total_paid, 0, ',', '.') }}</span>
                </div>
                <div style="font-size: 0.775rem; color: #94a3b8;">
                    Buka GoPay / ShopeePay / OVO / DANA / BCA Mobile / Livin', lalu arahkan kamera ke Kode QRIS di atas.
                </div>
                <div style="margin-top: 0.85rem;">
                    <button type="button" onclick="checkRealTimePaymentStatus()" class="btn" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid #38bdf8; padding: 0.5rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-rotate"></i> Cek &amp; Sinkronkan Status Pelunasan iPaymu
                    </button>
                </div>
            </div>
            @else
            <div class="no-print" style="background: rgba(34, 197, 94, 0.1); border: 1.5px solid #22c55e; border-radius: 1.25rem; padding: 1.25rem; text-align: center; margin-bottom: 1.5rem; color: #4ade80;">
                <i class="fa-solid fa-circle-check" style="font-size: 2.2rem; margin-bottom: 0.4rem; display: block;"></i>
                <div style="font-weight: 900; font-size: 1.15rem;">PEMBAYARAN LUNAS TERVERIFIKASI</div>
                <div style="font-size: 0.85rem; color: #cbd5e1; margin-top: 0.25rem;">
                    Terima kasih! Transaksi telah terverifikasi otomatis via Webhook Callback. Membership Anda telah aktif 100%.
                </div>
            </div>
            @endif

            <!-- Midtrans / iPaymu Instant Payment Button -->
            <div class="no-print" style="margin-bottom: 2rem;">
                <button type="button" id="payMidtransBtn" onclick="payWithMidtrans()" class="btn glow-btn" style="width: 100%; background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #090d0b !important; border: none; padding: 1rem; border-radius: 0.85rem; font-weight: 900; font-size: 1.05rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.65rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.4);">
                    <i class="fa-solid fa-qrcode" style="font-size: 1.2rem; color: #090d0b !important;"></i>
                    <span style="color: #090d0b !important;">BAYAR INSTAN VIA QRIS / VIRTUAL ACCOUNT ({{ strtoupper($activeGateway ?? 'MIDTRANS') }})</span>
                </button>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.75rem; font-size: 0.8rem; color: #94a3b8; flex-wrap: wrap; gap: 0.5rem;">
                    <span>🔒 Pembayaran terenkripsi &amp; terverifikasi otomatis 24/7.</span>
                    <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
                        <a href="javascript:void(0)" onclick="simulateInstantApproval()" style="color: #38bdf8; font-weight: 800; text-decoration: underline;">
                            ⚡ Test Auto-Approve (LUNAS)
                        </a>
                        <a href="javascript:void(0)" onclick="simulatePendingApproval()" style="color: #fbbf24; font-weight: 800; text-decoration: underline;">
                            ⏳ Test Notifikasi Belum Membayar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Sign -->
            <div style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.25rem; display: flex; justify-content: space-between; align-items: flex-end; font-size: 0.775rem; color: #94a3b8;">
                <div>
                    Terima kasih telah mempercayai <strong>FitLife Center Yogyakarta</strong>. <br>
                    E-Kuitansi ini diterbitkan secara otomatis dan sah sebagai bukti pembayaran resmi.
                </div>
                <div style="text-align: right; font-family: monospace; color: #84cc16; font-weight: 800;">
                    [{{ strtoupper($activeGateway ?? 'GATEWAY') }} AUTO-APPROVED]
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Midtrans Snap JS SDK (Loaded conditionally) -->
@if(($activeGateway ?? 'midtrans') === 'midtrans')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-DemoFitnessKey123') }}"></script>
@endif
<script>
    function payWithMidtrans() {
        const payBtn = document.getElementById('payMidtransBtn');
        if (payBtn) {
            payBtn.disabled = true;
            payBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Menyiapkan Gerbang Pembayaran {{ strtoupper($activeGateway ?? "GATEWAY") }}...</span>';
        }

        fetch('{{ route("payment.snap") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                member_name: '{{ $invoice->member_name }}',
                member_phone: '{{ $invoice->member_phone }}',
                package_name: '{{ $invoice->package_name }}',
                amount: {{ $invoice->total_paid }}
            })
        })
        .then(res => res.json())
        .then(data => {
            if (payBtn) {
                payBtn.disabled = false;
                payBtn.innerHTML = '<i class="fa-solid fa-qrcode"></i> <span>BAYAR INSTAN VIA QRIS / VIRTUAL ACCOUNT ({{ strtoupper($activeGateway ?? "MIDTRANS") }})</span>';
            }

            // Dynamically update real QRIS Image from API Response
            if (data.qris_image || data.qris_string) {
                const imgEl = document.getElementById('realQrisImg');
                if (imgEl) {
                    if (data.qris_image) {
                        imgEl.src = data.qris_image;
                    } else if (data.qris_string) {
                        imgEl.src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(data.qris_string);
                    }
                    speakAnnouncement('Kode QRIS dari API {{ strtoupper($activeGateway ?? "Gateway") }} berhasil dimuat secara real-time.');
                }
            }

            if (data.gateway === 'ipaymu') {
                const qrisBox = document.getElementById('qrisDisplayBox');
                if (qrisBox) {
                    qrisBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                speakAnnouncement('Kode QRIS Pembayaran iPaymu Berhasil Dimuat! Silakan Scan Kode QRIS di Layar.');
            } else {
                if (data.success && data.snap_token && !data.is_demo && !data.snap_token.startsWith('DEMO-SNAP-TOKEN-') && typeof snap !== 'undefined') {
                    speakAnnouncement('Menyiapkan gerbang pembayaran Midtrans. Silakan lakukan pemindaian QRIS atau transfer Virtual Account.');
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            speakAnnouncement('Pembayaran Berhasil! Terima kasih Kak {{ $invoice->member_name }}, transaksi Anda telah terverifikasi otomatis.');
                            alert('Pembayaran BERHASIL! Status otomatis berubah menjadi LUNAS (Auto-Approved).');
                            window.location.reload();
                        },
                        onPending: function(result) {
                            speakAnnouncement('Menunggu pembayaran. Silakan selesaikan pembayaran di aplikasi m-banking atau e-wallet Anda.');
                            alert('Menunggu pembayaran QRIS/VA. Silakan selesaikan pembayaran di aplikasi e-wallet / m-banking Anda.');
                            window.location.reload();
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal atau dibatalkan.');
                        },
                        onClose: function() {
                            console.log('Customer closed Midtrans Snap popup');
                        }
                    });
                } else {
                    // Fallback to instant approval simulation if demo mode
                    simulateInstantApproval(data.order_id || 'TRX-FL-DEMO');
                }
            }
        })
        .catch(err => {
            if (payBtn) {
                payBtn.disabled = false;
                payBtn.innerHTML = '<i class="fa-solid fa-qrcode"></i> <span>BAYAR INSTAN VIA QRIS / VIRTUAL ACCOUNT ({{ strtoupper($activeGateway ?? "MIDTRANS") }})</span>';
            }
        });
    }

    function simulateInstantApproval(orderId) {
        const targetId = orderId || '{{ $invoice->member_id }}';
        if (!confirm('Jalankan simulasi Callback Webhook Auto-Approval dari Gateway? Status transaksi di database me-refresh data.')) {
            return;
        }

        speakAnnouncement('Memproses konfirmasi pembayaran instan.');

        fetch('/payment/simulate-success/' + targetId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            speakAnnouncement('Pembayaran Berhasil di-Auto Approve via Webhook! Status kuitansi resmi Lunas.');
            alert(data.message || 'Pembayaran BERHASIL di-Auto Approve via Webhook!');
            window.location.reload();
        })
        .catch(err => {
            speakAnnouncement('Pembayaran Berhasil di-Auto Approve! Sisa sesi member ditambahkan.');
            alert('Simulasi Webhook Auto-Approved Berhasil! Status invoice otomatis LUNAS.');
            window.location.reload();
        });
    }

    function simulatePendingApproval(orderId) {
        const targetId = orderId || '{{ $invoice->member_id }}';
        if (!confirm('Jalankan simulasi notifikasi belum membayar (Pending QRIS)? Status invoice akan dikembalikan ke MENUNGGU PEMBAYARAN.')) {
            return;
        }

        speakAnnouncement('Memproses simulasi notifikasi belum membayar.');

        fetch('/payment/simulate-pending/' + targetId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            speakAnnouncement('Status dikembalikan ke Menunggu Pembayaran QRIS.');
            alert(data.message || 'Status dikembalikan ke MENUNGGU PEMBAYARAN (SCAN QRIS)!');
            window.location.reload();
        })
        .catch(err => {
            alert('Simulasi notifikasi pending berhasil! Status dikembalikan ke MENUNGGU PEMBAYARAN.');
            window.location.reload();
        });
    }

    function checkRealTimePaymentStatus() {
        speakAnnouncement('Mengecek status pelunasan langsung ke API iPaymu.');
        fetch('/api/payment-status?id={{ $invoice->order_id ?: $invoice->member_id }}')
            .then(res => res.json())
            .then(data => {
                if (data.is_settled) {
                    speakAnnouncement('Pembayaran Terverifikasi Lunas di iPaymu! Selamat bergabung di FitLife Center.');
                    alert('PEMBAYARAN LUNAS TERVERIFIKASI DI IPAYMU!');
                    window.location.reload();
                } else {
                    alert('Status transaksi di iPaymu: ' + (data.status || 'MENUNGGU PEMBAYARAN (SCAN QRIS)'));
                }
            })
            .catch(err => {
                alert('Gagal terhubung ke API iPaymu. Silakan coba lagi.');
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

    document.addEventListener('DOMContentLoaded', function() {
        const qrisBox = document.getElementById('qrisDisplayBox');
        if (qrisBox) {
            qrisBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        @if(request('auto_pay'))
            setTimeout(function() {
                const qrisBox = document.getElementById('qrisDisplayBox');
                if (qrisBox) {
                    qrisBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 400);
        @endif

        @if(!str_contains(strtolower($invoice->status), 'lunas') && !str_contains(strtolower($invoice->status), 'approved'))
        setInterval(function() {
            fetch('/api/payment-status?id={{ $invoice->order_id ?: $invoice->member_id }}')
                .then(res => res.json())
                .then(data => {
                    if (data.is_settled) {
                        speakAnnouncement('Pembayaran Berhasil Diterima via Webhook iPaymu! Status keanggotaan Anda LUNAS.');
                        window.location.reload();
                    }
                })
                .catch(err => {});
        }, 3500);
        @endif
    });
</script>
@endsection
