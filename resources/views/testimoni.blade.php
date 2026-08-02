@extends('layouts.app')

@section('title', 'Testimoni & Video Galeri Alumni - Les Renang Jogja')
@section('meta_description', 'Kisah nyata, testimoni foto & galeri video perkembangan siswa les renang anak, dewasa, & TNI POLRI di Yogyakarta.')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Bukti Nyata</span>
            <h1 class="hero-title">Galeri Testimoni & <span class="text-gradient">Video Alumni</span></h1>
            <p class="hero-description">
                Simak pengalaman asli para orang tua murid dan peserta les renang yang telah berhasil menguasai gaya renang bersama kami.
            </p>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-2">
            @foreach($testimonials as $testi)
            <div class="testimonial-card">
                <div class="rating-stars">
                    @for($i = 0; $i < $testi->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="font-style: italic; color: var(--dark-surface); font-size: 1.05rem; line-height: 1.7; margin-bottom: 1rem;">
                    "{{ $testi->review }}"
                </p>
                <div class="testimonial-user" style="display: flex; align-items: center; gap: 0.85rem;">
                    <div class="testimonial-avatar" style="width: 52px; height: 52px; border-radius: 50%; overflow: hidden; border: 2px solid var(--primary-light); flex-shrink: 0;">
                        <img src="{{ Str::startsWith($testi->avatar, 'http') ? $testi->avatar : asset($testi->avatar) }}" alt="{{ $testi->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:var(--primary);color:white;display:flex;align-items:center;justify-content:center;font-size:1.2rem;font-weight:800;\'>{{ substr($testi->name, 0, 1) }}</div>';">
                    </div>
                    <div>
                        <div style="font-weight: 800; color: var(--dark);">{{ $testi->name }}</div>
                        <div style="font-size: 0.85rem; color: var(--primary);">{{ $testi->role }} • {{ $testi->program }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <button onclick="openTrialModal()" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-bolt"></i> Rasakan Pengalaman Berenang Sekarang!
            </button>
        </div>
    </div>
</section>
@endsection
