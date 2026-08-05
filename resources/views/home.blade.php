@extends('layouts.app')

@section('title', 'ApexFitness Center - Gym & Personal Trainer Privat 1-on-1 Yogyakarta')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(180deg, #070a12 0%, #0f172a 70%, #070a12 100%); color: #ffffff; padding: 5rem 0 4rem; position: relative; overflow: hidden;">
    <div class="container">
        <div class="hero-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
            <div class="hero-text-col">
                <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); color: #10b981; padding: 0.45rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.25rem;">
                    <i class="fa-solid fa-award" style="color: #f97316;"></i> #1 Gym & Personal Training Studio Terpercaya di Jogja
                </div>
                <h1 class="hero-title" style="font-size: 3.2rem; font-weight: 900; line-height: 1.2; margin-bottom: 1.25rem; font-family: 'Outfit', sans-serif;">
                    Transformasi Fisik Ideal & Performa Maksimal di <span style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">ApexFitness</span>
                </h1>
                <p class="hero-description" style="font-size: 1.1rem; color: #94a3b8; line-height: 1.7; margin-bottom: 2rem;">
                    {{ site_setting('hero_subtitle', 'Bimbingan Personal Trainer 1-on-1 tersertifikasi APKI dengan garansi hasil terukur. Program Weight Loss, Muscle Building, Female Body Shaping, serta Persiapan Fisik TNI & POLRI.') }}
                </p>

                <div class="hero-cta-group" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                    <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.9rem 1.8rem; font-weight: 800; border-radius: 99px; box-shadow: 0 8px 24px rgba(16,185,129,0.35);">
                        <i class="fa-solid fa-paper-plane"></i> Daftar PT Sesi Privat
                    </button>
                    <button onclick="openTrialModal()" class="btn btn-accent btn-lg" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: #ffffff; padding: 0.9rem 1.8rem; font-weight: 800; border-radius: 99px;">
                        <i class="fa-solid fa-bolt" style="color: #f97316;"></i> Free Trial Sesi 1
                    </button>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(site_setting('whatsapp_message', 'Halo Admin ApexFitness, saya ingin klaim Free Trial PT Sesi 1.')) }}" target="_blank" class="btn btn-whatsapp btn-lg" style="background: #25d366; color: white; padding: 0.9rem 1.8rem; font-weight: 800; border-radius: 99px; text-decoration: none;">
                        <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                    </a>
                </div>

                <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(249, 115, 22, 0.12); border: 1px solid rgba(249, 115, 22, 0.3); color: #f97316; padding: 0.45rem 1rem; border-radius: 99px; font-size: 0.85rem; font-weight: 800; margin-bottom: 2rem;">
                    <i class="fa-solid fa-fire"></i> 🔥 Sisa 4 Slot Sesi Personal Trainer Bulan Ini! • InBody Scan Gratis
                </div>

                <div class="trust-badges" style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                    <div class="trust-item" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 700; color: #cbd5e1;">
                        <i class="fa-solid fa-shield-halved" style="color: #10b981; font-size: 1.25rem;"></i>
                        <span>PT Sertifikasi APKI / IFBB</span>
                    </div>
                    <div class="trust-item" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 700; color: #cbd5e1;">
                        <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 1.25rem;"></i>
                        <span>1.000+ Member Body Transformation</span>
                    </div>
                    <div class="trust-item" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 700; color: #cbd5e1;">
                        <i class="fa-solid fa-star" style="color: #f97316; font-size: 1.25rem;"></i>
                        <span>Rating 4.9/5 (300+ Review)</span>
                    </div>
                </div>
            </div>

            <!-- Hero Image Wrapper -->
            <div class="hero-image-wrapper" style="position: relative;">
                <div class="glass-card" style="background: #0f172a; border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 2rem; padding: 1.5rem; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
                    <div style="position: relative; border-radius: 1.5rem; overflow: hidden; height: 420px; background: #1e293b;">
                        <img src="{{ asset('images/assets/program_tni.webp') }}" alt="ApexFitness Personal Training Studio" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15,23,42,0.9) 0%, transparent 60%);"></div>
                        <div style="position: absolute; bottom: 1.5rem; left: 1.5rem; right: 1.5rem;">
                            <span style="background: #10b981; color: white; padding: 0.3rem 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase;">InBody 3D Scan & Custom Meal Plan</span>
                            <h3 style="color: white; font-size: 1.35rem; margin-top: 0.5rem; margin-bottom: 0.2rem;">Latihan Terstruktur & Garansi Terukur</h3>
                            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">Bimbingan intensif 1-on-1 hingga target fisik Anda tercapai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Banner -->
<section class="section" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; text-align: center; padding: 3.5rem 0;">
    <div class="container">
        <div class="grid-4" style="text-align: center;">
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #ffffff; margin-bottom: 0.25rem;">1.000+</div>
                <div style="color: #dcfce7; font-weight: 700; font-size: 0.95rem;">Member Berhasil Transformasi</div>
            </div>
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #ffffff; margin-bottom: 0.25rem;">10+ Th</div>
                <div style="color: #dcfce7; font-weight: 700; font-size: 0.95rem;">Pengalaman Personal Trainer</div>
            </div>
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #ffffff; margin-bottom: 0.25rem;">100%</div>
                <div style="color: #dcfce7; font-weight: 700; font-size: 0.95rem;">PT Sertifikasi APKI / IFBB</div>
            </div>
            <div>
                <div style="font-size: 3rem; font-weight: 900; color: #fde047; margin-bottom: 0.25rem;">4.9 / 5</div>
                <div style="color: #fde047; font-weight: 800; font-size: 0.95rem;"><i class="fa-solid fa-star" style="color: #f97316; margin-right: 0.35rem;"></i>Rating Kepuasan Member</div>
            </div>
        </div>
    </div>
</section>

<!-- Keunggulan Section -->
<section class="section" style="background: #070a12; padding: 5rem 0;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Mengapa ApexFitness?</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Keunggulan Latihan di ApexFitness Center</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Fasilitas gym modern, trainer tersertifikasi, InBody scan 3D, dan pendekatan nutrisi presisi.</p>
        </div>

        <div class="grid-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
            @forelse($features as $feat)
            <div class="glass-card" style="padding: 2rem 1.5rem; text-align: center; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; transition: transform 0.25s ease;">
                <div style="width: 60px; height: 60px; background: rgba(16, 185, 129, 0.15); color: #10b981; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; margin: 0 auto 1.25rem;">
                    <i class="{{ $feat->icon }}"></i>
                </div>
                <h3 style="font-size: 1.15rem; color: #ffffff; margin-bottom: 0.5rem; font-weight: 800;">{{ $feat->title }}</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">{{ $feat->description }}</p>
            </div>
            @empty
            <div style="grid-column: span 4; text-align: center; color: #94a3b8; padding: 2rem;">
                <p>Fitur keunggulan sedang diperbarui.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Program Fitness Section -->
<section class="section" style="background: #0f172a; padding: 5rem 0;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Program Unggulan</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Program Fitness Terbukti Berhasil</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Pilih program latihan sesuai dengan target kesehatan & bentuk tubuh yang Anda impikan.</p>
        </div>

        <div class="grid-3" id="programGridContainer" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
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
            @endphp
            <div class="program-card" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease;">
                <div class="program-thumb" style="position: relative; height: 200px; overflow: hidden;">
                    <img src="{{ Str::startsWith($image, 'http') ? $image : asset($image) }}" alt="{{ $title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                    @if($badge)
                        <span class="program-badge" style="position: absolute; top: 12px; right: 12px; background: #10b981; color: white; padding: 0.3rem 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase;">{{ $badge }}</span>
                    @endif
                </div>
                <div class="program-body" style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 class="program-title" style="font-size: 1.25rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem;">{{ $title }}</h3>
                    <div class="program-audience" style="font-size: 0.85rem; color: #10b981; font-weight: 700; margin-bottom: 0.75rem;">
                        <i class="fa-solid fa-users-viewfinder"></i> {{ $audience }}
                    </div>
                    <p class="program-desc" style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">{{ Str::limit($desc, 110) }}</p>
                    
                    <div style="margin-bottom: 1.25rem;">
                        @if($features)
                            @foreach(array_slice($features, 0, 3) as $feat)
                                <div style="font-size: 0.85rem; color: #cbd5e1; margin-bottom: 0.4rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> {{ $feat }}
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="program-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem; margin-top: auto;">
                        <div class="price-tag" style="font-size: 0.8rem; color: #94a3b8;">
                            Paket Sesi Mulai<br>
                            <span style="font-size: 1.15rem; font-weight: 900; color: #ffffff;">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('program.show', $slug ?: 'weight-loss-fat-burn') }}" class="btn btn-outline btn-sm" style="border: 1px solid #10b981; color: #10b981; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 700; text-decoration: none;">
                            Detail Program <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.9rem 2.2rem; font-weight: 800; border-radius: 99px;">
                <i class="fa-solid fa-paper-plane"></i> Daftar Personal Trainer Sekarang
            </button>
        </div>
    </div>
</section>

<!-- Langkah Alur Latihan -->
<section class="section" style="background: #070a12; padding: 5rem 0;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Alur Mudah</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">4 Langkah Memulai Transformasi Anda</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Proses booking & konsultasi cepat dalam hitungan menit.</p>
        </div>

        <div class="grid-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem;">
            <div class="step-card" style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); padding: 2rem 1.5rem; border-radius: 1.25rem; text-align: center; position: relative;">
                <div class="step-number" style="width: 44px; height: 44px; background: #10b981; color: white; font-weight: 900; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1.25rem;">1</div>
                <h3 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 0.5rem; font-weight: 800;">Free Trial / Konsul</h3>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">Isi form booking trial atau hubungi Admin WhatsApp ApexFitness.</p>
            </div>
            <div class="step-card" style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); padding: 2rem 1.5rem; border-radius: 1.25rem; text-align: center; position: relative;">
                <div class="step-number" style="width: 44px; height: 44px; background: #10b981; color: white; font-weight: 900; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1.25rem;">2</div>
                <h3 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 0.5rem; font-weight: 800;">InBody 3D Scan</h3>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">Evaluasi komposisi lemak tubuh, massa otot, & BMR metabolisme.</p>
            </div>
            <div class="step-card" style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); padding: 2rem 1.5rem; border-radius: 1.25rem; text-align: center; position: relative;">
                <div class="step-number" style="width: 44px; height: 44px; background: #10b981; color: white; font-weight: 900; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1.25rem;">3</div>
                <h3 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 0.5rem; font-weight: 800;">Latihan & Meal Plan</h3>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">Jalani sesi PT 1-on-1 terstruktur & dapatkan panduan makanan harian.</p>
            </div>
            <div class="step-card" style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); padding: 2rem 1.5rem; border-radius: 1.25rem; text-align: center; position: relative;">
                <div class="step-number" style="width: 44px; height: 44px; background: #10b981; color: white; font-weight: 900; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1.25rem;">4</div>
                <h3 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 0.5rem; font-weight: 800;">Target Fisik Tercapai!</h3>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">Nikmati tubuh lebih sehat, ramping, kencang, & stamina puncak.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni & Video Transformation Gallery -->
<section class="section" style="background: #0f172a; padding: 5rem 0;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Kisah Sukses</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Transformasi Nyata Member ApexFitness</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Ulasan jujur dari member yang berhasil memangkas lemak & membentuk otot ideal.</p>
        </div>

        <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem; margin-bottom: 3.5rem;">
            @foreach($testimonials as $testi)
            @php
                $rating = is_object($testi) ? $testi->rating : ($testi['rating'] ?? 5);
                $review = is_object($testi) ? $testi->review : ($testi['review'] ?? '');
                $name = is_object($testi) ? $testi->name : ($testi['name'] ?? '');
                $role = is_object($testi) ? $testi->role : ($testi['role'] ?? '');
                $programName = is_object($testi) ? $testi->program : ($testi['program'] ?? '');
            @endphp
            <div class="testimonial-card" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.75rem;">
                <div class="rating-stars" style="color: #f97316; margin-bottom: 1rem; font-size: 0.9rem;">
                    @for($i = 0; $i < $rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="font-style: italic; color: #e2e8f0; font-size: 1rem; line-height: 1.7; margin-bottom: 1.25rem;">
                    "{{ $review }}"
                </p>
                <div class="testimonial-user" style="display: flex; align-items: center; gap: 0.85rem;">
                    <div style="width: 44px; height: 44px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;">
                        {{ substr($name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 1rem;">{{ $name }}</div>
                        <div style="font-size: 0.825rem; color: #10b981; font-weight: 700;">{{ $role }} • {{ $programName }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Video Gallery Showcase Cards -->
        <div style="margin-top: 3.5rem;">
            <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 2.5rem;">
                <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;"><i class="fa-solid fa-clapperboard"></i> Galeri Transformasi Video</span>
                <h2 class="section-title" style="color: #ffffff; font-size: 2rem; font-weight: 900; margin-top: 0.5rem;">Perubahan Fisik 90 Hari</h2>
            </div>

            <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                @forelse($videos as $vid)
                <div class="reel-card" onclick="openReelModal('{{ $vid->title }}', '{{ $vid->subtitle }}', '{{ $vid->video_url }}')" style="position: relative; height: 380px; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.4); cursor: pointer; border: 2px solid rgba(255,255,255,0.15);">
                    <img src="{{ asset('images/assets/video_thumb_daffa.png') }}" alt="{{ $vid->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, #0f172a 0%, transparent 60%);"></div>

                    @if($vid->before_badge || $vid->after_badge)
                    <div style="position: absolute; top: 15px; left: 15px; display: flex; gap: 0.4rem; flex-wrap: wrap;">
                        @if($vid->before_badge)<span style="background: #ef4444; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px;">{{ $vid->before_badge }}</span>@endif
                        @if($vid->after_badge)<span style="background: #10b981; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px;">{{ $vid->after_badge }}</span>@endif
                    </div>
                    @endif

                    <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 56px; height: 56px; background: rgba(16, 185, 129, 0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 1.4rem;">
                        <i class="fa-solid fa-play" style="margin-left: 3px;"></i>
                    </div>

                    <div style="position: absolute; bottom: 18px; left: 18px; right: 18px; color: white;">
                        <div style="font-weight: 900; font-size: 1.1rem; margin-bottom: 0.2rem; color: #ffffff;">
                            {{ $vid->title }}
                        </div>
                        <div style="font-size: 0.825rem; color: #94a3b8; line-height: 1.4;">
                            {{ $vid->description }}
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: span 3; text-align: center; color: #94a3b8; padding: 2rem;">
                    <p>Video galeri sedang diperbarui.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section" style="background: #070a12; padding: 5rem 0;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Pertanyaan Populer</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">FAQ ApexFitness Center</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Jawaban atas pertanyaan seputar Personal Trainer, fasilitas, & biaya.</p>
        </div>

        <div style="max-width: 840px; margin: 0 auto;" id="faqListContainer">
            @foreach($popularFaqs as $faq)
            @php
                $qText = is_object($faq) ? $faq->question : ($faq['question'] ?? '');
                $aText = is_object($faq) ? $faq->answer : ($faq['answer'] ?? '');
            @endphp
            <div class="faq-item" style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.85rem; margin-bottom: 0.85rem; overflow: hidden;">
                <div class="faq-header" style="padding: 1.1rem 1.4rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 800; color: #ffffff;">
                    <span><i class="fa-regular fa-circle-question" style="color: #10b981; margin-right: 0.5rem;"></i> {{ $qText }}</span>
                    <i class="fa-solid fa-chevron-down faq-icon" style="color: #94a3b8;"></i>
                </div>
                <div class="faq-body" style="padding: 0 1.4rem 1.25rem; color: #cbd5e1; font-size: 0.925rem; line-height: 1.6; display: none;">
                    <p style="margin: 0;">{{ $aText }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 2.5rem;">
            <a href="{{ route('faq') }}" class="btn btn-outline" style="border: 1px solid #10b981; color: #10b981; padding: 0.75rem 1.5rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                Lihat Semua FAQ Fitness <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- High-Conversion CTA Banner -->
<section class="section" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; text-align: center; padding: 4.5rem 0;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1.25rem; background: rgba(255, 255, 255, 0.2); border-radius: 99px; font-weight: 800; font-size: 0.875rem; margin-bottom: 1.5rem;">
                🔥 Promo Spesial Bulan Ini - Free InBody 3D Scan & Sesi Consult
            </div>
            <h2 style="color: white; font-size: 2.75rem; margin-bottom: 1.25rem; font-weight: 900; line-height: 1.2;">
                Siap Memiliki Tubuh Ramping, Kencang & Performa Atletis?
            </h2>
            <p style="font-size: 1.15rem; color: #dcfce7; margin-bottom: 2.5rem; line-height: 1.6;">
                Konsultasikan target fitness Anda gratis dengan Personal Trainer kami sekarang juga!
            </p>
            <div style="display: flex; gap: 1.25rem; justify-content: center; flex-wrap: wrap;">
                <button onclick="openRegistrationModal()" class="btn btn-accent btn-lg" style="background: #ffffff; color: #059669; font-weight: 900; padding: 0.9rem 2rem; border-radius: 99px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                    <i class="fa-solid fa-paper-plane"></i> Daftar Sesi PT Sekarang
                </button>
                <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(site_setting('whatsapp_message', 'Halo Admin ApexFitness, saya mau konsultasi gratis Sesi PT.')) }}" target="_blank" class="btn btn-whatsapp btn-lg" style="background: #25d366; color: white; font-weight: 800; padding: 0.9rem 2rem; border-radius: 99px; text-decoration: none;">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
