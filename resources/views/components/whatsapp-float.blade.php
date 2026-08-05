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
        $waMessage = "Halo Admin FitLife Center Jogja, saya ingin bertanya info dan pendaftaran fitness & PT.";
    }

    $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($waMessage);
@endphp

<!-- Floating Action Stack Container (100% Perfectly Aligned Vertical Column) -->
<div class="floating-action-stack" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; align-items: center; gap: 12px; margin: 0; padding: 0;">

    <!-- Top Floating Element: Back To Top Button -->
    <button onclick="scrollToTop()" 
            id="backToTopBtn" 
            class="back-to-top-btn" 
            aria-label="Kembali ke atas"
            title="Kembali ke atas">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- Bottom Floating Element: WhatsApp Button -->
    <div class="wa-float-container" style="position: relative; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">
        <div class="wa-smart-tooltip" style="position: absolute; right: 68px; background: #ffffff; color: #0f172a; padding: 0.55rem 0.95rem; border-radius: 99px; font-size: 0.82rem; font-weight: 800; box-shadow: 0 10px 30px rgba(0,0,0,0.18); border: 1.5px solid #cbd5e1; display: flex; align-items: center; gap: 0.45rem; opacity: 0; visibility: hidden; transform: translateX(12px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); white-space: nowrap; pointer-events: none; z-index: 10000;">
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

</div>

<style>
.wa-float-btn {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.65rem;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.45);
    position: relative;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-decoration: none;
    box-sizing: border-box;
}
.wa-float-btn:hover {
    transform: scale(1.1) rotate(6deg);
}
.wa-pulse {
    position: absolute;
    inset: -4px;
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

.back-to-top-btn {
    width: 52px;
    height: 52px;
    background: #0d1310;
    color: #84cc16;
    border: 2px solid #84cc16;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5), 0 0 15px rgba(132, 204, 22, 0.2);
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transform: scale(0.8);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-sizing: border-box;
}

.back-to-top-btn.show {
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}

.back-to-top-btn:hover {
    background: #84cc16;
    color: #090d0b;
    transform: scale(1.1);
    box-shadow: 0 15px 30px rgba(132, 204, 22, 0.5);
}

@media (max-width: 640px) {
    .floating-action-stack {
        bottom: 78px !important;
        right: 16px !important;
        gap: 10px !important;
    }
    .wa-float-btn, .back-to-top-btn {
        width: 46px !important;
        height: 46px !important;
        font-size: 1.4rem !important;
    }
    .back-to-top-btn {
        font-size: 1rem !important;
    }
}
</style>

<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.addEventListener('scroll', function() {
        const btn = document.getElementById('backToTopBtn');
        if (btn) {
            if (window.scrollY > 300) {
                btn.classList.add('show');
            } else {
                btn.classList.remove('show');
            }
        }
    });
</script>
