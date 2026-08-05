<div class="modal-overlay" id="registrationModal">
    <div class="modal-card" style="max-width: 640px; padding: 2rem; background: #0f172a; border: 1px solid rgba(255,255,255,0.15); color: #ffffff;">
        <button class="modal-close" onclick="closeRegistrationModal()" style="color: #ffffff;">&times;</button>
        
        <div style="text-align: center; margin-bottom: 1.25rem;">
            <div style="display: inline-flex; width: 48px; height: 48px; background: rgba(16, 185, 129, 0.15); border-radius: 50%; color: #10b981; align-items: center; justify-content: center; font-size: 1.35rem; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-dumbbell"></i>
            </div>
            <h3 style="font-size: 1.5rem; margin-bottom: 0.2rem; color: #ffffff;">Pendaftaran Paket Personal Trainer</h3>
            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Pilih cabang studio gym & jadwalkan sesi konsultasi Personal Trainer Anda.</p>
        </div>

        <form action="{{ route('lead.register') }}" method="POST" id="formRegistration">
            @csrf

            <!-- 1. Visual Choice: Studio Location Selector -->
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="font-weight: 800; font-size: 0.9rem; margin-bottom: 0.5rem; display: block; color: #e2e8f0;">
                    1. Pilih Cabang Studio Gym <span style="color:#ef4444;">*</span>
                </label>
                <input type="hidden" name="preferred_location" id="selectedLocationInput" value="ApexFitness Center Sleman (HQ)" required>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 0.65rem;" id="locationPickerGroup">
                    <div class="location-chip" data-loc="ApexFitness Center Sleman (HQ)" onclick="selectLocationChip(this, 'ApexFitness Center Sleman (HQ)')" style="border: 2px solid #10b981; background: rgba(16, 185, 129, 0.12); padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #10b981;"><i class="fa-solid fa-building"></i> Sleman HQ</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Kaliurang KM 5.5 • Complete Gym</div>
                    </div>
                    <div class="location-chip" data-loc="Apex Studio Seturan" onclick="selectLocationChip(this, 'Apex Studio Seturan')" style="border: 1px solid #334155; background: #1e293b; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #ffffff;"><i class="fa-solid fa-graduation-cap"></i> Seturan Studio</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Area Kampus UGM/UPN</div>
                    </div>
                    <div class="location-chip" data-loc="Apex Performance Umbulharjo" onclick="selectLocationChip(this, 'Apex Performance Umbulharjo')" style="border: 1px solid #334155; background: #1e293b; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #ffffff;"><i class="fa-solid fa-city"></i> Umbulharjo Jogja</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Kota Jogja • Heavy Lifting</div>
                    </div>
                    <div class="location-chip" data-loc="Private Home Training (Pelatih ke Rumah)" onclick="selectLocationChip(this, 'Private Home Training (Pelatih ke Rumah)')" style="border: 1px solid #334155; background: #1e293b; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #ffffff;"><i class="fa-solid fa-house-user"></i> Home Visit PT</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Trainer Datang ke Rumah</div>
                    </div>
                </div>
            </div>

            <!-- 2. Target Goal & Preferred Schedule -->
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="font-weight: 800; font-size: 0.9rem; margin-bottom: 0.5rem; display: block; color: #e2e8f0;">
                    2. Sesi Jam Latihan Favorit <span style="color:#ef4444;">*</span>
                </label>
                <input type="hidden" name="preferred_schedule" id="selectedScheduleInput" value="Pagi Hari (06:00 - 09:00 WIB)" required>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 0.5rem;" id="timeSlotGroup">
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Pagi Hari (06:00 - 09:00 WIB)')" style="border: 2px solid #10b981; background: rgba(16, 185, 129, 0.12); padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #10b981;">🌅 Pagi</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">06:00 - 09:00 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Siang Hari (10:00 - 14:00 WIB)')" style="border: 1px solid #334155; background: #1e293b; padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #ffffff;">☀️ Siang</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">10:00 - 14:00 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Sore Hari (15:30 - 18:30 WIB)')" style="border: 1px solid #334155; background: #1e293b; padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #ffffff;">🌇 Sore</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">15:30 - 18:30 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Malam Hari (19:00 - 21:30 WIB)')" style="border: 1px solid #334155; background: #1e293b; padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #ffffff;">🌃 Malam</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">19:00 - 21:30 WIB</div>
                    </div>
                </div>
            </div>

            <!-- 3. Form Inputs -->
            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 0.85rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Anda" required style="padding: 0.55rem 0.85rem; font-size: 0.9rem; background: #1e293b; border-color: #334155; color: #ffffff;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1;">No. WhatsApp <span style="color:#ef4444;">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="081234567890" required style="padding: 0.55rem 0.85rem; font-size: 0.9rem; background: #1e293b; border-color: #334155; color: #ffffff;">
                </div>
            </div>

            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 1rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1;">Target Utama Fitness <span style="color:#ef4444;">*</span></label>
                    <select name="program_name" id="modalProgramSelect" class="form-control" required style="padding: 0.55rem 0.85rem; font-size: 0.875rem; background: #1e293b; border-color: #334155; color: #ffffff;">
                        <option value="Weight Loss & Body Transformation">Weight Loss & Fat Burn (Turun BB)</option>
                        <option value="Muscle Building & Hypertrophy">Muscle Building & Hypertrophy (Bulking)</option>
                        <option value="Female Fitness & Body Shaping">Female Fitness & Pilates (Khusus Wanita)</option>
                        <option value="Strength & Persiapan TNI-POLRI">Persiapan Fisik TNI / POLRI</option>
                        <option value="Posture Correction & Rehab Fungsional">Posture Correction & Rehab Nyeri</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1;">Pilihan Personal Trainer <span style="color:#ef4444;">*</span></label>
                    <select name="age_category" class="form-control" required style="padding: 0.55rem 0.85rem; font-size: 0.875rem; background: #1e293b; border-color: #334155; color: #ffffff;">
                        <option value="Personal Trainer Pria (Senior)">Personal Trainer Pria (Senior)</option>
                        <option value="Personal Trainer Wanita (Privat)">Personal Trainer Wanita (Privat)</option>
                        <option value="Spesialis Rehab & Posture">Spesialis Posture Rehab & Pain Relief</option>
                        <option value="Spesialis Fisik TNI POLRI">Spesialis Fisik TNI / POLRI</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-weight: 800; border-radius: 0.75rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                    <i class="fa-solid fa-paper-plane"></i> Submit Pendaftaran
                </button>
                <button type="button" onclick="submitRegistrationToWA()" class="btn btn-whatsapp" style="width: 100%; padding: 0.85rem; font-weight: 800; border-radius: 0.75rem; background: #25d366; border: none; color: white;">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function submitRegistrationToWA() {
        const form = document.getElementById('formRegistration');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        const name = form.querySelector('[name="name"]').value;
        const phone = form.querySelector('[name="phone"]').value;
        const prog = form.querySelector('[name="program_name"]').value;
        const ptPref = form.querySelector('[name="age_category"]').value;
        const loc = document.getElementById('selectedLocationInput').value;
        const sched = document.getElementById('selectedScheduleInput').value;

        const text = `Halo Admin ApexFitness Center, saya ingin mendaftar *Paket Personal Trainer*:\n` +
                     `• Nama: *${name}*\n` +
                     `• No. WA: *${phone}*\n` +
                     `• Target Fitness: *${prog}*\n` +
                     `• Opsi PT: *${ptPref}*\n` +
                     `• Studio Gym: *${loc}*\n` +
                     `• Sesi Jam: *${sched}*\n\n` +
                     `Mohon info promo & konfirmasi jadwal konsulnya min!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
    }

    function selectLocationChip(el, locName) {
        document.querySelectorAll('#locationPickerGroup .location-chip').forEach(chip => {
            chip.style.border = "1px solid #334155";
            chip.style.background = "#1e293b";
            chip.querySelector('.chip-title').style.color = "#ffffff";
        });
        el.style.border = "2px solid #10b981";
        el.style.background = "rgba(16, 185, 129, 0.12)";
        el.querySelector('.chip-title').style.color = "#10b981";
        document.getElementById('selectedLocationInput').value = locName;
    }

    function selectTimeSlot(el, timeSlotName) {
        document.querySelectorAll('#timeSlotGroup .time-slot-chip').forEach(chip => {
            chip.style.border = "1px solid #334155";
            chip.style.background = "#1e293b";
            chip.querySelector('.slot-title').style.color = "#ffffff";
        });
        el.style.border = "2px solid #10b981";
        el.style.background = "rgba(16, 185, 129, 0.12)";
        el.querySelector('.slot-title').style.color = "#10b981";
        document.getElementById('selectedScheduleInput').value = timeSlotName;
    }
</script>
