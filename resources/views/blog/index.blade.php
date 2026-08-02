@extends('layouts.app')

@section('title', 'Blog & Tips Renang Jogja - Tips, Parenting, & Persiapan TNI')
@section('meta_description', 'Kumpulan artikel tips renang, kesehatan hydrotherapy, pola mengajar anak, & rahasia tes fisik TNI POLRI di Les Renang Jogja.')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Wawasan & Panduan</span>
            <h1 class="hero-title">Blog & <span class="text-gradient">Tips Renang</span></h1>
            <p class="hero-description">
                Artikel edukasi dari para instruktur profesional seputar teknik renang, parenting, kesehatan, dan persiapan ujian kesamaptaan.
            </p>
        </div>
    </div>
</section>

<!-- Category Filter & Search Bar -->
<section class="section" style="padding: 2rem 0; background: #ffffff;">
    <div class="container">
        <form action="{{ route('blog.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; align-items: center;">
            <a href="{{ route('blog.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline' }}">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" class="btn btn-sm {{ request('category') == $cat ? 'btn-primary' : 'btn-outline' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </form>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-3">
            @foreach($posts as $post)
            <div class="glass-card" style="overflow: hidden; background: #ffffff;">
                <div style="height: 200px; overflow: hidden; background: #e0f2fe;">
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/assets/pool_uny.webp') }}';">
                </div>
                <div style="padding: 1.5rem;">
                    <div style="font-size: 0.8rem; font-weight: 700; color: var(--primary); margin-bottom: 0.5rem; text-transform: uppercase;">
                        {{ $post->category }} • {{ $post->reading_time }} Menit Baca
                    </div>
                    <h2 style="font-size: 1.2rem; margin-bottom: 0.75rem; line-height: 1.4;">
                        <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: var(--dark);">{{ $post->title }}</a>
                    </h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.25rem;">{{ Str::limit($post->excerpt, 100) }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" style="font-weight: 700; color: var(--primary); text-decoration: none; font-size: 0.9rem;">
                        Baca Artikel Lengkap <i class="fa-solid fa-arrow-right"></i>
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
