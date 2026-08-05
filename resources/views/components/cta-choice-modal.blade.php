<div class="modal-overlay" id="ctaChoiceModal" style="z-index: 99999;">
    <div class="modal-card" style="max-width: 580px; padding: 2.25rem; border-radius: 2rem; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); position: relative;">
        <button class="modal-close" onclick="closeCtaChoiceModal()" style="top: 15px; right: 15px; font-size: 1.5rem;">&times;</button>
        
        <div style="text-align: center; margin-bottom: 1.75rem;">
            <span style="background: rgba(132, 204, 22, 0.15); color: #65a30d; padding: 0.4rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 0.6rem;">
                <i class="fa-solid fa-sparkles"></i> Pilihan Pendaftaran & Konsultasi
            </span>
            <h3 style="font-size: 1.65rem; margin: 0; color: #0f172a; font-weight: 900;">
                Mana yang Lebih Nyaman Untuk Anda?
            </h3>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.4rem; margin-bottom: 0;">
                Pilih opsi di bawah untuk respon paling cepat dari tim pelatih kami!
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 1rem; margin-bottom: 1.25rem;">
            <!-- Choice 1: Booking Trial Gratis -->
            <div onclick="closeCtaChoiceModal(); openTrialModal();" style="border: 2px solid #84cc16; background: linear-gradient(135deg, #f7fee7 0%, #ffffff 100%); padding: 1.5rem 1.25rem; border-radius: 1.35rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: center; box-shadow: 0 10px 25px rgba(132, 204, 22, 0.15);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 18px 35px rgba(132, 204, 22, 0.3)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 10px 25px rgba(132, 204, 22, 0.15)'">
                <div style="width: 54px; height: 54px; background: rgba(132, 204, 22, 0.2); border-radius: 50%; color: #65a30d; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 0.85rem;">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div style="font-weight: 900; font-size: 1.1rem; color: #0f172a; margin-bottom: 0.35rem;">
                    Coba Trial Gratis 30m
                </div>
                <p style="font-size: 0.8rem; color: #64748b; line-height: 1.4; margin-bottom: 1rem;">
                    Uji coba 1 sesi 30 menit gratis! Cek langsung keramahan pelatih & fasilitas gym.
                </p>
                <div style="background: #84cc16; color: #090d0b; padding: 0.65rem 1rem; border-radius: 0.85rem; font-weight: 900; font-size: 0.875rem;">
                    ⚡ Booking Trial Sekarang
                </div>
            </div>

            <!-- Choice 2: Chat WA Dulu -->
            @php
                $waNumChoice = site_setting('whatsapp_number', '6281234567890');
                $waMsgChoice = site_setting('whatsapp_message', 'Halo Admin FitLife Gym Jogja, saya mau konsultasi gratis jadwal dan pendaftaran.');
                $waUrlChoice = "https://wa.me/" . $waNumChoice . "?text=" . urlencode($waMsgChoice);
            @endphp
            <a href="{{ $waUrlChoice }}" target="_blank" onclick="closeCtaChoiceModal();" style="border: 2px solid #22c55e; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); padding: 1.5rem 1.25rem; border-radius: 1.35rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: center; text-decoration: none; box-shadow: 0 10px 25px rgba(34, 197, 94, 0.12);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 18px 35px rgba(34, 197, 94, 0.25)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 10px 25px rgba(34, 197, 94, 0.12)'">
                <div style="width: 54px; height: 54px; background: rgba(34, 197, 94, 0.15); border-radius: 50%; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 0.85rem;">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div style="font-weight: 900; font-size: 1.1rem; color: #0f172a; margin-bottom: 0.35rem;">
                    Konsultasi WA Dulu
                </div>
                <p style="font-size: 0.8rem; color: #64748b; line-height: 1.4; margin-bottom: 1rem;">
                    Masih mau tanya-tanya seputar jadwal, lokasi studio gym terdekat, atau harga paket?
                </p>
                <div style="background: #22c55e; color: white; padding: 0.65rem 1rem; border-radius: 0.85rem; font-weight: 800; font-size: 0.875rem;">
                    💬 Chat WA Fast Response
                </div>
            </a>
        </div>

        <div style="text-align: center; border-top: 1px solid #e2e8f0; padding-top: 1rem;">
            <button onclick="closeCtaChoiceModal(); openRegistrationModal();" style="background: none; border: none; font-size: 0.85rem; color: #65a30d; font-weight: 800; text-decoration: underline; cursor: pointer;">
                Atau langsung isi Formulir Pendaftaran Paket →
            </button>
        </div>
    </div>
</div>
