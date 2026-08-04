@extends('layouts.app')

@section('title', $area['title'])
@section('meta_description', $area['meta_description'])

@section('content')
<!-- Hero Area Landing Banner -->
<section class="hero-section" style="padding: 4rem 0 3.5rem;">
    <div class="container">
        <div style="max-width: 860px; margin: 0 auto; text-align: center;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.35rem; background: rgba(0, 119, 182, 0.12); color: var(--primary); border-radius: 99px; font-weight: 800; font-size: 0.875rem; margin-bottom: 1.5rem; border: 1px solid rgba(0, 119, 182, 0.25);">
                <i class="fa-solid {{ $area['icon'] }}"></i> Layanan Les Renang Privat Area {{ $area['area_name'] }}
            </div>
            
            <h1 class="hero-title" style="font-size: 2.85rem; margin-bottom: 1.25rem; line-height: 1.2;">
                Les Renang Privat <span class="text-gradient">Wilayah {{ $area['area_name'] }}</span>
            </h1>
            
            <p class="hero-description" style="font-size: 1.15rem; color: var(--text-muted); margin-bottom: 2.25rem; line-height: 1.75;">
                {{ $area['description'] }} Dilatih oleh pelatih renang berlisensi resmi dengan bimbingan 1-on-1 privat bergaransi 100% cepat bisa!
            </p>

            <div style="display: flex; gap: 1.15rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.5rem;">
                <button onclick="openRegistrationModal()" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-paper-plane"></i> Daftar Les Renang {{ $area['area_name'] }}
                </button>
                <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin,%20saya%20tanya%20jadwal%20les%20renang%20area%20{{ urlencode($area['area_name']) }}." target="_blank" class="btn btn-whatsapp btn-lg">
                    <i class="fa-brands fa-whatsapp"></i> Chat Admin WhatsApp
                </a>
            </div>

            <!-- Subdistricts Tags Cloud -->
            <div style="display: flex; gap: 0.6rem; justify-content: center; flex-wrap: wrap;">
                <span style="font-weight: 800; font-size: 0.85rem; color: var(--dark); align-self: center;">Cakupan Area:</span>
                @foreach($area['subdistricts'] as $sub)
                    <span style="background: #ffffff; border: 1px solid #cbd5e1; padding: 0.3rem 0.85rem; border-radius: 99px; font-weight: 700; font-size: 0.825rem; color: var(--primary);">
                        📍 {{ $sub }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Nearby Recommended Pools -->
<section class="section" style="background: #ffffff;">
    <div class="container">
        <div class="glass-card" style="padding: 2.5rem; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; border-radius: 2rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <div style="width: 52px; height: 52px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fa-solid fa-water-ladder"></i>
                </div>
                <div>
                    <h2 style="color: white; font-size: 1.75rem; margin: 0;">Rekomendasi Kolam Renang Area {{ $area['area_name'] }}</h2>
                    <p style="color: #e0f2fe; margin: 0.25rem 0 0; font-size: 0.95rem;">Kolam pilihan yang bersih, aman, dan nyaman untuk latihan privat renang Anda.</p>
                </div>
            </div>
            <div style="font-weight: 700; font-size: 1.05rem; background: rgba(255,255,255,0.15); padding: 1.15rem 1.5rem; border-radius: 1.15rem; border: 1px solid rgba(255,255,255,0.3); line-height: 1.7;">
                <i class="fa-solid fa-location-dot" style="color: var(--accent); margin-right: 0.5rem;"></i> {{ $area['pools'] }}
            </div>
        </div>
    </div>
</section>

<!-- Program Pilihan Area Landing -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Program Les Renang {{ $area['area_name'] }}</span>
            <h2 class="section-title">Pilih Program Privat Renang Sesuai Kebutuhan Anda</h2>
            <p class="section-description">Tersedia program untuk anak-anak, dewasa pemula, privat wanita/muslimah, dan persiapan TNI POLRI.</p>
        </div>

        <div class="grid-3">
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
            <div class="program-card">
                <div class="program-thumb">
                    <img src="{{ Str::startsWith($image, 'http') ? $image : asset($image) }}" alt="{{ $title }} {{ $area['area_name'] }}" onerror="this.onerror=null; this.src='{{ asset('images/logo.webp') }}';">
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
                    <div class="program-footer">
                        <div class="price-tag">
                            Mulai dari<br>
                            <span>Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('program.show', $slug) }}" class="btn btn-primary btn-sm">
                            Detail Program <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Switch Area Quick Links -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Area Layanan Lainnya</span>
            <h2 class="section-title">Temukan Les Renang Terdekat di Area Anda</h2>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('area.landing', 'sleman') }}" class="btn {{ $slugKey === 'sleman' ? 'btn-primary' : 'btn-outline' }}">
                📍 Sleman & Depok
            </a>
            <a href="{{ route('area.landing', 'bantul') }}" class="btn {{ $slugKey === 'bantul' ? 'btn-primary' : 'btn-outline' }}">
                📍 Bantul & Sewon
            </a>
            <a href="{{ route('area.landing', 'ugm') }}" class="btn {{ $slugKey === 'ugm' ? 'btn-primary' : 'btn-outline' }}">
                📍 UGM & UNY
            </a>
            <a href="{{ route('area.landing', 'kota-jogja') }}" class="btn {{ $slugKey === 'kota-jogja' ? 'btn-primary' : 'btn-outline' }}">
                📍 Kota Yogyakarta
            </a>
            <a href="{{ route('area.landing', 'kulon-progo') }}" class="btn {{ $slugKey === 'kulon-progo' ? 'btn-primary' : 'btn-outline' }}">
                📍 Kulon Progo & Wates
            </a>
        </div>
    </div>
</section>
@endsection
