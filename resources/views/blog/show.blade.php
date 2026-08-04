@extends('layouts.app')

@section('title', $post->title . ' - Les Renang Jogja')
@section('meta_description', $post->excerpt)

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <div style="font-size: 0.875rem; font-weight: 700; color: var(--primary); text-transform: uppercase; margin-bottom: 0.5rem;">
                {{ $post->category }} • Oleh {{ $post->author }}
            </div>
            <h1 class="hero-title" style="font-size: 2.5rem;">{{ $post->title }}</h1>
            <div style="font-size: 0.875rem; color: var(--text-muted); margin-top: 0.75rem;">
                Dipublikasikan pada {{ $post->published_at ? $post->published_at->format('d M Y') : date('d M Y') }} • {{ $post->views }}x Dilihat
            </div>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Featured Article Image Banner -->
            <div style="height: 380px; border-radius: 1.5rem; overflow: hidden; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(0, 119, 182, 0.15);">
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_uny.webp') }}';">
            </div>

            <!-- Social Share Buttons -->
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem; padding: 1rem; background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0;">
                <span style="font-weight: 700; font-size: 0.9rem; color: var(--dark-surface);">Bagikan Artikel:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-whatsapp btn-sm">
                    <i class="fa-brands fa-whatsapp"></i> WA
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-outline btn-sm">
                    <i class="fa-brands fa-facebook"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-outline btn-sm">
                    <i class="fa-brands fa-x-twitter"></i> X
                </a>
            </div>

            <!-- Article Body -->
            <div class="glass-card" style="padding: 2.5rem; background: #ffffff; line-height: 1.8; font-size: 1.05rem;">
                {!! $post->content !!}
            </div>

            <!-- Lead Conversion Box inside Article -->
            <div class="glass-card" style="margin-top: 2.5rem; padding: 2rem; background: linear-gradient(135deg, #0284c7 0%, #06b6d4 100%); color: white; text-align: center;">
                <h3 style="color: white; font-size: 1.5rem; margin-bottom: 0.5rem;">Tertarik Mencoba Latihan Renang Privat?</h3>
                <p style="color: #e0f2fe; font-size: 0.95rem; margin-bottom: 1.5rem;">Konsultasikan kendala atau booking trial gratis bersama pelatih profesional kami sekarang juga!</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <button onclick="openRegistrationModal()" class="btn btn-accent btn-sm">
                        <i class="fa-solid fa-paper-plane"></i> Daftar Now
                    </button>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin,%20saya%20membaca%20artikel%20{{ urlencode($post->title) }}" target="_blank" class="btn btn-whatsapp btn-sm">
                        <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
