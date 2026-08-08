@extends('admin.layout')

@section('title', 'Pengaturan Integrasi API Midtrans & WhatsApp Gateway - Admin Panel')
@section('header_title', 'Integrasi Midtrans & WhatsApp Gateway (Wablas / Fonnte)')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #10b981; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="padding: 1rem 1.25rem; background: rgba(244, 63, 94, 0.15); border: 1px solid rgba(244, 63, 94, 0.4); color: #f43f5e; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem;">
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
    <div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
        <!-- Decorative Glow Effects -->
        <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

        <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.25rem;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); border: 1px solid rgba(132, 204, 22, 0.4); margin-bottom: 0.75rem;">
                    <i class="fa-solid fa-plug-circle-check"></i> HUB KONEKSI API SENSOR &amp; PAYMENT
                </div>
                <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif; color: #ffffff;">
                    Halaman Pengaturan Midtrans &amp; Wablas WA Gateway
                </h2>
                <p style="color: #cbd5e1; margin: 0; font-size: 0.925rem;">
                    Atur kunci kredensial API untuk pembayaran instan (QRIS &amp; Virtual Account) serta pengiriman notifikasi WhatsApp otomatis dari server.
                </p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.4); padding: 0.65rem 1.15rem; border-radius: 1rem; text-align: right;">
                    <span style="font-size: 0.7rem; color: #4ade80; font-weight: 800; text-transform: uppercase;">STATUS MIDTRANS</span>
                    <div style="font-size: 1.1rem; font-weight: 900; color: white;">
                        <i class="fa-solid fa-circle" style="color: #4ade80; font-size: 0.65rem;"></i> {{ strtoupper($integrations->midtrans_mode) }}
                    </div>
                </div>
                <div style="background: rgba(6, 182, 212, 0.15); border: 1px solid rgba(6, 182, 212, 0.4); padding: 0.65rem 1.15rem; border-radius: 1rem; text-align: right;">
                    <span style="font-size: 0.7rem; color: #06b6d4; font-weight: 800; text-transform: uppercase;">WA PROVIDER</span>
                    <div style="font-size: 1.1rem; font-weight: 900; color: white;">
                        {{ strtoupper($integrations->wa_provider) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.integrations.update') }}" method="POST">
        @csrf

        <!-- CARD 0: SELECT ACTIVE PAYMENT GATEWAY -->
        <div class="admin-card" style="padding: 1.5rem 2rem; border-radius: 1.5rem; background: rgba(132, 204, 22, 0.08); border: 1.5px solid var(--brand-lime, #84cc16); margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 44px; height: 44px; background: #84cc16; border-radius: 0.85rem; display: flex; align-items: center; justify-content: center; color: #060907; font-size: 1.25rem;">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 1.15rem; color: #ffffff; margin: 0 0 0.15rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            Pilihan Payment Gateway Utama Website
                        </h4>
                        <p style="color: #cbd5e1; font-size: 0.825rem; margin: 0;">
                            Pilih provider gerbang pembayaran yang aktif digunakan untuk checkout transaksi member.
                        </p>
                    </div>
                </div>

                <div>
                    <select name="active_gateway" style="background: #090d0b; border: 2px solid #84cc16; border-radius: 0.75rem; padding: 0.6rem 1rem; font-weight: 900; font-size: 0.95rem; color: #84cc16; cursor: pointer;">
                        <option value="midtrans" {{ ($integrations->active_gateway ?? 'midtrans') === 'midtrans' ? 'selected' : '' }}>💳 Midtrans Payment Gateway (Aktif)</option>
                        <option value="ipaymu" {{ ($integrations->active_gateway ?? 'midtrans') === 'ipaymu' ? 'selected' : '' }}>🏦 iPaymu Payment Gateway (Aktif)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- CARD 1: MIDTRANS PAYMENT GATEWAY -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 1.25rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #060907; font-size: 1.35rem;">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.35rem; color: #ffffff; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            1. Pengaturan Midtrans Payment Gateway
                        </h3>
                        <p style="color: #cbd5e1; font-size: 0.875rem; margin: 0;">
                            Mendukung Pembayaran QRIS Instan (GoPay/ShopeePay) &amp; Virtual Account (BCA/Mandiri/BNI/BRI).
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255, 255, 255, 0.04); padding: 0.4rem 0.85rem; border-radius: 0.75rem; border: 1px solid rgba(255, 255, 255, 0.12);">
                    <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin: 0;">Mode Lingkungan:</label>
                    <select name="midtrans_mode" style="background: #121c17; border: 1px solid rgba(255,255,255,0.15); border-radius: 0.5rem; padding: 0.35rem 0.65rem; font-weight: 800; font-size: 0.85rem; color: #ffffff; color-scheme: dark;">
                        <option value="sandbox" {{ $integrations->midtrans_mode === 'sandbox' ? 'selected' : '' }}>🟡 Sandbox (Testing / Simulasi)</option>
                        <option value="production" {{ $integrations->midtrans_mode === 'production' ? 'selected' : '' }}>🟢 Production (Live Transaksi Asli)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;" class="grid-2">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        MIDTRANS MERCHANT ID *
                    </label>
                    <input type="text" name="midtrans_merchant_id" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('midtrans_merchant_id', $integrations->midtrans_merchant_id) }}" placeholder="e.g. G123456789">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        MIDTRANS CLIENT KEY *
                    </label>
                    <input type="text" name="midtrans_client_key" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('midtrans_client_key', $integrations->midtrans_client_key) }}" placeholder="e.g. SB-Mid-client-XXXXX">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        MIDTRANS SERVER KEY *
                    </label>
                    <input type="password" name="midtrans_server_key" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('midtrans_server_key', $integrations->midtrans_server_key) }}" placeholder="e.g. SB-Mid-server-XXXXX">
                </div>
            </div>

            <!-- Webhook URL Info Box -->
            <div style="background: rgba(6, 182, 212, 0.1); border: 1px dashed #06b6d4; border-radius: 1rem; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="font-size: 0.75rem; color: #06b6d4; font-weight: 800; text-transform: uppercase;">URL WEBHOOK CALLBACK (SERVER NOTIFICATION URL)</span>
                    <div style="font-family: monospace; font-size: 0.95rem; color: #38bdf8; font-weight: 900; margin-top: 0.2rem;">
                        {{ $integrations->midtrans_webhook_url }}
                    </div>
                </div>
        <!-- CARD 2: IPAYMU PAYMENT GATEWAY -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 1.25rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #060907; font-size: 1.35rem;">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.35rem; color: #ffffff; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            2. Pengaturan iPaymu Payment Gateway
                        </h3>
                        <p style="color: #cbd5e1; font-size: 0.875rem; margin: 0;">
                            Mendukung Pembayaran QRIS, Virtual Account (BCA/Mandiri/BRI/CIMB), &amp; Retail Outlet (Alfamart/Indomaret).
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255, 255, 255, 0.04); padding: 0.4rem 0.85rem; border-radius: 0.75rem; border: 1px solid rgba(255, 255, 255, 0.12);">
                    <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin: 0;">Mode Lingkungan:</label>
                    <select name="ipaymu_mode" style="background: #121c17; border: 1px solid rgba(255,255,255,0.15); border-radius: 0.5rem; padding: 0.35rem 0.65rem; font-weight: 800; font-size: 0.85rem; color: #ffffff; color-scheme: dark;">
                        <option value="sandbox" {{ $integrations->ipaymu_mode === 'sandbox' ? 'selected' : '' }}>🟡 Sandbox (Testing / Simulasi)</option>
                        <option value="production" {{ $integrations->ipaymu_mode === 'production' ? 'selected' : '' }}>🟢 Production (Live Transaksi Asli)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;" class="grid-2">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        IPAYMU VA ACCOUNT NUMBER *
                    </label>
                    <input type="text" name="ipaymu_va" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('ipaymu_va', $integrations->ipaymu_va) }}" placeholder="e.g. 0000002447990145">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        IPAYMU API KEY (SECRET KEY) *
                    </label>
                    <input type="password" name="ipaymu_api_key" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('ipaymu_api_key', $integrations->ipaymu_api_key) }}" placeholder="e.g. SANDBOX67650-XXXXXXXX-XXXX">
                </div>
            </div>

            <!-- Webhook URL Info Box -->
            <div style="background: rgba(245, 158, 11, 0.1); border: 1px dashed #f59e0b; border-radius: 1rem; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="font-size: 0.75rem; color: #f59e0b; font-weight: 800; text-transform: uppercase;">URL WEBHOOK CALLBACK IPAYMU (NOTIFY URL)</span>
                    <div style="font-family: monospace; font-size: 0.95rem; color: #fbbf24; font-weight: 900; margin-top: 0.2rem;">
                        {{ $integrations->ipaymu_webhook_url }}
                    </div>
                </div>
                <button type="button" onclick="navigator.clipboard.writeText('{{ $integrations->ipaymu_webhook_url }}'); alert('URL Webhook iPaymu berhasil disalin!');" class="btn" style="background: #f59e0b; color: #060907; border: none; padding: 0.5rem 1rem; border-radius: 0.65rem; font-weight: 900; font-size: 0.8rem; cursor: pointer;">
                    <i class="fa-solid fa-copy"></i> Salin URL Webhook
                </button>
            </div>
        </div>

        <!-- CARD 2: WABLAS / FONNTE WHATSAPP GATEWAY -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); margin-bottom: 2.25rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 1.25rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #060907; font-size: 1.35rem;">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.35rem; color: #ffffff; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            2. Pengaturan WhatsApp Gateway (Wablas / Fonnte)
                        </h3>
                        <p style="color: #cbd5e1; font-size: 0.875rem; margin: 0;">
                            Pengiriman WA otomatis server-to-server (Welcome WA, E-Receipt Invoice Lunas, &amp; Sisa Sesi Presensi).
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255, 255, 255, 0.04); padding: 0.4rem 0.85rem; border-radius: 0.75rem; border: 1px solid rgba(255, 255, 255, 0.12);">
                    <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin: 0;">Pilihan Provider WA:</label>
                    <select name="wa_provider" id="waProviderSelect" onchange="switchWaProvider(this.value)" style="background: #121c17; border: 1px solid rgba(255,255,255,0.15); border-radius: 0.5rem; padding: 0.35rem 0.65rem; font-weight: 800; font-size: 0.85rem; color: #ffffff; color-scheme: dark;">
                        <option value="wablas" {{ $integrations->wa_provider === 'wablas' ? 'selected' : '' }}>🚀 Wablas.com Gateway API</option>
                        <option value="fonnte" {{ $integrations->wa_provider === 'fonnte' ? 'selected' : '' }}>⚡ Fonnte.com Gateway API</option>
                        <option value="custom" {{ $integrations->wa_provider === 'custom' ? 'selected' : '' }}>🛠️ Custom API / Node.js WA Service</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;" class="grid-2">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        WA API TOKEN / SECURITY KEY *
                    </label>
                    <input type="password" name="wa_api_key" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('wa_api_key', $integrations->wa_api_key) }}" placeholder="Masukkan Token API Wablas / Fonnte">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        ENDPOINT API URL *
                    </label>
                    <input type="text" id="waEndpointInput" name="wa_api_endpoint" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('wa_api_endpoint', $integrations->wa_api_endpoint) }}" placeholder="https://api.fonnte.com/send">
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.4rem; letter-spacing: 0.05em;">
                        NOMOR WA PENGIRIM / ADMIN CS *
                    </label>
                    <input type="text" name="wa_sender_phone" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; box-sizing: border-box; font-weight: 700;" value="{{ old('wa_sender_phone', $integrations->wa_sender_phone) }}" placeholder="e.g. 6281234567890">
                </div>
            </div>

            <!-- Interactive Test Send WhatsApp Box -->
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 1rem; padding: 1.25rem;">
                <div style="font-weight: 800; color: #10b981; font-size: 0.9rem; margin-bottom: 0.65rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-vial"></i> DOKUMEN &amp; UJI SIMULASI KONEKSI WHATSAPP API
                </div>
                
                <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                    <input type="text" id="testWaPhone" placeholder="Masukkan nomor HP tujuan tes (misal: 081234567890)..." style="flex: 1; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.6rem 0.85rem; font-weight: 700; outline: none; font-size: 0.875rem;">
                    <button type="button" onclick="testSendWaNotification()" class="btn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #060907; border: none; padding: 0.6rem 1.25rem; border-radius: 0.65rem; font-weight: 900; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-paper-plane fa-solid"></i> Kirim Tes Pesan WA
                    </button>
                </div>
            </div>
        </div>

        <!-- Submit Button Bar -->
        <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1.5rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 1rem; width: 100%; max-width: 380px; font-weight: 900; background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border: none; box-shadow: 0 0 25px rgba(132, 204, 22, 0.35);">
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
