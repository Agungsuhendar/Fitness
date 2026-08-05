@extends('layouts.app')

@section('title', 'FAQ Pertanyaan Umum ApexFitness Center')
@section('meta_description', 'Jawaban lengkap 20+ pertanyaan seputar Personal Trainer, paket fitness, InBody scan 3D, trainer wanita, & cabang gym ApexFitness Jogja.')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: #10b981; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Pusat Informasi</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Frequently Asked <span style="color: #10b981;">Questions (FAQ)</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Jawaban lengkap atas pertanyaan yang sering diajukan seputar Personal Trainer, garansi hasil, InBody scan, & paket gym.
            </p>
        </div>
    </div>
</section>

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <!-- FAQ Realtime Search Input -->
        <div class="search-box" style="background: #1e293b; border: 1px solid #334155; border-radius: 99px; padding: 0.5rem 1.5rem; max-width: 600px; margin: 0 auto 2.5rem; display: flex; align-items: center;">
            <i class="fa-solid fa-magnifying-glass" style="color: #94a3b8; margin-right: 0.85rem;"></i>
            <input type="text" id="faqSearchInputPage" class="search-input" placeholder="Cari pertanyaan (misal: garansi, trainer wanita, harga)..." style="background: transparent; border: none; color: white; width: 100%; font-size: 0.95rem; outline: none;">
        </div>

        <!-- Category Pills -->
        <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.5rem;">
            <a href="{{ route('faq') }}" class="btn btn-sm" style="background: {{ !request('category') ? '#10b981' : '#1e293b' }}; color: white; border: none; padding: 0.5rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                Semua Kategori ({{ count($faqs) }})
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('faq', ['category' => $cat]) }}" class="btn btn-sm" style="background: {{ request('category') == $cat ? '#10b981' : '#1e293b' }}; color: white; border: none; padding: 0.5rem 1.25rem; border-radius: 99px; font-weight: 700; text-decoration: none;">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <div style="max-width: 880px; margin: 0 auto;" id="faqPageContainer">
            @foreach($faqs as $faq)
            <div class="faq-item" data-question="{{ strtolower($faq->question) }} {{ strtolower($faq->answer) }}" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.85rem; margin-bottom: 0.85rem; overflow: hidden;">
                <div class="faq-header" style="padding: 1.1rem 1.4rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 800; color: #ffffff;">
                    <span>
                        <span style="background: rgba(16, 185, 129, 0.15); color: #10b981; font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 0.3rem; margin-right: 0.5rem;">
                            {{ $faq->category }}
                        </span>
                        {{ $faq->question }}
                    </span>
                    <i class="fa-solid fa-chevron-down faq-icon" style="color: #94a3b8;"></i>
                </div>
                <div class="faq-body" style="padding: 0 1.4rem 1.25rem; color: #cbd5e1; font-size: 0.925rem; line-height: 1.6; display: none;">
                    <p style="margin: 0;">{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <p style="color: #94a3b8; margin-bottom: 1rem;">Pertanyaan Anda belum terjawab di atas?</p>
            <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(site_setting('whatsapp_message', 'Halo Admin ApexFitness, saya mau tanya seputar Sesi PT.')) }}" target="_blank" class="btn btn-whatsapp btn-lg" style="background: #25d366; color: white; font-weight: 800; padding: 0.85rem 2rem; border-radius: 99px; text-decoration: none;">
                <i class="fa-brands fa-whatsapp"></i> Tanya CS via WhatsApp Admin
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
