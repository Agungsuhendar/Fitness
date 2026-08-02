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

            <button type="submit" class="btn btn-accent" style="width: 100%; border-radius: var(--radius-sm);">
                <i class="fa-solid fa-bolt"></i> Konfirmasi Booking Trial Gratis
            </button>
        </form>
    </div>
</div>
