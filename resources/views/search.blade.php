@extends('layouts.app')

@section('title', 'Hasil Pencarian "' . $q . '" - ApexFitness Center')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Pencarian Situs</span>
            <h1 class="hero-title" style="font-size: 2.75rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Hasil Pencarian: <span style="color: #10b981;">"{{ $q }}"</span></h1>
        </div>
    </div>
</section>

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <!-- Programs Search Results -->
        @if($programs->count() > 0)
        <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: #10b981; font-weight: 800;">Program Fitness Terkait ({{ $programs->count() }})</h2>
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            @foreach($programs as $prog)
            <div class="program-card" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem; padding: 1.5rem;">
                <h3 class="program-title" style="font-size: 1.2rem; color: white; font-weight: 800;">{{ $prog->title }}</h3>
                <p class="program-desc" style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1rem;">{{ Str::limit($prog->description, 100) }}</p>
                <a href="{{ route('program.show', $prog->slug) }}" class="btn btn-outline btn-sm" style="border: 1px solid #10b981; color: #10b981; padding: 0.4rem 0.85rem; border-radius: 0.5rem; text-decoration: none; font-weight: 700;">Lihat Program</a>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Articles Search Results -->
        @if($posts->count() > 0)
        <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: #10b981; font-weight: 800;">Artikel Blog Terkait ({{ $posts->count() }})</h2>
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            @foreach($posts as $post)
            <div class="glass-card" style="padding: 1.5rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem;">
                <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem;"><a href="{{ route('blog.show', $post->slug) }}" style="color: #ffffff; text-decoration: none; font-weight: 800;">{{ $post->title }}</a></h3>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.5;">{{ Str::limit($post->excerpt, 90) }}</p>
            </div>
            @endforeach
        </div>
        @endif

        <!-- FAQ Search Results -->
        @if($faqs->count() > 0)
        <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: #10b981; font-weight: 800;">FAQ Terkait ({{ $faqs->count() }})</h2>
        <div style="max-width: 800px; margin-bottom: 3rem;">
            @foreach($faqs as $faq)
            <div class="faq-item" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.85rem; margin-bottom: 1rem; padding: 1.25rem;">
                <div style="font-weight: 800; color: #ffffff; margin-bottom: 0.5rem;">{{ $faq->question }}</div>
                <div style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.6;">
                    <p style="margin: 0;">{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($programs->count() == 0 && $posts->count() == 0 && $faqs->count() == 0)
        <div style="text-align: center; padding: 3rem 0;">
            <i class="fa-solid fa-face-frown" style="font-size: 4rem; color: #94a3b8; margin-bottom: 1rem;"></i>
            <h3 style="color: white; font-size: 1.5rem;">Tidak ditemukan hasil untuk "{{ $q }}"</h3>
            <p style="color: #94a3b8; margin-bottom: 1.5rem;">Coba kata kunci lain seperti "weight loss", "muscle", "wanita", "harga", "TNI".</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="background: #10b981; border: none; color: white; padding: 0.75rem 1.5rem; border-radius: 99px; text-decoration: none; font-weight: 800;">Kembali ke Beranda</a>
        </div>
        @endif
    </div>
</section>
@endsection
