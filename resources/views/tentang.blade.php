@extends('layouts.app')

@section('title', 'Tentang Kami - Profil, Visi Misi & Instruktur Les Renang Jogja')

@section('content')
<section class="hero-section" style="padding: 3.5rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Profil Lembaga</span>
            <h1 class="hero-title">Tentang <span class="text-gradient">Les Renang Jogja</span></h1>
            <p class="hero-description">
                Lembaga pelatihan renang privat profesional di Yogyakarta dengan pengalaman lebih dari 10 tahun mencetak 2.500+ alumni mahir berenang.
            </p>
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-2" style="align-items: center;">
            <div>
                <span class="section-subtitle">Nilai Utama Kami</span>
                <h2 style="font-size: 2.35rem; margin-bottom: 1.35rem;">Visi & Misi Les Renang Jogja</h2>
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 1.3rem; color: var(--primary); margin-bottom: 0.5rem;"><i class="fa-solid fa-eye"></i> Visi</h3>
                    <p style="color: var(--text-muted); line-height: 1.75; font-size: 1.05rem;">
                        Menjadi pusat pendidikan & pelatihan renang privat nomor 1 di Yogyakarta dan Jawa Tengah yang paling tepercaya, mengutamakan keselamatan air (Water Safety), serta memberikan garansi cepat bisa dengan pendekatan menyenangkan.
                    </p>
                </div>
                <div>
                    <h3 style="font-size: 1.3rem; color: var(--primary-light); margin-bottom: 0.5rem;"><i class="fa-solid fa-bullseye"></i> Misi</h3>
                    <ul style="color: var(--text-muted); line-height: 1.85; padding-left: 1.25rem; font-size: 1.025rem;">
                        <li>Menyediakan metode latihan renang ilmiah yang efisien dan aman bagi anak & dewasa.</li>
                        <li>Mengeliminasi rasa takut dan trauma air (Aquaphobia) melalui bimbingan psikologis yang tepat.</li>
                        <li>Membantu calon taruna TNI, POLRI, dan Kedinasan meraih nilai tes renang maksimal.</li>
                        <li>Memberikan kenyamanan penuh bagi wanita dan muslimah lewat instruktur wanita & kolam privat.</li>
                    </ul>
                </div>
            </div>

            <div class="glass-card" style="padding: 2.75rem 2rem; text-align: center; background: linear-gradient(135deg, #0077b6 0%, #03045e 100%); color: white; border-radius: 2rem;">
                <h3 style="color: white; font-size: 1.9rem; margin-bottom: 1rem;">Pengalaman & Rekam Jejak</h3>
                <div class="grid-2" style="gap: 1.5rem; margin-top: 2rem;">
                    <div style="background: rgba(255,255,255,0.15); padding: 1.5rem; border-radius: 1.25rem;">
                        <div style="font-size: 2.75rem; font-weight: 900; color: #fbbf24;">10+</div>
                        <div style="font-size: 0.925rem; color: #e0f2fe; font-weight: 700;">Tahun Pengalaman</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); padding: 1.5rem; border-radius: 1.25rem;">
                        <div style="font-size: 2.75rem; font-weight: 900; color: #90e0ef;">2.500+</div>
                        <div style="font-size: 0.925rem; color: #e0f2fe; font-weight: 700;">Alumni Mahir</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); padding: 1.5rem; border-radius: 1.25rem;">
                        <div style="font-size: 2.75rem; font-weight: 900; color: #4ade80;">100%</div>
                        <div style="font-size: 0.925rem; color: #e0f2fe; font-weight: 700;">Pelatih Berlisensi</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); padding: 1.5rem; border-radius: 1.25rem;">
                        <div style="font-size: 2.75rem; font-weight: 900; color: #f472b6;">4.9/5</div>
                        <div style="font-size: 0.925rem; color: #e0f2fe; font-weight: 700;">Rating Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team & Certifications Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Instruktur Kami</span>
            <h2 class="section-title">Tim Pelatih & Sertifikasi Resmi</h2>
            <p class="section-description">Seluruh pelatih merupakan lulusan Fakultas Keolahragaan & berlisensi nasional.</p>
        </div>

        <div class="grid-3">
            <div class="glass-card" style="padding: 2.25rem; text-align: center; background: #ffffff;">
                <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.25rem; border: 3px solid var(--primary-light);">
                    <img src="{{ asset('images/assets/coach_hendra.webp') }}" alt="Coach Hendra" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <h3 style="font-size: 1.35rem;">Coach Hendra, S.Pd.</h3>
                <div style="color: var(--primary); font-weight: 800; font-size: 0.875rem; margin-bottom: 0.85rem;">Head Coach & Spesialis Anak</div>
                <p style="color: var(--text-muted); font-size: 0.925rem; line-height: 1.6;">Lulusan FIK UNY, Pemegang Sertifikat Pelatih PRSI Tingkat Nasional. Pengalaman 12 tahun mengajar renang anak & trauma air.</p>
            </div>

            <div class="glass-card" style="padding: 2.25rem; text-align: center; background: #ffffff;">
                <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.25rem; border: 3px solid #d946ef;">
                    <img src="{{ asset('images/assets/coach_rina.webp') }}" alt="Coach Rina" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <h3 style="font-size: 1.35rem;">Coach Rina, S.Or.</h3>
                <div style="color: #d946ef; font-weight: 800; font-size: 0.875rem; margin-bottom: 0.85rem;">Spesialis Wanita & Muslimah</div>
                <p style="color: var(--text-muted); font-size: 0.925rem; line-height: 1.6;">Ahli hydrotherapy & instruktur khusus wanita. Ramah, sabar, dan menguasai teknik adaptasi kolam privat.</p>
            </div>

            <div class="glass-card" style="padding: 2.25rem; text-align: center; background: #ffffff;">
                <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.25rem; border: 3px solid #d97706;">
                    <img src="{{ asset('images/assets/coach_danu.webp') }}" alt="Coach Danu" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <h3 style="font-size: 1.35rem;">Coach Danu (Purn)</h3>
                <div style="color: #d97706; font-weight: 800; font-size: 0.875rem; margin-bottom: 0.85rem;">Head Trainer TNI & POLRI</div>
                <p style="color: var(--text-muted); font-size: 0.925rem; line-height: 1.6;">Mantan instruktur jasmani militer. Berpengalaman melatih fisik 500+ calon taruna Akpol, Bintara, dan Sekolah Kedinasan.</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-paper-plane"></i> Konsultasikan Pilihan Pelatih Anda
            </button>
        </div>
    </div>
</section>
@endsection
