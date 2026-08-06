@extends('layouts.app')

@section('title', 'Tentang ApexFitness - Profil, Visi Misi & Personal Trainer Berlisensi')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: var(--brand-primary, #84cc16); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Profil Studio Fitness</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif; color: #ffffff;">Tentang <span style="color: var(--brand-primary, #84cc16);">FitLife</span> Center</h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Pusat kebugaran gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta dengan rekam jejak sukses mendampingi {{ site_setting('stat_alumni', '1.000+') }} member mencapai bentuk tubuh ideal & performa fisik maksimal.
            </p>
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="section" style="background: #0f172a; color: white; padding: 5rem 0;">
    <div class="container">
        <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; align-items: center;">
            <div>
                <span class="section-subtitle" style="color: var(--brand-primary, #84cc16); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Nilai Utama Kami</span>
                <h2 style="font-size: 2.2rem; margin-bottom: 1.35rem; color: #ffffff; font-weight: 900;">Visi & Misi FitLife</h2>
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 1.25rem; color: var(--brand-primary, #84cc16); margin-bottom: 0.5rem; font-weight: 800;"><i class="fa-solid fa-eye"></i> Visi</h3>
                    <p style="color: #cbd5e1; line-height: 1.75; font-size: 1rem;">
                        Menjadi pusat kebugaran gym & studio Personal Training privat nomor 1 di Yogyakarta dan Jawa Tengah yang mengedepankan metode ilmiah, pemantauan InBody 3D Scan terukur, dan garansi hasil fisik berkelanjutan.
                    </p>
                </div>
                <div>
                    <h3 style="font-size: 1.25rem; color: #f97316; margin-bottom: 0.5rem; font-weight: 800;"><i class="fa-solid fa-bullseye"></i> Misi</h3>
                    <ul style="color: #cbd5e1; line-height: 1.85; padding-left: 1.25rem; font-size: 1rem;">
                        <li>Menyediakan program latihan beban & nutrisi harian yang aman bagi pemula hingga atlet.</li>
                        <li>Menggunakan data analisis InBody 3D Scan untuk memantau pemangkasan lemak & massa otot.</li>
                        <li>Membantu calon taruna TNI, POLRI, & Kedinasan lulus tes kesamaptaan fisik dengan skor 100.</li>
                        <li>Menyediakan area studio privat & Personal Trainer wanita khusus bagi member cewek / muslimah.</li>
                    </ul>
                </div>
            </div>

            <div class="glass-card" style="padding: 2.5rem 2rem; text-align: center; background: #1e293b; color: white; border-radius: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
                <h3 style="color: white; font-size: 1.75rem; margin-bottom: 1rem; font-weight: 800;">Rekam Jejak & Prestasi</h3>
                <div class="grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-top: 1.5rem;">
                    <div style="background: rgba(255,255,255,0.05); padding: 1.25rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.08);">
                        <div style="font-size: 2.2rem; font-weight: 900; color: var(--brand-primary, #84cc16);">10+ Th</div>
                        <div style="font-size: 0.85rem; color: #94a3b8; font-weight: 700;">Pengalaman PT</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 1.25rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.08);">
                        <div style="font-size: 2.2rem; font-weight: 900; color: #f97316;">1.000+</div>
                        <div style="font-size: 0.85rem; color: #94a3b8; font-weight: 700;">Member Sukses</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 1.25rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.08);">
                        <div style="font-size: 2.2rem; font-weight: 900; color: #38bdf8;">100%</div>
                        <div style="font-size: 0.85rem; color: #94a3b8; font-weight: 700;">PT Lisensi APKI</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 1.25rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.08);">
                        <div style="font-size: 2.2rem; font-weight: 900; color: #fde047;">4.9 / 5</div>
                        <div style="font-size: 0.85rem; color: #94a3b8; font-weight: 700;">Rating Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Personal Trainers Section -->
<section class="section" style="background: #070a12; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: var(--brand-primary, #84cc16); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Tim Instruktur</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Personal Trainer Berlisensi APKI / IFBB</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Didampingi pelatih berpengalaman yang memahami biomekanika tubuh & manajemen nutrisi.</p>
        </div>

        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            <div class="glass-card" style="padding: 2rem; text-align: center; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem;">
                <div style="width: 95px; height: 95px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem; border: 3px solid var(--brand-primary, #84cc16); box-shadow: 0 0 20px rgba(132,204,22,0.35);">
                    <img src="{{ asset('images/assets/coach_hendra.webp') }}" alt="Coach Hendra" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.25rem; color: #ffffff; font-weight: 800;">Coach Hendra, CSCS</h3>
                <div style="color: var(--brand-primary, #84cc16); font-weight: 800; font-size: 0.85rem; margin-bottom: 0.75rem;">Head Personal Trainer & Weight Loss Specialist</div>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6;">Lulusan Ilmu Keolahragaan & APKI Certified. Pengalaman 10 tahun melatih 500+ member fat burn & body transformation.</p>
            </div>

            <div class="glass-card" style="padding: 2rem; text-align: center; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem;">
                <div style="width: 95px; height: 95px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem; border: 3px solid #f97316; box-shadow: 0 0 20px rgba(249,115,22,0.35);">
                    <img src="{{ asset('images/assets/coach_danu.webp') }}" alt="Coach Danu" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.25rem; color: #ffffff; font-weight: 800;">Coach Danu, APKI</h3>
                <div style="color: #f97316; font-weight: 800; font-size: 0.85rem; margin-bottom: 0.75rem;">Spesialis Physical Test TNI/POLRI & Muscle Gain</div>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6;">Spesialis drill kalistenik, stamina lari, & pull-up presisi. Sukses mencetak nilai 100 pada tes kesamaptaan TNI-POLRI.</p>
            </div>

            <div class="glass-card" style="padding: 2rem; text-align: center; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem;">
                <div style="width: 95px; height: 95px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem; border: 3px solid #ec4899; box-shadow: 0 0 20px rgba(236,72,153,0.35);">
                    <img src="{{ asset('images/assets/coach_rina.webp') }}" alt="Coach Rina" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.25rem; color: #ffffff; font-weight: 800;">Coach Rina, Pilates PT</h3>
                <div style="color: #ec4899; font-weight: 800; font-size: 0.85rem; margin-bottom: 0.75rem;">Female Body Shaping & Reformer Pilates</div>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6;">Pelatih wanita khusus cewek & muslimah. Fokus mengencangkan paha, glutes, perut, serta perbaikan postur tubuh.</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg" style="background: var(--brand-primary, #84cc16); color: #ffffff !important; border: none; padding: 0.9rem 2.2rem; font-weight: 800; border-radius: 99px;">
                <i class="fa-solid fa-paper-plane" style="color: #ffffff !important;"></i> Konsultasikan Pilihan Trainer Anda
            </button>
        </div>
    </div>
</section>
@endsection
