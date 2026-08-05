<div class="sticky-mobile-bar" id="mobileStickyCtaBar" style="display: flex; gap: 0.35rem; padding: 0.6rem 0.85rem;">
    <button onclick="openRegistrationModal()" class="btn btn-primary btn-sm" style="flex: 1; justify-content: center; font-size: 0.76rem; padding: 0.5rem 0.35rem; white-space: nowrap;">
        <i class="fa-solid fa-paper-plane"></i> Daftar
    </button>
    <button onclick="openTrialModal()" class="btn btn-accent btn-sm" style="flex: 1; justify-content: center; font-size: 0.76rem; padding: 0.5rem 0.35rem; white-space: nowrap;">
        <i class="fa-solid fa-bolt"></i> Trial
    </button>
    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(site_setting('whatsapp_message', 'Halo Admin, saya konsultasi gratis les renang.')) }}" target="_blank" class="btn btn-whatsapp btn-sm" style="flex: 1; justify-content: center; font-size: 0.76rem; padding: 0.5rem 0.35rem; white-space: nowrap;">
        <i class="fa-brands fa-whatsapp"></i> Chat WA
    </a>
</div>
