@extends('layouts.app')

@section('title', 'FitLife - Stronger Body, Better Life | Fitness Center Terpercaya di Yogyakarta')
@section('meta_description', 'Raih versi terbaik dirimu bersama program latihan dan bimbingan profesional dari trainer berpengalaman di FitLife Yogyakarta. Trial Gratis 7 Hari tanpa komitmen!')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: #090d0b; color: #ffffff; padding: 4.5rem 0 6rem; position: relative; overflow: hidden;">
    <!-- Subtle Background Ambient Light -->
    <div style="position: absolute; top: -100px; right: 10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(132, 204, 22, 0.12) 0%, transparent 70%); pointer-events: none; filter: blur(60px);"></div>
    <div style="position: absolute; bottom: -100px; left: 5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(132, 204, 22, 0.08) 0%, transparent 70%); pointer-events: none; filter: blur(60px);"></div>

    <div class="container">
        <div class="hero-grid" style="display: grid; grid-template-columns: 1.15fr 1fr; gap: 3rem; align-items: center;">
            
            <!-- Left Text Column -->
            <div class="hero-text-col" style="z-index: 2;">
                <!-- Hero Badge -->
                <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.08); border: 1px solid rgba(132, 204, 22, 0.3); color: #ffffff; padding: 0.45rem 1.1rem; border-radius: 99px; font-weight: 700; font-size: 0.85rem; margin-bottom: 1.75rem;">
                    <i class="fa-solid fa-trophy" style="color: #84cc16; font-size: 0.9rem;"></i>
                    <span>#1 Fitness Center Terpercaya di Yogyakarta</span>
                </div>

                <!-- Hero Title -->
                <h1 class="hero-title" style="font-size: 4rem; font-weight: 900; line-height: 1.1; margin-bottom: 1.25rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.03em;">
                    Stronger Body<br>
                    <span style="color: #84cc16;">Better Life</span>
                </h1>

                <!-- Hero Description -->
                <p class="hero-description" style="font-size: 1.15rem; color: #94a3b8; line-height: 1.7; margin-bottom: 2.25rem; max-width: 540px;">
                    Raih versi terbaik dirimu bersama program latihan dan bimbingan profesional dari trainer berpengalaman.
                </p>

                <!-- 3 Feature Bullets Row -->
                <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; margin-bottom: 2.5rem;">
                    <!-- Feature 1 -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.12); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">Program Terstruktur</div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Sesuai tujuanmu</div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.12); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">Trainer Profesional</div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Bersertifikasi</div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.12); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">Fasilitas Lengkap</div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">& Modern</div>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Buttons -->
                <div class="hero-cta-group" style="display: flex; gap: 1.15rem; align-items: center; flex-wrap: wrap;">
                    <button onclick="openRegistrationModal()" class="btn btn-lg" style="background: #84cc16; color: #090d0b; border: none; padding: 0.95rem 2.2rem; font-weight: 900; border-radius: 99px; display: flex; align-items: center; gap: 0.6rem; font-size: 1rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.45); cursor: pointer;">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <button onclick="openTrialModal()" class="btn btn-lg" style="background: rgba(255, 255, 255, 0.05); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.95rem 2rem; font-weight: 700; border-radius: 99px; display: flex; align-items: center; gap: 0.6rem; font-size: 1rem; cursor: pointer;">
                        <i class="fa-solid fa-circle-play" style="color: #cbd5e1; font-size: 1.1rem;"></i>
                        <span>Lihat Video</span>
                    </button>
                </div>
            </div>

            <!-- Right Image Column with Floating Card -->
            <div class="hero-image-col" style="position: relative; z-index: 2;">
                <!-- Main Fitness Couple Photo -->
                <div style="position: relative; border-radius: 2.2rem; overflow: hidden; height: 500px; box-shadow: 0 30px 60px rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.1);">
                    <img src="{{ asset('images/assets/fitlife_hero_couple.png') }}" alt="FitLife Muscular Couple" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/program_tni.webp') }}';">
                    
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(9,13,11,0.6) 0%, transparent 40%);"></div>

                    <!-- Right Floating Trial Card -->
                    <div class="floating-trial-card" style="position: absolute; right: 1.25rem; bottom: 35%; background: rgba(13, 18, 15, 0.9); backdrop-filter: blur(16px); border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.25rem 1.5rem; text-align: center; color: #ffffff; box-shadow: 0 15px 35px rgba(0,0,0,0.5); min-width: 150px;">
                        <div style="width: 46px; height: 46px; background: rgba(132, 204, 22, 0.15); border-radius: 0.85rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.35rem; margin: 0 auto 0.75rem;">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div style="font-weight: 800; font-size: 1rem; color: #ffffff; line-height: 1.2;">Trial Gratis</div>
                        <div style="font-weight: 900; font-size: 1.4rem; color: #84cc16; margin: 0.15rem 0;">7 Hari</div>
                        <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">Tanpa komitmen</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Floating Stats Bar (5 Columns Card) -->
        <div class="bottom-stats-bar" style="margin-top: -3.5rem; position: relative; z-index: 10;">
            <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 1.75rem; padding: 1.25rem 1.75rem; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);">
                <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr; gap: 1.5rem; align-items: center;">
                    
                    <!-- Column 1: Tour Gym Thumbnail Card -->
                    <div style="position: relative; border-radius: 1.15rem; overflow: hidden; height: 100px; border: 1px solid rgba(255,255,255,0.15); cursor: pointer;" onclick="openTrialModal()">
                        <img src="{{ asset('images/assets/fitlife_gym_tour.png') }}" alt="FitLife Tour Gym" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_uny.webp') }}';">
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 100%); flex-direction: column; justify-content: flex-end; padding: 0.75rem;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 40px; height: 40px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-size: 1rem; box-shadow: 0 4px 14px rgba(0,0,0,0.4);">
                                <i class="fa-solid fa-play" style="margin-left: 2px;"></i>
                            </div>
                            <div style="position: absolute; bottom: 0.6rem; left: 0.75rem; right: 0.75rem;">
                                <div style="font-weight: 800; color: #ffffff; font-size: 0.9rem;">Tour Gym</div>
                                <div style="color: #cbd5e1; font-size: 0.725rem;">Lihat fasilitas kami</div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Member Aktif -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div style="font-size: 1.75rem; font-weight: 900; color: #ffffff; line-height: 1;">2.500+</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Member Aktif</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Bergabung dan raih tujuan bersama kami</div>
                    </div>

                    <!-- Column 3: Program Latihan -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div style="font-size: 1.75rem; font-weight: 900; color: #ffffff; line-height: 1;">50+</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Program Latihan</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Dari fat loss, muscle building hingga strength</div>
                    </div>

                    <!-- Column 4: Trainer Profesional -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <div style="font-size: 1.75rem; font-weight: 900; color: #ffffff; line-height: 1;">15+</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Trainer Profesional</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Berpengalaman & bersertifikasi</div>
                    </div>

                    <!-- Column 5: Lokasi Strategis -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div style="font-size: 1.75rem; font-weight: 900; color: #ffffff; line-height: 1;">4 Lokasi</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Strategis di Jogja</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Mudah diakses dengan fasilitas parkir luas</div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- Program Fitness Section -->
<section class="section" style="background: #060907; padding: 6rem 0 5rem; color: white;" id="program">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Pilihan Program</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Program Latihan Sesuai Target Anda</h2>
            <p style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Dirancang khusus oleh Personal Trainer profesional dengan panduan nutrisi & evaluasi berkala.</p>
        </div>

        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @foreach($programs as $prog)
            <div class="program-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.35rem; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s, border-color 0.3s;">
                <div class="program-thumb" style="position: relative; height: 210px; background: #161f19;">
                    <img src="{{ Str::startsWith($prog->image, 'http') ? $prog->image : asset($prog->image) }}" alt="{{ $prog->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/fitlife_gym_tour.png') }}';">
                    @if($prog->badge)
                        <span style="position: absolute; top: 14px; right: 14px; background: #84cc16; color: #090d0b; padding: 0.35rem 0.85rem; border-radius: 99px; font-weight: 900; font-size: 0.75rem; text-transform: uppercase;">{{ $prog->badge }}</span>
                    @endif
                </div>
                <div class="program-body" style="padding: 1.6rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="font-size: 1.3rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem; font-family: 'Outfit', sans-serif;">{{ $prog->title }}</h3>
                    <div style="font-size: 0.85rem; color: #84cc16; font-weight: 700; margin-bottom: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-bullseye"></i> {{ $prog->target_audience }}
                    </div>
                    <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">{{ Str::limit($prog->description, 110) }}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.1rem; margin-top: auto;">
                        <div>
                            <span style="font-size: 0.75rem; color: #94a3b8;">Mulai dari</span>
                            <div style="font-size: 1.2rem; font-weight: 900; color: #ffffff;">Rp {{ number_format($prog->price_start, 0, ',', '.') }}</div>
                        </div>
                        <a href="{{ route('program.show', $prog->slug) }}" class="btn btn-sm" style="background: rgba(132, 204, 22, 0.12); color: #84cc16; border: 1px solid rgba(132, 204, 22, 0.3); padding: 0.55rem 1.1rem; border-radius: 99px; font-weight: 800; text-decoration: none;">
                            Detail <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Trainer Section -->
<section class="section" style="background: #090d0b; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Tim Instruktur</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Personal Trainer Berpengalaman & Bersertifikasi</h2>
            <p style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Siap mendampingi dan memastikan teknik serta hasil latihan Anda maksimal.</p>
        </div>

        <div class="grid-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
            @if(isset($coaches) && count($coaches) > 0)
                @foreach($coaches as $coach)
                <div class="glass-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; overflow: hidden; text-align: center;">
                    <div style="height: 240px; overflow: hidden; background: #161f19;">
                        <img src="{{ Str::startsWith($coach->photo, 'http') ? $coach->photo : asset($coach->photo) }}" alt="{{ $coach->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/coach_hendra.webp') }}';">
                    </div>
                    <div style="padding: 1.25rem;">
                        <h3 style="color: white; font-size: 1.25rem; font-weight: 800; margin-bottom: 0.2rem;">{{ $coach->name }}</h3>
                        <div style="color: #84cc16; font-size: 0.825rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $coach->title }} • {{ $coach->specialty }}</div>
                        <p style="color: #94a3b8; font-size: 0.8rem; line-height: 1.5; margin: 0;">{{ $coach->description }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Testimoni Transformation -->
<section class="section" style="background: #060907; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Kisah Sukses</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Transformasi Member FitLife</h2>
        </div>

        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @foreach($testimonials as $testi)
            <div class="glass-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; padding: 1.75rem; display: flex; flex-direction: column;">
                <div style="display: flex; gap: 0.3rem; color: #f97316; margin-bottom: 1rem;">
                    @for($i=0; $i<$testi->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; italic">"{{ $testi->review }}"</p>
                <div style="display: flex; align-items: center; gap: 0.85rem; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem;">
                    <div style="width: 44px; height: 44px; border-radius: 50%; overflow: hidden; background: #84cc16; flex-shrink: 0;">
                        <img src="{{ Str::startsWith($testi->avatar, 'http') ? $testi->avatar : asset($testi->avatar) }}" alt="{{ $testi->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/coach_hendra.webp') }}';">
                    </div>
                    <div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">{{ $testi->name }}</div>
                        <div style="color: #84cc16; font-size: 0.8rem; font-weight: 700;">{{ $testi->role }} • {{ $testi->program }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Final CTA Banner -->
<section class="section" style="background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%); color: #090d0b; padding: 4.5rem 0; text-align: center;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 2.75rem; font-weight: 900; margin-bottom: 1rem; color: #090d0b; font-family: 'Outfit', sans-serif;">Siap Memulai Perjalanan Fitness Anda?</h2>
            <p style="font-size: 1.15rem; margin-bottom: 2rem; color: #1a2e05; font-weight: 700;">Klaim Trial Gratis 7 Hari & konsultasi bersama Personal Trainer hari ini tanpa komitmen!</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <button onclick="openRegistrationModal()" class="btn btn-lg" style="background: #090d0b; color: #ffffff; border: none; padding: 1rem 2.2rem; font-weight: 900; border-radius: 99px; font-size: 1rem; cursor: pointer;">
                    Daftar Sekarang <i class="fa-solid fa-arrow-right" style="margin-left: 0.4rem;"></i>
                </button>
                <button onclick="openTrialModal()" class="btn btn-lg" style="background: rgba(255, 255, 255, 0.9); color: #090d0b; border: none; padding: 1rem 2.2rem; font-weight: 800; border-radius: 99px; font-size: 1rem; cursor: pointer;">
                    Klaim Trial Gratis 7 Hari
                </button>
            </div>
        </div>
    </div>
</section>
@endsection
