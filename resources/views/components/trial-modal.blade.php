<div class="modal-overlay" id="trialModal">
    <div class="modal-card">
        <button class="modal-close" onclick="closeTrialModal()">&times;</button>
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div style="display: inline-flex; width: 50px; height: 50px; background: rgba(245, 158, 11, 0.15); border-radius: 50%; color: var(--accent-hover); align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h3 style="font-size: 1.6rem; margin-bottom: 0.25rem;">Booking Trial Uji Coba Gratis</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Coba 1 sesi uji coba 30 menit gratis sebelum memutuskan mendaftar paket!</p>
        </div>

        <form action="{{ route('lead.trial') }}" method="POST" id="formTrial">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Orang Tua / Pemesan <span style="color:red;">*</span></label>
                <input type="text" name="parent_name" class="form-control" placeholder="Contoh: Ibu Rina" required>
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Nama Peserta <span style="color:red;">*</span></label>
                    <input type="text" name="participant_name" class="form-control" placeholder="Contoh: Kenzo" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Usia Peserta <span style="color:red;">*</span></label>
                    <input type="text" name="participant_age" class="form-control" placeholder="Contoh: 7 Tahun" required>
                </div>
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">No. WhatsApp <span style="color:red;">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="081234567890" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Program Renang <span style="color:red;">*</span></label>
                    <select name="program_name" id="trialProgramSelect" class="form-control" required>
                        <option value="Les Renang Anak">Les Renang Anak</option>
                        <option value="Les Renang Dewasa Pemula">Les Renang Dewasa Pemula</option>
                        <option value="Les Renang Wanita">Les Renang Wanita</option>
                        <option value="Persiapan Tes TNI/POLRI">Persiapan Tes TNI/POLRI</option>
                        <option value="Terapi Renang">Terapi Renang</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasi Kolam Renang <span style="color:red;">*</span></label>
                <select name="preferred_location" class="form-control" required>
                    <option value="FIK UNY Sleman">FIK UNY Sleman</option>
                    <option value="Depok Sport Center (Seturan)">Depok Sport Center (Seturan)</option>
                    <option value="Umbulharjo / Kota Jogja">Umbulharjo / Kota Jogja</option>
                    <option value="Hyatt Regency Palagan">Hyatt Regency Palagan</option>
                </select>
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Rencana Tanggal Trial <span style="color:red;">*</span></label>
                    <input type="date" name="trial_date" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Trial <span style="color:red;">*</span></label>
                    <select name="trial_time" class="form-control" required>
                        <option value="07.00 WIB">07.00 WIB (Pagi)</option>
                        <option value="09.00 WIB">09.00 WIB (Pagi)</option>
                        <option value="15.30 WIB">15.30 WIB (Sore)</option>
                        <option value="16.30 WIB">16.30 WIB (Sore)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1rem;">
                <button type="submit" class="btn btn-accent" style="width: 100%; border-radius: var(--radius-sm); font-weight: 800;">
                    <i class="fa-solid fa-bolt"></i> Booking via Web
                </button>
                <button type="button" onclick="submitTrialToWA()" class="btn btn-whatsapp" style="width: 100%; border-radius: var(--radius-sm); font-weight: 800;">
                    <i class="fa-brands fa-whatsapp"></i> Booking via WA
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
        const parentName = form.querySelector('[name="parent_name"]').value;
        const partName = form.querySelector('[name="participant_name"]').value;
        const partAge = form.querySelector('[name="participant_age"]').value;
        const phone = form.querySelector('[name="phone"]').value;
        const prog = form.querySelector('[name="program_name"]').value;
        const loc = form.querySelector('[name="preferred_location"]').value;
        const date = form.querySelector('[name="trial_date"]').value;
        const time = form.querySelector('[name="trial_time"]').value;

        const text = `Halo Admin Les Renang Jogja, saya ingin konfirmasi *Booking Trial Uji Coba Gratis 30 Menit*:\n` +
                     `• Nama Pemesan: *${parentName}*\n` +
                     `• Nama Peserta: *${partName}* (${partAge})\n` +
                     `• No. WA: *${phone}*\n` +
                     `• Program: *${prog}*\n` +
                     `• Lokasi: *${loc}*\n` +
                     `• Rencana Jadwal: *${date} jam ${time}*\n\n` +
                     `Mohon diproses slot jadwal trial gratis saya ya admin!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
    }
</script>
