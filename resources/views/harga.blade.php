@extends('layouts.app')

@section('title', 'Harga Member & Paket Personal Trainer ApexFitness Center')
@section('meta_description', 'Daftar harga paket Personal Trainer & membership gym ApexFitness Yogyakarta. Transparan, bergaransi hasil, InBody Scan gratis!')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: var(--brand-primary, #84cc16); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Investasi Kesehatan</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif; color: #ffffff;">Daftar Harga <span style="color: var(--brand-primary, #84cc16);">&amp; Paket Gym &amp; PT</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Pilihan investasi paket Personal Trainer & membership gym transparan tanpa biaya tersembunyi. Dapatkan jaminan kualitas & evaluasi fisik terukur.
            </p>
        </div>
    </div>
</section>

<!-- Promo Header -->
<section style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: #ffffff; padding: 1rem 0; text-align: center; font-weight: 800; font-size: 0.95rem;">
    <div class="container">
        {{ site_setting('promo_text', '🔥 PROMO SPESIAL BULAN INI: Diskon Sesi PT 20% + Gratis InBody 3D Scan untuk Pendaftaran Paket Couple / Buddy!') }}
    </div>
</section>

<!-- Pricing Cards Grid -->
<section class="section" style="background: #0f172a; padding: 5rem 0;">
    <div class="container">
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
            @foreach($programs as $prog)
            @php
                $title = is_object($prog) ? $prog->title : ($prog['title'] ?? '');
                $subtitle = is_object($prog) ? $prog->subtitle : ($prog['subtitle'] ?? '');
                $badge = is_object($prog) ? $prog->badge : ($prog['badge'] ?? '');
                $price = is_object($prog) ? $prog->price_start : ($prog['price_start'] ?? 0);
                $features = is_object($prog) ? $prog->features : ($prog['features'] ?? []);
                $isPopular = Str::contains(strtolower($badge), 'populer') || Str::contains(strtolower($badge), 'rekomendasi');
            @endphp
            <div class="glass-card" style="padding: 2.25rem; background: #1e293b; border: {{ $isPopular ? '2px solid #10b981' : '1px solid rgba(255,255,255,0.1)' }}; border-radius: 1.25rem; position: relative; color: white; display: flex; flex-direction: column;">
                @if($badge)
                <div style="position: absolute; top: -14px; right: 2rem; background: var(--brand-primary, #84cc16); color: #ffffff !important; font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 99px; text-transform: uppercase;">
                    {{ $badge }}
                </div>
                @endif
                <span style="background: rgba(16, 185, 129, 0.15); color: #10b981; font-weight: 800; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px; text-transform: uppercase; align-self: flex-start;">
                    {{ $title }}
                </span>
                <h3 style="font-size: 1.35rem; font-weight: 800; margin-top: 1rem; color: #ffffff;">{{ $title }}</h3>
                <p style="color: #94a3b8; font-size: 0.875rem; margin-bottom: 1.5rem; line-height: 1.5;">{{ Str::limit($subtitle, 70) }}</p>
                <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin-bottom: 1.5rem;">
                    Rp {{ number_format($price, 0, ',', '.') }} <span style="font-size: 0.85rem; color: #94a3b8; font-weight: 400;">/ paket sesi</span>
                </div>
                <ul style="list-style: none; padding: 0; margin-bottom: 2rem; color: #cbd5e1; font-size: 0.9rem; line-height: 2; flex-grow: 1;">
                    @if(is_array($features))
                        @foreach($features as $feat)
                            <li style="display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-check" style="color: #10b981;"></i> {{ $feat }}</li>
                        @endforeach
                    @endif
                </ul>
                <button onclick="openRegistrationModal('{{ $title }}')" class="btn" style="width: 100%; background: {{ $isPopular ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : '#334155' }}; color: white; padding: 0.85rem; border-radius: 0.75rem; font-weight: 800; border: none; cursor: pointer;">
                    Ambil Paket {{ $title }}
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- AI Features Tier Comparison Section -->
<section style="background: linear-gradient(180deg, #0f172a 0%, #060907 100%); padding: 4rem 0 5rem; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 750px; margin: 0 auto 3rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(168, 85, 247, 0.15); border: 1.5px solid #a855f7; color: #c084fc; padding: 0.4rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-brain"></i>
                <span>MATRIKS FITUR KECERDASAN BUATAN (AI SMART TOOLS)</span>
            </div>
            <h2 style="font-size: 2.2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif;">
                Rekomendasi Paket Fitur AI Cerdas
            </h2>
            <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6;">
                Tabel transparansi distribusi fitur AI untuk Member Studio &amp; Manajemen Admin Gym berdasarkan tingkatan paket investasi.
            </p>
        </div>

        <div style="background: #0d1310; border: 1.5px solid rgba(168, 85, 247, 0.3); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.6);">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; color: #cbd5e1; font-size: 0.9rem;">
                    <thead>
                        <tr style="background: rgba(168, 85, 247, 0.12); border-bottom: 1.5px solid rgba(168, 85, 247, 0.3);">
                            <th style="padding: 1.25rem 1.5rem; color: #ffffff; font-weight: 800; font-size: 1rem;">Modul Fitur AI</th>
                            <th style="padding: 1.25rem 1.5rem; color: #94a3b8; font-weight: 800; text-align: center;">Paket STARTER</th>
                            <th style="padding: 1.25rem 1.5rem; color: #84cc16; font-weight: 900; text-align: center; background: rgba(132,204,22,0.1);">Paket PRO VIP ⭐</th>
                            <th style="padding: 1.25rem 1.5rem; color: #38bdf8; font-weight: 900; text-align: center;">Paket ENTERPRISE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-robot" style="color: #84cc16; margin-right: 0.5rem;"></i> AI Chatbot Assistant CS (Public 24/7)
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #84cc16; font-size: 1.2rem;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04);"><i class="fa-solid fa-circle-check" style="color: #84cc16; font-size: 1.2rem;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i></td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-wand-magic-sparkles" style="color: #a855f7; margin-right: 0.5rem;"></i> AI Workout &amp; Nutrition Planner (Member)
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; color: #94a3b8;">Basic (1x/bln)</td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04); font-weight: 900; color: #84cc16;"><i class="fa-solid fa-circle-check" style="color: #84cc16; font-size: 1.2rem;"></i> Unlimited</td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; font-weight: 900; color: #38bdf8;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i> Unlimited</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-user-astronaut" style="color: #6366f1; margin-right: 0.5rem;"></i> AI Smart Coach Matchmaker (Member)
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04);"><i class="fa-solid fa-circle-check" style="color: #84cc16; font-size: 1.2rem;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i></td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-camera-retro" style="color: #38bdf8; margin-right: 0.5rem;"></i> AI Vision Calorie &amp; Meal Scanner (Member)
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04); color: #94a3b8;">Add-on Optional</td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i> Full Access</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-pen-nib" style="color: #f59e0b; margin-right: 0.5rem;"></i> Admin AI Marketing Copywriter
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04);"><i class="fa-solid fa-circle-check" style="color: #84cc16; font-size: 1.2rem;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i></td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-chart-pie" style="color: #10b981; margin-right: 0.5rem;"></i> Admin AI Revenue &amp; Traffic Forecasting
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04);"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i> Enterprise Only</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.1rem 1.5rem; font-weight: 700; color: white;">
                                <i class="fa-solid fa-user-slash" style="color: #ef4444; margin-right: 0.5rem;"></i> Admin AI Churn Risk &amp; Retention Predictor
                            </td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center; background: rgba(132,204,22,0.04);"><i class="fa-solid fa-minus" style="color: #64748b;"></i></td>
                            <td style="padding: 1.1rem 1.5rem; text-align: center;"><i class="fa-solid fa-circle-check" style="color: #38bdf8; font-size: 1.2rem;"></i> Enterprise Only</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Price Calculator Section -->
<section class="section" style="background: #070a12; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="glass-card" style="padding: 3rem; background: #0f172a; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h3 style="font-size: 1.8rem; color: #ffffff; font-weight: 800; margin-bottom: 0.5rem;"><i class="fa-solid fa-calculator" style="color: #10b981;"></i> Kalkulator Simulasi Biaya PT</h3>
                <p style="color: #94a3b8; font-size: 0.95rem;">Hitung estimasi investasi Personal Trainer sesuai jumlah peserta & sesi latihan.</p>
            </div>

            <div class="grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label" style="color: #cbd5e1; font-weight: 700;">Program Fitness</label>
                    <select id="calcCategory" class="form-control" style="background: #1e293b; border-color: #334155; color: #ffffff;">
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
                    <label class="form-label" style="color: #cbd5e1; font-weight: 700;">Jumlah Peserta</label>
                    <select id="calcPersons" class="form-control" style="background: #1e293b; border-color: #334155; color: #ffffff;">
                        <option value="1">1 Orang (Privat Single)</option>
                        <option value="2">2 Orang (Buddy Package - Diskon 10%)</option>
                        <option value="3">3 Orang (Group Trio - Diskon 15%)</option>
                    </select>
                </div>
            </div>

            <div style="text-align: center; padding: 1.5rem; background: #1e293b; border-radius: 1rem; border: 1px dashed #10b981; margin-bottom: 1.5rem;">
                <div style="font-size: 0.9rem; color: #94a3b8;">Estimasi Total Investasi Sesi PT:</div>
                <div id="calcResult" style="font-size: 2.25rem; font-weight: 900; color: #10b981; margin: 0.25rem 0;">
                    Rp {{ isset($programs[0]) ? number_format(is_object($programs[0]) ? $programs[0]->price_start : $programs[0]['price_start'], 0, ',', '.') : '450.000' }}
                </div>
                <div style="font-size: 0.85rem; color: #34d399; font-weight: 700;">Sudah termasuk InBody 3D Scan & Custom Meal Plan!</div>
            </div>

            <button onclick="openRegistrationModal()" class="btn btn-accent btn-lg" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-weight: 800; border-radius: 0.75rem;">
                <i class="fa-solid fa-paper-plane"></i> Klaim Promo Simulasi Ini Now
            </button>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function updateCalc() {
        const catSelect = document.getElementById('calcCategory');
        const personsSelect = document.getElementById('calcPersons');
        if (!catSelect || !personsSelect) return;
        const cat = parseInt(catSelect.value) || 0;
        const persons = parseInt(personsSelect.value) || 1;
        let total = cat * persons;
        if (persons === 2) total *= 0.9;
        if (persons === 3) total *= 0.85;

        document.getElementById('calcResult').innerText = 'Rp ' + Math.round(total).toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', updateCalc);
    document.getElementById('calcCategory')?.addEventListener('change', updateCalc);
    document.getElementById('calcPersons')?.addEventListener('change', updateCalc);
</script>
@endpush
@endsection
