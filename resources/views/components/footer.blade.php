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
            <!-- Col 1: Brand Info & Description -->
            <div>
                @php
                    $footerAbout = site_setting('site_footer_about', 'FitLife Center adalah pusat kebugaran fitness gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta. Menyediakan program Weight Loss & Fat Burning, Muscle Building, Female Body Shaping, serta Persiapan Fisik TNI POLRI & Rehabilitasi Postur.');
                @endphp
                <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 1.25rem;">
                    <img src="{{ asset('images/logo-footer.png') }}" alt="FitLife Logo Footer" style="height: 52px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(132, 204, 22, 0.3));">
                </div>
                <p style="font-size: 0.925rem; line-height: 1.7; margin-bottom: 1.5rem; color: #94a3b8;">
                    {{ $footerAbout }}
                </p>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ site_setting('instagram_url', 'https://instagram.com/apexfitness.id') }}" target="_blank" style="width: 38px; height: 38px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.12); color: #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.25s ease;" onmouseover="this.style.background='#84cc16'; this.style.color='#090d0b';" onmouseout="this.style.background='rgba(255, 255, 255, 0.06)'; this.style.color='#84cc16';"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ site_setting('tiktok_url', 'https://tiktok.com/@apexfitness.id') }}" target="_blank" style="width: 38px; height: 38px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.12); color: #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.25s ease;" onmouseover="this.style.background='#84cc16'; this.style.color='#090d0b';" onmouseout="this.style.background='rgba(255, 255, 255, 0.06)'; this.style.color='#84cc16';"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="{{ site_setting('youtube_url', 'https://youtube.com/@apexfitnessid') }}" target="_blank" style="width: 38px; height: 38px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.12); color: #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.25s ease;" onmouseover="this.style.background='#84cc16'; this.style.color='#090d0b';" onmouseout="this.style.background='rgba(255, 255, 255, 0.06)'; this.style.color='#84cc16';"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}" target="_blank" style="width: 38px; height: 38px; background: #25d366; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.25s ease; box-shadow: 0 0 15px rgba(37, 211, 102, 0.4);"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Col 2: Navigation Links -->
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
                <div style="font-size: 0.9rem; margin-bottom: 1.25rem; color: #94a3b8; line-height: 1.6;">
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-location-dot" style="color: #84cc16; margin-right: 0.5rem;"></i> Headquarter: {{ site_setting('office_address', 'Jl. Kaliurang KM 5.5, Sleman') }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-brands fa-whatsapp" style="color: #25d366; margin-right: 0.5rem;"></i> {{ site_setting('site_phone', '+62 812-3456-7890') }} (CS Admin)</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-regular fa-clock" style="color: #84cc16; margin-right: 0.5rem;"></i> {{ site_setting('office_hours', 'Buka Setiap Hari: 06.00 - 22.00 WIB') }}</p>
                </div>
                <button onclick="openTrialModal()" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.75rem 1.2rem; border-radius: 99px; font-weight: 900; font-size: 0.875rem; cursor: pointer; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                    <i class="fa-solid fa-bolt"></i> Klaim Free Trial 7 Hari
                </button>
            </div>
        </div>

        <!-- SEO Tag Cloud -->
        <div style="border-top: 1px solid rgba(255,255,255,0.08); margin-top: 2.5rem; padding-top: 1.5rem; font-size: 0.825rem; color: #64748b;">
            <div style="font-weight: 800; color: #cbd5e1; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem;">
                <i class="fa-solid fa-tags" style="color: #84cc16;"></i> Kata Kunci Pencarian Fitness Populer:
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; line-height: 1.8;">
                <a href="{{ route('program.index') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 0.2rem 0.6rem; border-radius: 6px; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#94a3b8'">FitLife Gym Jogja</a>
                <a href="{{ route('program.show', 'weight-loss-fat-burn') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 0.2rem 0.6rem; border-radius: 6px; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#94a3b8'">Personal Trainer Weight Loss Sleman</a>
                <a href="{{ route('program.show', 'female-fitness-shaping') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 0.2rem 0.6rem; border-radius: 6px; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#94a3b8'">Gym Khusus Wanita Jogja</a>
                <a href="{{ route('program.show', 'calisthenics-strength-conditioning') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 0.2rem 0.6rem; border-radius: 6px; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#94a3b8'">Latihan Kesamaptaan Fisik TNI POLRI</a>
                <a href="{{ route('harga') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 0.2rem 0.6rem; border-radius: 6px; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#94a3b8'">Harga Member Gym & PT Sesi Jogja</a>
                <a href="{{ route('lokasi') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 0.2rem 0.6rem; border-radius: 6px; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#94a3b8'">Tempat Gym Terdekat UGM & Seturan</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                © {{ date('Y') }} <strong style="color: #ffffff;">FitLife Center</strong>. All Rights Reserved.
            </div>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; justify-content: center; align-items: center;">
                <a href="{{ route('tentang') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">Tentang Kami</a>
                <a href="{{ route('kalkulator') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">Kalkulator Kalori</a>
                <a href="{{ route('quiz') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">Program Quiz</a>
                <a href="{{ route('member.dashboard') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">Area Member</a>
                <a href="{{ route('pelatih') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">Tim Pelatih</a>
                <a href="{{ route('faq') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">FAQ</a>
                <a href="{{ route('blog.index') }}" style="color: #64748b; text-decoration: none;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">Artikel</a>
                <a href="{{ route('admin.login') }}" style="color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='#64748b'">
                    <i class="fa-solid fa-lock" style="font-size: 0.75rem;"></i>
                    <span>Admin Panel</span>
                </a>
            </div>
        </div>
    </div>
</footer>
