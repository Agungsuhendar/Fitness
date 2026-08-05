<div class="modal-overlay" id="trialModal">
    <div class="modal-card" style="background: #0f172a; border: 1px solid rgba(255,255,255,0.15); color: #ffffff;">
        <button class="modal-close" onclick="closeTrialModal()" style="color: #ffffff;">&times;</button>
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div style="display: inline-flex; width: 50px; height: 50px; background: rgba(16, 185, 129, 0.15); border-radius: 50%; color: #10b981; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h3 style="font-size: 1.6rem; margin-bottom: 0.25rem; color: #ffffff;">Klaim Free Trial Sesi 1 Personal Trainer</h3>
            <p style="color: #94a3b8; font-size: 0.9rem;">Dapatkan 1 Sesi Free Assessment InBody + Konsultasi Sesi Latihan 45 Menit Gratis!</p>
        </div>

        <form action="{{ route('lead.trial') }}" method="POST" id="formTrial">
            @csrf
            <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                <input type="text" name="parent_name" class="form-control" placeholder="Contoh: Bima Perkasa" required style="background: #1e293b; border-color: #334155; color: #ffffff;">
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" style="color: #cbd5e1;">No. WhatsApp <span style="color:#ef4444;">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="081234567890" required style="background: #1e293b; border-color: #334155; color: #ffffff;">
                </div>
                <div class="form-group">
                    <label class="form-label" style="color: #cbd5e1;">Target Utama <span style="color:#ef4444;">*</span></label>
                    <select name="program_name" id="trialProgramSelect" class="form-control" required style="background: #1e293b; border-color: #334155; color: #ffffff;">
                        <option value="Weight Loss & Fat Burn">Weight Loss & Fat Burn</option>
                        <option value="Muscle Building & Hypertrophy">Muscle Building & Hypertrophy</option>
                        <option value="Female Fitness & Body Shaping">Female Fitness & Shaping</option>
                        <option value="Strength & Persiapan TNI-POLRI">Persiapan Fisik TNI / POLRI</option>
                        <option value="Posture Correction & Rehab">Posture Correction & Rehab</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Cabang Studio Gym <span style="color:#ef4444;">*</span></label>
                <select name="preferred_location" class="form-control" required style="background: #1e293b; border-color: #334155; color: #ffffff;">
                    <option value="ApexFitness Center Sleman HQ">ApexFitness Center Sleman HQ</option>
                    <option value="Apex Studio Seturan">Apex Studio Seturan</option>
                    <option value="Apex Performance Gym Umbulharjo">Apex Performance Gym Umbulharjo</option>
                    <option value="Private Home Training">Private Home Training (Datang ke Rumah)</option>
                </select>
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label" style="color: #cbd5e1;">Rencana Tanggal Trial <span style="color:#ef4444;">*</span></label>
                    <input type="date" name="trial_date" class="form-control" min="{{ date('Y-m-d') }}" required style="background: #1e293b; border-color: #334155; color: #ffffff;">
                </div>
                <div class="form-group">
                    <label class="form-label" style="color: #cbd5e1;">Waktu Trial <span style="color:#ef4444;">*</span></label>
                    <select name="trial_time" class="form-control" required style="background: #1e293b; border-color: #334155; color: #ffffff;">
                        <option value="08.00 WIB">08.00 WIB (Pagi)</option>
                        <option value="10.00 WIB">10.00 WIB (Pagi)</option>
                        <option value="16.00 WIB">16.00 WIB (Sore)</option>
                        <option value="19.00 WIB">19.00 WIB (Malam)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                <button type="submit" class="btn btn-accent" style="width: 100%; border-radius: var(--radius-sm); font-weight: 800; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; color: white;">
                    <i class="fa-solid fa-bolt"></i> Klaim via Web
                </button>
                <button type="button" onclick="submitTrialToWA()" class="btn btn-whatsapp" style="width: 100%; border-radius: var(--radius-sm); font-weight: 800; background: #25d366; border: none; color: white;">
                    <i class="fa-brands fa-whatsapp"></i> Klaim via WA
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function submitTrialToWA() {
        const form = document.getElementById('formTrial');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        const name = form.querySelector('[name="parent_name"]').value;
        const phone = form.querySelector('[name="phone"]').value;
        const prog = form.querySelector('[name="program_name"]').value;
        const loc = form.querySelector('[name="preferred_location"]').value;
        const date = form.querySelector('[name="trial_date"]').value;
        const time = form.querySelector('[name="trial_time"]').value;

        const text = `Halo Admin ApexFitness Center, saya ingin klaim *Free Sesi Trial 1 Personal Trainer + Assessment*:\n` +
                     `• Nama: *${name}*\n` +
                     `• No. WA: *${phone}*\n` +
                     `• Target Fitness: *${prog}*\n` +
                     `• Cabang Gym: *${loc}*\n` +
                     `• Jadwal Rencana: *${date} jam ${time}*\n\n` +
                     `Mohon diproses konfirmasi slot trainer trial gratis saya ya min!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
    }
</script>
