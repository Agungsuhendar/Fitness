@extends('layouts.app')

@section('title', 'Hasil Pencarian "' . $q . '" - Les Renang Jogja')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Pencarian Situs</span>
            <h1 class="hero-title">Hasil Pencarian: <span class="text-gradient">"{{ $q }}"</span></h1>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <!-- Programs Search Results -->
        @if($programs->count() > 0)
        <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: var(--primary-dark);">Program Renang Terkait ({{ $programs->count() }})</h2>
        <div class="grid-3" style="margin-bottom: 3rem;">
            @foreach($programs as $prog)
            <div class="program-card">
                <div class="program-body">
                    <h3 class="program-title">{{ $prog->title }}</h3>
                    <p class="program-desc">{{ Str::limit($prog->description, 100) }}</p>
                    <a href="{{ route('program.show', $prog->slug) }}" class="btn btn-outline btn-sm">Lihat Program</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Articles Search Results -->
        @if($posts->count() > 0)
        <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: var(--primary-dark);">Artikel Blog Terkait ({{ $posts->count() }})</h2>
        <div class="grid-3" style="margin-bottom: 3rem;">
            @foreach($posts as $post)
            <div class="glass-card" style="padding: 1.5rem; background: #ffffff;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem;"><a href="{{ route('blog.show', $post->slug) }}" style="color: var(--dark); text-decoration: none;">{{ $post->title }}</a></h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">{{ Str::limit($post->excerpt, 90) }}</p>
            </div>
            @endforeach
        </div>
        @endif

        <!-- FAQ Search Results -->
        @if($faqs->count() > 0)
        <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: var(--primary-dark);">FAQ Terkait ({{ $faqs->count() }})</h2>
        <div style="max-width: 800px;">
            @foreach($faqs as $faq)
            <div class="faq-item" style="margin-bottom: 1rem;">
                <div class="faq-header">
                    <span>{{ $faq->question }}</span>
                </div>
                <div class="faq-body" style="display: block;">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($programs->count() == 0 && $posts->count() == 0 && $faqs->count() == 0)
        <div style="text-align: center; padding: 3rem 0;">
            <i class="fa-solid fa-face-frown" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
            <h3>Tidak ditemukan hasil untuk "{{ $q }}"</h3>
            <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Coba gunakan kata kunci lain seperti "anak", "dewasa", "wanita", "harga", "TNI".</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
        @endif
    </div>
</section>
@endsection
