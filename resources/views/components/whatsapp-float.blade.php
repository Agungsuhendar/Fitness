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
            $waMessage = "Halo Kak, saya mau konsultasi Paket FitLife Female Fitness & Personal Trainer Wanita.";
        } elseif (Str::contains($slug, 'tni') || Str::contains($slug, 'polri')) {
            $waMessage = "Halo Coach, saya mau konsultasi kelas fisik intensif Muscle Building & Kesamaptaan TNI POLRI.";
        } elseif (Str::contains($slug, 'fat-loss') || Str::contains($slug, 'dewasa')) {
            $waMessage = "Halo Admin, saya berminat ikut program Weight Loss & Fat Burning FitLife.";
        } elseif (Str::contains($slug, 'terapi') || Str::contains($slug, 'rehab')) {
            $waMessage = "Halo Coach, saya mau tanya informasi Posture Correction & Rehab Fungsional.";
        } else {
            $waMessage = "Halo Admin, saya tertarik menanyakan info pendaftaran program " . ucfirst(str_replace('-', ' ', $slug)) . ".";
        }
    } elseif ($routeName === 'harga') {
        $waMessage = "Halo Admin, saya mau bertanya promo & harga paket FitLife Gym & PT bulan ini.";
    } elseif ($routeName === 'lokasi' || $routeName === 'area.fitness' || $routeName === 'area.landing') {
        $areaName = isset($area) && is_array($area) ? ($area['area_name'] ?? 'Jogja') : 'Jogja';
        $waMessage = "Halo Admin, saya mau tanya lokasi studio gym terdekat dan jadwal privat area " . $areaName . ".";
    } elseif ($routeName === 'faq') {
        $waMessage = "Halo Admin, saya ada pertanyaan seputar sistem latihan dan jadwal Personal Trainer FitLife.";
    } elseif ($routeName === 'kontak') {
        $waMessage = "Halo Admin FitLife Center Jogja, saya mau konsultasi gratis jadwal dan pendaftaran.";
    } else {
        $waMessage = site_setting('whatsapp_message', 'Halo Admin FitLife Center Jogja, saya ingin bertanya info dan pendaftaran fitness & PT.');
    }

    $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($waMessage);
@endphp

<div class="wa-float-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; align-items: center;">
    <div class="wa-smart-tooltip" style="position: absolute; right: 68px; background: #ffffff; color: var(--dark-surface); padding: 0.55rem 0.95rem; border-radius: 99px; font-size: 0.82rem; font-weight: 800; box-shadow: 0 10px 30px rgba(0,0,0,0.18); border: 1.5px solid #cbd5e1; display: flex; align-items: center; gap: 0.45rem; opacity: 0; visibility: hidden; transform: translateX(12px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); white-space: nowrap; pointer-events: none; z-index: 10000;">
        <span style="width: 8px; height: 8px; background: #84cc16; border-radius: 50%; display: inline-block; box-shadow: 0 0 8px #84cc16;"></span>
        <span style="color: #0f172a; font-weight: 800;">Admin Online • Konsultasi Gratis</span>
    </div>
    <a href="{{ $waUrl }}" 
       target="_blank" 
       class="wa-float-btn" 
       title="Chat WhatsApp Admin FitLife Center Jogja"
       id="whatsappFloatingButton"
       style="z-index: 9999;">
        <div class="wa-pulse"></div>
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<style>
.wa-float-btn {
    width: 54px;
    height: 54px;
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.45);
    position: relative;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-decoration: none;
}
.wa-float-btn:hover {
    transform: scale(1.1) rotate(6deg);
}
.wa-pulse {
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px solid #25d366;
    animation: waPulse 2s infinite ease-out;
    pointer-events: none;
}
@keyframes waPulse {
    0% { transform: scale(1); opacity: 0.8; }
    100% { transform: scale(1.35); opacity: 0; }
}
.wa-float-container:hover .wa-smart-tooltip {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
}

@media (max-width: 640px) {
    .wa-float-container {
        bottom: 78px !important;
        right: 18px !important;
    }
    .wa-float-btn {
        width: 48px !important;
        height: 48px !important;
        font-size: 1.55rem !important;
    }
}
</style>
