@extends('admin.layout')

@section('title', 'Pengaturan Website & Gambar - Admin Panel')
@section('header_title', 'Pengaturan Website & Media Gambar')

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
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i> Upload / Gagal Memperbarui Pengaturan:
            </div>
            <ul style="margin: 0; padding-left: 1.5rem; font-weight: 600; font-size: 0.875rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-card" style="padding: 1.75rem 1.5rem; border-radius: 1.5rem; background: var(--admin-card-bg, #0d1410); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        <div style="margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.15rem;">
            <h3 style="font-size: 1.35rem; color: #ffffff; margin-bottom: 0.35rem; font-weight: 900;">
                <i class="fa-solid fa-sliders" style="color: #06b6d4; margin-right: 0.45rem;"></i> Pengaturan Gambar Logo, Hero & Informasi Website
            </h3>
            <p style="color: #94a3b8; font-size: 0.925rem; margin: 0;">
                Ganti logo header/footer, gambar hero pefitness beranda, nomor WhatsApp admin, serta teks statistik secara terpusat.
            </p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @php
                $isSuperAdmin = (auth()->user()->role === 'superadmin' || auth()->user()->email === 'admin@fitlife.id');
                $currentTier = $settings['subscription_tier'] ?? 'enterprise';
            @endphp

            <!-- Section 0: Subscription Package Tier Switcher (Superadmin Only) -->
            <div class="admin-card" style="margin-bottom: 2.5rem; background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2rem; border-radius: 1.5rem; border: 1px solid rgba(132, 204, 22, 0.4); box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 30px rgba(132, 204, 22, 0.15); position: relative; overflow: hidden;">
                <!-- Decorative Glow Effects -->
                <div style="position: absolute; top: -60px; right: -60px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(40px);"></div>

                <div style="position: relative; z-index: 2;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.25rem;">
                        <div>
                            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.15); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); border: 1px solid rgba(132, 204, 22, 0.4); margin-bottom: 0.65rem;">
                                <i class="fa-solid fa-crown" style="color: #eab308;"></i> CONTROL FEATURE GATEWAY
                            </div>
                            <h3 style="font-size: 1.4rem; color: #ffffff; margin: 0 0 0.35rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                                Status Paket Langganan Aplikasi Gym (Feature Gate)
                            </h3>
                            <p style="color: #cbd5e1; font-size: 0.875rem; margin: 0;">
                                Fitur &amp; modul aplikasi yang tidak termasuk dalam paket akan otomatis terkunci &amp; disembunyikan dari pengelola gym.
                            </p>
                        </div>

                        <div style="background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.35); padding: 0.65rem 1.25rem; border-radius: 1rem; text-align: right;">
                            <span style="font-size: 0.7rem; color: #cbd5e1; font-weight: 800; text-transform: uppercase;">TIER AKTIF SAAT INI</span>
                            <div style="font-size: 1.15rem; font-weight: 900; color: var(--brand-lime, #84cc16); font-family: 'Outfit', sans-serif; margin-top: 0.1rem;">
                                👑 {{ strtoupper($currentTier) }}
                            </div>
                        </div>
                    </div>

                    @if($isSuperAdmin)
                        <div style="background: rgba(18, 28, 23, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 1.15rem; padding: 1.25rem; margin-top: 1rem;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem; flex-wrap: wrap; gap: 0.5rem;">
                                <label style="font-size: 0.8rem; font-weight: 800; color: var(--brand-lime, #84cc16); letter-spacing: 0.05em; margin: 0;">
                                    <i class="fa-solid fa-user-shield"></i> PILIH TIER PAKET LANGGANAN KLIEN (SUPERADMIN ONLY)
                                </label>
                                <span style="font-size: 0.75rem; color: #94a3b8;">* Perubahan akan langsung membatasi modul di sidebar &amp; dashboard</span>
                            </div>

                            <select name="subscription_tier" style="width: 100%; background: #060907; border: 1.5px solid var(--brand-lime, #84cc16); border-radius: 0.75rem; padding: 0.85rem 1rem; color: #ffffff; font-weight: 800; font-size: 0.95rem; outline: none; box-shadow: 0 0 15px rgba(132, 204, 22, 0.15); color-scheme: dark;">
                                <option value="starter" {{ $currentTier === 'starter' ? 'selected' : '' }}>🟢 PAKET STARTER (Rp 199rb/bln) — Presensi Basic &amp; Website Marketing</option>
                                <option value="pro" {{ $currentTier === 'pro' ? 'selected' : '' }}>🔵 PAKET PRO (Rp 349rb/bln) — Presensi Suara TTS + POS Kasir + WA Notification</option>
                                <option value="enterprise" {{ $currentTier === 'enterprise' ? 'selected' : '' }}>👑 PAKET ENTERPRISE VIP (Rp 499rb/bln) — Full Unlimited: Midtrans, Broadcast, Classes, Mutasi Stok, RBAC</option>
                            </select>
                        </div>
                    @else
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-top: 1rem; background: rgba(18, 28, 23, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); padding: 1.25rem; border-radius: 1.15rem;">
                            <div>
                                <span style="font-size: 0.8rem; color: #94a3b8; display: block; margin-bottom: 0.25rem; font-weight: 700;">PAKET LANGGANAN GYM ANDA SAAT INI:</span>
                                <div style="font-size: 1.2rem; font-weight: 900; color: var(--brand-lime, #84cc16); font-family: 'Outfit', sans-serif;">
                                    @if($currentTier === 'starter')
                                        🟢 PAKET STARTER (Presensi Basic &amp; Web Marketing)
                                    @elseif($currentTier === 'pro')
                                        🔵 PAKET PRO (Presensi Suara + POS Kasir + WA Notif)
                                    @else
                                        👑 PAKET ENTERPRISE VIP (Full Unlimited Features)
                                    @endif
                                </div>
                            </div>
                            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281234567890' }}?text=Halo%20Admin%20Vendor,%20saya%20ingin%20upgrade%20paket%20langganan%20gym" target="_blank" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border: none; padding: 0.65rem 1.25rem; border-radius: 0.75rem; font-weight: 900; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.3);">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi Software Vendor untuk Upgrade Paket
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section 1: Pengaturan Gambar & Logo -->
            <div style="margin-bottom: 2.5rem; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-image" style="color: #06b6d4;"></i> Kelola Gambar Logo, Hero & Share Link Website
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                    <!-- Header Logo -->
                    <div style="background: #121c17; color: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.12); text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.75rem;">
                            Logo Header Website:
                        </label>
                        <div style="height: 70px; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ Str::startsWith($settings['site_logo'], 'http') ? $settings['site_logo'] : asset($settings['site_logo']) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <input type="file" name="site_logo_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>

                    <!-- Footer Logo -->
                    <div style="background: #121c17; color: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.12); text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #e2e8f0; margin-bottom: 0.75rem;">
                            Logo Footer & Sidebar Admin:
                        </label>
                        <div style="height: 70px; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ Str::startsWith($settings['site_logo_footer'], 'http') ? $settings['site_logo_footer'] : asset($settings['site_logo_footer']) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <input type="file" name="site_logo_footer_file" accept="image/*" style="font-size: 0.8rem; width: 100%; color: #e2e8f0;">
                    </div>

                    <!-- Hero Swimmer Image -->
                    <div style="background: #121c17; color: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.12); text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.75rem;">
                            Gambar Hero Fitness (Beranda):
                        </label>
                        <div style="height: 70px; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem; overflow: hidden; margin-bottom: 0.85rem;">
                            <img src="{{ Str::startsWith($settings['hero_image'], 'http') ? $settings['hero_image'] : asset($settings['hero_image']) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <input type="file" name="hero_image_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>

                    <!-- Share Link Image -->
                    <div style="background: #121c17; color: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.12); text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.75rem;">
                            Gambar Preview Share Link (WA PNG):
                        </label>
                        <div style="height: 70px; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ Str::startsWith($settings['site_share_image'] ?? '', 'http') ? $settings['site_share_image'] : asset($settings['site_share_image'] ?? 'images/logo.png') }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <input type="file" name="site_share_image_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>

                    <!-- Favicon Browser Icon -->
                    <div style="background: #121c17; color: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.12); text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.75rem;">
                            Icon Favicon Browser (32x32 / ICO):
                        </label>
                        <div style="height: 70px; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ asset('images/favicon.png') }}" style="height: 36px; width: 36px; object-fit: contain; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                        </div>
                        <input type="file" name="site_favicon_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>

                    <!-- PWA App Launcher Icon -->
                    <div style="background: #060907; color: white; padding: 1.15rem; border-radius: 1rem; border: 1.5px solid #84cc16; text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #84cc16; margin-bottom: 0.75rem;">
                            📱 Icon App PWA Launcher (512x512 PNG):
                        </label>
                        <div style="height: 70px; background: rgba(255,255,255,0.05); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ asset('images/icon-512.png') }}" style="height: 48px; width: 48px; object-fit: contain; border-radius: 10px; box-shadow: 0 0 12px rgba(132, 204, 22, 0.4);">
                        </div>
                        <input type="file" name="site_pwa_icon_file" accept="image/*" style="font-size: 0.8rem; width: 100%; color: #e2e8f0;">
                    </div>
                </div>
            </div>

            <!-- Section 2: Konten Hero Beranda -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-heading" style="color: #0077b6;"></i> Judul Utama & Subtitle Beranda
                </h4>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Judul Utama Hero Beranda:
                    </label>
                    <input type="text" name="hero_title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('hero_title', $settings['hero_title']) }}">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Deskripsi / Subtitle Hero Beranda:
                    </label>
                    <textarea name="hero_subtitle" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 80px; box-sizing: border-box;">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
                </div>

                <div style="margin-top: 1.25rem; border-top: 1px dashed #cbd5e1; padding-top: 1.15rem;">
                    <div style="margin-bottom: 1.25rem;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Judul Banner CTA Utama (Bagian Bawah Beranda):
                        </label>
                        <input type="text" name="cta_banner_title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('cta_banner_title', $settings['cta_banner_title'] ?? 'Siap Memulai Perjalanan Fitness Dalam Waktu Singkat?') }}">
                    </div>

                    <div style="margin-bottom: 0.5rem;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Sub-Judul / Deskripsi Banner CTA Utama:
                        </label>
                        <textarea name="cta_banner_subtitle" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 70px; box-sizing: border-box;">{{ old('cta_banner_subtitle', $settings['cta_banner_subtitle'] ?? 'Jangan tunda lagi! Konsultasikan kebutuhan fitness & personal trainer Anda secara gratis dengan tim admin & pelatih kami sekarang juga.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section CTA Popup Settings -->
            <div style="margin-bottom: 2.25rem; background: rgba(6, 182, 212, 0.08); border: 1px solid rgba(6, 182, 212, 0.3); padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #06b6d4; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-window-restore" style="color: #06b6d4;"></i> Pengaturan Pop-up CTA Decision Modal ("Trial Gratis vs Chat WA")
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Status Kemunculan Pop-up:
                        </label>
                        <select name="cta_popup_enabled" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; font-weight: 700; box-sizing: border-box;">
                            <option value="1" {{ old('cta_popup_enabled', $settings['cta_popup_enabled'] ?? '1') == '1' ? 'selected' : '' }}>✅ Aktif (Otomatis Muncul)</option>
                            <option value="0" {{ old('cta_popup_enabled', $settings['cta_popup_enabled'] ?? '1') == '0' ? 'selected' : '' }}>❌ Nonaktifkan Pop-up</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Waktu Penundaan Muncul (Detik):
                        </label>
                        <input type="number" name="cta_popup_delay" min="3" max="180" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; font-weight: 700; box-sizing: border-box;" value="{{ old('cta_popup_delay', $settings['cta_popup_delay'] ?? '20') }}" placeholder="Contoh: 20">
                    </div>
                </div>
            </div>

            <!-- Section 2.5: SEO & Share Link Meta (WhatsApp Preview) -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-globe" style="color: #2563eb;"></i> Pengaturan SEO & Tampilan Share Link (WhatsApp / Sosmed)
                </h4>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Judul Meta SEO / Share Link:
                    </label>
                    <input type="text" name="site_seo_title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('site_seo_title', $settings['site_seo_title'] ?? '') }}">
                    <small style="color: #94a3b8; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Judul yang akan muncul saat link dibagikan di WhatsApp/Facebook & di pencarian Google.</small>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Deskripsi Meta SEO / Share Link:
                    </label>
                    <textarea name="site_seo_description" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 75px; box-sizing: border-box;">{{ old('site_seo_description', $settings['site_seo_description'] ?? '') }}</textarea>
                    <small style="color: #94a3b8; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Deskripsi singkat yang tampil di kartu preview saat link dibagikan di WhatsApp.</small>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Teks Deskripsi Profil Footer (Tampil di Kolom 1 Footer):
                    </label>
                    <textarea name="site_footer_about" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 75px; box-sizing: border-box;">{{ old('site_footer_about', $settings['site_footer_about'] ?? '') }}</textarea>
                    <small style="color: #94a3b8; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Teks ringkas deskripsi profil lembaga di bagian bawah footer seluruh halaman.</small>
                </div>
            </div>

            <!-- Section 3: Kontak WhatsApp & Operasional -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> WhatsApp & Kontak Informasi
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Nomor WhatsApp Admin (Format 62...):
                        </label>
                        <input type="text" name="whatsapp_number" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" required>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Telepon Display (Tampilan):
                        </label>
                        <input type="text" name="site_phone" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('site_phone', $settings['site_phone']) }}">
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Pesan Default WhatsApp Chat:
                    </label>
                    <input type="text" name="whatsapp_message" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('whatsapp_message', $settings['whatsapp_message']) }}">
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Email Resmi Website:
                        </label>
                        <input type="email" name="site_email" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('site_email', $settings['site_email']) }}" required>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            Jam Operasional:
                        </label>
                        <input type="text" name="office_hours" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('office_hours', $settings['office_hours']) }}">
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Alamat Kantor Head Office:
                    </label>
                    <input type="text" name="office_address" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('office_address', $settings['office_address']) }}">
                </div>
            </div>

            <!-- Section 4: Angka Statistik Counter Beranda -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-chart-simple" style="color: #10b981;"></i> Angka Statistik Counter Beranda
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Statistik 1 (Siswa Alumni):</label>
                        <input type="text" name="stat_alumni" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_alumni', $settings['stat_alumni']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Label 1:</label>
                        <input type="text" name="stat_alumni_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_alumni_label', $settings['stat_alumni_label']) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Statistik 2 (Pengalaman):</label>
                        <input type="text" name="stat_experience" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_experience', $settings['stat_experience']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Label 2:</label>
                        <input type="text" name="stat_experience_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_experience_label', $settings['stat_experience_label']) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Statistik 3 (Lisensi PRSI):</label>
                        <input type="text" name="stat_trainers" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_trainers', $settings['stat_trainers']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Label 3:</label>
                        <input type="text" name="stat_trainers_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_trainers_label', $settings['stat_trainers_label']) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Statistik 4 (Rating):</label>
                        <input type="text" name="stat_rating" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_rating', $settings['stat_rating']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.3rem;">Label 4:</label>
                        <input type="text" name="stat_rating_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_rating_label', $settings['stat_rating_label']) }}">
                    </div>
                </div>
            </div>

            <!-- Section 5: Teks Promo Halaman Harga -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-fire" style="color: #ef4444;"></i> Teks Promo Banner Halaman Harga
                </h4>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Teks Promo (muncul di banner kuning halaman Harga):
                    </label>
                    <input type="text" name="promo_text" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('promo_text', $settings['promo_text'] ?? '🔥 PROMO SPESIAL BULAN INI: Diskon Rp 50.000 + Gratis Shaker & Handuk Gym untuk Pendaftaran Paket Privat 2 Orang!') }}">
                    <small style="color: #94a3b8; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Kosongkan jika tidak ingin menampilkan promo.</small>
                </div>
            </div>

            <!-- Section 6: Integration API Midtrans Payment Gateway -->
            <div style="margin-bottom: 2.25rem; background: rgba(6, 182, 212, 0.08); border: 1px solid rgba(6, 182, 212, 0.3); padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #06b6d4; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-credit-card" style="color: #06b6d4;"></i> Integrasi Kunci API Midtrans Payment Gateway (QRIS &amp; VA)
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 0.35rem;">
                            Midtrans Merchant ID:
                        </label>
                        <input type="text" name="midtrans_merchant_id" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('midtrans_merchant_id', $settings['midtrans_merchant_id'] ?? 'G123456789') }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 0.35rem;">
                            Midtrans Client Key:
                        </label>
                        <input type="text" name="midtrans_client_key" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('midtrans_client_key', $settings['midtrans_client_key'] ?? 'SB-Mid-client-DemoFitnessKey123') }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 0.35rem;">
                            Midtrans Server Key:
                        </label>
                        <input type="password" name="midtrans_server_key" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('midtrans_server_key', $settings['midtrans_server_key'] ?? 'SB-Mid-server-DemoFitnessKey123') }}">
                    </div>
                </div>

                <div style="font-size: 0.825rem; color: #94a3b8; background: rgba(6, 182, 212, 0.1); padding: 0.75rem 1rem; border-radius: 0.75rem; border: 1px dashed #06b6d4; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                    <span>📌 <strong>Webhook Notification URL Callback:</strong> <code style="color: #38bdf8; font-weight: 800;">{{ url('/api/midtrans/webhook') }}</code></span>
                    <span style="color: #059669; font-weight: 800;">Mode: Sandbox / Testing</span>
                </div>
            </div>

            <!-- Section 7: Integration WhatsApp Gateway API -->
            <div style="margin-bottom: 2.25rem; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.4); padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #10b981; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> Pengaturan WhatsApp Gateway Server-to-Server (Fonnte / Wablas)
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 0.35rem;">
                            WA Gateway API Token / Key:
                        </label>
                        <input type="password" name="wa_api_key" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('wa_api_key', $settings['wa_api_key'] ?? 'demo_wa_api_key_fitlife') }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 0.35rem;">
                            WA Gateway Endpoint API URL:
                        </label>
                        <input type="text" name="wa_api_endpoint" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('wa_api_endpoint', $settings['wa_api_endpoint'] ?? 'https://api.fonnte.com/send') }}">
                    </div>
                </div>

                <div style="font-size: 0.8rem; color: #10b981; font-weight: 700;">
                    ⚡ Otomatis mengirimkan ucapan Selamat Datang, E-Receipt Invoice Lunas, &amp; Notifikasi Sisa Sesi Presensi ke WA Member.
                </div>
            </div>

            <!-- Section 8: Link Sosial Media -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-share-nodes" style="color: #f59e0b;"></i> Link Akun Sosial Media Resmi
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-instagram" style="color: #e1306c;"></i> Link Instagram:
                        </label>
                        <input type="url" name="instagram_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('instagram_url', $settings['instagram_url']) }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-tiktok" style="color: #000000;"></i> Link TikTok:
                        </label>
                        <input type="url" name="tiktok_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('tiktok_url', $settings['tiktok_url']) }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-youtube" style="color: #ff0000;"></i> Link YouTube:
                        </label>
                        <input type="url" name="youtube_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('youtube_url', $settings['youtube_url']) }}">
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 1rem; width: 100%; max-width: 320px; font-weight: 900;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan Website
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
