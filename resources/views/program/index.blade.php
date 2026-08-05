@extends('layouts.app')

@section('title', 'Program Fitness & Personal Trainer ApexFitness Center')
@section('meta_description', 'Pilihan program Personal Trainer & kelas fitness ApexFitness Jogja: Weight Loss, Muscle Building, Female Body Shaping, & Persiapan TNI POLRI.')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Program Unggulan</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Program <span style="color: #10b981;">ApexFitness Center</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Temukan program latihan privat & Personal Trainer 1-on-1 yang dirancang khusus sesuai dengan target bentuk tubuh Anda.
            </p>
        </div>
    </div>
</section>

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @foreach($programs as $prog)
            <div class="program-card" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; overflow: hidden; display: flex; flex-direction: column;">
                <div class="program-thumb" style="position: relative; height: 200px;">
                    <img src="{{ Str::startsWith($prog->image, 'http') ? $prog->image : asset($prog->image) }}" alt="{{ $prog->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                    @if($prog->badge)
                        <span class="program-badge" style="position: absolute; top: 12px; right: 12px; background: #10b981; color: white; padding: 0.3rem 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase;">{{ $prog->badge }}</span>
                    @endif
                </div>
                <div class="program-body" style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h2 class="program-title" style="font-size: 1.3rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem;">{{ $prog->title }}</h2>
                    <div class="program-audience" style="font-size: 0.85rem; color: #10b981; font-weight: 700; margin-bottom: 0.85rem;">
                        <i class="fa-solid fa-users"></i> {{ $prog->target_audience }}
                    </div>
                    <p class="program-desc" style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">{{ $prog->description }}</p>

                    <div class="program-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem; margin-top: auto;">
                        <div class="price-tag" style="font-size: 0.8rem; color: #94a3b8;">
                            Mulai dari<br>
                            <span style="font-size: 1.15rem; font-weight: 900; color: #ffffff;">Rp {{ number_format($prog->price_start, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('program.show', $prog->slug) }}" class="btn btn-outline btn-sm" style="border: 1px solid #10b981; color: #10b981; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 700; text-decoration: none;">
                            Lihat Detail <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
