@extends('layouts.app')

@section('title', 'Harga Paket Les Renang Jogja - Transparan & Hemat')
@section('meta_description', 'Daftar harga paket les renang privat di Yogyakarta. Paket anak, dewasa, privat wanita, & kelas TNI POLRI. Tanpa biaya tersembunyi!')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Investasi Kesehatan</span>
            <h1 class="hero-title">Daftar Harga & <span class="text-gradient">Paket Les Renang</span></h1>
            <p class="hero-description">
                Pilihan paket investasi privat transparan tanpa biaya tersembunyi. Dapatkan jaminan kualitas & bimbingan instruktur profesional.
            </p>
        </div>
    </div>
</section>

<!-- Promo Countdown Header -->
<section style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #0f172a; padding: 1rem 0; text-align: center; font-weight: 800;">
    <div class="container">
        🔥 PROMO SPESIAL BULAN INI: Diskon Rp 50.000 + Gratis Kacamata Renang untuk Pendaftaran Paket Privat 2 Orang!
    </div>
</section>

<!-- Pricing Cards Grid -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-3">
            <div class="glass-card" style="padding: 2.25rem; background: #ffffff; position: relative;">
                <span style="background: #e0f2fe; color: var(--primary-dark); font-weight: 800; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px;">
                    PRIVAT ANAK
                </span>
                <h3 style="font-size: 1.5rem; margin-top: 0.75rem;">Paket Anak Ceria</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Khusus usia 3 s/d 15 tahun (8x Sesi)</p>
                <div style="font-size: 2.3rem; font-weight: 800; color: var(--primary); margin-bottom: 1.5rem;">
                    Rp 350.000 <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: 400;">/ paket</span>
                </div>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--dark-surface); font-size: 0.95rem; line-height: 2;">
                    <li>✓ 8 Kali Pertemuan (Durasi 60 Menit)</li>
                    <li>✓ 1 Pelatih : 1–2 Anak (Privat)</li>
                    <li>✓ Bebas Pilih Hari & Jam Latihan</li>
                    <li>✓ Laporan Evaluasi Perkembangan</li>
                    <li>✓ Sertifikat Kelulusan Renang</li>
                </ul>
                <button onclick="openRegistrationModal('Les Renang Anak')" class="btn btn-primary" style="width: 100%;">
                    Daftar Paket Anak
                </button>
            </div>

            <div class="glass-card" style="padding: 2.25rem; background: #ffffff; border: 2px solid var(--primary); transform: scale(1.03); box-shadow: var(--shadow-lg);">
                <div style="position: absolute; top: -14px; right: 2rem; background: var(--accent); color: #0f172a; font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 99px;">
                    PALING LARIS
                </div>
                <span style="background: #e0f2fe; color: var(--primary-dark); font-weight: 800; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px;">
                    PRIVAT DEWASA & WANITA
                </span>
                <h3 style="font-size: 1.5rem; margin-top: 0.75rem;">Paket Privat Intensive</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Dewasa Pemula / Instruktur Wanita (8x Sesi)</p>
                <div style="font-size: 2.3rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem;">
                    Rp 400.000 <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: 400;">/ paket</span>
                </div>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--dark-surface); font-size: 0.95rem; line-height: 2;">
                    <li>✓ 8 Kali Pertemuan Intensif (60m)</li>
                    <li>✓ Privat 1-on-1 Eksklusif</li>
                    <li>✓ Penanganan Khusus Trauma Air</li>
                    <li>✓ Penguasaan 2 Gaya & Injak Air</li>
                    <li>✓ Garansi Bimbingan Tambahan</li>
                </ul>
                <button onclick="openRegistrationModal('Les Renang Dewasa')" class="btn btn-accent" style="width: 100%;">
                    Daftar Privat Intensive
                </button>
            </div>

            <div class="glass-card" style="padding: 2.25rem; background: #ffffff;">
                <span style="background: #fef3c7; color: #d97706; font-weight: 800; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px;">
                    KEDINASAAN & MILITER
                </span>
                <h3 style="font-size: 1.5rem; margin-top: 0.75rem;">Paket TNI / POLRI</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Persiapan Tes Kesamaptaan 50 Meter</p>
                <div style="font-size: 2.3rem; font-weight: 800; color: var(--dark); margin-bottom: 1.5rem;">
                    Rp 500.000 <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: 400;">/ paket</span>
                </div>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--dark-surface); font-size: 0.95rem; line-height: 2;">
                    <li>✓ Drill Kecepatan & Stamina (8x Sesi)</li>
                    <li>✓ Simulasi Waktu Standar Tes Resmi</li>
                    <li>✓ Teknik Gaya Dada Militer Efisien</li>
                    <li>✓ Analisis Koreksi Gerakan Video</li>
                    <li>✓ Target Skor Maksimal 100</li>
                </ul>
                <button onclick="openRegistrationModal('Persiapan TNI POLRI')" class="btn btn-primary" style="width: 100%;">
                    Daftar Paket TNI/POLRI
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Price Calculator Section -->
<section class="section">
    <div class="container">
        <div class="glass-card" style="padding: 3rem; background: #ffffff; max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h3 style="font-size: 1.8rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-calculator" style="color: var(--primary);"></i> Kalkulator Simulasi Biaya</h3>
                <p style="color: var(--text-muted);">Hitung estimasi biaya les renang privat sesuai jumlah peserta & sesi latihan.</p>
            </div>

            <div class="grid-2" style="gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Kategori Peserta</label>
                    <select id="calcCategory" class="form-control">
                        <option value="350000">Anak (Rp 350.000 / 8x sesi)</option>
                        <option value="400000">Dewasa Pemula (Rp 400.000 / 8x sesi)</option>
                        <option value="450000">Wanita Privat (Rp 450.000 / 8x sesi)</option>
                        <option value="500000">TNI / POLRI (Rp 500.000 / 8x sesi)</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Jumlah Peserta</label>
                    <select id="calcPersons" class="form-control">
                        <option value="1">1 Peserta (Privat Single)</option>
                        <option value="2">2 Peserta (Semi Privat Kakak/Adik - Diskon 10%)</option>
                        <option value="3">3 Peserta (Grup Keluarga - Diskon 15%)</option>
                    </select>
                </div>
            </div>

            <div style="text-align: center; padding: 1.5rem; background: #f0f9ff; border-radius: 1rem; border: 1px dashed var(--primary); margin-bottom: 1.5rem;">
                <div style="font-size: 0.9rem; color: var(--text-muted);">Estimasi Total Investasi:</div>
                <div id="calcResult" style="font-size: 2.25rem; font-weight: 800; color: var(--primary-dark); margin: 0.25rem 0;">
                    Rp 350.000
                </div>
                <div style="font-size: 0.85rem; color: var(--emerald); font-weight: 700;">Termasuk garansi bimbingan & sertifikat!</div>
            </div>

            <button onclick="openRegistrationModal()" class="btn btn-accent btn-lg" style="width: 100%;">
                <i class="fa-solid fa-paper-plane"></i> Ambil Promo Simulasi Ini Now
            </button>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function updateCalc() {
        const cat = parseInt(document.getElementById('calcCategory').value);
        const persons = parseInt(document.getElementById('calcPersons').value);
        let total = cat * persons;
        if (persons === 2) total *= 0.9;
        if (persons === 3) total *= 0.85;

        document.getElementById('calcResult').innerText = 'Rp ' + Math.round(total).toLocaleString('id-ID');
    }

    document.getElementById('calcCategory')?.addEventListener('change', updateCalc);
    document.getElementById('calcPersons')?.addEventListener('change', updateCalc);
</script>
@endpush
@endsection
