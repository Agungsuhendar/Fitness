@extends('layouts.app')

@section('title', $area['title'])
@section('meta_description', $area['meta_description'])

@section('content')
<!-- Hero Area Landing Banner -->
<section class="hero-section" style="padding: 4rem 0 3.5rem; background: #070a12; color: white;">
    <div class="container">
        <div style="max-width: 860px; margin: 0 auto; text-align: center;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.35rem; background: rgba(16, 185, 129, 0.15); color: #10b981; border-radius: 99px; font-weight: 800; font-size: 0.875rem; margin-bottom: 1.5rem; border: 1px solid rgba(16, 185, 129, 0.3);">
                <i class="fa-solid {{ $area['icon'] }}"></i> Gym & Personal Trainer Privat Area {{ $area['area_name'] }}
            </div>
            
            <h1 class="hero-title" style="font-size: 2.85rem; margin-bottom: 1.25rem; line-height: 1.2; font-family: 'Outfit', sans-serif;">
                Gym & Personal Trainer <span style="color: #10b981;">Wilayah {{ $area['area_name'] }}</span>
            </h1>
            
            <p class="hero-description" style="font-size: 1.15rem; color: #94a3b8; margin-bottom: 2.25rem; line-height: 1.75;">
                {{ $area['description'] }} Dilatih oleh Personal Trainer berlisensi APKI / IFBB dengan bimbingan 1-on-1 privat & garansi hasil terukur!
            </p>

            <div style="display: flex; gap: 1.15rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.5rem;">
                <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.9rem 2rem; font-weight: 800; border-radius: 99px;">
                    <i class="fa-solid fa-paper-plane"></i> Daftar PT {{ $area['area_name'] }}
                </button>
                <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin%20ApexFitness,%20saya%20tanya%20jadwal%20PT%20area%20{{ urlencode($area['area_name']) }}." target="_blank" class="btn btn-whatsapp btn-lg" style="background: #25d366; color: white; padding: 0.9rem 2rem; font-weight: 800; border-radius: 99px; text-decoration: none;">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                </a>
            </div>

            <!-- Subdistricts Tags Cloud -->
            <div style="display: flex; gap: 0.6rem; justify-content: center; flex-wrap: wrap;">
                <span style="font-weight: 800; font-size: 0.85rem; color: #cbd5e1; align-self: center;">Cakupan Area:</span>
                @foreach($area['subdistricts'] as $sub)
                    <span style="background: #1e293b; border: 1px solid #334155; padding: 0.3rem 0.85rem; border-radius: 99px; font-weight: 700; font-size: 0.825rem; color: #10b981;">
                        📍 {{ $sub }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Nearby Recommended Gym Studios -->
<section class="section" style="background: #0f172a; padding: 4rem 0; color: white;">
    <div class="container">
        <div class="glass-card" style="padding: 2.5rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <div style="width: 52px; height: 52px; background: rgba(16, 185, 129, 0.15); color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fa-solid fa-dumbbell"></i>
                </div>
                <div>
                    <h2 style="color: white; font-size: 1.75rem; margin: 0; font-weight: 800;">Cabang Gym Studio Area {{ $area['area_name'] }}</h2>
                    <p style="color: #94a3b8; margin: 0.25rem 0 0; font-size: 0.95rem;">Fasilitas studio gym modern & nyaman untuk latihan privat Anda.</p>
                </div>
            </div>
            <div style="font-weight: 700; font-size: 1.05rem; background: #0f172a; color: #cbd5e1; padding: 1.15rem 1.5rem; border-radius: 1rem; border: 1px solid #334155; line-height: 1.7;">
                <i class="fa-solid fa-location-dot" style="color: #10b981; margin-right: 0.5rem;"></i> {{ $area['pools'] }}
            </div>
        </div>
    </div>
</section>

<!-- Program Pilihan Area Landing -->
<section class="section" style="background: #070a12; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Program Fitness {{ $area['area_name'] }}</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2.2rem; font-weight: 900; margin-top: 0.5rem;">Program Personal Trainer Sesuai Target</h2>
            <p class="section-description" style="color: #94a3b8; font-size: 1rem; margin-top: 0.5rem;">Tersedia program Weight Loss, Muscle Building, Female Body Shaping, & Persiapan TNI POLRI.</p>
        </div>

        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem;">
            @foreach($programs as $prog)
            @php 
                $slug = is_object($prog) ? $prog->slug : ($prog['slug'] ?? '');
                $title = is_object($prog) ? $prog->title : ($prog['title'] ?? '');
                $image = is_object($prog) ? $prog->image : ($prog['image'] ?? '');
                $badge = is_object($prog) ? $prog->badge : ($prog['badge'] ?? '');
                $audience = is_object($prog) ? $prog->target_audience : ($prog['target_audience'] ?? '');
                $desc = is_object($prog) ? $prog->description : ($prog['description'] ?? '');
                $price = is_object($prog) ? $prog->price_start : ($prog['price_start'] ?? 0);
            @endphp
            <div class="program-card" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; overflow: hidden; display: flex; flex-direction: column;">
                <div class="program-thumb" style="position: relative; height: 190px;">
                    <img src="{{ Str::startsWith($image, 'http') ? $image : asset($image) }}" alt="{{ $title }} {{ $area['area_name'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                    @if($badge)
                        <span class="program-badge" style="position: absolute; top: 12px; right: 12px; background: #10b981; color: white; padding: 0.3rem 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase;">{{ $badge }}</span>
                    @endif
                </div>
                <div class="program-body" style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 class="program-title" style="font-size: 1.2rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem;">{{ $title }}</h3>
                    <div class="program-audience" style="font-size: 0.85rem; color: #10b981; font-weight: 700; margin-bottom: 0.75rem;">
                        <i class="fa-solid fa-users-viewfinder"></i> {{ $audience }}
                    </div>
                    <p class="program-desc" style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">{{ Str::limit($desc, 110) }}</p>
                    <div class="program-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem; margin-top: auto;">
                        <div class="price-tag" style="font-size: 0.8rem; color: #94a3b8;">
                            Mulai dari<br>
                            <span style="font-size: 1.1rem; font-weight: 900; color: #ffffff;">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('program.show', $slug) }}" class="btn btn-primary btn-sm" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 700; color: white; text-decoration: none;">
                            Detail <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Switch Area Links -->
<section class="section" style="background: #0f172a; padding: 4rem 0; color: white;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 2.5rem;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Area Layanan Lainnya</span>
            <h2 class="section-title" style="color: #ffffff; font-size: 2rem; font-weight: 900; margin-top: 0.5rem;">Cari Fitness & Gym Terdekat di Area Anda</h2>
        </div>

        <div style="display: flex; gap: 0.85rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('area.fitness', 'sleman') }}" class="btn" style="background: {{ $slugKey === 'sleman' ? '#10b981' : '#1e293b' }}; color: white; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                📍 Sleman & Seturan
            </a>
            <a href="{{ route('area.fitness', 'bantul') }}" class="btn" style="background: {{ $slugKey === 'bantul' ? '#10b981' : '#1e293b' }}; color: white; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                📍 Bantul & Sewon
            </a>
            <a href="{{ route('area.fitness', 'ugm') }}" class="btn" style="background: {{ $slugKey === 'ugm' ? '#10b981' : '#1e293b' }}; color: white; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                📍 UGM & UNY
            </a>
            <a href="{{ route('area.fitness', 'kota-jogja') }}" class="btn" style="background: {{ $slugKey === 'kota-jogja' ? '#10b981' : '#1e293b' }}; color: white; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                📍 Kota Yogyakarta
            </a>
            <a href="{{ route('area.fitness', 'kulon-progo') }}" class="btn" style="background: {{ $slugKey === 'kulon-progo' ? '#10b981' : '#1e293b' }}; color: white; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                📍 Kulon Progo & Wates
            </a>
        </div>
    </div>
</section>
@endsection
