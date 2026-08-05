@extends('layouts.app')

@section('title', 'Cabang Studio Gym & Area Layanan Personal Trainer - ApexFitness Center')
@section('meta_description', 'Lokasi cabang gym studio & area layanan Personal Trainer ApexFitness di Yogyakarta (Sleman, Seturan, Kota Jogja, Palagan Hyatt). Alat impor & InBody 3D Scan!')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Studio & Cabang Gym</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Cabang Gym & <span style="color: #10b981;">Area Layanan PT</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Pilih cabang studio gym ApexFitness terdekat di Yogyakarta atau manfaatkan layanan Private Home Personal Training ke rumah Anda.
            </p>
        </div>
    </div>
</section>

<!-- Area Coverage -->
<section class="section" style="padding: 2rem 0; background: #0f172a; border-bottom: 1px solid rgba(255,255,255,0.08); color: white;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1.2rem; color: #cbd5e1;">Cakupan Area Layanan Personal Trainer</h3>
        </div>
        <div style="display: flex; justify-content: center; gap: 0.85rem; flex-wrap: wrap;">
            <span style="padding: 0.5rem 1.25rem; background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; border-radius: 99px; font-size: 0.875rem;">📍 Sleman & Seturan</span>
            <span style="padding: 0.5rem 1.25rem; background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; border-radius: 99px; font-size: 0.875rem;">📍 Kota Yogyakarta</span>
            <span style="padding: 0.5rem 1.25rem; background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; border-radius: 99px; font-size: 0.875rem;">📍 Area Kampus UGM & UNY</span>
            <span style="padding: 0.5rem 1.25rem; background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; border-radius: 99px; font-size: 0.875rem;">📍 Bantul & Sewon</span>
            <span style="padding: 0.5rem 1.25rem; background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; border-radius: 99px; font-size: 0.875rem;">📍 Kulon Progo</span>
        </div>
    </div>
</section>

<!-- Gym Branch Cards -->
<section class="section" style="background: #070a12; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Fasilitas & Peta</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Cabang Studio ApexFitness</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Fasilitas alat gym impor kelas dunia, studio privat cewek, locker air hangat, & InBody scan.</p>
        </div>

        <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            @foreach($locations as $loc)
            <div class="glass-card" style="padding: 2rem; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem;">
                <div style="height: 200px; border-radius: 1rem; overflow: hidden; margin-bottom: 1.25rem; background: #1e293b;">
                    <img src="{{ Str::startsWith($loc->image, 'http') ? $loc->image : asset($loc->image) }}" alt="{{ $loc->name }}" style="width:100%; height:100%; object-fit:cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                </div>
                <div style="margin-bottom: 1rem;">
                    <span style="background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; font-size: 0.75rem; padding: 0.3rem 0.85rem; border-radius: 99px; text-transform: uppercase;">
                        {{ $loc->city }}
                    </span>
                    <h3 style="font-size: 1.35rem; color: #ffffff; font-weight: 800; margin-top: 0.5rem;">{{ $loc->name }}</h3>
                </div>
                <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 1.25rem; line-height: 1.6;">
                    <i class="fa-solid fa-location-dot" style="color: #10b981; margin-right: 0.4rem;"></i> {{ $loc->address }}
                </p>

                <div style="margin-bottom: 1.25rem;">
                    @if($loc->features)
                        @foreach($loc->features as $f)
                            <span style="display: inline-block; background: #1e293b; color: #cbd5e1; font-size: 0.8rem; font-weight: 700; padding: 0.35rem 0.7rem; border-radius: 0.5rem; margin-right: 0.45rem; margin-bottom: 0.45rem; border: 1px solid rgba(255,255,255,0.08);">
                                ✓ {{ $f }}
                            </span>
                        @endforeach
                    @endif
                </div>

                @if($loc->map_embed_url)
                <div style="border-radius: 1rem; overflow: hidden; height: 180px; margin-bottom: 1.25rem; border: 1px solid #334155;">
                    <iframe src="{{ $loc->map_embed_url }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                @endif

                <div style="display: flex; gap: 0.75rem;">
                    <button onclick="openRegistrationModal()" class="btn btn-primary btn-sm" style="flex: 1; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-weight: 800; padding: 0.75rem; border-radius: 0.65rem; color: white;">
                        <i class="fa-solid fa-calendar-plus"></i> Pilih Cabang Ini
                    </button>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin%20ApexFitness,%20saya%20tanya%20jadwal%20di%20{{ urlencode($loc->name) }}" target="_blank" class="btn btn-whatsapp btn-sm" style="background: #25d366; color: white; padding: 0.75rem 1rem; border-radius: 0.65rem; font-weight: 800; text-decoration: none;">
                        <i class="fa-brands fa-whatsapp"></i> Chat WA
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
