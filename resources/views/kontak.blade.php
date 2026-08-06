@extends('layouts.app')

@section('title', 'Hubungi FitLife Center & Personal Training Studio')
@section('meta_description', 'Kontak resmi FitLife Center Yogyakarta. Customer service WhatsApp, alamat cabang studio gym, jam operasional 06.00 - 22.00 WIB.')

@section('content')
<section class="hero-section" style="padding: 4rem 0; background: #070a12; color: white;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle" style="color: var(--brand-primary, #84cc16); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Customer Care</span>
            <h1 class="hero-title" style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; font-family: 'Outfit', sans-serif; color: #ffffff;">Hubungi <span style="color: var(--brand-primary, #84cc16);">FitLife Center</span></h1>
            <p class="hero-description" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-top: 1rem;">
                Tim customer service dan Personal Trainer kami siap melayani konsultasi target fitness, cabang studio gym, &amp; pendaftaran 7 hari seminggu.
            </p>
        </div>
    </div>
</section>

<section class="section" style="background: #0f172a; padding: 5rem 0; color: white;">
    <div class="container">
        <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
            <!-- Left Info -->
            <div>
                <div class="glass-card" style="padding: 2.25rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.5rem; color: #ffffff; font-weight: 800; margin-bottom: 1.25rem;">Informasi Layanan</h3>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem; align-items: center;">
                        <div style="width: 46px; height: 46px; background: rgba(37, 211, 102, 0.15); color: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff;">WhatsApp Admin Direct</div>
                            <div style="color: #94a3b8; font-size: 0.9rem;">{{ site_setting('site_phone', '+62 812-3456-7890') }} (Fast Response)</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem; align-items: center;">
                        <div style="width: 46px; height: 46px; background: rgba(132, 204, 22, 0.15); color: var(--brand-primary, #84cc16); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff;">Jam Operasional Gym &amp; Studio</div>
                            <div style="color: #94a3b8; font-size: 0.9rem;">{{ site_setting('office_hours', 'Buka Setiap Hari: 06.00 – 22.00 WIB') }}</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem; align-items: center;">
                        <div style="width: 46px; height: 46px; background: rgba(132, 204, 22, 0.15); color: var(--brand-primary, #84cc16); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: #ffffff;">Headquarter Studio</div>
                            <div style="color: #94a3b8; font-size: 0.9rem;">{{ site_setting('office_address', 'Jl. Kaliurang KM 5.5 No. 88, Sleman, D.I. Yogyakarta') }}</div>
                        </div>
                    </div>
                </div>

                <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(site_setting('whatsapp_message', 'Halo Admin FitLife, saya mau konsultasi.')) }}" target="_blank" class="btn btn-whatsapp btn-lg" style="width: 100%; background: #25d366; color: white; padding: 0.9rem 1.5rem; border-radius: 0.75rem; font-weight: 800; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp CS Admin Now
                </a>
            </div>

            <!-- Right Form -->
            <div>
                <div class="glass-card" style="padding: 2.25rem; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem;">
                    <h3 style="font-size: 1.5rem; color: #ffffff; font-weight: 800; margin-bottom: 1rem;">Form Konsultasi Target Fitness</h3>
                    <form action="{{ route('lead.register') }}" method="POST">
                        @csrf
                        <div class="form-group" style="margin-bottom: 1rem;">
                            <label class="form-label" style="color: #cbd5e1;">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Anda" required style="background: #0f172a; border-color: #334155; color: #ffffff;">
                        </div>
                        <div class="form-group" style="margin-bottom: 1rem;">
                            <label class="form-label" style="color: #cbd5e1;">No. WhatsApp</label>
                            <input type="tel" name="phone" class="form-control" placeholder="081234567890" required style="background: #0f172a; border-color: #334155; color: #ffffff;">
                        </div>
                        <div class="form-group" style="margin-bottom: 1rem;">
                            <label class="form-label" style="color: #cbd5e1;">Program Target Fitness</label>
                            <select name="program_name" class="form-control" style="background: #0f172a; border-color: #334155; color: #ffffff;">
                                <option value="Weight Loss & Body Transformation">Weight Loss &amp; Fat Burn</option>
                                <option value="Muscle Building & Hypertrophy">Muscle Building &amp; Bulking</option>
                                <option value="Female Fitness & Body Shaping">Female Fitness &amp; Shaping</option>
                                <option value="Strength & Persiapan TNI POLRI">Persiapan Fisik TNI / POLRI</option>
                                <option value="Posture Correction & Rehab">Posture Correction &amp; Rehab</option>
                            </select>
                        </div>
                        <input type="hidden" name="age_category" value="Umum">
                        <input type="hidden" name="preferred_location" value="Yogyakarta">
                        <input type="hidden" name="preferred_schedule" value="Fleksibel">
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="color: #cbd5e1;">Pesan / Target Yang Ingin Dicapai</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Tuliskan pertanyaan atau target fitness Anda..." style="background: #0f172a; border-color: #334155; color: #ffffff;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; background: var(--brand-primary, #84cc16); border: none; padding: 0.85rem; font-weight: 800; border-radius: 0.75rem; color: #ffffff !important;">
                            <i class="fa-solid fa-paper-plane" style="color: #ffffff !important;"></i> <span style="color: #ffffff !important;">Kirim Pesan Konsultasi</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
