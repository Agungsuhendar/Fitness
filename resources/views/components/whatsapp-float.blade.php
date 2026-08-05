@php
    if (!function_exists('site_setting')) {
        function site_setting($key, $default = null) {
            return class_exists('\App\Models\Setting') ? \App\Models\Setting::get($key, $default) : $default;
        }
    }

    $waNumber = site_setting('whatsapp_number', '6281234567890');
    
    // Dynamic Contextual Message based on current route/page
    $routeName = request()->route() ? request()->route()->getName() : '';
    $slug = request()->route('slug');

    if ($routeName === 'program.show') {
        if (Str::contains($slug, 'wanita')) {
            $waMessage = "Halo Kak, saya mau konsultasi Paket Les Renang Wanita / Muslimah dengan pelatih wanita di kolam privat.";
        } elseif (Str::contains($slug, 'tni') || Str::contains($slug, 'polri')) {
            $waMessage = "Halo Coach, saya mau konsultasi kelas fisik intensif Persiapan Tes Renang TNI & POLRI.";
        } elseif (Str::contains($slug, 'anak')) {
            $waMessage = "Halo Admin, saya mau tanya pendaftaran Les Renang Anak untuk anak usia [..] thn.";
        } elseif (Str::contains($slug, 'dewasa')) {
            $waMessage = "Halo Admin, saya berminat ikut Les Renang Dewasa Pemula (bebas trauma air).";
        } elseif (Str::contains($slug, 'terapi')) {
            $waMessage = "Halo Coach, saya mau tanya informasi Terapi Renang Medis.";
        } else {
            $waMessage = "Halo Admin, saya tertarik menanyakan info pendaftaran program " . ucfirst(str_replace('-', ' ', $slug)) . ".";
        }
    } elseif ($routeName === 'harga') {
        $waMessage = "Halo Admin, saya mau bertanya promo & harga paket les renang bulan ini.";
    } elseif ($routeName === 'lokasi' || $routeName === 'area.landing') {
        $areaName = isset($area) && is_array($area) ? ($area['area_name'] ?? 'Jogja') : 'Jogja';
        $waMessage = "Halo Admin, saya mau tanya lokasi kolam terdekat dan jadwal les renang area " . $areaName . ".";
    } elseif ($routeName === 'faq') {
        $waMessage = "Halo Admin, saya ada pertanyaan seputar sistem latihan dan jadwal les renang.";
    } elseif ($routeName === 'kontak') {
        $waMessage = "Halo Admin Les Renang Jogja, saya mau konsultasi gratis jadwal dan pendaftaran.";
    } else {
        $waMessage = site_setting('whatsapp_message', 'Halo Admin Les Renang Jogja, saya ingin bertanya info dan pendaftaran les renang.');
    }

    $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($waMessage);
@endphp

<div class="wa-float-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; align-items: center;">
    <div class="wa-smart-tooltip" style="position: absolute; right: 68px; background: #ffffff; color: var(--dark-surface); padding: 0.55rem 0.95rem; border-radius: 99px; font-size: 0.82rem; font-weight: 800; box-shadow: 0 10px 30px rgba(0,0,0,0.18); border: 1.5px solid #cbd5e1; display: flex; align-items: center; gap: 0.45rem; opacity: 0; visibility: hidden; transform: translateX(12px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); white-space: nowrap; pointer-events: none; z-index: 10000;">
        <span style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; box-shadow: 0 0 8px #22c55e;"></span>
        <span style="color: #0f172a; font-weight: 800;">Admin Online • Konsultasi Gratis</span>
    </div>
    <a href="{{ $waUrl }}" 
       target="_blank" 
       class="wa-float-btn" 
       title="Chat WhatsApp Admin Les Renang Jogja"
       id="whatsappFloatingButton"
       style="z-index: 9999;">
        <div class="wa-pulse"></div>
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<style>
    .wa-float-container:hover .wa-smart-tooltip {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateX(0) !important;
    }
    @media (max-width: 640px) {
        .wa-float-container {
            bottom: 20px !important;
            right: 20px !important;
        }
        .wa-smart-tooltip {
            right: 62px !important;
        }
    }
</style>
