@extends('layouts.app')

@section('title', $program->title . ' - ApexFitness Center')
@section('meta_description', $program->subtitle)

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto; text-align: center;">
            <a href="{{ route('program.index') }}" style="color: #10b981; text-decoration: none; font-weight: 700; font-size: 0.9rem;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Program
            </a>
            <h1 class="hero-title" style="margin-top: 0.75rem; font-size: 2.75rem; font-weight: 900; font-family: 'Outfit', sans-serif;">{{ $program->title }}</h1>
            <p class="hero-description" style="font-size: 1.15rem; color: #10b981; font-weight: 700;">
                {{ $program->subtitle }}
            </p>
        </div>
    </div>
</section>

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="grid-3" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2.5rem;">
            <!-- Left Main Details -->
            <div>
                <div class="glass-card" style="padding: 2.25rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; margin-bottom: 2rem;">
                    <h2 style="font-size: 1.6rem; color: #ffffff; font-weight: 800; margin-bottom: 1rem;">Deskripsi Program</h2>
                    <p style="color: #94a3b8; line-height: 1.8; font-size: 1.05rem; margin-bottom: 1.75rem;">
                        {{ $program->description }}
                    </p>

                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: #ffffff; font-weight: 800;">Keunggulan & Fasilitas Utama</h3>
                    <div style="margin-bottom: 2rem;">
                        @if($program->features)
                            @foreach($program->features as $feat)
                                <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.975rem; margin-bottom: 0.75rem; color: #cbd5e1;">
                                    <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 1.15rem;"></i>
                                    <span>{{ $feat }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if($program->curriculum)
                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: #ffffff; font-weight: 800;">Fase & Kurikulum Latihan</h3>
                    <div style="background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem; padding: 1.5rem;">
                        @foreach($program->curriculum as $index => $curr)
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; align-items: flex-start;">
                                <div style="width: 32px; height: 32px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; flex-shrink: 0;">
                                    {{ $index + 1 }}
                                </div>
                                <div style="font-size: 0.95rem; font-weight: 600; color: #e2e8f0; padding-top: 0.2rem; line-height: 1.5;">
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
                <div class="glass-card" style="padding: 2rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; position: sticky; top: 100px;">
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <span style="font-size: 0.85rem; color: #94a3b8; text-transform: uppercase; font-weight: 700;">Investasi Sesi PT</span>
                        <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.25rem 0;">
                            Rp {{ number_format($program->price_start, 0, ',', '.') }}
                        </div>
                        <span style="font-size: 0.85rem; color: #10b981; font-weight: 700;">*Sudah Termasuk InBody 3D Scan</span>
                    </div>

                    <button onclick="openRegistrationModal('{{ $program->title }}')" class="btn btn-primary btn-lg" style="width: 100%; margin-bottom: 1rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-weight: 800; border-radius: 0.75rem;">
                        <i class="fa-solid fa-paper-plane"></i> Daftar Program Ini
                    </button>

                    <button onclick="openTrialModal('{{ $program->title }}')" class="btn btn-accent" style="width: 100%; margin-bottom: 1rem; background: #334155; border: none; font-weight: 800; border-radius: 0.75rem; color: white;">
                        <i class="fa-solid fa-bolt" style="color: #f97316;"></i> Free Trial PT Sesi 1
                    </button>

                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin%20ApexFitness,%20saya%20tanya%20detail%20{{ urlencode($program->title) }}" target="_blank" class="btn btn-whatsapp" style="width: 100%; background: #25d366; color: white; padding: 0.75rem; border-radius: 0.75rem; font-weight: 800; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-brands fa-whatsapp"></i> Chat Admin WA
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
