@extends('layouts.app')

@section('title', 'Les Renang Jogja - Privat Anak, Dewasa, Wanita & Persiapan TNI POLRI')

@section('content')
<!-- Hero Section with Floating Bubbles Water Animation -->
<section class="hero-section">
    <div class="bubbles-container">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="container">
        <div class="hero-grid">
            <div class="hero-text-col">
                <div class="hero-badge">
                    <i class="fa-solid fa-award" style="color: var(--accent);"></i> #1 Kursus & Privat Renang Terpercaya di Yogyakarta
                </div>
                <h1 class="hero-title">
                    Kuasai Renang Cepat & Aman Bersama <span class="text-gradient">Les Renang Jogja</span>
                </h1>
                <p class="hero-description">
                    Bimbingan privat 1-on-1 bergaransi cepat bisa! Melayani les renang anak, dewasa pemula (bebas trauma air), khusus wanita/muslimah, serta persiapan tes TNI/POLRI.
                </p>

                <div class="hero-cta-group">
                    <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-paper-plane"></i> Daftar Sekarang
                    </button>
                    <button onclick="openTrialModal()" class="btn btn-accent btn-lg">
                        <i class="fa-solid fa-bolt"></i> Booking Trial Gratis
                    </button>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Les%20Renang%20Jogja,%20saya%20konsultasi%20gratis." target="_blank" class="btn btn-whatsapp btn-lg">
                        <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>

                <div class="trust-badges">
                    <div class="trust-item">
                        <i class="fa-solid fa-shield-halved" style="color: var(--primary); font-size: 1.35rem;"></i>
                        <span>Pelatih Berlisensi PRSI</span>
                    </div>
                    <div class="trust-item">
                        <i class="fa-solid fa-circle-check" style="color: var(--emerald); font-size: 1.35rem;"></i>
                        <span>2.500+ Alumni Mahir</span>
                    </div>
                    <div class="trust-item">
                        <i class="fa-solid fa-star" style="color: var(--accent); font-size: 1.35rem;"></i>
                        <span>Rating 4.9/5 (500+ Ulasan)</span>
                    </div>
                </div>
            </div>

            <div class="hero-image-wrapper">
                <!-- SVG ClipPath Definition for Left & Right Vertical Wave Edges -->
                <svg width="0" height="0" style="position: absolute; pointer-events: none;">
                    <defs>
                        <clipPath id="heroLeftWaveClip" clipPathUnits="objectBoundingBox">
                            <path d="M 0.07 0 
                                     C -0.02 0.18, 0.12 0.38, 0.01 0.58 
                                     C 0.10 0.78, 0.02 0.90, 0.07 1.0 
                                     L 1.0 1.0 
                                     L 1.0 0 
                                     Z" />
                        </clipPath>
                    </defs>
                </svg>

                <div class="hero-image-container">
                    <!-- SVG Left & Right Garis Wave Glowing Outline Borders -->
                    <svg viewBox="0 0 500 400" preserveAspectRatio="none" class="hero-wave-border-svg">
                        <defs>
                            <linearGradient id="waveBorderGradLeft" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#00f2fe" stop-opacity="1"/>
                                <stop offset="50%" stop-color="#0077b6" stop-opacity="0.9"/>
                                <stop offset="100%" stop-color="#00b4d8" stop-opacity="1"/>
                            </linearGradient>
                            <linearGradient id="waveBorderGradRight" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#f59e0b" stop-opacity="1"/>
                                <stop offset="50%" stop-color="#00b4d8" stop-opacity="0.9"/>
                                <stop offset="100%" stop-color="#00f2fe" stop-opacity="1"/>
                            </linearGradient>
                            <filter id="waveGlowEffect" x="-20%" y="-20%" width="140%" height="140%">
                                <feGaussianBlur stdDeviation="5" result="blur" />
                                <feComposite in="SourceGraphic" in2="blur" operator="over" />
                            </filter>
                        </defs>

                        <!-- Left Wave Line Stroke -->
                        <path d="M 30 0 C -10 72 60 152 5 232 C 50 312 10 360 30 400" 
                              stroke="url(#waveBorderGradLeft)" stroke-width="5" fill="none" filter="url(#waveGlowEffect)"/>

                        <!-- Right Wave Line Stroke -->
                        <path d="M 470 0 C 490 72 440 152 495 232 C 450 312 490 360 470 400" 
                              stroke="url(#waveBorderGradRight)" stroke-width="5" fill="none" filter="url(#waveGlowEffect)"/>
                              
                        <!-- Decorative Water Droplets -->
                        <circle cx="15" cy="80" r="6" fill="#00f2fe" opacity="0.9"/>
                        <circle cx="485" cy="120" r="7" fill="#f59e0b" opacity="0.9"/>
                        <circle cx="25" cy="310" r="5" fill="#00b4d8" opacity="0.85"/>
                        <circle cx="480" cy="330" r="6" fill="#00f2fe" opacity="0.9"/>
                    </svg>

                    <!-- Swimmer Image Card with Left-Right Wave Clip-Path & Full Display -->
                    <div class="hero-swimmer-card-full">
                        <img src="{{ asset('images/assets/hero_wave_right.webp') }}" 
                             alt="Les Renang Jogja Latihan Privat" 
                             onerror="this.onerror=null; this.src='{{ asset('images/logo.webp') }}';">

                        <!-- Bottom Gradient Overlay for Text Contrast -->
                        <div class="hero-img-gradient-overlay"></div>

                        <!-- Inner Wave Line Overlay at Bottom -->
                        <svg viewBox="0 0 500 80" preserveAspectRatio="none" class="hero-img-bottom-wave-svg">
                            <path d="M0,35 C150,70 350,5 500,45 L500,80 L0,80 Z" fill="rgba(0, 119, 182, 0.4)"/>
                            <path d="M0,48 C210,12 370,68 500,28 L500,80 L0,80 Z" fill="rgba(3, 4, 94, 0.6)"/>
                            <path d="M0,48 C210,12 370,68 500,28" stroke="#00f2fe" stroke-width="3" fill="none" opacity="0.95"/>
                        </svg>


                    </div>

                    <!-- Floating Top Right PRSI Badge -->
                    <div class="hero-floating-prsi-badge">
                        <i class="fa-solid fa-certificate" style="color: #ffffff; font-size: 1rem;"></i>
                        <span>Pelatih PRSI</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Banner (Matches Big High CTA Banner) -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; text-align: center; padding: 4rem 0;">
    <div class="container">
        <div class="grid-4" style="text-align: center;">
            <div>
                <div style="font-size: 3.2rem; font-weight: 900; color: #ffffff; margin-bottom: 0.35rem; line-height: 1.1;">2.500+</div>
                <div style="color: #e0f2fe; font-weight: 700; font-size: 1rem;">Siswa Alumni Mahir</div>
            </div>
            <div>
                <div style="font-size: 3.2rem; font-weight: 900; color: #ffffff; margin-bottom: 0.35rem; line-height: 1.1;">10+ Th</div>
                <div style="color: #e0f2fe; font-weight: 700; font-size: 1rem;">Pengalaman Pelatihan</div>
            </div>
            <div>
                <div style="font-size: 3.2rem; font-weight: 900; color: #ffffff; margin-bottom: 0.35rem; line-height: 1.1;">100%</div>
                <div style="color: #e0f2fe; font-weight: 700; font-size: 1rem;">Pelatih Lisensi PRSI</div>
            </div>
            <div>
                <div style="font-size: 3.2rem; font-weight: 900; color: #ffffff; margin-bottom: 0.35rem; line-height: 1.1;">4.9 / 5</div>
                <div style="color: #e0f2fe; font-weight: 700; font-size: 1rem;">Rating Kepuasan Wali</div>
            </div>
        </div>
    </div>
</section>

<!-- Keunggulan Section -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Mengapa Memilih Kami</span>
            <h2 class="section-title">Keunggulan Les Renang Jogja</h2>
            <p class="section-description">
                Metode teruji, pelatih sabar, dan lingkungan latihan higienis untuk pengalaman renang terbaik Anda.
            </p>
        </div>

        <div class="grid-4">
            <div class="glass-card" style="padding: 2.25rem 1.5rem; text-align: center;">
                <div style="width: 64px; height: 64px; background: rgba(0, 119, 182, 0.12); color: var(--primary); border-radius: 1.35rem; display: flex; align-items: center; justify-content: center; font-size: 1.85rem; margin: 0 auto 1.35rem;">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Pelatih Sabar & Pro</h3>
                <p style="color: var(--text-muted); font-size: 0.925rem;">Lulusan FIK Keolahragaan, lisensi PRSI/POSSI, dan tersertifikasi First Aid.</p>
            </div>

            <div class="glass-card" style="padding: 2.25rem 1.5rem; text-align: center;">
                <div style="width: 64px; height: 64px; background: rgba(0, 180, 216, 0.12); color: var(--primary-light); border-radius: 1.35rem; display: flex; align-items: center; justify-content: center; font-size: 1.85rem; margin: 0 auto 1.35rem;">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Jadwal Super Fleksibel</h3>
                <p style="color: var(--text-muted); font-size: 0.925rem;">Pilih jam latihan sesuai kesibukan Anda (Pagi 06.00 s/d Malam 20.00 WIB).</p>
            </div>

            <div class="glass-card" style="padding: 2.25rem 1.5rem; text-align: center;">
                <div style="width: 64px; height: 64px; background: rgba(245, 158, 11, 0.12); color: var(--accent-hover); border-radius: 1.35rem; display: flex; align-items: center; justify-content: center; font-size: 1.85rem; margin: 0 auto 1.35rem;">
                    <i class="fa-solid fa-person-dress"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Instruktur Wanita Privat</h3>
                <p style="color: var(--text-muted); font-size: 0.925rem;">Khusus siswa perempuan / muslimah dengan pilihan kolam privat aman.</p>
            </div>

            <div class="glass-card" style="padding: 2.25rem 1.5rem; text-align: center;">
                <div style="width: 64px; height: 64px; background: rgba(16, 185, 129, 0.12); color: var(--emerald); border-radius: 1.35rem; display: flex; align-items: center; justify-content: center; font-size: 1.85rem; margin: 0 auto 1.35rem;">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Garansi Bimbingan</h3>
                <p style="color: var(--text-muted); font-size: 0.925rem;">Diimbimbing hingga berani air, mengapung, meluncur, dan mahir berenang.</p>
            </div>
        </div>
    </div>
</section>

<!-- Program Section with Interactive Category Filter Tabs -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Program Pilihan</span>
            <h2 class="section-title">Pilih Program Les Renang Sesuai Kebutuhan Anda</h2>
            <p class="section-description">
                Dari kelas anak ramah & menyenangkan hingga persiapan fisik intensif seleksi TNI POLRI.
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="tab-btn active" onclick="filterPrograms('all', this)">Semua Program</button>
            <button class="tab-btn" onclick="filterPrograms('anak', this)">Renang Anak</button>
            <button class="tab-btn" onclick="filterPrograms('dewasa', this)">Dewasa Pemula</button>
            <button class="tab-btn" onclick="filterPrograms('wanita', this)">Khusus Wanita</button>
            <button class="tab-btn" onclick="filterPrograms('tni', this)">Persiapan TNI POLRI</button>
            <button class="tab-btn" onclick="filterPrograms('terapi', this)">Terapi Medis</button>
        </div>

        <div class="grid-3" id="programGridContainer">
            @foreach($programs as $prog)
            @php 
                $slug = is_object($prog) ? $prog->slug : ($prog['slug'] ?? '');
                $title = is_object($prog) ? $prog->title : ($prog['title'] ?? '');
                $image = is_object($prog) ? $prog->image : ($prog['image'] ?? '');
                $badge = is_object($prog) ? $prog->badge : ($prog['badge'] ?? '');
                $audience = is_object($prog) ? $prog->target_audience : ($prog['target_audience'] ?? '');
                $desc = is_object($prog) ? $prog->description : ($prog['description'] ?? '');
                $features = is_object($prog) ? $prog->features : ($prog['features'] ?? []);
                $price = is_object($prog) ? $prog->price_start : ($prog['price_start'] ?? 0);
                $cat = Str::contains($slug, 'anak') ? 'anak' : (Str::contains($slug, 'dewasa') ? 'dewasa' : (Str::contains($slug, 'wanita') ? 'wanita' : (Str::contains($slug, 'tni') ? 'tni' : (Str::contains($slug, 'terapi') ? 'terapi' : 'other'))));
            @endphp
            <div class="program-card program-item-card" data-category="{{ $cat }}">
                <div class="program-thumb">
                    <img src="{{ Str::startsWith($image, 'http') ? $image : asset($image) }}" alt="{{ $title }}" onerror="this.onerror=null; this.src='{{ asset('images/logo.webp') }}';">
                    @if($badge)
                        <span class="program-badge">{{ $badge }}</span>
                    @endif
                </div>
                <div class="program-body">
                    <h3 class="program-title">{{ $title }}</h3>
                    <div class="program-audience">
                        <i class="fa-solid fa-users-viewfinder"></i> {{ $audience }}
                    </div>
                    <p class="program-desc">{{ Str::limit($desc, 110) }}</p>
                    
                    <div style="margin-bottom: 1.35rem;">
                        @if($features)
                            @foreach(array_slice($features, 0, 3) as $feat)
                                <div style="font-size: 0.875rem; color: var(--text-main); margin-bottom: 0.45rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fa-solid fa-circle-check" style="color: var(--emerald);"></i> {{ $feat }}
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="program-footer">
                        <div class="price-tag">
                            Mulai dari<br>
                            <span>Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('program.show', $slug ?: 'les-renang-anak') }}" class="btn btn-outline btn-sm">
                            Detail Program <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-paper-plane"></i> Daftar Program Sekarang
            </button>
        </div>
    </div>
</section>

<!-- Cara Pendaftaran Section -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Alur Mudah</span>
            <h2 class="section-title">4 Langkah Mudah Memulai Les Renang</h2>
            <p class="section-description">Proses pendaftaran cepat tanpa ribet dalam hitungan menit.</p>
        </div>

        <div class="grid-4">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Isi Form / Chat WA</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Klik tombol daftar atau hubungi Admin WhatsApp untuk konsultasi awal.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Pilih Jadwal & Kolam</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Tentukan hari, jam latihan, dan lokasi kolam renang partner pilihan Anda.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Sesi Trial / Sesi 1</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Ikuti latihan pertama bersama pelatih ramah & profesional kami di air.</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Mahir Berenang!</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Kuasai berbagai teknik gaya renang & dapatkan sertifikat kelulusan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni & Interactive Video Lightbox Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Kisah Sukses</span>
            <h2 class="section-title">Apa Kata Orang Tua & Siswa Kami?</h2>
            <p class="section-description">Pengalaman nyata ribuan alumni Les Renang Jogja.</p>
        </div>

        <div class="grid-2" style="margin-bottom: 3.5rem;">
            @foreach($testimonials as $testi)
            @php
                $rating = is_object($testi) ? $testi->rating : ($testi['rating'] ?? 5);
                $review = is_object($testi) ? $testi->review : ($testi['review'] ?? '');
                $name = is_object($testi) ? $testi->name : ($testi['name'] ?? '');
                $avatar = is_object($testi) ? $testi->avatar : ($testi['avatar'] ?? '');
                $role = is_object($testi) ? $testi->role : ($testi['role'] ?? '');
                $programName = is_object($testi) ? $testi->program : ($testi['program'] ?? '');
            @endphp
            <div class="testimonial-card">
                <div class="rating-stars">
                    @for($i = 0; $i < $rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="font-style: italic; color: var(--dark-surface); font-size: 1.05rem; line-height: 1.75; margin-bottom: 1.25rem;">
                    "{{ $review }}"
                </p>
                <div class="testimonial-user">
                    <div class="testimonial-avatar">
                        <img src="{{ Str::startsWith($avatar, 'http') ? $avatar : asset($avatar) }}" alt="{{ $name }}" onerror="this.onerror=null; this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:var(--primary);color:white;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:800;\'>{{ substr($name, 0, 1) }}</div>';">
                    </div>
                    <div>
                        <div style="font-weight: 900; color: var(--dark); font-size: 1.05rem;">{{ $name }}</div>
                        <div style="font-size: 0.875rem; color: var(--primary); font-weight: 700;">{{ $role }} • {{ $programName }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Interactive Before-After Video Gallery (Shorts / Reels Style) -->
        <div style="margin-top: 3.5rem; margin-bottom: 3.5rem;">
            <div class="section-header" style="margin-bottom: 2rem;">
                <span class="section-subtitle"><i class="fa-solid fa-clapperboard"></i> Bukti Hasil Latihan Siswa</span>
                <h2 class="section-title">Galeri Video Before-After (Gaya Reels / Shorts)</h2>
                <p class="section-description">Lihat transformasi nyata siswa kami: dari tidak berani masuk air hingga mahir berenang hanya dalam 4-6 sesi privat!</p>
            </div>

            <!-- 3 Vertical 9:16 Shorts Cards Grid -->
            <div class="grid-3" style="gap: 1.5rem;">
                <!-- Reel 1: Siswa Anak -->
                <div class="reel-card" onclick="openReelModal('Daffa (7 Tahun)', 'Hari 1: Takut Air & Menangis ➔ Hari 4: Mahir Gaya Dada 25m', 'https://www.youtube.com/embed/5ee8sX_1-9c')" style="position: relative; height: 420px; border-radius: 1.75rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.25); cursor: pointer; border: 3px solid rgba(255,255,255,0.9); transition: all 0.35s ease;">
                    <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?q=80&w=800&auto=format&fit=crop" alt="Before After Les Renang Anak Daffa" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(3,4,94,0.92) 0%, rgba(3,4,94,0.2) 50%, rgba(0,0,0,0.4) 100%);"></div>

                    <!-- Floating Before/After Badge Top -->
                    <div style="position: absolute; top: 15px; left: 15px; display: flex; gap: 0.4rem; flex-wrap: wrap;">
                        <span style="background: #ef4444; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">🔴 Hari 1: Takut Air</span>
                        <span style="background: #10b981; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">🟢 Hari 4: Mahir</span>
                    </div>

                    <!-- Center Play Reel Icon -->
                    <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 64px; height: 64px; background: rgba(255,255,255,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.6rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        <i class="fa-solid fa-play" style="margin-left: 4px; color: var(--accent);"></i>
                    </div>

                    <!-- Bottom User Info & Story -->
                    <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; color: white;">
                        <div style="font-weight: 900; font-size: 1.15rem; margin-bottom: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                            <i class="fa-solid fa-child-reaching" style="color: var(--accent);"></i> Daffa (7 Tahun)
                        </div>
                        <div style="font-size: 0.85rem; color: #e0f2fe; line-height: 1.4;">
                            Dari tidak mau lepas pegangan hingga berani meluncur & renang gaya dada 25 meter mandiri!
                        </div>
                    </div>
                </div>

                <!-- Reel 2: Siswa Dewasa Wanita -->
                <div class="reel-card" onclick="openReelModal('Mbak Siti (24 Tahun)', 'Hari 1: Trauma Kedalaman ➔ Hari 3: Meluncur di Kolam Dalam 2m', 'https://www.youtube.com/embed/M5cs8a3Bhfg')" style="position: relative; height: 420px; border-radius: 1.75rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.25); cursor: pointer; border: 3px solid rgba(255,255,255,0.9); transition: all 0.35s ease;">
                    <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=800&auto=format&fit=crop" alt="Before After Les Renang Dewasa Wanita Siti" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(3,4,94,0.92) 0%, rgba(3,4,94,0.2) 50%, rgba(0,0,0,0.4) 100%);"></div>

                    <!-- Floating Before/After Badge Top -->
                    <div style="position: absolute; top: 15px; left: 15px; display: flex; gap: 0.4rem; flex-wrap: wrap;">
                        <span style="background: #ef4444; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">🔴 Hari 1: Trauma</span>
                        <span style="background: #10b981; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">🟢 Hari 3: Berani 2m</span>
                    </div>

                    <!-- Center Play Reel Icon -->
                    <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 64px; height: 64px; background: rgba(255,255,255,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.6rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        <i class="fa-solid fa-play" style="margin-left: 4px; color: var(--accent);"></i>
                    </div>

                    <!-- Bottom User Info & Story -->
                    <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; color: white;">
                        <div style="font-weight: 900; font-size: 1.15rem; margin-bottom: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                            <i class="fa-solid fa-person-dress" style="color: var(--accent);"></i> Mbak Siti (24 Tahun)
                        </div>
                        <div style="font-size: 0.85rem; color: #e0f2fe; line-height: 1.4;">
                            Bimbingan privat 1-on-1 wanita ramah. Dalam 3 sesi berhasil mengatasi trauma air kedalaman 2 meter!
                        </div>
                    </div>
                </div>

                <!-- Reel 3: Peserta TNI / POLRI -->
                <div class="reel-card" onclick="openReelModal('Rian (Calon TNI/POLRI)', 'Hari 1: Renang 15m Terengah ➔ Hari 6: Lulus Tes 50m Gaya Bebas', 'https://www.youtube.com/embed/xVeXGKPOH58')" style="position: relative; height: 420px; border-radius: 1.75rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.25); cursor: pointer; border: 3px solid rgba(255,255,255,0.9); transition: all 0.35s ease;">
                    <img src="https://images.unsplash.com/photo-1438029071396-1e831a7fa6d8?q=80&w=800&auto=format&fit=crop" alt="Before After Les Renang TNI POLRI Rian" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(3,4,94,0.92) 0%, rgba(3,4,94,0.2) 50%, rgba(0,0,0,0.4) 100%);"></div>

                    <!-- Floating Before/After Badge Top -->
                    <div style="position: absolute; top: 15px; left: 15px; display: flex; gap: 0.4rem; flex-wrap: wrap;">
                        <span style="background: #ef4444; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">🔴 Hari 1: 15m</span>
                        <span style="background: #10b981; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">🟢 Hari 6: Lulus 50m</span>
                    </div>

                    <!-- Center Play Reel Icon -->
                    <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 64px; height: 64px; background: rgba(255,255,255,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.6rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                        <i class="fa-solid fa-play" style="margin-left: 4px; color: var(--accent);"></i>
                    </div>

                    <!-- Bottom User Info & Story -->
                    <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; color: white;">
                        <div style="font-weight: 900; font-size: 1.15rem; margin-bottom: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                            <i class="fa-solid fa-user-ninja" style="color: var(--accent);"></i> Rian (Calon TNI/POLRI)
                        </div>
                        <div style="font-size: 0.85rem; color: #e0f2fe; line-height: 1.4;">
                            Pelatihan stamina & teknik pernapasan intensif. Lulus tes renang 50m gaya bebas target waktu 55 detik!
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Gallery Showcase with Interactive Modal Player -->
        <div class="glass-card" style="padding: 3.5rem 2rem; text-align: center; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; border-radius: 2rem; box-shadow: var(--shadow-glow); border: 1px solid rgba(255,255,255,0.25);">
            <span style="color: var(--accent); font-weight: 800; letter-spacing: 2px; text-transform: uppercase; font-size: 0.875rem;">Video Showcase Aktivitas</span>
            <h3 style="color: white; font-size: 2.3rem; margin: 0.5rem 0 1rem;">Lihat Perubahan & Kemajuan Peserta Kami di Air</h3>
            <p style="color: rgba(255, 255, 255, 0.9); max-width: 680px; margin: 0 auto 2.5rem; font-size: 1.05rem;">
                Tonton proses dari tidak berani masuk air hingga mahir berenang gaya dada dan meluncur dengan percaya diri!
            </p>
            <div style="display: flex; justify-content: center; gap: 1.25rem; flex-wrap: wrap;">
                <button onclick="openVideoModal()" class="btn btn-accent btn-lg">
                    <i class="fa-solid fa-circle-play" style="font-size: 1.4rem;"></i> Tonton Video Aktivitas (Interactive)
                </button>
                <button onclick="openTrialModal()" class="btn btn-outline btn-lg" style="color: white; border-color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-bolt"></i> Booking Trial Gratis 30m
                </button>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Accordion Section -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Pertanyaan Populer</span>
            <h2 class="section-title">Frequently Asked Questions (FAQ)</h2>
            <p class="section-description">Jawaban lengkap atas pertanyaan yang sering diajukan calon siswa.</p>
        </div>

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: 1rem; color: var(--text-muted); align-self: center;"></i>
            <input type="text" id="faqSearchInput" class="search-input" placeholder="Cari pertanyaan... (contoh: harga, garansi, pelatih wanita)">
        </div>

        <div style="max-width: 880px; margin: 0 auto;" id="faqListContainer">
            @foreach($popularFaqs as $faq)
            @php
                $qText = is_object($faq) ? $faq->question : ($faq['question'] ?? '');
                $aText = is_object($faq) ? $faq->answer : ($faq['answer'] ?? '');
            @endphp
            <div class="faq-item" data-question="{{ strtolower($qText) }} {{ strtolower($aText) }}">
                <div class="faq-header">
                    <span><i class="fa-regular fa-circle-question" style="color: var(--primary); margin-right: 0.5rem;"></i> {{ $qText }}</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-body">
                    <p>{{ $aText }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 2.75rem;">
            <a href="{{ route('faq') }}" class="btn btn-outline">
                Lihat Semua 20+ Pertanyaan FAQ <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Latest Articles / Blog Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Edukasi & Tips</span>
            <h2 class="section-title">Artikel Tips Renang Terbaru</h2>
            <p class="section-description">Wawasan seputar kesehatan renang, parenting, dan persiapan tes fisik.</p>
        </div>

        <div class="grid-3">
            @foreach($latestPosts as $post)
            @php
                $postTitle = is_object($post) ? $post->title : ($post['title'] ?? '');
                $postSlug = is_object($post) ? $post->slug : ($post['slug'] ?? '');
                $postImage = is_object($post) ? $post->image : ($post['image'] ?? '');
                $postCat = is_object($post) ? $post->category : ($post['category'] ?? '');
                $postTime = is_object($post) ? $post->reading_time : ($post['reading_time'] ?? 4);
                $postExcerpt = is_object($post) ? $post->excerpt : ($post['excerpt'] ?? '');
            @endphp
            <div class="glass-card" style="overflow: hidden; background: #ffffff;">
                <div style="height: 200px; overflow: hidden; background: #e0f2fe;">
                    <img src="{{ Str::startsWith($postImage, 'http') ? $postImage : asset($postImage) }}" alt="{{ $postTitle }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_uny.webp') }}';">
                </div>
                <div style="padding: 1.6rem;">
                    <div style="font-size: 0.8rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem; text-transform: uppercase;">
                        {{ $postCat }} • {{ $postTime }} Menit Baca
                    </div>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; line-height: 1.4;">
                        <a href="{{ route('blog.show', $postSlug ?: '5-tips-mengatasi-anak-takut-air-saat-belajar-renang') }}" style="text-decoration: none; color: var(--dark);">{{ $postTitle }}</a>
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.925rem; margin-bottom: 1.35rem;">{{ Str::limit($postExcerpt, 90) }}</p>
                    <a href="{{ route('blog.show', $postSlug ?: '5-tips-mengatasi-anak-takut-air-saat-belajar-renang') }}" style="font-weight: 800; color: var(--primary); text-decoration: none; font-size: 0.9rem;">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- High-Impact Wild Surging Liquid Wave Top Divider -->
<div class="promo-wave-divider" style="position: relative; width: 100%; overflow: hidden; line-height: 0; margin-bottom: -1px; z-index: 5;">
    <svg viewBox="0 0 1440 220" preserveAspectRatio="none" style="width: 100%; height: 145px; display: block;">
        <!-- Wave Layer 1 (Wild Soft Backing Curve - High Peaks & Deep Drops) -->
        <path d="M0,40 C180,210 380,-40 620,130 C860,280 1100,-20 1280,110 C1380,180 1420,20 1440,60 L1440,220 L0,220 Z" fill="var(--primary-light)" opacity="0.4"></path>

        <!-- Wave Layer 2 (Wild Mid Fluid Surge) -->
        <path d="M0,85 C240,215 480,-10 740,120 C980,240 1220,-30 1440,90 L1440,220 L0,220 Z" fill="var(--primary)" opacity="0.65"></path>

        <!-- Wild Water Splash Droplets & Bubbles -->
        <circle cx="150" cy="50" r="8" fill="var(--primary-light)" opacity="0.85"></circle>
        <circle cx="175" cy="30" r="5" fill="var(--primary-light)" opacity="0.9"></circle>
        <circle cx="480" cy="20" r="10" fill="var(--primary-light)" opacity="0.85"></circle>
        <circle cx="515" cy="45" r="6" fill="var(--primary-light)" opacity="0.95"></circle>
        <circle cx="820" cy="35" r="9" fill="var(--primary-light)" opacity="0.8"></circle>
        <circle cx="850" cy="15" r="5" fill="var(--primary-light)" opacity="0.9"></circle>
        <circle cx="1180" cy="25" r="8" fill="var(--primary-light)" opacity="0.85"></circle>
        <circle cx="1210" cy="50" r="4" fill="var(--primary-light)" opacity="0.95"></circle>

        <!-- Wave Layer 3 (Foreground Wild Surging Ocean Crest - Seamless var(--primary-dark)) -->
        <path d="M0,130 C150,15 350,185 550,70 C750,-40 950,170 1160,55 C1300,-25 1390,115 1440,85 L1440,220 L0,220 Z" fill="var(--primary-dark)"></path>
    </svg>
</div>

<!-- Big High-Conversion CTA Banner (Seamless Fill Match with var(--primary-dark)) -->
<section class="section" style="background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; text-align: center; padding: 2.5rem 0 5rem; position: relative;">
    <div class="container" style="position: relative; z-index: 2;">
        <div style="max-width: 840px; margin: 0 auto;">
            
            <!-- Theme-Responsive Glowing Promo Badge -->
            <div style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.85rem 2rem; background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(16px); border: 2px solid rgba(255, 255, 255, 0.45); border-radius: 99px; font-weight: 900; font-size: 1.05rem; margin-bottom: 2rem; box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2); transform: scale(1.02); transition: all 0.3s ease;">
                <span style="font-size: 1.5rem; filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));">🔥</span> 
                <span style="color: #ffffff; letter-spacing: 0.5px;">
                    Promo Terbatas Bulan Ini - Diskon Paket Kakak Adik
                </span>
            </div>

            <h2 style="color: white; font-size: 3rem; margin-bottom: 1.5rem; line-height: 1.25; font-weight: 900; text-shadow: 0 5px 20px rgba(0, 0, 0, 0.25);">
                Siap Mahir Berenang Dalam Waktu Singkat?
            </h2>
            <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2.75rem; line-height: 1.75; font-weight: 500;">
                Jangan tunda lagi! Konsultasikan kebutuhan les renang Anda secara gratis dengan tim admin & pelatih kami sekarang juga.
            </p>
            <div style="display: flex; gap: 1.35rem; justify-content: center; flex-wrap: wrap;">
                <button onclick="openRegistrationModal()" class="btn btn-accent btn-lg" style="box-shadow: 0 12px 30px rgba(245, 158, 11, 0.45); transform: translateY(-2px);">
                    <i class="fa-solid fa-paper-plane"></i> Daftar Les Renang Sekarang
                </button>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20konsultasi%20gratis%20les%20renang." target="_blank" class="btn btn-whatsapp btn-lg" style="box-shadow: 0 12px 30px rgba(37, 211, 102, 0.45); transform: translateY(-2px);">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Reels Modal Player Overlay -->
<div class="modal-overlay" id="reelModalOverlay" style="display: none; align-items: center; justify-content: center; z-index: 9999;">
    <div class="modal-card" style="max-width: 460px; width: 92%; padding: 0; overflow: hidden; border-radius: 2rem; background: #000;">
        <div style="padding: 1.15rem 1.4rem; background: #0f172a; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h4 id="reelModalTitle" style="margin: 0; color: white; font-size: 1.1rem; font-weight: 800;">Before-After Shorts</h4>
                <p id="reelModalSub" style="margin: 0.2rem 0 0; color: #38bdf8; font-size: 0.8rem; font-weight: 700;"></p>
            </div>
            <button onclick="closeReelModal()" style="background: transparent; border: none; color: white; font-size: 1.6rem; cursor: pointer;">&times;</button>
        </div>
        <div style="position: relative; padding-top: 140%; width: 100%;">
            <iframe id="reelModalIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;" src="" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openReelModal(title, sub, videoUrl) {
        document.getElementById('reelModalTitle').innerText = title;
        document.getElementById('reelModalSub').innerText = sub;
        document.getElementById('reelModalIframe').src = videoUrl + '?autoplay=1';
        document.getElementById('reelModalOverlay').style.display = 'flex';
    }

    function closeReelModal() {
        document.getElementById('reelModalIframe').src = '';
        document.getElementById('reelModalOverlay').style.display = 'none';
    }

    function filterPrograms(category, btnElement) {
        // Tab buttons styling
        document.querySelectorAll('.filter-tabs .tab-btn').forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');

        // Program cards filter logic
        const cards = document.querySelectorAll('.program-item-card');
        cards.forEach(card => {
            const cat = card.getAttribute('data-category');
            if (category === 'all' || cat === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    document.getElementById('faqSearchInput')?.addEventListener('keyup', function(e) {
        const query = e.target.value.toLowerCase();
        const items = document.querySelectorAll('#faqListContainer .faq-item');
        items.forEach(item => {
            const text = item.getAttribute('data-question');
            if (text.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
