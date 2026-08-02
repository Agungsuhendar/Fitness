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
            <div>
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
                <div class="hero-image-card">
                    <img src="{{ asset('images/assets/hero_pool.webp') }}" alt="Les Renang Jogja Privat Anak & Dewasa" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/logo.webp') }}';">
                </div>
                <div class="floating-trust-card">
                    <div style="width: 50px; height: 50px; background: rgba(37, 211, 102, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #25d366; font-size: 1.6rem;">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.05rem; color: var(--dark);">Garansi Bisa Renang</div>
                        <div style="font-size: 0.85rem; color: var(--text-muted);">Bimbingan ekstra hingga mahir</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Banner -->
<section style="background: linear-gradient(135deg, #0b132b 0%, #1c2541 100%); padding: 3.5rem 0; color: white;">
    <div class="container">
        <div class="grid-4" style="text-align: center;">
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #00f2fe; margin-bottom: 0.25rem;">2.500+</div>
                <div style="color: #94a3b8; font-weight: 700; font-size: 0.95rem;">Siswa Alumni Mahir</div>
            </div>
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #fbbf24; margin-bottom: 0.25rem;">10+ Th</div>
                <div style="color: #94a3b8; font-weight: 700; font-size: 0.95rem;">Pengalaman Pelatihan</div>
            </div>
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #4ade80; margin-bottom: 0.25rem;">100%</div>
                <div style="color: #94a3b8; font-weight: 700; font-size: 0.95rem;">Pelatih Lisensi PRSI</div>
            </div>
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #f472b6; margin-bottom: 0.25rem;">4.9 / 5</div>
                <div style="color: #94a3b8; font-weight: 700; font-size: 0.95rem;">Rating Kepuasan Wali</div>
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
                    <img src="{{ Str::startsWith($image, 'http') ? $image : asset($image) }}" alt="{{ $title }}" onerror="this.onerror=null; this.src='{{ asset('images/hero.svg') }}';">
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

        <!-- Video Gallery Showcase with Interactive Modal Player -->
        <div class="glass-card" style="padding: 3.5rem 2rem; text-align: center; background: linear-gradient(135deg, #0b132b 0%, #1c2541 100%); color: white; border-radius: 2rem; box-shadow: var(--shadow-glow);">
            <span style="color: var(--cyan-glow); font-weight: 800; letter-spacing: 2px; text-transform: uppercase; font-size: 0.875rem;">Video Showcase Aktivitas</span>
            <h3 style="color: white; font-size: 2.3rem; margin: 0.5rem 0 1rem;">Lihat Perubahan & Kemajuan Peserta Kami di Air</h3>
            <p style="color: #94a3b8; max-width: 680px; margin: 0 auto 2.5rem; font-size: 1.05rem;">
                Tonton proses dari tidak berani masuk air hingga mahir berenang gaya dada dan meluncur dengan percaya diri!
            </p>
            <div style="display: flex; justify-content: center; gap: 1.25rem; flex-wrap: wrap;">
                <button onclick="openVideoModal()" class="btn btn-accent btn-lg">
                    <i class="fa-solid fa-circle-play" style="font-size: 1.4rem;"></i> Tonton Video Aktivitas (Interactive)
                </button>
                <button onclick="openTrialModal()" class="btn btn-outline btn-lg" style="color: white; border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.1);">
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

<!-- Big High-Conversion CTA Banner -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; text-align: center;">
    <div class="container">
        <div style="max-width: 840px; margin: 0 auto;">
            <div style="display: inline-block; padding: 0.6rem 1.35rem; background: rgba(255,255,255,0.18); border-radius: 99px; font-weight: 800; font-size: 0.875rem; margin-bottom: 1.35rem;">
                🔥 Promo Terbatas Bulan Ini - Diskon Paket Kakak Adik
            </div>
            <h2 style="color: white; font-size: 2.85rem; margin-bottom: 1.35rem; line-height: 1.2;">
                Siap Mahir Berenang Dalam Waktu Singkat?
            </h2>
            <p style="font-size: 1.2rem; color: #e0f2fe; margin-bottom: 2.5rem;">
                Jangan tunda lagi! Konsultasikan kebutuhan les renang Anda secara gratis dengan tim admin & pelatih kami sekarang juga.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <button onclick="openRegistrationModal()" class="btn btn-accent btn-lg">
                    <i class="fa-solid fa-paper-plane"></i> Daftar Les Renang Sekarang
                </button>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20konsultasi%20gratis%20les%20renang." target="_blank" class="btn btn-whatsapp btn-lg">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
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
