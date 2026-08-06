<div class="modal-overlay" id="registrationModal">
    <div class="modal-card" style="max-width: 640px; padding: 2rem; background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); color: #ffffff; border-radius: 1.75rem;">
        <button class="modal-close" onclick="closeRegistrationModal()" style="color: #ffffff; background: rgba(255,255,255,0.1); border-radius: 50%; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; top: 1.25rem; right: 1.25rem;">&times;</button>
        
        <div style="text-align: center; margin-bottom: 1.25rem;">
            <div style="display: inline-flex; width: 48px; height: 48px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; color: #84cc16; align-items: center; justify-content: center; font-size: 1.35rem; margin-bottom: 0.5rem; box-shadow: 0 0 15px rgba(132, 204, 22, 0.3);">
                <i class="fa-solid fa-dumbbell"></i>
            </div>
            <h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 0.2rem; color: #ffffff; font-family: 'Outfit', sans-serif;">Pendaftaran Paket Personal Trainer</h3>
            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Pilih cabang studio gym & jadwalkan sesi konsultasi Personal Trainer Anda.</p>
        </div>

        <form action="{{ route('lead.register') }}" method="POST" id="formRegistration">
            @csrf

            <!-- 1. Visual Choice: Studio Location Selector -->
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="font-weight: 800; font-size: 0.9rem; margin-bottom: 0.5rem; display: block; color: #e2e8f0;">
                    1. Pilih Cabang Studio Gym <span style="color:#ef4444;">*</span>
                </label>
                <input type="hidden" name="preferred_location" id="selectedLocationInput" value="FitLife HQ Kaliurang (Sleman)" required>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 0.65rem;" id="locationPickerGroup">
                    <div class="location-chip" data-loc="FitLife HQ Kaliurang (Sleman)" onclick="selectLocationChip(this, 'FitLife HQ Kaliurang (Sleman)')" style="border: 2px solid #84cc16; background: rgba(132, 204, 22, 0.12); padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #84cc16;"><i class="fa-solid fa-building"></i> Sleman HQ</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Kaliurang KM 5.5 • Complete Gym</div>
                    </div>
                    <div class="location-chip" data-loc="FitLife Studio Seturan (UGM)" onclick="selectLocationChip(this, 'FitLife Studio Seturan (UGM)')" style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.05); padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #ffffff;"><i class="fa-solid fa-graduation-cap"></i> Seturan Studio</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Area Kampus UGM/UPN</div>
                    </div>
                    <div class="location-chip" data-loc="FitLife Branch Sewon (Bantul)" onclick="selectLocationChip(this, 'FitLife Branch Sewon (Bantul)')" style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.05); padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: #ffffff;"><i class="fa-solid fa-city"></i> Sewon Bantul</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Bantul & Sewon Area</div>
                    </div>
                    <div class="location-chip" data-loc="Private Home Training (Pelatih ke Rumah)" onclick="selectLocationChip(this, 'Private Home Training (Pelatih ke Rumah)')" style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.05); padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
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
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Pagi Hari (06:00 - 09:00 WIB)')" style="border: 2px solid #84cc16; background: rgba(132, 204, 22, 0.12); padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #84cc16;">🌅 Pagi</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">06:00 - 09:00 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Siang Hari (10:00 - 14:00 WIB)')" style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.05); padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #ffffff;">☀️ Siang</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">10:00 - 14:00 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Sore Hari (15:30 - 18:30 WIB)')" style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.05); padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #ffffff;">🌇 Sore</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">15:30 - 18:30 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Malam Hari (19:00 - 21:30 WIB)')" style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.05); padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: #ffffff;">🌃 Malam</div>
                        <div style="font-size: 0.725rem; color: #94a3b8;">19:00 - 21:30 WIB</div>
                    </div>
                </div>
            </div>

            <!-- 3. Form Inputs -->
            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 0.85rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Anda" required style="padding: 0.55rem 0.85rem; font-size: 0.9rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">No. WhatsApp <span style="color:#ef4444;">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="081234567890" required style="padding: 0.55rem 0.85rem; font-size: 0.9rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none;">
                </div>
            </div>

            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 1rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">Target Utama Fitness <span style="color:#ef4444;">*</span></label>
                    <select name="program_name" id="modalProgramSelect" class="form-control" required style="padding: 0.55rem 0.85rem; font-size: 0.875rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none;">
                        <option value="Weight Loss & Body Transformation">Weight Loss & Fat Burn (Turun BB)</option>
                        <option value="Muscle Building & Hypertrophy">Muscle Building & Hypertrophy (Bulking)</option>
                        <option value="Female Fitness & Body Shaping">Female Fitness & Shaping (Khusus Wanita)</option>
                        <option value="Strength & Persiapan TNI-POLRI">Persiapan Fisik TNI / POLRI</option>
                        <option value="Posture Correction & Rehab Fungsional">Posture Correction & Rehab Nyeri</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">Pilihan Personal Trainer <span style="color:#ef4444;">*</span></label>
                    <select name="age_category" class="form-control" required style="padding: 0.55rem 0.85rem; font-size: 0.875rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none;">
                        <option value="Personal Trainer Pria (Senior)">Personal Trainer Pria (Senior)</option>
                        <option value="Personal Trainer Wanita (Privat)">Personal Trainer Wanita (Privat)</option>
                        <option value="Spesialis Rehab & Posture">Spesialis Posture Rehab & Pain Relief</option>
                        <option value="Spesialis Fisik TNI POLRI">Spesialis Fisik TNI / POLRI</option>
                    </select>
                </div>
            </div>

            <!-- 4. Interactive Promo Code Section -->
            <div class="form-group" style="margin-bottom: 1.15rem; background: rgba(255,255,255,0.03); border: 1px dashed rgba(132,204,22,0.4); border-radius: 0.85rem; padding: 0.85rem;">
                <label class="form-label" style="font-size: 0.825rem; color: #cbd5e1; font-weight: 700; display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
                    <span><i class="fa-solid fa-ticket" style="color: #84cc16;"></i> Punya Kode Voucher Promo?</span>
                    <span style="font-size: 0.75rem; color: #84cc16;">Opsional</span>
                </label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="promo_code" id="regPromoCodeInput" class="form-control" placeholder="Contoh: MAHASISWA15 / FITLIFE10" style="padding: 0.55rem 0.85rem; font-size: 0.875rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; text-transform: uppercase; font-weight: 800; flex: 1; outline: none;">
                    <button type="button" onclick="verifyRegPromoCode()" style="background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.55rem 1rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.85rem; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                        Gunakan Kode
                    </button>
                </div>
                <div id="regPromoMessage" style="margin-top: 0.45rem; font-size: 0.8rem; display: none;"></div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                <button type="submit" class="btn glow-btn" style="width: 100%; padding: 0.85rem; font-weight: 900; border-radius: 99px; background: #84cc16; border: none; color: #090d0b; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                    <i class="fa-solid fa-paper-plane"></i> Submit Pendaftaran
                </button>
                <button type="button" onclick="submitRegistrationToWA()" class="btn" style="width: 100%; padding: 0.85rem; font-weight: 900; border-radius: 99px; background: #25d366; border: none; color: white; box-shadow: 0 0 20px rgba(37,211,102,0.4);">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let activeRegPromoCode = '';

    function verifyRegPromoCode() {
        const input = document.getElementById('regPromoCodeInput');
        const msgDiv = document.getElementById('regPromoMessage');
        const code = input.value.trim();

        if (!code) {
            msgDiv.style.display = 'block';
            msgDiv.style.color = '#f87171';
            msgDiv.innerText = 'Silakan masukkan kode voucher promo terlebih dahulu.';
            return;
        }

        fetch('/check-promo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        })
        .then(res => res.json())
        .then(data => {
            msgDiv.style.display = 'block';
            if (data.success && data.valid) {
                activeRegPromoCode = data.code;
                msgDiv.style.color = '#84cc16';
                msgDiv.innerHTML = `<i class="fa-solid fa-circle-check"></i> <strong>${data.title}</strong>: ${data.description}`;
            } else {
                activeRegPromoCode = '';
                msgDiv.style.color = '#f87171';
                msgDiv.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> ${data.message || 'Kode promo tidak valid.'}`;
            }
        })
        .catch(err => {
            msgDiv.style.display = 'block';
            msgDiv.style.color = '#f87171';
            msgDiv.innerText = 'Gagal memverifikasi kode promo. Silakan coba lagi.';
        });
    }

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
        const promo = activeRegPromoCode || form.querySelector('[name="promo_code"]').value.trim();

        const text = `Halo Admin FitLife Gym Jogja, saya ingin mendaftar *Paket Personal Trainer*:\n` +
                     `• Nama: *${name}*\n` +
                     `• No. WA: *${phone}*\n` +
                     `• Target Fitness: *${prog}*\n` +
                     `• Opsi PT: *${ptPref}*\n` +
                     `• Studio Gym: *${loc}*\n` +
                     `• Sesi Jam: *${sched}*\n` +
                     (promo ? `• *KODE PROMO VOUCHER:* *${promo}*\n` : '') +
                     `\nMohon info promo & konfirmasi jadwal konsulnya min!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
    }

    function selectLocationChip(el, locName) {
        document.querySelectorAll('#locationPickerGroup .location-chip').forEach(chip => {
            chip.style.border = "1px solid rgba(255,255,255,0.12)";
            chip.style.background = "rgba(255,255,255,0.05)";
            chip.querySelector('.chip-title').style.color = "#ffffff";
        });
        el.style.border = "2px solid #84cc16";
        el.style.background = "rgba(132, 204, 22, 0.12)";
        el.querySelector('.chip-title').style.color = "#84cc16";
        document.getElementById('selectedLocationInput').value = locName;
    }

    function selectTimeSlot(el, timeSlotName) {
        document.querySelectorAll('#timeSlotGroup .time-slot-chip').forEach(chip => {
            chip.style.border = "1px solid rgba(255,255,255,0.12)";
            chip.style.background = "rgba(255,255,255,0.05)";
            chip.querySelector('.slot-title').style.color = "#ffffff";
        });
        el.style.border = "2px solid #84cc16";
        el.style.background = "rgba(132, 204, 22, 0.12)";
        el.querySelector('.slot-title').style.color = "#84cc16";
        document.getElementById('selectedScheduleInput').value = timeSlotName;
    }
</script>
