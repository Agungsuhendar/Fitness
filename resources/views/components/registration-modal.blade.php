<div class="modal-overlay" id="registrationModal">
    <div class="modal-card" style="max-width: 640px; padding: 2rem;">
        <button class="modal-close" onclick="closeRegistrationModal()">&times;</button>
        
        <div style="text-align: center; margin-bottom: 1.25rem;">
            <div style="display: inline-flex; width: 48px; height: 48px; background: rgba(0, 119, 182, 0.12); border-radius: 50%; color: var(--primary); align-items: center; justify-content: center; font-size: 1.35rem; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <h3 style="font-size: 1.5rem; margin-bottom: 0.2rem;">Pendaftaran & Pemilihan Jadwal Les</h3>
            <p style="color: var(--text-muted); font-size: 0.875rem; margin: 0;">Pilih lokasi kolam terdekat & sesi jam latihan pilihan Anda.</p>
        </div>

        <form action="{{ route('lead.register') }}" method="POST" id="formRegistration">
            @csrf

            <!-- 1. Visual Choice: Location Selector -->
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="font-weight: 800; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">
                    1. Pilih Lokasi Kolam Renang <span style="color:red;">*</span>
                </label>
                <input type="hidden" name="preferred_location" id="selectedLocationInput" value="Depok Sport Center (Seturan)" required>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 0.65rem;" id="locationPickerGroup">
                    <div class="location-chip" data-loc="Depok Sport Center (Seturan)" onclick="selectLocationChip(this, 'Depok Sport Center (Seturan)')" style="border: 2px solid var(--primary); background: rgba(0, 119, 182, 0.08); padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: var(--primary);"><i class="fa-solid fa-water-ladder"></i> DSC Seturan</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Sleman • Air Hangat/Dingin</div>
                    </div>
                    <div class="location-chip" data-loc="FIK UNY Karangmalang" onclick="selectLocationChip(this, 'FIK UNY Karangmalang')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: var(--dark);"><i class="fa-solid fa-school"></i> FIK UNY Sleman</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Kampus UNY • Standar Olahraga</div>
                    </div>
                    <div class="location-chip" data-loc="Umbulharjo / Kota Jogja" onclick="selectLocationChip(this, 'Umbulharjo / Kota Jogja')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: var(--dark);"><i class="fa-solid fa-city"></i> Umbulharjo Jogja</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Kota Jogja • Kolam Nyaman</div>
                    </div>
                    <div class="location-chip" data-loc="Tirta Tamansari / Bantul" onclick="selectLocationChip(this, 'Tirta Tamansari / Bantul')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: var(--dark);"><i class="fa-solid fa-water"></i> Tamansari Bantul</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Sewon Bantul • Ramah Anak</div>
                    </div>
                    <div class="location-chip" data-loc="Kolam Privat / Rumah Peserta" onclick="selectLocationChip(this, 'Kolam Privat / Rumah Peserta')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 0.85rem; cursor: pointer; transition: all 0.2s ease;">
                        <div class="chip-title" style="font-weight: 800; font-size: 0.875rem; color: var(--dark);"><i class="fa-solid fa-house-user"></i> Home Visit / Privat</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">Pelatih Datang ke Rumah</div>
                    </div>
                </div>
            </div>

            <!-- 2. Interactive Schedule: Hari & Sesi Jam -->
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="font-weight: 800; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">
                    2. Pilih Hari & Sesi Jam Latihan <span style="color:red;">*</span>
                </label>
                <input type="hidden" name="preferred_schedule" id="selectedScheduleInput" value="Sabtu / Minggu • Sesi Pagi (06:00 - 08:00 WIB)" required>
                
                <!-- Day Chips -->
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.65rem;" id="dayPickerGroup">
                    <span class="day-chip" onclick="selectDayChip(this, 'Senin / Rabu')" style="padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem; border: 1px solid #cbd5e1; background: #ffffff; color: var(--dark); cursor: pointer;">Senin - Rabu</span>
                    <span class="day-chip" onclick="selectDayChip(this, 'Selasa / Kamis')" style="padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem; border: 1px solid #cbd5e1; background: #ffffff; color: var(--dark); cursor: pointer;">Selasa - Kamis</span>
                    <span class="day-chip" onclick="selectDayChip(this, 'Jumat')" style="padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem; border: 1px solid #cbd5e1; background: #ffffff; color: var(--dark); cursor: pointer;">Jumat Saja</span>
                    <span class="day-chip active" onclick="selectDayChip(this, 'Sabtu / Minggu')" style="padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem; border: 2px solid var(--primary); background: rgba(0, 119, 182, 0.1); color: var(--primary); cursor: pointer;">Sabtu / Minggu (Weekend)</span>
                </div>

                <!-- Time Slot Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 0.5rem;" id="timeSlotGroup">
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Sesi Pagi (06:00 - 08:00 WIB)')" style="border: 2px solid var(--primary); background: rgba(0, 119, 182, 0.08); padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: var(--primary);">🌅 Sesi Pagi A</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">06:00 - 08:00 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Sesi Pagi B (08:00 - 10:00 WIB)')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: var(--dark);">☀️ Sesi Pagi B</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">08:00 - 10:00 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Sesi Sore (15:30 - 17:30 WIB)')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: var(--dark);">🌇 Sesi Sore</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">15:30 - 17:30 WIB</div>
                    </div>
                    <div class="time-slot-chip" onclick="selectTimeSlot(this, 'Sesi Malam (18:30 - 20:00 WIB)')" style="border: 1px solid #cbd5e1; background: #ffffff; padding: 0.5rem; border-radius: 0.65rem; text-align: center; cursor: pointer;">
                        <div class="slot-title" style="font-weight: 800; font-size: 0.825rem; color: var(--dark);">🌃 Sesi Malam</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">18:30 - 20:00 WIB</div>
                    </div>
                </div>
            </div>

            <!-- 3. Program & Contact Form Inputs -->
            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 0.85rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem;">Nama Pendaftar <span style="color:red;">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Anda / Orang Tua" required style="padding: 0.55rem 0.85rem; font-size: 0.9rem;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem;">No. WhatsApp <span style="color:red;">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="081234567890" required style="padding: 0.55rem 0.85rem; font-size: 0.9rem;">
                </div>
            </div>

            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 1rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem;">Program Les Pilihan <span style="color:red;">*</span></label>
                    <select name="program_name" id="modalProgramSelect" class="form-control" required style="padding: 0.55rem 0.85rem; font-size: 0.875rem;">
                        <option value="Les Renang Anak (Usia 3–15 Tahun)">Les Renang Anak (Usia 3–15 Th)</option>
                        <option value="Les Renang Dewasa Pemula">Les Renang Dewasa Pemula</option>
                        <option value="Les Renang Khusus Wanita / Muslimah">Les Renang Wanita / Muslimah</option>
                        <option value="Program Persiapan Tes TNI, POLRI & Kedinasan">Persiapan Tes TNI / POLRI</option>
                        <option value="Terapi Renang & Pemulihan Fisik">Terapi Renang & Pemulihan</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem;">Kategori Usia <span style="color:red;">*</span></label>
                    <select name="age_category" class="form-control" required style="padding: 0.55rem 0.85rem; font-size: 0.875rem;">
                        <option value="Anak (3-15 Tahun)">Anak (3-15 Tahun)</option>
                        <option value="Dewasa Pemula (16+ Tahun)">Dewasa Pemula (16+ Tahun)</option>
                        <option value="Wanita / Muslimah Privat">Wanita / Muslimah Privat</option>
                        <option value="Persiapan TNI / POLRI">Persiapan TNI / POLRI</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-weight: 800; border-radius: 0.75rem;">
                    <i class="fa-solid fa-paper-plane"></i> Daftar via Web
                </button>
                <button type="button" onclick="submitRegistrationToWA()" class="btn btn-whatsapp" style="width: 100%; padding: 0.85rem; font-weight: 800; border-radius: 0.75rem;">
                    <i class="fa-brands fa-whatsapp"></i> Daftar via WA
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
        const ageCat = form.querySelector('[name="age_category"]').value;
        const loc = document.getElementById('selectedLocationInput').value;
        const sched = document.getElementById('selectedScheduleInput').value;

        const text = `Halo Admin Les Renang Jogja, saya ingin mendaftar *Paket Les Renang*:\n` +
                     `• Nama Pendaftar: *${name}*\n` +
                     `• No. WA: *${phone}*\n` +
                     `• Program: *${prog}* (${ageCat})\n` +
                     `• Lokasi Kolam: *${loc}*\n` +
                     `• Jadwal Pilihan: *${sched}*\n\n` +
                     `Mohon informasi total biaya & konfirmasi slot pelatihnya ya admin!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
    }
</script>

<script>
let currentDayPref = "Sabtu / Minggu";
let currentTimePref = "Sesi Pagi (06:00 - 08:00 WIB)";

function selectLocationChip(el, locName) {
    document.querySelectorAll('#locationPickerGroup .location-chip').forEach(chip => {
        chip.style.border = "1px solid #cbd5e1";
        chip.style.background = "#ffffff";
        chip.querySelector('.chip-title').style.color = "var(--dark)";
    });
    el.style.border = "2px solid var(--primary)";
    el.style.background = "rgba(0, 119, 182, 0.08)";
    el.querySelector('.chip-title').style.color = "var(--primary)";
    document.getElementById('selectedLocationInput').value = locName;
}

function selectDayChip(el, dayName) {
    document.querySelectorAll('#dayPickerGroup .day-chip').forEach(chip => {
        chip.style.border = "1px solid #cbd5e1";
        chip.style.background = "#ffffff";
        chip.style.color = "var(--dark)";
    });
    el.style.border = "2px solid var(--primary)";
    el.style.background = "rgba(0, 119, 182, 0.1)";
    el.style.color = "var(--primary)";
    currentDayPref = dayName;
    updateScheduleInputValue();
}

function selectTimeSlot(el, timeSlotName) {
    document.querySelectorAll('#timeSlotGroup .time-slot-chip').forEach(chip => {
        chip.style.border = "1px solid #cbd5e1";
        chip.style.background = "#ffffff";
        chip.querySelector('.slot-title').style.color = "var(--dark)";
    });
    el.style.border = "2px solid var(--primary)";
    el.style.background = "rgba(0, 119, 182, 0.08)";
    el.querySelector('.slot-title').style.color = "var(--primary)";
    currentTimePref = timeSlotName;
    updateScheduleInputValue();
}

function updateScheduleInputValue() {
    document.getElementById('selectedScheduleInput').value = currentDayPref + ' • ' + currentTimePref;
}
</script>
