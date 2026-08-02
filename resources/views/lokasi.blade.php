@extends('layouts.app')

@section('title', 'Lokasi Kolam Renang Partner & Area Layanan - Les Renang Jogja')
@section('meta_description', 'Lokasi kolam renang partner les renang privat di Yogyakarta (Sleman, Bantul, UNY, Depok) serta area layanan Semarang, Solo, Magelang, & Klaten.')

@section('content')
<section class="hero-section" style="padding: 3.5rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Jangkauan Luas</span>
            <h1 class="hero-title">Lokasi Kolam & <span class="text-gradient">Area Layanan</span></h1>
            <p class="hero-description">
                Pilih kolam renang partner terdekat di Yogyakarta atau manfaatkan layanan pelatih privat panggilan ke rumah/perumahan Anda.
            </p>
        </div>
    </div>
</section>

<!-- Area Layanan Coverage Bar -->
<section class="section" style="padding: 2.75rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 1.75rem;">
            <h3 style="font-size: 1.35rem;">Cakupan Wilayah Operasional Pelatih</h3>
        </div>
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <span style="padding: 0.65rem 1.35rem; background: #e0f2fe; color: var(--primary-dark); font-weight: 800; border-radius: 99px;">📍 DIY (Yogyakarta, Sleman, Bantul, Kulon Progo)</span>
            <span style="padding: 0.65rem 1.35rem; background: #e0f2fe; color: var(--primary-dark); font-weight: 800; border-radius: 99px;">📍 Semarang</span>
            <span style="padding: 0.65rem 1.35rem; background: #e0f2fe; color: var(--primary-dark); font-weight: 800; border-radius: 99px;">📍 Solo / Surakarta</span>
            <span style="padding: 0.65rem 1.35rem; background: #e0f2fe; color: var(--primary-dark); font-weight: 800; border-radius: 99px;">📍 Magelang</span>
            <span style="padding: 0.65rem 1.35rem; background: #e0f2fe; color: var(--primary-dark); font-weight: 800; border-radius: 99px;">📍 Klaten</span>
        </div>
    </div>
</section>

<!-- Partner Pool Locations Grid & Maps -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Peta & Kolam Partner</span>
            <h2 class="section-title">Kolam Renang Pilihan di Yogyakarta</h2>
            <p class="section-description">Fasilitas kolam bersih, aman, air jernih, & memiliki kedalaman bertingkat.</p>
        </div>

        <div class="grid-2" style="gap: 2.75rem;">
            @foreach($locations as $loc)
            <div class="glass-card" style="padding: 2.25rem; background: #ffffff;">
                <div style="height: 200px; border-radius: 1.15rem; overflow: hidden; margin-bottom: 1.35rem;">
                    <img src="{{ Str::startsWith($loc->image, 'http') ? $loc->image : asset($loc->image) }}" alt="{{ $loc->name }}" style="width:100%; height:100%; object-fit:cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_uny.webp') }}';">
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                    <div>
                        <span style="background: rgba(0, 119, 182, 0.12); color: var(--primary); font-weight: 800; font-size: 0.75rem; padding: 0.3rem 0.85rem; border-radius: 99px; text-transform: uppercase;">
                            {{ $loc->city }}
                        </span>
                        <h3 style="font-size: 1.4rem; margin-top: 0.6rem;">{{ $loc->name }}</h3>
                    </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.35rem; line-height: 1.6;">
                    <i class="fa-solid fa-location-dot" style="color: var(--primary); margin-right: 0.4rem;"></i> {{ $loc->address }}
                </p>

                <div style="margin-bottom: 1.5rem;">
                    @if($loc->features)
                        @foreach($loc->features as $f)
                            <span style="display: inline-block; background: #f1f5f9; color: var(--dark-surface); font-size: 0.825rem; font-weight: 700; padding: 0.35rem 0.7rem; border-radius: 0.5rem; margin-right: 0.45rem; margin-bottom: 0.45rem;">
                                ✓ {{ $f }}
                            </span>
                        @endforeach
                    @endif
                </div>

                @if($loc->map_embed_url)
                <div style="border-radius: 1.15rem; overflow: hidden; height: 210px; margin-bottom: 1.5rem; border: 1px solid #cbd5e1;">
                    <iframe src="{{ $loc->map_embed_url }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                @endif

                <div style="display: flex; gap: 1rem;">
                    <button onclick="openRegistrationModal()" class="btn btn-primary btn-sm" style="flex: 1;">
                        <i class="fa-solid fa-calendar-plus"></i> Pilih Lokasi Ini
                    </button>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tanya%20jadwal%20di%20{{ urlencode($loc->name) }}" target="_blank" class="btn btn-whatsapp btn-sm">
                        <i class="fa-brands fa-whatsapp"></i> Chat WA
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
