@php
    if (!function_exists('site_setting')) {
        function site_setting($key, $default = null) {
            return class_exists('\App\Models\Setting') ? \App\Models\Setting::get($key, $default) : $default;
        }
    }
@endphp
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Col 1: Brand Info & SEO Text -->
            <div>
                @php
                    $footerAbout = site_setting('site_footer_about', 'Pusat kebugaran fitness gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta. Menyediakan program Weight Loss & Fat Burning, Muscle Building, Female Body Shaping, serta Persiapan Fisik TNI POLRI & Rehabilitasi Postur.');
                @endphp
                <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 1.25rem;">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 1.25rem; box-shadow: 0 4px 14px rgba(16,185,129,0.35);">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <span style="font-weight: 900; font-size: 1.5rem; color: #ffffff; letter-spacing: -0.02em; font-family: 'Outfit', sans-serif;">APEX<span style="color: #10b981;">FITNESS</span></span>
                </div>
                <p style="font-size: 0.925rem; line-height: 1.7; margin-bottom: 1.5rem; color: #94a3b8;">
                    {{ $footerAbout }}
                </p>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ site_setting('instagram_url', 'https://instagram.com/apexfitness.id') }}" target="_blank" style="width: 38px; height: 38px; background: #1e293b; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ site_setting('tiktok_url', 'https://tiktok.com/@apexfitness.id') }}" target="_blank" style="width: 38px; height: 38px; background: #1e293b; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="{{ site_setting('youtube_url', 'https://youtube.com/@apexfitnessid') }}" target="_blank" style="width: 38px; height: 38px; background: #1e293b; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}" target="_blank" style="width: 38px; height: 38px; background: #25d366; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Col 2: Dynamic Navigation Links -->
            <div>
                <h4 class="footer-title">Program Fitness</h4>
                <ul class="footer-links">
                    @php
                        try {
                            $footerPrograms = \App\Models\Program::orderBy('order')->take(6)->get();
                        } catch (\Exception $e) {
                            $footerPrograms = collect();
                        }
                    @endphp
                    @forelse($footerPrograms as $fp)
                        <li><a href="{{ route('program.show', $fp->slug) }}">{{ $fp->title }}</a></li>
                    @empty
                        <li><a href="{{ route('program.show', 'weight-loss-fat-burn') }}">Weight Loss & Fat Burn</a></li>
                        <li><a href="{{ route('program.show', 'muscle-building-hypertrophy') }}">Muscle Building & Hypertrophy</a></li>
                        <li><a href="{{ route('program.show', 'female-fitness-shaping') }}">Female Fitness & Shaping</a></li>
                        <li><a href="{{ route('program.show', 'calisthenics-strength-conditioning') }}">Strength & Persiapan TNI POLRI</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Col 3: Service Areas -->
            <div>
                <h4 class="footer-title">Cabang & Area Gym</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('area.fitness', 'sleman') }}">Gym & PT Sleman & Seturan</a></li>
                    <li><a href="{{ route('area.fitness', 'bantul') }}">Gym & PT Bantul & Sewon</a></li>
                    <li><a href="{{ route('area.fitness', 'ugm') }}">Gym Mahasiswa UGM & UNY</a></li>
                    <li><a href="{{ route('area.fitness', 'kota-jogja') }}">Gym & PT Kota Yogyakarta</a></li>
                    <li><a href="{{ route('area.fitness', 'kulon-progo') }}">Gym & PT Kulon Progo</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & Hours -->
            <div>
                <h4 class="footer-title">Informasi & Kontak</h4>
                <div style="font-size: 0.9rem; margin-bottom: 1rem; color: #94a3b8;">
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-location-dot" style="color: #10b981; margin-right: 0.5rem;"></i> Headquarter: {{ site_setting('office_address', 'Jl. Kaliurang KM 5.5, Sleman') }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-brands fa-whatsapp" style="color: #25d366; margin-right: 0.5rem;"></i> {{ site_setting('site_phone', '+62 812-3456-7890') }} (CS Admin)</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-regular fa-clock" style="color: #f97316; margin-right: 0.5rem;"></i> {{ site_setting('office_hours', 'Buka Setiap Hari: 06.00 - 22.00 WIB') }}</p>
                </div>
                <button onclick="openTrialModal()" class="btn btn-accent btn-sm" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                    <i class="fa-solid fa-bolt"></i> Klaim Free Trial PT Sesi 1
                </button>
            </div>
        </div>

        <!-- SEO Target Keywords Footer Tag Cloud -->
        <div style="border-top: 1px solid rgba(255,255,255,0.08); margin-top: 2.5rem; padding-top: 1.5rem; font-size: 0.825rem; color: #64748b;">
            <div style="font-weight: 800; color: #94a3b8; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem;">
                <i class="fa-solid fa-tags" style="color: #10b981;"></i> Kata Kunci Pencarian Fitness Populer:
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; line-height: 1.8;">
                <a href="{{ route('program.index') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">ApexFitness Gym Jogja</a>
                <a href="{{ route('program.show', 'weight-loss-fat-burn') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Personal Trainer Weight Loss Sleman</a>
                <a href="{{ route('program.show', 'female-fitness-shaping') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Gym Khusus Wanita Jogja</a>
                <a href="{{ route('program.show', 'calisthenics-strength-conditioning') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Latihan Kesamaptaan Fisik TNI POLRI</a>
                <a href="{{ route('harga') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Harga Member Gym & PT Sesi Jogja</a>
                <a href="{{ route('lokasi') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Tempat Gym Terdekat UGM & Seturan</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                © {{ date('Y') }} <strong>ApexFitness Center</strong>. All Rights Reserved.
            </div>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; justify-content: center;">
                <a href="{{ route('faq') }}" style="color: #64748b; text-decoration: none;">FAQ Fitness</a>
                <a href="{{ route('blog.index') }}" style="color: #64748b; text-decoration: none;">Tips Nutrisi & Gym</a>
                <a href="{{ route('kontak') }}" style="color: #64748b; text-decoration: none;">Hubungi Kami</a>
                <a href="{{ route('admin.login') }}" style="color: #64748b; text-decoration: none;"><i class="fa-solid fa-lock"></i> Admin Panel</a>
            </div>
        </div>
    </div>
</footer>
