@extends('layouts.app')

@section('title', $program->title . ' - Les Renang Jogja')
@section('meta_description', $program->subtitle)

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto; text-align: center;">
            <a href="{{ route('program.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; font-size: 0.9rem;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Program
            </a>
            <h1 class="hero-title" style="margin-top: 0.75rem;">{{ $program->title }}</h1>
            <p class="hero-description" style="font-size: 1.25rem; color: var(--primary-dark); font-weight: 600;">
                {{ $program->subtitle }}
            </p>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-3" style="grid-template-columns: 2fr 1fr; gap: 3rem;">
            <!-- Left Main Details -->
            <div>
                <div class="glass-card" style="padding: 2rem; background: #ffffff; margin-bottom: 2rem;">
                    <h2 style="font-size: 1.6rem; margin-bottom: 1rem;">Deskripsi Program</h2>
                    <p style="color: var(--text-muted); line-height: 1.8; font-size: 1.05rem; margin-bottom: 1.5rem;">
                        {{ $program->description }}
                    </p>

                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--dark);">Keunggulan & Fasilitas Utama</h3>
                    <div style="margin-bottom: 2rem;">
                        @if($program->features)
                            @foreach($program->features as $feat)
                                <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; margin-bottom: 0.75rem; color: var(--dark-surface);">
                                    <i class="fa-solid fa-circle-check" style="color: var(--emerald); font-size: 1.2rem;"></i>
                                    <span>{{ $feat }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if($program->curriculum)
                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--dark);">Kurikulum Latihan Pertemuan</h3>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem;">
                        @foreach($program->curriculum as $index => $curr)
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; align-items: flex-start;">
                                <div style="width: 32px; height: 32px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; flex-shrink: 0;">
                                    {{ $index + 1 }}
                                </div>
                                <div style="font-size: 0.975rem; font-weight: 600; color: var(--dark); padding-top: 0.25rem;">
                                    {{ $curr }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Sidebar CTA -->
            <div>
                <div class="glass-card" style="padding: 2rem; background: #ffffff; position: sticky; top: 100px;">
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Investasi Privat</span>
                        <div style="font-size: 2.2rem; font-weight: 800; color: var(--primary-dark); margin: 0.25rem 0;">
                            Rp {{ number_format($program->price_start, 0, ',', '.') }}
                        </div>
                        <span style="font-size: 0.85rem; color: var(--emerald); font-weight: 700;">*Paket Reguler 8 Pertemuan</span>
                    </div>

                    <button onclick="openRegistrationModal('{{ $program->title }}')" class="btn btn-primary btn-lg" style="width: 100%; margin-bottom: 1rem;">
                        <i class="fa-solid fa-paper-plane"></i> Daftar Program Ini
                    </button>

                    <button onclick="openTrialModal('{{ $program->title }}')" class="btn btn-accent" style="width: 100%; margin-bottom: 1rem;">
                        <i class="fa-solid fa-bolt"></i> Booking Trial Gratis
                    </button>

                    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tanya%20detail%20{{ urlencode($program->title) }}" target="_blank" class="btn btn-whatsapp" style="width: 100%;">
                        <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
