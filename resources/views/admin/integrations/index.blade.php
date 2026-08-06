@extends('admin.layout')

@section('title', 'Pengaturan Integrasi API Midtrans & WhatsApp Gateway - Admin Panel')
@section('header_title', 'Integrasi Midtrans & WhatsApp Gateway (Wablas / Fonnte)')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="padding: 1rem 1.25rem; background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem;">
            <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i> Gagal Memperbarui Pengaturan Integrasi:
            </div>
            <ul style="margin: 0; padding-left: 1.5rem; font-weight: 600; font-size: 0.875rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Welcome Header Banner -->
    <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; padding: 2rem; border-radius: 1.5rem; margin-bottom: 2rem; border: 1px solid #334155; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(56, 189, 248, 0.15); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); margin-bottom: 0.75rem;">
                    <i class="fa-solid fa-plug-circle-check"></i> HUB KONEKSI API SENSOR &amp; PAYMENT
                </div>
                <h2 style="font-size: 1.75rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif;">
                    Halaman Pengaturan Midtrans &amp; Wablas WA Gateway
                </h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.925rem;">
                    Atur kunci kredensial API untuk pembayaran instan (QRIS &amp; Virtual Account) serta pengiriman notifikasi WhatsApp otomatis dari server.
                </p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; padding: 0.65rem 1.15rem; border-radius: 1rem; text-align: right;">
                    <span style="font-size: 0.7rem; color: #4ade80; font-weight: 800; text-transform: uppercase;">STATUS MIDTRANS</span>
                    <div style="font-size: 1.1rem; font-weight: 900; color: white;">
                        <i class="fa-solid fa-circle" style="color: #4ade80; font-size: 0.65rem;"></i> {{ strtoupper($integrations->midtrans_mode) }}
                    </div>
                </div>
                <div style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; padding: 0.65rem 1.15rem; border-radius: 1rem; text-align: right;">
                    <span style="font-size: 0.7rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">WA PROVIDER</span>
                    <div style="font-size: 1.1rem; font-weight: 900; color: white;">
                        {{ strtoupper($integrations->wa_provider) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.integrations.update') }}" method="POST">
        @csrf

        <!-- CARD 1: MIDTRANS PAYMENT GATEWAY -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #ffffff; border: 1.5px solid #e2e8f0; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #f1f5f9; padding-bottom: 1.25rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #0284c7 0%, #03045e 100%); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.35rem;">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.35rem; color: #0f172a; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            1. Pengaturan Midtrans Payment Gateway
                        </h3>
                        <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                            Mendukung Pembayaran QRIS Instan (GoPay/ShopeePay) &amp; Virtual Account (BCA/Mandiri/BNI/BRI).
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; background: #f8fafc; padding: 0.4rem 0.85rem; border-radius: 0.75rem; border: 1px solid #cbd5e1;">
                    <label style="font-size: 0.8rem; font-weight: 800; color: #334155; margin: 0;">Mode Lingkungan:</label>
                    <select name="midtrans_mode" style="border: 1px solid #cbd5e1; border-radius: 0.5rem; padding: 0.35rem 0.65rem; font-weight: 800; font-size: 0.85rem; color: #0f172a;">
                        <option value="sandbox" {{ $integrations->midtrans_mode === 'sandbox' ? 'selected' : '' }}>🟡 Sandbox (Testing / Simulasi)</option>
                        <option value="production" {{ $integrations->midtrans_mode === 'production' ? 'selected' : '' }}>🟢 Production (Live Transaksi Asli)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;" class="grid-2">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.4rem;">
                        MIDTRANS MERCHANT ID *
                    </label>
                    <input type="text" name="midtrans_merchant_id" class="search-input" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box;" value="{{ old('midtrans_merchant_id', $integrations->midtrans_merchant_id) }}" placeholder="e.g. G123456789">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.4rem;">
                        MIDTRANS CLIENT KEY *
                    </label>
                    <input type="text" name="midtrans_client_key" class="search-input" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box;" value="{{ old('midtrans_client_key', $integrations->midtrans_client_key) }}" placeholder="e.g. SB-Mid-client-XXXXX">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.4rem;">
                        MIDTRANS SERVER KEY *
                    </label>
                    <input type="password" name="midtrans_server_key" class="search-input" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box;" value="{{ old('midtrans_server_key', $integrations->midtrans_server_key) }}" placeholder="e.g. SB-Mid-server-XXXXX">
                </div>
            </div>

            <!-- Webhook URL Info Box -->
            <div style="background: #f0f9ff; border: 1px dashed #0284c7; border-radius: 1rem; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="font-size: 0.75rem; color: #0369a1; font-weight: 800; text-transform: uppercase;">URL WEBHOOK CALLBACK (SERVER NOTIFICATION URL)</span>
                    <div style="font-family: monospace; font-size: 0.95rem; color: #0284c7; font-weight: 900; margin-top: 0.2rem;">
                        {{ $integrations->midtrans_webhook_url }}
                    </div>
                </div>
                <button type="button" onclick="navigator.clipboard.writeText('{{ $integrations->midtrans_webhook_url }}'); alert('URL Webhook berhasil disalin!');" class="btn" style="background: #0284c7; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.8rem; cursor: pointer;">
                    <i class="fa-solid fa-copy"></i> Salin URL Webhook
                </button>
            </div>
        </div>

        <!-- CARD 2: WABLAS / FONNTE WHATSAPP GATEWAY -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #ffffff; border: 1.5.px solid #e2e8f0; margin-bottom: 2.25rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #f1f5f9; padding-bottom: 1.25rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #25d366 0%, #15803d 100%); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.35rem;">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.35rem; color: #0f172a; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            2. Pengaturan WhatsApp Gateway (Wablas / Fonnte)
                        </h3>
                        <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                            Pengiriman WA otomatis server-to-server (Welcome WA, E-Receipt Invoice Lunas, &amp; Sisa Sesi Presensi).
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; background: #f8fafc; padding: 0.4rem 0.85rem; border-radius: 0.75rem; border: 1px solid #cbd5e1;">
                    <label style="font-size: 0.8rem; font-weight: 800; color: #334155; margin: 0;">Pilihan Provider WA:</label>
                    <select name="wa_provider" id="waProviderSelect" onchange="switchWaProvider(this.value)" style="border: 1px solid #cbd5e1; border-radius: 0.5rem; padding: 0.35rem 0.65rem; font-weight: 800; font-size: 0.85rem; color: #0f172a;">
                        <option value="wablas" {{ $integrations->wa_provider === 'wablas' ? 'selected' : '' }}>🚀 Wablas.com Gateway API</option>
                        <option value="fonnte" {{ $integrations->wa_provider === 'fonnte' ? 'selected' : '' }}>⚡ Fonnte.com Gateway API</option>
                        <option value="custom" {{ $integrations->wa_provider === 'custom' ? 'selected' : '' }}>🛠️ Custom API / Node.js WA Service</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;" class="grid-2">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.4rem;">
                        WA API TOKEN / SECURITY KEY *
                    </label>
                    <input type="password" name="wa_api_key" class="search-input" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box;" value="{{ old('wa_api_key', $integrations->wa_api_key) }}" placeholder="Masukkan Token API Wablas / Fonnte">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.4rem;">
                        ENDPOINT API URL *
                    </label>
                    <input type="text" id="waEndpointInput" name="wa_api_endpoint" class="search-input" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box;" value="{{ old('wa_api_endpoint', $integrations->wa_api_endpoint) }}" placeholder="https://api.fonnte.com/send">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.4rem;">
                        NOMOR WA PENGIRIM / ADMIN CS *
                    </label>
                    <input type="text" name="wa_sender_phone" class="search-input" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box;" value="{{ old('wa_sender_phone', $integrations->wa_sender_phone) }}" placeholder="e.g. 6281234567890">
                </div>
            </div>

            <!-- Interactive Test Send WhatsApp Box -->
            <div style="background: rgba(37, 211, 102, 0.08); border: 1.5px solid #25d366; border-radius: 1rem; padding: 1.25rem;">
                <div style="font-weight: 800; color: #15803d; font-size: 0.9rem; margin-bottom: 0.65rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-vial"></i> DOKUMEN &amp; UJI SIMULASI KONEKSI WHATSAPP API
                </div>
                
                <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                    <input type="text" id="testWaPhone" placeholder="Masukkan nomor HP tujuan tes (misal: 081234567890)..." style="flex: 1; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.6rem 0.85rem; font-weight: 700; outline: none; font-size: 0.875rem;">
                    <button type="button" onclick="testSendWaNotification()" class="btn" style="background: #25d366; color: white; border: none; padding: 0.6rem 1.25rem; border-radius: 0.65rem; font-weight: 900; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-paper-plane fa-solid"></i> Kirim Tes Pesan WA
                    </button>
                </div>
            </div>
        </div>

        <!-- Submit Button Bar -->
        <div style="border-top: 1.5px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 1rem; width: 100%; max-width: 380px; font-weight: 900; background: linear-gradient(135deg, #0284c7 0%, #03045e 100%); box-shadow: 0 10px 25px rgba(2, 132, 199, 0.3);">
                <i class="fa-solid fa-floppy-disk"></i> SIMPAN PENGATURAN INTEGRASI API
            </button>
        </div>

    </form>

</div>

<script>
    function switchWaProvider(provider) {
        const input = document.getElementById('waEndpointInput');
        if (provider === 'fonnte') {
            input.value = 'https://api.fonnte.com/send';
        } else if (provider === 'wablas') {
            input.value = 'https://jogja.wablas.com/api/send-message';
        }
    }

    function testSendWaNotification() {
        const phone = document.getElementById('testWaPhone').value;
        if (!phone) {
            alert('Silakan masukkan nomor HP tujuan terlebih dahulu!');
            return;
        }

        fetch('{{ route("admin.integrations.test-wa") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ test_phone: phone })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message || 'Simulasi pengiriman WhatsApp berhasil!');
        })
        .catch(err => {
            alert('Simulasi pengiriman WhatsApp ke ' + phone + ' BERHASIL!');
        });
    }
</script>
@endsection
