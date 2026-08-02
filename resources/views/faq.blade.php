@extends('layouts.app')

@section('title', 'FAQ (Pertanyaan Umum) 20+ Items - Les Renang Jogja')
@section('meta_description', 'Pusat informasi lengkap FAQ Les Renang Jogja. Temukan jawaban seputar harga, garansi bisa renang, pelatih wanita, & lokasi kolam renang.')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Pertanyaan Populer</span>
            <h1 class="hero-title">Frequently Asked <span class="text-gradient">Questions (FAQ)</span></h1>
            <p class="hero-description">
                Temukan jawaban lengkap atas 20+ pertanyaan yang paling sering diajukan mengenai sistem belajar, pelatih, kolam, dan pembayaran.
            </p>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <!-- FAQ Realtime Search Input -->
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass" style="margin-left: 1rem; color: var(--text-muted); align-self: center;"></i>
            <input type="text" id="faqSearchInputPage" class="search-input" placeholder="Ketik kata kunci pertanyaan Anda (misal: garansi, wanita, harga)...">
        </div>

        <!-- Category Pills -->
        <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.5rem;">
            <a href="{{ route('faq') }}" class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline' }}">
                Semua Category (20+)
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('faq', ['category' => $cat]) }}" class="btn btn-sm {{ request('category') == $cat ? 'btn-primary' : 'btn-outline' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <div style="max-width: 880px; margin: 0 auto;" id="faqPageContainer">
            @foreach($faqs as $faq)
            <div class="faq-item" data-question="{{ strtolower($faq->question) }} {{ strtolower($faq->answer) }}">
                <div class="faq-header">
                    <span>
                        <span style="background: rgba(2, 132, 199, 0.1); color: var(--primary); font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.5rem; border-radius: 0.3rem; margin-right: 0.5rem;">
                            {{ $faq->category }}
                        </span>
                        {{ $faq->question }}
                    </span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-body">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <p style="color: var(--text-muted); margin-bottom: 1rem;">Pertanyaan Anda belum terjawab di sini?</p>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tanya%20pertanyaan%20seputar%20les%20renang." target="_blank" class="btn btn-whatsapp btn-lg">
                <i class="fa-brands fa-whatsapp"></i> Tanya Langsung via WhatsApp Admin
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.getElementById('faqSearchInputPage')?.addEventListener('keyup', function(e) {
        const query = e.target.value.toLowerCase();
        const items = document.querySelectorAll('#faqPageContainer .faq-item');
        items.forEach(item => {
            const text = item.getAttribute('data-question');
            if (text.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
