@extends('layouts.app')

@section('title', 'Blog Tips Fitness, Nutrisi & Fat Loss - ApexFitness Center')
@section('meta_description', 'Kumpulan artikel tips fitness, sains defisit kalori, panduan latihan beban, & persiapan tes fisik TNI POLRI di ApexFitness Jogja.')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Wawasan & Panduan</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Blog & <span style="color: #10b981;">Tips Fitness</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Artikel edukasi sains fitness dari Personal Trainer profesional seputar fat loss, pembentukan otot, manajemen nutrisi, & persiapan tes fisik.
            </p>
        </div>
    </div>
</section>

<!-- Category Filter -->
<section class="section" style="padding: 1.75rem 0; background: #0f172a; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <form action="{{ route('blog.index') }}" method="GET" style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; align-items: center;">
            <a href="{{ route('blog.index') }}" class="btn btn-sm" style="background: {{ !request('category') ? '#10b981' : '#1e293b' }}; color: white; border: none; padding: 0.5rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" class="btn btn-sm" style="background: {{ request('category') == $cat ? '#10b981' : '#1e293b' }}; color: white; border: none; padding: 0.5rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                    {{ $cat }}
                </a>
            @endforeach
        </form>
    </div>
</section>

<section class="section" style="background: #070a12; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @foreach($posts as $post)
            <div class="glass-card" style="overflow: hidden; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; display: flex; flex-direction: column;">
                <div style="height: 190px; overflow: hidden; background: #1e293b;">
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_depok.webp') }}';">
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.8rem; font-weight: 800; color: #10b981; margin-bottom: 0.5rem; text-transform: uppercase;">
                        {{ $post->category }} • {{ $post->reading_time }} Menit Baca
                    </div>
                    <h2 style="font-size: 1.15rem; margin-bottom: 0.75rem; line-height: 1.4; color: #ffffff; font-weight: 800;">
                        <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: #ffffff;">{{ $post->title }}</a>
                    </h2>
                    <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">{{ Str::limit($post->excerpt, 100) }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" style="font-weight: 800; color: #10b981; text-decoration: none; font-size: 0.875rem; margin-top: auto;">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div style="margin-top: 2.5rem; display: flex; justify-content: center;">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
