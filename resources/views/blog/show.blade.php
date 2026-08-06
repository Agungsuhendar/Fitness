@extends('layouts.app')

@section('title', $post->title . ' - ApexFitness Center')
@section('meta_description', $post->excerpt)

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <div style="font-size: 0.875rem; font-weight: 800; color: #10b981; text-transform: uppercase; margin-bottom: 0.5rem;">
                {{ $post->category }} • Oleh {{ $post->author }}
            </div>
            <h1 class="hero-title" style="font-size: 2.5rem; font-weight: 900; font-family: 'Outfit', sans-serif;">{{ $post->title }}</h1>
            <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 0.75rem;">
                Dipublikasikan pada {{ $post->published_at ? $post->published_at->format('d M Y') : date('d M Y') }} • {{ $post->views }}x Dilihat
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Featured Image -->
            <div style="height: 380px; border-radius: 1.5rem; overflow: hidden; margin-bottom: 2rem; border: 1px solid rgba(255,255,255,0.15);">
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
            </div>

            <!-- Share Bar -->
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem; padding: 1rem 1.25rem; background: #1e293b; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.1);">
                <span style="font-weight: 700; font-size: 0.875rem; color: #cbd5e1;">Bagikan Artikel:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-whatsapp btn-sm" style="background: #25d366; color: white; border: none; font-weight: 700; border-radius: 0.5rem; text-decoration: none; padding: 0.4rem 0.85rem;">
                    <i class="fa-brands fa-whatsapp"></i> WA
                </a>
            </div>

            <!-- Article Content -->
            <div class="glass-card" style="padding: 2.5rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; line-height: 1.8; font-size: 1.05rem; color: #e2e8f0;">
                {!! $post->content !!}
            </div>

            <!-- Lead Conversion Box -->
            <div class="glass-card" style="margin-top: 2.5rem; padding: 2.25rem; background: linear-gradient(135deg, #0d1310 0%, #16201a 100%); border: 1.5px solid var(--brand-primary, #84cc16); color: white; text-align: center; border-radius: 1.25rem;">
                <h3 style="color: white; font-size: 1.6rem; font-weight: 900; margin-bottom: 0.5rem;">Ingin Konsultasi Program Fitness &amp; Sesi PT?</h3>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-bottom: 1.5rem;">Klaim 1 Sesi Free Trial Personal Trainer &amp; Assessment InBody 3D gratis hari ini!</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <button onclick="openRegistrationModal()" class="btn btn-accent btn-sm" style="background: var(--brand-primary, #84cc16); color: #ffffff !important; font-weight: 900; border: none; padding: 0.65rem 1.25rem; border-radius: 99px;">
                        <i class="fa-solid fa-paper-plane" style="color: #ffffff !important;"></i> <span style="color: #ffffff !important;">Daftar Now</span>
                    </button>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin%20FitLife,%20saya%20membaca%20artikel%20{{ urlencode($post->title) }}" target="_blank" class="btn btn-whatsapp btn-sm" style="background: #25d366; color: white; font-weight: 800; border-radius: 99px; text-decoration: none; padding: 0.65rem 1.25rem;">
                        <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
