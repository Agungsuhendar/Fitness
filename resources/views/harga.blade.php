@extends('layouts.app')

@section('title', 'Harga Paket Les Renang Jogja - Transparan & Hemat')
@section('meta_description', 'Daftar harga paket les renang privat di Yogyakarta. Paket anak, dewasa, privat wanita, & kelas TNI POLRI. Tanpa biaya tersembunyi!')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Investasi Kesehatan</span>
            <h1 class="hero-title">Daftar Harga & <span class="text-gradient">Paket Les Renang</span></h1>
            <p class="hero-description">
                Pilihan paket investasi privat transparan tanpa biaya tersembunyi. Dapatkan jaminan kualitas & bimbingan instruktur profesional.
            </p>
        </div>
    </div>
</section>

<!-- Promo Countdown Header -->
<section style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #0f172a; padding: 1rem 0; text-align: center; font-weight: 800;">
    <div class="container">
        🔥 PROMO SPESIAL BULAN INI: Diskon Rp 50.000 + Gratis Kacamata Renang untuk Pendaftaran Paket Privat 2 Orang!
    </div>
</section>

<!-- Pricing Cards Grid -->
<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-3">
            @foreach($programs as $prog)
            @php
                $title = is_object($prog) ? $prog->title : ($prog['title'] ?? '');
                $subtitle = is_object($prog) ? $prog->subtitle : ($prog['subtitle'] ?? '');
                $badge = is_object($prog) ? $prog->badge : ($prog['badge'] ?? '');
                $price = is_object($prog) ? $prog->price_start : ($prog['price_start'] ?? 0);
                $features = is_object($prog) ? $prog->features : ($prog['features'] ?? []);
                $isPopular = Str::contains(strtolower($badge), 'populer') || Str::contains(strtolower($badge), 'laris');
            @endphp
            <div class="glass-card" style="padding: 2.25rem; background: #ffffff; position: relative; {{ $isPopular ? 'border: 2px solid var(--primary); transform: scale(1.03); box-shadow: var(--shadow-lg);' : '' }}">
                @if($badge)
                <div style="position: absolute; top: -14px; right: 2rem; background: var(--accent); color: #0f172a; font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 99px; text-transform: uppercase;">
                    {{ $badge }}
                </div>
                @endif
                <span style="background: #e0f2fe; color: var(--primary-dark); font-weight: 800; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px; text-transform: uppercase;">
                    {{ $title }}
                </span>
                <h3 style="font-size: 1.4rem; margin-top: 0.85rem;">{{ $title }}</h3>
                <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 1.5rem; line-height: 1.5;">{{ Str::limit($subtitle, 65) }}</p>
                <div style="font-size: 2.2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem;">
                    Rp {{ number_format($price, 0, ',', '.') }} <span style="font-size: 0.875rem; color: var(--text-muted); font-weight: 400;">/ paket</span>
                </div>
                <ul style="list-style: none; margin-bottom: 2rem; color: var(--dark-surface); font-size: 0.925rem; line-height: 2;">
                    @if(is_array($features))
                        @foreach($features as $feat)
                            <li>✓ {{ $feat }}</li>
                        @endforeach
                    @endif
                </ul>
                <button onclick="openRegistrationModal('{{ $title }}')" class="btn {{ $isPopular ? 'btn-accent' : 'btn-primary' }}" style="width: 100%;">
                    Daftar {{ $title }}
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Interactive Price Calculator Section -->
<section class="section">
    <div class="container">
        <div class="glass-card" style="padding: 3rem; background: #ffffff; max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h3 style="font-size: 1.8rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-calculator" style="color: var(--primary);"></i> Kalkulator Simulasi Biaya</h3>
                <p style="color: var(--text-muted);">Hitung estimasi biaya les renang privat sesuai jumlah peserta & sesi latihan.</p>
            </div>

            <div class="grid-2" style="gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Kategori Peserta</label>
                    <select id="calcCategory" class="form-control">
                        @foreach($programs as $p)
                        @php
                            $pTitle = is_object($p) ? $p->title : $p['title'];
                            $pPrice = is_object($p) ? $p->price_start : $p['price_start'];
                        @endphp
                        <option value="{{ $pPrice }}">{{ $pTitle }} (Rp {{ number_format($pPrice, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Jumlah Peserta</label>
                    <select id="calcPersons" class="form-control">
                        <option value="1">1 Peserta (Privat Single)</option>
                        <option value="2">2 Peserta (Semi Privat Kakak/Adik - Diskon 10%)</option>
                        <option value="3">3 Peserta (Grup Keluarga - Diskon 15%)</option>
                    </select>
                </div>
            </div>

            <div style="text-align: center; padding: 1.5rem; background: #f0f9ff; border-radius: 1rem; border: 1px dashed var(--primary); margin-bottom: 1.5rem;">
                <div style="font-size: 0.9rem; color: var(--text-muted);">Estimasi Total Investasi:</div>
                <div id="calcResult" style="font-size: 2.25rem; font-weight: 800; color: var(--primary-dark); margin: 0.25rem 0;">
                    Rp 350.000
                </div>
                <div style="font-size: 0.85rem; color: var(--emerald); font-weight: 700;">Termasuk garansi bimbingan & sertifikat!</div>
            </div>

            <button onclick="openRegistrationModal()" class="btn btn-accent btn-lg" style="width: 100%;">
                <i class="fa-solid fa-paper-plane"></i> Ambil Promo Simulasi Ini Now
            </button>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function updateCalc() {
        const cat = parseInt(document.getElementById('calcCategory').value);
        const persons = parseInt(document.getElementById('calcPersons').value);
        let total = cat * persons;
        if (persons === 2) total *= 0.9;
        if (persons === 3) total *= 0.85;

        document.getElementById('calcResult').innerText = 'Rp ' + Math.round(total).toLocaleString('id-ID');
    }

    document.getElementById('calcCategory')?.addEventListener('change', updateCalc);
    document.getElementById('calcPersons')?.addEventListener('change', updateCalc);
</script>
@endpush
@endsection
