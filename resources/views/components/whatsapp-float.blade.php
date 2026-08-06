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

<!-- Floating Action Stack Container (Tight 1-Column Stack) -->
<div class="floating-action-stack" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; margin: 0; padding: 0;">

    <!-- Top Button: Back To Top -->
    <button onclick="scrollToTop()" 
            id="backToTopBtn" 
            class="back-to-top-btn" 
            aria-label="Kembali ke atas"
            title="Kembali ke atas">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- Bottom Button: WhatsApp Floating -->
    <div class="wa-float-container" style="position: relative; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0;">
        <div class="wa-smart-tooltip" style="position: absolute; right: 58px; top: 50%; transform: translateY(-50%) translateX(12px); background: #ffffff; color: #0f172a; padding: 0.5rem 0.85rem; border-radius: 99px; font-size: 0.8rem; font-weight: 800; box-shadow: 0 10px 30px rgba(0,0,0,0.18); border: 1.5px solid #cbd5e1; display: flex; align-items: center; gap: 0.45rem; opacity: 0; visibility: hidden; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); white-space: nowrap; pointer-events: none; z-index: 10000;">
            <span style="width: 8px; height: 8px; background: #84cc16; border-radius: 50%; display: inline-block; box-shadow: 0 0 8px #84cc16;"></span>
            <span style="color: #0f172a; font-weight: 800;">Admin Online • Konsultasi Gratis</span>
        </div>
        <a href="{{ $waUrl }}" 
           target="_blank" 
           class="wa-float-btn" 
           title="Chat WhatsApp Admin FitLife Center Jogja"
           id="whatsappFloatingButton"
           style="z-index: 9999;">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

</div>

<style>
.floating-action-stack {
    box-sizing: border-box;
}

.wa-float-btn {
    position: relative !important;
    bottom: auto !important;
    right: auto !important;
    width: 48px !important;
    height: 48px !important;
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%) !important;
    color: #ffffff !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.5rem !important;
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4) !important;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    text-decoration: none !important;
    box-sizing: border-box !important;
    margin: 0 !important;
    padding: 0 !important;
}
.wa-float-btn:hover {
    transform: scale(1.1) rotate(6deg) !important;
}

.wa-float-container:hover .wa-smart-tooltip {
    opacity: 1;
    visibility: visible;
    transform: translateY(-50%) translateX(0);
}

.back-to-top-btn {
    width: 48px !important;
    height: 48px !important;
    background: #0d1310 !important;
    color: #84cc16 !important;
    border: 2px solid #84cc16 !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1rem !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5), 0 0 12px rgba(132, 204, 22, 0.2) !important;
    cursor: pointer !important;
    opacity: 0;
    visibility: hidden;
    transform: scale(0.8);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    box-sizing: border-box !important;
    margin: 0 !important;
    padding: 0 !important;
}

.back-to-top-btn.show {
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}

.back-to-top-btn:hover {
    background: #84cc16 !important;
    color: #090d0b !important;
    transform: scale(1.1) !important;
    box-shadow: 0 12px 25px rgba(132, 204, 22, 0.5) !important;
}

@media (max-width: 640px) {
    .floating-action-stack {
        bottom: 16px !important;
        right: 14px !important;
        gap: 8px !important;
    }
    .wa-float-container {
        width: 44px !important;
        height: 44px !important;
    }
    .wa-float-btn, .back-to-top-btn {
        width: 44px !important;
        height: 44px !important;
        font-size: 1.35rem !important;
    }
    .back-to-top-btn {
        font-size: 0.95rem !important;
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
            if (window.scrollY > 250) {
                btn.classList.add('show');
            } else {
                btn.classList.remove('show');
            }
        }
    });
</script>
