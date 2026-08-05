@extends('layouts.app')

@section('title', 'Transformasi & Review Member ApexFitness Center')
@section('meta_description', 'Kisah nyata, ulasan, & galeri video sebelum-sesudah member ApexFitness Yogyakarta. Penurunan berat badan, pembentukan otot, & persiapan TNI POLRI.')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Hasil Terukur</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Galeri Transformasi & <span style="color: #10b981;">Review Member</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Simak kisah sukses nyata para member yang telah berhasil memangkas lemak, membentuk massa otot, dan meningkatkan stamina puncak bersama Personal Trainer ApexFitness.
            </p>
        </div>
    </div>
</section>

@if(session('success'))
<section style="padding: 0; background: #070a12;">
    <div class="container">
        <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 1rem 1.25rem; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    </div>
</section>
@endif

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
            @forelse($testimonials as $testi)
            <div class="testimonial-card" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.75rem;">
                <div class="rating-stars" style="color: #f97316; margin-bottom: 1rem;">
                    @for($i = 0; $i < $testi->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="font-style: italic; color: #e2e8f0; font-size: 1rem; line-height: 1.7; margin-bottom: 1.25rem;">
                    "{{ $testi->review }}"
                </p>
                <div class="testimonial-user" style="display: flex; align-items: center; gap: 0.85rem;">
                    <div class="testimonial-avatar" style="width: 48px; height: 48px; border-radius: 50%; overflow: hidden; background: #10b981; color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;">
                        {{ strtoupper(substr($testi->name, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 800; color: #ffffff;">{{ $testi->name }}</div>
                        <div style="font-size: 0.85rem; color: #10b981;">{{ $testi->role }} • {{ $testi->program }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: span 2; text-align: center; padding: 3rem; color: #94a3b8;">
                <i class="fa-solid fa-comment-dots" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                <p style="font-size: 1.1rem;">Belum ada testimoni. Kirim ulasan Anda setelah latihan bersama kami!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Video Gallery Before-After -->
<section class="section" style="background: #070a12; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;"><i class="fa-solid fa-clapperboard"></i> Video Transformasi</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Perubahan Fisik Member</h2>
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
                    <div style="font-weight: 900; font-size: 1.1rem; margin-bottom: 0.2rem;">
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
</section>

<!-- Form Kirim Testimoni -->
<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="glass-card" style="padding: 3rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; max-width: 750px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Bagikan Pengalaman Anda</span>
                <h2 style="font-size: 1.85rem; color: #ffffff; font-weight: 900; margin-top: 0.3rem;">
                    <i class="fa-solid fa-pen-fancy" style="color: #10b981;"></i> Kirim Ulasan Member
                </h2>
                <p style="color: #94a3b8; font-size: 0.95rem;">
                    Ceritakan hasil transformasi & pengalaman Anda berlatih di ApexFitness Center.
                </p>
            </div>

            <form action="{{ route('testimoni.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Contoh: Bima Perkasa" style="background: #0f172a; border-color: #334155; color: #ffffff; padding: 0.75rem 1rem; border-radius: 0.75rem;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Pekerjaan / Keterangan <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="role" class="form-control" value="{{ old('role') }}" required placeholder="Contoh: Software Engineer" style="background: #0f172a; border-color: #334155; color: #ffffff; padding: 0.75rem 1rem; border-radius: 0.75rem;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Program Fitness <span style="color: #ef4444;">*</span></label>
                        <select name="program" class="form-control" required style="background: #0f172a; border-color: #334155; color: #ffffff; padding: 0.75rem 1rem; border-radius: 0.75rem;">
                            <option value="Weight Loss & Fat Burn">Weight Loss & Fat Burn</option>
                            <option value="Muscle Building & Hypertrophy">Muscle Building & Hypertrophy</option>
                            <option value="Female Fitness & Body Shaping">Female Fitness & Body Shaping</option>
                            <option value="Strength & Persiapan TNI POLRI">Strength & Persiapan TNI POLRI</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Rating Kepuasan <span style="color: #ef4444;">*</span></label>
                        <select name="rating" class="form-control" required style="background: #0f172a; border-color: #334155; color: #ffffff; padding: 0.75rem 1rem; border-radius: 0.75rem;">
                            <option value="5">⭐⭐⭐⭐⭐ Bintang 5 (Sangat Puas)</option>
                            <option value="4">⭐⭐⭐⭐ Bintang 4 (Bagus)</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Ceritakan Hasil Transformasi Anda <span style="color: #ef4444;">*</span></label>
                    <textarea name="review" class="form-control" required rows="4" placeholder="Turun berapa kg / hasil otot / bimbingan trainer..." style="background: #0f172a; border-color: #334155; color: #ffffff; padding: 0.75rem 1rem; border-radius: 0.75rem;">{{ old('review') }}</textarea>
                </div>

                <button type="submit" class="btn btn-accent btn-lg" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-weight: 800; border-radius: 0.75rem; color: white;">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Review Sekarang
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
