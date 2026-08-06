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

    <div class="admin-card" style="padding: 1.75rem 1.5rem; border-radius: 1.5rem; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        <div style="margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.15rem;">
            <h3 style="font-size: 1.35rem; color: #0f172a; margin-bottom: 0.35rem; font-weight: 900;">
                <i class="fa-solid fa-sliders" style="color: #0284c7; margin-right: 0.45rem;"></i> Pengaturan Gambar Logo, Hero & Informasi Website
            </h3>
            <p style="color: #64748b; font-size: 0.925rem; margin: 0;">
                Ganti logo header/footer, gambar hero pefitness beranda, nomor WhatsApp admin, serta teks statistik secara terpusat.
            </p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Pengaturan Gambar & Logo -->
            <div style="margin-bottom: 2.5rem; background: #f8fafc; border: 1px solid #e2e8f0; padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-image" style="color: #0284c7;"></i> Kelola Gambar Logo, Hero & Share Link Website
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                    <!-- Header Logo -->
                    <div style="background: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid #cbd5e1; text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.75rem;">
                            Logo Header Website:
                        </label>
                        <div style="height: 70px; background: #f1f5f9; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ Str::startsWith($settings['site_logo'], 'http') ? $settings['site_logo'] : asset($settings['site_logo']) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <input type="file" name="site_logo_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>

                    <!-- Footer Logo -->
                    <div style="background: #0f172a; color: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid #1e293b; text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #e2e8f0; margin-bottom: 0.75rem;">
                            Logo Footer & Sidebar Admin:
                        </label>
                        <div style="height: 70px; background: #1e293b; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ Str::startsWith($settings['site_logo_footer'], 'http') ? $settings['site_logo_footer'] : asset($settings['site_logo_footer']) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <input type="file" name="site_logo_footer_file" accept="image/*" style="font-size: 0.8rem; width: 100%; color: #e2e8f0;">
                    </div>

                    <!-- Hero Swimmer Image -->
                    <div style="background: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid #cbd5e1; text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.75rem;">
                            Gambar Hero Fitness (Beranda):
                        </label>
                        <div style="height: 70px; background: #f1f5f9; border-radius: 0.5rem; overflow: hidden; margin-bottom: 0.85rem;">
                            <img src="{{ Str::startsWith($settings['hero_image'], 'http') ? $settings['hero_image'] : asset($settings['hero_image']) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <input type="file" name="hero_image_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>

                    <!-- Share Link Image -->
                    <div style="background: white; padding: 1.15rem; border-radius: 1rem; border: 1px solid #cbd5e1; text-align: center;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.75rem;">
                            Gambar Preview Share Link (WA PNG):
                        </label>
                        <div style="height: 70px; background: #f1f5f9; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.85rem; padding: 0.5rem;">
                            <img src="{{ Str::startsWith($settings['site_share_image'] ?? '', 'http') ? $settings['site_share_image'] : asset($settings['site_share_image'] ?? 'images/logo.png') }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <input type="file" name="site_share_image_file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
                    </div>
                </div>
            </div>

            <!-- Section 2: Konten Hero Beranda -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-heading" style="color: #0077b6;"></i> Judul Utama & Subtitle Beranda
                </h4>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Judul Utama Hero Beranda:
                    </label>
                    <input type="text" name="hero_title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('hero_title', $settings['hero_title']) }}">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Deskripsi / Subtitle Hero Beranda:
                    </label>
                    <textarea name="hero_subtitle" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 80px; box-sizing: border-box;">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
                </div>

                <div style="margin-top: 1.25rem; border-top: 1px dashed #cbd5e1; padding-top: 1.15rem;">
                    <div style="margin-bottom: 1.25rem;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Judul Banner CTA Utama (Bagian Bawah Beranda):
                        </label>
                        <input type="text" name="cta_banner_title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('cta_banner_title', $settings['cta_banner_title'] ?? 'Siap Memulai Perjalanan Fitness Dalam Waktu Singkat?') }}">
                    </div>

                    <div style="margin-bottom: 0.5rem;">
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Sub-Judul / Deskripsi Banner CTA Utama:
                        </label>
                        <textarea name="cta_banner_subtitle" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 70px; box-sizing: border-box;">{{ old('cta_banner_subtitle', $settings['cta_banner_subtitle'] ?? 'Jangan tunda lagi! Konsultasikan kebutuhan fitness & personal trainer Anda secara gratis dengan tim admin & pelatih kami sekarang juga.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section CTA Popup Settings -->
            <div style="margin-bottom: 2.25rem; background: #eff6ff; border: 1px solid #bfdbfe; padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #1e40af; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-window-restore" style="color: #0284c7;"></i> Pengaturan Pop-up CTA Decision Modal ("Trial Gratis vs Chat WA")
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Status Kemunculan Pop-up:
                        </label>
                        <select name="cta_popup_enabled" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; font-weight: 700; box-sizing: border-box;">
                            <option value="1" {{ old('cta_popup_enabled', $settings['cta_popup_enabled'] ?? '1') == '1' ? 'selected' : '' }}>✅ Aktif (Otomatis Muncul)</option>
                            <option value="0" {{ old('cta_popup_enabled', $settings['cta_popup_enabled'] ?? '1') == '0' ? 'selected' : '' }}>❌ Nonaktifkan Pop-up</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Waktu Penundaan Muncul (Detik):
                        </label>
                        <input type="number" name="cta_popup_delay" min="3" max="180" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; font-weight: 700; box-sizing: border-box;" value="{{ old('cta_popup_delay', $settings['cta_popup_delay'] ?? '20') }}" placeholder="Contoh: 20">
                    </div>
                </div>
            </div>

            <!-- Section 2.5: SEO & Share Link Meta (WhatsApp Preview) -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-globe" style="color: #2563eb;"></i> Pengaturan SEO & Tampilan Share Link (WhatsApp / Sosmed)
                </h4>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Judul Meta SEO / Share Link:
                    </label>
                    <input type="text" name="site_seo_title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('site_seo_title', $settings['site_seo_title'] ?? '') }}">
                    <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Judul yang akan muncul saat link dibagikan di WhatsApp/Facebook & di pencarian Google.</small>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Deskripsi Meta SEO / Share Link:
                    </label>
                    <textarea name="site_seo_description" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 75px; box-sizing: border-box;">{{ old('site_seo_description', $settings['site_seo_description'] ?? '') }}</textarea>
                    <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Deskripsi singkat yang tampil di kartu preview saat link dibagikan di WhatsApp.</small>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Teks Deskripsi Profil Footer (Tampil di Kolom 1 Footer):
                    </label>
                    <textarea name="site_footer_about" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 75px; box-sizing: border-box;">{{ old('site_footer_about', $settings['site_footer_about'] ?? '') }}</textarea>
                    <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Teks ringkas deskripsi profil lembaga di bagian bawah footer seluruh halaman.</small>
                </div>
            </div>

            <!-- Section 3: Kontak WhatsApp & Operasional -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> WhatsApp & Kontak Informasi
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Nomor WhatsApp Admin (Format 62...):
                        </label>
                        <input type="text" name="whatsapp_number" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" required>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Telepon Display (Tampilan):
                        </label>
                        <input type="text" name="site_phone" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('site_phone', $settings['site_phone']) }}">
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Pesan Default WhatsApp Chat:
                    </label>
                    <input type="text" name="whatsapp_message" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('whatsapp_message', $settings['whatsapp_message']) }}">
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Email Resmi Website:
                        </label>
                        <input type="email" name="site_email" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('site_email', $settings['site_email']) }}" required>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Jam Operasional:
                        </label>
                        <input type="text" name="office_hours" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('office_hours', $settings['office_hours']) }}">
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Alamat Kantor Head Office:
                    </label>
                    <input type="text" name="office_address" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('office_address', $settings['office_address']) }}">
                </div>
            </div>

            <!-- Section 4: Angka Statistik Counter Beranda -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-chart-simple" style="color: #10b981;"></i> Angka Statistik Counter Beranda
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Statistik 1 (Siswa Alumni):</label>
                        <input type="text" name="stat_alumni" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_alumni', $settings['stat_alumni']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Label 1:</label>
                        <input type="text" name="stat_alumni_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_alumni_label', $settings['stat_alumni_label']) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Statistik 2 (Pengalaman):</label>
                        <input type="text" name="stat_experience" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_experience', $settings['stat_experience']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Label 2:</label>
                        <input type="text" name="stat_experience_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_experience_label', $settings['stat_experience_label']) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Statistik 3 (Lisensi PRSI):</label>
                        <input type="text" name="stat_trainers" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_trainers', $settings['stat_trainers']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Label 3:</label>
                        <input type="text" name="stat_trainers_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_trainers_label', $settings['stat_trainers_label']) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Statistik 4 (Rating):</label>
                        <input type="text" name="stat_rating" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_rating', $settings['stat_rating']) }}">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.825rem; color: #334155; margin-bottom: 0.3rem;">Label 4:</label>
                        <input type="text" name="stat_rating_label" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('stat_rating_label', $settings['stat_rating_label']) }}">
                    </div>
                </div>
            </div>

            <!-- Section 5: Teks Promo Halaman Harga -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-fire" style="color: #ef4444;"></i> Teks Promo Banner Halaman Harga
                </h4>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Teks Promo (muncul di banner kuning halaman Harga):
                    </label>
                    <input type="text" name="promo_text" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('promo_text', $settings['promo_text'] ?? '🔥 PROMO SPESIAL BULAN INI: Diskon Rp 50.000 + Gratis Shaker & Handuk Gym untuk Pendaftaran Paket Privat 2 Orang!') }}">
                    <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Kosongkan jika tidak ingin menampilkan promo.</small>
                </div>
            </div>

            <!-- Section 6: Integration API Midtrans Payment Gateway -->
            <div style="margin-bottom: 2.25rem; background: rgba(2, 132, 199, 0.05); border: 1.5px solid #0284c7; padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #0284c7; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-credit-card" style="color: #0284c7;"></i> Integrasi Kunci API Midtrans Payment Gateway (QRIS &amp; VA)
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.35rem;">
                            Midtrans Merchant ID:
                        </label>
                        <input type="text" name="midtrans_merchant_id" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('midtrans_merchant_id', $settings['midtrans_merchant_id'] ?? 'G123456789') }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.35rem;">
                            Midtrans Client Key:
                        </label>
                        <input type="text" name="midtrans_client_key" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('midtrans_client_key', $settings['midtrans_client_key'] ?? 'SB-Mid-client-DemoFitnessKey123') }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.35rem;">
                            Midtrans Server Key:
                        </label>
                        <input type="password" name="midtrans_server_key" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('midtrans_server_key', $settings['midtrans_server_key'] ?? 'SB-Mid-server-DemoFitnessKey123') }}">
                    </div>
                </div>

                <div style="font-size: 0.825rem; color: #475569; background: white; padding: 0.75rem 1rem; border-radius: 0.75rem; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                    <span>📌 <strong>Webhook Notification URL Callback:</strong> <code style="color: #0284c7; font-weight: 800;">{{ url('/api/midtrans/webhook') }}</code></span>
                    <span style="color: #059669; font-weight: 800;">Mode: Sandbox / Testing</span>
                </div>
            </div>

            <!-- Section 7: Integration WhatsApp Gateway API -->
            <div style="margin-bottom: 2.25rem; background: rgba(37, 211, 102, 0.05); border: 1.5px solid #25d366; padding: 1.5rem; border-radius: 1.25rem;">
                <h4 style="font-size: 1.1rem; color: #15803d; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> Pengaturan WhatsApp Gateway Server-to-Server (Fonnte / Wablas)
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.35rem;">
                            WA Gateway API Token / Key:
                        </label>
                        <input type="password" name="wa_api_key" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('wa_api_key', $settings['wa_api_key'] ?? 'demo_wa_api_key_fitlife') }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.85rem; color: #334155; margin-bottom: 0.35rem;">
                            WA Gateway Endpoint API URL:
                        </label>
                        <input type="text" name="wa_api_endpoint" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('wa_api_endpoint', $settings['wa_api_endpoint'] ?? 'https://api.fonnte.com/send') }}">
                    </div>
                </div>

                <div style="font-size: 0.8rem; color: #15803d; font-weight: 700;">
                    ⚡ Otomatis mengirimkan ucapan Selamat Datang, E-Receipt Invoice Lunas, &amp; Notifikasi Sisa Sesi Presensi ke WA Member.
                </div>
            </div>

            <!-- Section 8: Link Sosial Media -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800;">
                    <i class="fa-solid fa-share-nodes" style="color: #f59e0b;"></i> Link Akun Sosial Media Resmi
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-instagram" style="color: #e1306c;"></i> Link Instagram:
                        </label>
                        <input type="url" name="instagram_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('instagram_url', $settings['instagram_url']) }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-tiktok" style="color: #000000;"></i> Link TikTok:
                        </label>
                        <input type="url" name="tiktok_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; box-sizing: border-box;" value="{{ old('tiktok_url', $settings['tiktok_url']) }}">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
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
