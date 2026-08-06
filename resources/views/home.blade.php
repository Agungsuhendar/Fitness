@extends('layouts.app')

@section('title', 'FitLife - Stronger Body, Better Life | Fitness Center Terpercaya di Yogyakarta')
@section('meta_description', 'Raih versi terbaik dirimu bersama program latihan dan bimbingan profesional dari trainer berpengalaman di FitLife Yogyakarta. Trial Gratis 7 Hari tanpa komitmen!')

@section('content')
<!-- Hero Section with Full-Width Gym Background & Overhead Neon Lights -->
<section class="hero-section" style="background: linear-gradient(90deg, rgba(7, 10, 8, 0.96) 0%, rgba(7, 10, 8, 0.82) 42%, rgba(7, 10, 8, 0.35) 75%, rgba(7, 10, 8, 0.88) 100%), url('{{ asset('images/assets/fitlife_hero_gym_bg.png') }}') center/cover no-repeat; color: #ffffff; padding: 7rem 0 6.5rem; position: relative; overflow: hidden; min-height: 640px;">
    
    <!-- Neon Glow Overlay Effects -->
    <div style="position: absolute; top: 0; right: 20%; width: 450px; height: 450px; background: radial-gradient(circle, rgba(132, 204, 22, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

    <div class="container">
        <div class="hero-grid" style="display: grid; grid-template-columns: 1.15fr 1fr; gap: 2rem; align-items: center;">
            
            <!-- Left Text Column -->
            <div class="hero-text-col" style="z-index: 5; padding-right: 1rem;">
                <!-- Hero Badge -->
                <div class="hero-badge pulse-badge" style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.1); border: 1px solid rgba(132, 204, 22, 0.4); color: #ffffff; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 700; font-size: 0.85rem; margin-bottom: 1.75rem; backdrop-filter: blur(10px);">
                    <i class="fa-solid fa-trophy" style="color: #84cc16; font-size: 0.9rem;"></i>
                    <span>#1 Fitness Center Terpercaya di Yogyakarta</span>
                </div>

                <!-- Hero Title -->
                <h1 class="hero-title" style="font-size: 4.1rem; font-weight: 900; line-height: 1.08; margin-bottom: 1.25rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.03em;">
                    <span style="color: #ffffff;">Stronger Body</span><br>
                    <span style="color: #84cc16; text-shadow: 0 0 30px rgba(132, 204, 22, 0.35);">Better Life</span>
                </h1>

                <!-- Hero Description -->
                <p class="hero-description" style="font-size: 1.15rem; color: #cbd5e1; line-height: 1.7; margin-bottom: 2.25rem; max-width: 520px;">
                    Raih versi terbaik dirimu bersama program latihan dan bimbingan profesional dari trainer berpengalaman.
                </p>

                <!-- 3 Feature Bullets Row -->
                <div style="display: flex; gap: 1.75rem; flex-wrap: wrap; margin-bottom: 2.5rem;">
                    <!-- Feature 1 -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border: 1px solid rgba(132, 204, 22, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; flex-shrink: 0; box-shadow: 0 0 15px rgba(132, 204, 22, 0.2);">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">Program Terstruktur</div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Sesuai tujuanmu</div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border: 1px solid rgba(132, 204, 22, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; flex-shrink: 0; box-shadow: 0 0 15px rgba(132, 204, 22, 0.2);">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">Trainer Profesional</div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Bersertifikasi</div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border: 1px solid rgba(132, 204, 22, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; flex-shrink: 0; box-shadow: 0 0 15px rgba(132, 204, 22, 0.2);">
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
                    <button onclick="openRegistrationModal()" class="btn btn-lg glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.95rem 2.2rem; font-weight: 900; border-radius: 99px; display: flex; align-items: center; gap: 0.6rem; font-size: 1rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.5); cursor: pointer;">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <button onclick="openTrialModal()" class="btn btn-lg" style="background: rgba(255, 255, 255, 0.06); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.22); padding: 0.95rem 2rem; font-weight: 700; border-radius: 99px; display: flex; align-items: center; gap: 0.6rem; font-size: 1rem; backdrop-filter: blur(10px); cursor: pointer;">
                        <i class="fa-solid fa-circle-play" style="color: #cbd5e1; font-size: 1.1rem;"></i>
                        <span>Lihat Video</span>
                    </button>
                </div>
            </div>

            <!-- Right Column - Transparent Cutout Models Standing Seamlessly on Gym Background -->
            <div class="hero-image-col" style="position: relative; z-index: 5;">
                <div style="position: relative; width: 100%; height: 580px; display: flex; justify-content: center; align-items: flex-end;">
                    
                    <!-- Transparent Cutout Models Figure (Enlarged slightly for maximum impact) -->
                    <div style="position: relative; height: 100%; width: 100%; display: flex; justify-content: center; align-items: flex-end;">
                        <img src="{{ asset('images/assets/fitlife_models_cutout.png') }}" alt="FitLife Muscular Couple Cutout" style="height: 100%; max-width: 100%; object-fit: contain; transform: translate(-80px, 80px); filter: drop-shadow(0 25px 40px rgba(0,0,0,0.9));" onerror="this.onerror=null; this.src='{{ asset('images/assets/fitlife_hero_couple.png') }}';">
                    </div>

                    <!-- Right Floating Trial Card (Matches Screenshot Exactly) -->
                    <div class="floating-trial-card pulse-badge" style="position: absolute; right: -0.5rem; bottom: 25%; background: rgba(10, 15, 12, 0.88); backdrop-filter: blur(16px); border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.25rem 1.4rem; text-align: center; color: #ffffff; box-shadow: 0 20px 40px rgba(0,0,0,0.7); min-width: 145px; z-index: 10;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border-radius: 0.85rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.3rem; margin: 0 auto 0.65rem;">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div style="font-weight: 800; font-size: 0.95rem; color: #ffffff; line-height: 1.2;">Trial Gratis</div>
                        <div style="font-weight: 900; font-size: 1.4rem; color: #84cc16; margin: 0.15rem 0;">7 Hari</div>
                        <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">Tanpa komitmen</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Floating Stats Bar (5 Columns Card) -->
        <div class="bottom-stats-bar" style="margin-top: -3.5rem; position: relative; z-index: 15;">
            <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.75rem; padding: 1.35rem 1.75rem; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.8);">
                <div class="bottom-stats-bar-inner" style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr; gap: 1.5rem; align-items: center;">
                    
                    <!-- Column 1: Tour Gym Thumbnail Card -->
                    <div class="stats-tour-col fitlife-card" style="position: relative; border-radius: 1.15rem; overflow: hidden; height: 150px; border: 1px solid rgba(255,255,255,0.15); cursor: pointer;" onclick="openTrialModal()">
                        <img src="{{ asset('images/assets/fitlife_gym_tour.png') }}" alt="FitLife Tour Gym" class="fitlife-card-img" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_uny.webp') }}';">
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 100%); flex-direction: column; justify-content: flex-end; padding: 0.75rem;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 42px; height: 42px; background: rgba(255,255,255,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-size: 1.05rem; box-shadow: 0 4px 14px rgba(0,0,0,0.5);">
                                <i class="fa-solid fa-play" style="margin-left: 2px;"></i>
                            </div>
                            <div style="position: absolute; bottom: 0.65rem; left: 0.75rem; right: 0.75rem;">
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
                        <div style="font-size: 1.8rem; font-weight: 900; color: #ffffff; line-height: 1; font-family: 'Outfit', sans-serif;">2.500+</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Member Aktif</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Bergabung dan raih tujuan bersama kami</div>
                    </div>

                    <!-- Column 3: Program Latihan -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-solid fa-dumbbell"></i>
                        </div>
                        <div style="font-size: 1.8rem; font-weight: 900; color: #ffffff; line-height: 1; font-family: 'Outfit', sans-serif;">50+</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Program Latihan</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Dari fat loss, muscle building hingga strength</div>
                    </div>

                    <!-- Column 4: Trainer Profesional -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <div style="font-size: 1.8rem; font-weight: 900; color: #ffffff; line-height: 1; font-family: 'Outfit', sans-serif;">15+</div>
                        <div style="font-weight: 800; color: #ffffff; font-size: 0.85rem; margin-top: 0.25rem;">Trainer Profesional</div>
                        <div style="color: #94a3b8; font-size: 0.75rem; line-height: 1.3;">Berpengalaman & bersertifikasi</div>
                    </div>

                    <!-- Column 5: Lokasi Strategis -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start;">
                        <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.12); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.15rem; margin-bottom: 0.6rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div style="font-size: 1.8rem; font-weight: 900; color: #ffffff; line-height: 1; font-family: 'Outfit', sans-serif;">1 Lokasi</div>
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
            <div class="program-card fitlife-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.35rem; overflow: hidden; display: flex; flex-direction: column;">
                <div class="program-thumb" style="position: relative; height: 210px; background: #161f19; overflow: hidden;">
                    <img src="{{ Str::startsWith($prog->image, 'http') ? $prog->image : asset($prog->image) }}" alt="{{ $prog->title }}" class="fitlife-card-img" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/fitlife_gym_tour.png') }}';">
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
                        <a href="{{ route('program.show', $prog->slug) }}" class="btn btn-sm glow-btn" style="background: rgba(132, 204, 22, 0.12); color: #84cc16; border: 1px solid rgba(132, 204, 22, 0.3); padding: 0.55rem 1.1rem; border-radius: 99px; font-weight: 800; text-decoration: none;">
                            Detail <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Membership Pricing Section -->
<section class="section" style="background: #090d0b; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Paket Keanggotaan</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Pilih Paket FitLife Gym & PT</h2>
            <p style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Transparan tanpa biaya tersembunyi. Sudah termasuk fasilitas loker & InBody Scan.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem;">
            <!-- Plan 1 -->
            <div class="fitlife-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.5rem; padding: 2rem; display: flex; flex-direction: column;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Paket Bulanan</span>
                <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">1 Bulan Gym Pass</h3>
                <div style="font-size: 2.2rem; font-weight: 900; color: #84cc16; margin: 1rem 0;">Rp 350.000 <span style="font-size: 0.85rem; color: #94a3b8; font-weight: 600;">/ bln</span></div>
                <ul style="list-style: none; padding: 0; margin: 0 0 2rem; color: #cbd5e1; font-size: 0.9rem; line-height: 2;">
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Akses Unlimited Semua Cabang</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Free Locker & Shower Hot Water</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> 1x InBody 3D Scan Assessment</li>
                </ul>
                <button onclick="openRegistrationModal('1 Bulan Gym Pass')" class="btn glow-btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.85rem; border-radius: 99px; font-weight: 800; cursor: pointer; margin-top: auto;">Daftar Paket Ini</button>
            </div>

            <!-- Plan 2 (Popular) -->
            <div class="fitlife-card pulse-badge" style="background: #0d1310; border: 2px solid #84cc16; border-radius: 1.5rem; padding: 2rem; display: flex; flex-direction: column; position: relative;">
                <span style="position: absolute; top: -14px; right: 20px; background: #84cc16; color: #090d0b; padding: 0.3rem 0.9rem; border-radius: 99px; font-weight: 900; font-size: 0.75rem; text-transform: uppercase;">Paling Populer</span>
                <span style="font-size: 0.8rem; font-weight: 800; color: #84cc16; text-transform: uppercase; letter-spacing: 1px;">Paket Bundling PT</span>
                <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">12 Sesi Personal Trainer</h3>
                <div style="font-size: 2.2rem; font-weight: 900; color: #84cc16; margin: 1rem 0;">Rp 1.800.000 <span style="font-size: 0.85rem; color: #94a3b8; font-weight: 600;">/ paket</span></div>
                <ul style="list-style: none; padding: 0; margin: 0 0 2rem; color: #cbd5e1; font-size: 0.9rem; line-height: 2;">
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> 12 Sesi Privat 1-on-1 Trainer</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Free Membership Gym 2 Bulan</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Custom Meal Plan & Defisit Kalori</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Unlimited InBody 3D Scan</li>
                </ul>
                <button onclick="openRegistrationModal('12 Sesi Personal Trainer')" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.85rem; border-radius: 99px; font-weight: 900; cursor: pointer; margin-top: auto;">Daftar PT Sekarang</button>
            </div>

            <!-- Plan 3 -->
            <div class="fitlife-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.5rem; padding: 2rem; display: flex; flex-direction: column;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Paket Tahunan VIP</span>
                <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; margin: 0.3rem 0;">1 Year VIP All Access</h3>
                <div style="font-size: 2.2rem; font-weight: 900; color: #84cc16; margin: 1rem 0;">Rp 2.900.000 <span style="font-size: 0.85rem; color: #94a3b8; font-weight: 600;">/ thn</span></div>
                <ul style="list-style: none; padding: 0; margin: 0 0 2rem; color: #cbd5e1; font-size: 0.9rem; line-height: 2;">
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Hemat 35% Dibanding Bulanan</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Free Bring A Friend Pass 5x/bln</li>
                    <li><i class="fa-solid fa-check" style="color: #84cc16; margin-right: 0.5rem;"></i> Free Merchandise FitLife Shaker</li>
                </ul>
                <button onclick="openRegistrationModal('1 Year VIP All Access')" class="btn glow-btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.85rem; border-radius: 99px; font-weight: 800; cursor: pointer; margin-top: auto;">Daftar VIP Tahunan</button>
            </div>
        </div>
    </div>
</section>

<!-- Trainer Section -->
<section class="section" style="background: #060907; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Tim Instruktur</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Personal Trainer Berpengalaman & Bersertifikasi</h2>
            <p style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Siap mendampingi dan memastikan teknik serta hasil latihan Anda maksimal.</p>
        </div>

        <div class="grid-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
            @if(isset($coaches) && count($coaches) > 0)
                @foreach($coaches as $coach)
                <div class="glass-card fitlife-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; overflow: hidden; text-align: center;">
                    <div style="height: 250px; overflow: hidden; background: #161f19;">
                        <img src="{{ Str::startsWith($coach->photo, 'http') ? $coach->photo : asset($coach->photo) }}" alt="{{ $coach->name }}" class="fitlife-card-img" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/coach_hendra.webp') }}';">
                    </div>
                    <div style="padding: 1.35rem;">
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
<section class="section" style="background: #090d0b; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Kisah Sukses</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Transformasi Member FitLife</h2>
        </div>

        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @foreach($testimonials as $testi)
            <div class="glass-card fitlife-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; padding: 1.75rem; display: flex; flex-direction: column;">
                <div style="display: flex; gap: 0.3rem; color: #f97316; margin-bottom: 1rem;">
                    @for($i=0; $i<$testi->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">"{{ $testi->review }}"</p>
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

<!-- Interactive Realtime FAQ Section -->
<section class="section" style="background: #060907; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span style="color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.85rem;">Pertanyaan Umum</span>
            <h2 style="color: #ffffff; font-size: 2.3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Frequently Asked Questions (FAQ)</h2>
        </div>

        <div style="max-width: 850px; margin: 0 auto;" id="faqHomeContainer">
            @php $faqItems = isset($faqs) ? $faqs : (isset($popularFaqs) ? $popularFaqs : collect()); @endphp
            @foreach($faqItems->take(6) as $faq)
            <div class="faq-item fitlife-card" style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; margin-bottom: 1rem; overflow: hidden;">
                <div class="faq-header" style="padding: 1.25rem 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 800; color: #ffffff;" onclick="toggleHomeFaq(this)">
                    <span>
                        <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 0.3rem; margin-right: 0.5rem;">{{ $faq->category }}</span>
                        {{ $faq->question }}
                    </span>
                    <i class="fa-solid fa-chevron-down" style="color: #84cc16; transition: transform 0.3s;"></i>
                </div>
                <div class="faq-body-content" style="padding: 0 1.5rem 1.25rem; color: #cbd5e1; font-size: 0.925rem; line-height: 1.6; display: none;">
                    <p style="margin: 0;">{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Final High Impact CTA Banner -->
<section class="section" style="background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%); color: #090d0b; padding: 5rem 0; text-align: center;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 2.85rem; font-weight: 900; margin-bottom: 1rem; color: #090d0b; font-family: 'Outfit', sans-serif;">Siap Memulai Perjalanan Fitness Anda?</h2>
            <p style="font-size: 1.15rem; margin-bottom: 2.25rem; color: #1a2e05; font-weight: 700;">Klaim Trial Gratis 7 Hari & konsultasi bersama Personal Trainer hari ini tanpa komitmen!</p>
            <div style="display: flex; gap: 1.25rem; justify-content: center; flex-wrap: wrap;">
                <button onclick="openRegistrationModal()" class="btn btn-lg glow-btn" style="background: #090d0b; color: #ffffff; border: none; padding: 1rem 2.5rem; font-weight: 900; border-radius: 99px; font-size: 1rem; cursor: pointer; box-shadow: 0 10px 30px rgba(0,0,0,0.4);">
                    Daftar Sekarang <i class="fa-solid fa-arrow-right" style="margin-left: 0.4rem;"></i>
                </button>
                <button onclick="openTrialModal()" class="btn btn-lg" style="background: rgba(255, 255, 255, 0.95); color: #090d0b; border: none; padding: 1rem 2.5rem; font-weight: 800; border-radius: 99px; font-size: 1rem; cursor: pointer; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    Klaim Trial Gratis 7 Hari
                </button>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function toggleHomeFaq(element) {
        const body = element.nextElementSibling;
        const icon = element.querySelector('.fa-chevron-down');
        if (body.style.display === 'block') {
            body.style.display = 'none';
            if (icon) icon.style.transform = 'rotate(0deg)';
        } else {
            body.style.display = 'block';
            if (icon) icon.style.transform = 'rotate(180deg)';
        }
    }
</script>
@endpush
@endsection
