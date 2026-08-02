<div class="modal-overlay" id="registrationModal">
    <div class="modal-card">
        <button class="modal-close" onclick="closeRegistrationModal()">&times;</button>
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div style="display: inline-flex; width: 50px; height: 50px; background: rgba(2, 132, 199, 0.1); border-radius: 50%; color: var(--primary); align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <h3 style="font-size: 1.6rem; margin-bottom: 0.25rem;">Formulir Pendaftaran Les Renang</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Isi formulir di bawah ini untuk mendapatkan rekomendasi pelatih & jadwal terbaik.</p>
        </div>

        <form action="{{ route('lead.register') }}" method="POST" id="formRegistration">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap Pendaftar / Orang Tua <span style="color:red;">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Hendra Wijaya" required>
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">No. WhatsApp <span style="color:red;">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="081234567890" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Usia <span style="color:red;">*</span></label>
                    <select name="age_category" class="form-control" required>
                        <option value="Anak (3-15 Tahun)">Anak (3-15 Tahun)</option>
                        <option value="Dewasa Pemula (16+ Tahun)">Dewasa Pemula (16+ Tahun)</option>
                        <option value="Wanita / Muslimah Privat">Wanita / Muslimah Privat</option>
                        <option value="Persiapan TNI / POLRI / Kedinasan">Persiapan TNI / POLRI / Kedinasan</option>
                        <option value="Terapi Renang Medis">Terapi Renang Medis</option>
                        <option value="Corporate / Group">Corporate / Group</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Program Renang Pilihan <span style="color:red;">*</span></label>
                <select name="program_name" id="modalProgramSelect" class="form-control" required>
                    <option value="Les Renang Anak (Usia 3–15 Tahun)">Les Renang Anak (Usia 3–15 Tahun)</option>
                    <option value="Les Renang Dewasa Pemula">Les Renang Dewasa Pemula</option>
                    <option value="Les Renang Khusus Wanita / Muslimah">Les Renang Khusus Wanita / Muslimah</option>
                    <option value="Program Persiapan Tes TNI, POLRI & Kedinasan">Program Persiapan Tes TNI, POLRI & Kedinasan</option>
                    <option value="Terapi Renang & Pemulihan Fisik">Terapi Renang & Pemulihan Fisik</option>
                    <option value="Corporate Training & Group Class">Corporate Training & Group Class</option>
                </select>
            </div>

            <div class="grid-2" style="gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Pilihan Area / Kolam <span style="color:red;">*</span></label>
                    <select name="preferred_location" class="form-control" required>
                        <option value="FIK UNY Sleman">FIK UNY Sleman</option>
                        <option value="Depok Sport Center (Seturan)">Depok Sport Center (Seturan)</option>
                        <option value="Umbulharjo / Kota Jogja">Umbulharjo / Kota Jogja</option>
                        <option value="Hyatt Regency Palagan">Hyatt Regency Palagan</option>
                        <option value="Kolam Perumahan / Privat Peserta">Kolam Perumahan / Privat Peserta</option>
                        <option value="Area Semarang / Solo / Magelang / Klaten">Area Semarang / Solo / Magelang / Klaten</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Preferensi Jadwal <span style="color:red;">*</span></label>
                    <select name="preferred_schedule" class="form-control" required>
                        <option value="Pagi (06.00 - 09.00 WIB)">Pagi (06.00 - 09.00 WIB)</option>
                        <option value="Sore (15.00 - 18.00 WIB)">Sore (15.00 - 18.00 WIB)</option>
                        <option value="Malam (18.00 - 20.00 WIB)">Malam (18.00 - 20.00 WIB)</option>
                        <option value="Weekend (Sabtu / Minggu)">Weekend (Sabtu / Minggu)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Catatan Khusus (Opsional / Trauma Air / Kondisi Fisik)</label>
                <textarea name="notes" class="form-control" rows="2" placeholder="Contoh: Belum pernah bisa renang sama sekali, takut kedalaman..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: var(--radius-sm);">
                <i class="fa-solid fa-paper-plane"></i> Kirim Pendaftaran via WhatsApp
            </button>
        </form>
    </div>
</div>
