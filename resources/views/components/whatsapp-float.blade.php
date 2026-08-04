@php
    if (!function_exists('site_setting')) {
        function site_setting($key, $default = null) {
            return class_exists('\App\Models\Setting') ? \App\Models\Setting::get($key, $default) : $default;
        }
    }
@endphp
<div class="wa-float-container" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; align-items: center;">
    <div class="wa-smart-tooltip" style="position: absolute; right: 68px; background: #ffffff; color: var(--dark-surface); padding: 0.55rem 0.95rem; border-radius: 99px; font-size: 0.82rem; font-weight: 800; box-shadow: 0 10px 30px rgba(0,0,0,0.18); border: 1.5px solid #cbd5e1; display: flex; align-items: center; gap: 0.45rem; opacity: 0; visibility: hidden; transform: translateX(12px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); white-space: nowrap; pointer-events: none; z-index: 10000;">
        <span style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; box-shadow: 0 0 8px #22c55e;"></span>
        <span style="color: #0f172a; font-weight: 800;">Admin Online • Konsultasi Gratis</span>
    </div>
    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(site_setting('whatsapp_message', 'Halo Admin Les Renang Jogja, saya ingin tanya informasi jadwal dan biaya les renang.')) }}" 
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
