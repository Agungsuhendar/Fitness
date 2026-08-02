@extends('layouts.app')

@section('title', 'Program Les Renang Jogja - Anak, Dewasa, Wanita & TNI POLRI')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Pilihan Terbaik</span>
            <h1 class="hero-title">Program <span class="text-gradient">Les Renang Jogja</span></h1>
            <p class="hero-description">
                Temukan program latihan renang privat yang dirancang khusus sesuai kelompok usia dan target pencapaian Anda.
            </p>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-3">
            @foreach($programs as $prog)
            <div class="program-card">
                <div class="program-thumb">
                    <img src="{{ asset($prog->image) }}" alt="{{ $prog->title }}">
                    @if($prog->badge)
                        <span class="program-badge">{{ $prog->badge }}</span>
                    @endif
                </div>
                <div class="program-body">
                    <h2 class="program-title" style="font-size: 1.35rem;">{{ $prog->title }}</h2>
                    <div class="program-audience">
                        <i class="fa-solid fa-users"></i> {{ $prog->target_audience }}
                    </div>
                    <p class="program-desc">{{ $prog->description }}</p>

                    <div class="program-footer">
                        <div class="price-tag">
                            Mulai dari<br>
                            <span>Rp {{ number_format($prog->price_start, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('program.show', $prog->slug) }}" class="btn btn-outline btn-sm">
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
