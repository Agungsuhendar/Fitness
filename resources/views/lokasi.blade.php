@extends('layouts.app')

@section('title', 'Peta & Cabang Studio Gym FitLife Center Yogyakarta')
@section('meta_description', 'Lokasi cabang gym studio & area layanan Personal Trainer FitLife Center di Yogyakarta (Sleman, Seturan, Bantul, Umbulharjo). Alat impor & InBody 3D Scan!')

@section('content')
<!-- Header Banner -->
<section style="background: linear-gradient(180deg, #090d0b 0%, #0d1310 100%); padding: 6rem 0 3rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="text-align: center; max-width: 850px;">
        <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.25rem;">
            <i class="fa-solid fa-location-dot"></i>
            <span>Jaringan Studio Gym Terluas di Yogyakarta</span>
        </div>
        <h1 style="font-size: 2.8rem; font-weight: 900; color: #ffffff; margin-bottom: 1rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
            Cabang Studio & <span style="color: #84cc16;">Fasilitas Gym</span>
        </h1>
        <p style="font-size: 1.1rem; color: #94a3b8; line-height: 1.7;">
            Pilih cabang studio gym FitLife terdekat di wilayahmu atau manfaatkan layanan privat Personal Trainer yang datang langsung ke rumah Anda (*Home Visit PT*).
        </p>
    </div>
</section>

<!-- Filter & Branch Cards Section -->
<section style="background: #060907; padding: 4rem 0 6rem; color: white; min-height: 600px;">
    <div class="container">
        
        <!-- Region Filter Pills Bar -->
        <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 3rem;" id="branchFilterBar">
            <button type="button" class="branch-filter-pill active" onclick="filterBranches('all', this)" style="background: rgba(132, 204, 22, 0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 800; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🏢 Semua Cabang Studio
            </button>
            <button type="button" class="branch-filter-pill" onclick="filterBranches('sleman', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                📍 Sleman HQ (Kaliurang)
            </button>
            <button type="button" class="branch-filter-pill" onclick="filterBranches('ugm', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🎓 Seturan UGM / Depok
            </button>
            <button type="button" class="branch-filter-pill" onclick="filterBranches('bantul', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                📍 Sewon Bantul
            </button>
            <button type="button" class="branch-filter-pill" onclick="filterBranches('home', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🏠 Home Visit (Ke Rumah)
            </button>
        </div>

        <!-- Gym Branch Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2rem;" id="branchesGrid">
            
            <!-- Branch 1: Sleman HQ -->
            <div class="branch-card-item" data-region="sleman">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#84cc16'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <!-- Branch Header Banner Image -->
                    <div style="position: relative; height: 200px; background: #162019; overflow: hidden;">
                        <img src="{{ asset('images/assets/pool_depok.webp') }}" alt="FitLife HQ Sleman" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';">
                        <span style="position: absolute; top: 1rem; left: 1rem; background: rgba(132, 204, 22, 0.95); color: #090d0b; font-weight: 900; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px; text-transform: uppercase; box-shadow: 0 0 12px rgba(132,204,22,0.5);">
                            MAIN HEADQUARTERS
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.35rem;">
                            FitLife HQ Kaliurang (Sleman)
                        </h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-location-dot" style="color: #84cc16; margin-right: 0.35rem;"></i> Jl. Kaliurang KM 5.5, Depok, Sleman, DI Yogyakarta
                        </p>

                        <div style="font-size: 0.825rem; color: #cbd5e1; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-regular fa-clock" style="color: #84cc16;"></i> Buka Setiap Hari: 06.00 - 22.00 WIB
                        </div>

                        <!-- Facility Badges -->
                        <div style="display: flex; gap: 0.45rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
                            <span style="background: rgba(132,204,22,0.12); color: #84cc16; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🏋️ Alat Impor Lengkap</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">📊 InBody 3D Scan</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🚿 Air Hangat & Locker</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">📶 Free WiFi</span>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 0.65rem;">
                            <button type="button" onclick="openTrialModal('FitLife HQ Kaliurang (Sleman)')" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(132,204,22,0.3);">
                                <i class="fa-solid fa-bolt"></i> Booking Trial Here
                            </button>
                            <a href="https://maps.google.com/?q=FitLife+Center+Kaliurang+Sleman" target="_blank" class="btn" style="background: rgba(255,255,255,0.06); color: white; border: 1px solid rgba(255,255,255,0.15); padding: 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-align: center; text-decoration: none;">
                                <i class="fa-solid fa-map-location-dot" style="color: #38bdf8;"></i> Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branch 2: Seturan UGM -->
            <div class="branch-card-item" data-region="ugm">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#38bdf8'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 200px; background: #162019; overflow: hidden;">
                        <img src="{{ asset('images/assets/pool_seturan.webp') }}" alt="FitLife Studio Seturan" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';">
                        <span style="position: absolute; top: 1rem; left: 1rem; background: rgba(56, 189, 248, 0.95); color: #ffffff; font-weight: 900; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px; text-transform: uppercase; box-shadow: 0 0 12px rgba(56,189,248,0.5);">
                            CAMPUS STUDIO (UGM & UNY)
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.35rem;">
                            FitLife Studio Seturan (UGM)
                        </h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-location-dot" style="color: #38bdf8; margin-right: 0.35rem;"></i> Area Kampus UGM & UNY, Gejayan, Seturan, Sleman
                        </p>

                        <div style="font-size: 0.825rem; color: #cbd5e1; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-regular fa-clock" style="color: #38bdf8;"></i> Buka Setiap Hari: 06.00 - 22.00 WIB
                        </div>

                        <!-- Facility Badges -->
                        <div style="display: flex; gap: 0.45rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
                            <span style="background: rgba(56,189,248,0.12); color: #38bdf8; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🎓 Diskon Mahasiswa</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🏋️ Heavy Lifting Zone</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🌸 Studio Privat Cewek</span>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 0.65rem;">
                            <button type="button" onclick="openTrialModal('FitLife Studio Seturan (UGM/Depok)')" class="btn" style="background: #38bdf8; color: #090d0b; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(56,189,248,0.3);">
                                <i class="fa-solid fa-bolt"></i> Booking Trial Here
                            </button>
                            <a href="https://maps.google.com/?q=FitLife+Studio+Seturan+Depok" target="_blank" class="btn" style="background: rgba(255,255,255,0.06); color: white; border: 1px solid rgba(255,255,255,0.15); padding: 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-align: center; text-decoration: none;">
                                <i class="fa-solid fa-map-location-dot" style="color: #38bdf8;"></i> Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branch 3: Sewon Bantul -->
            <div class="branch-card-item" data-region="bantul">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#fbbf24'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 200px; background: #162019; overflow: hidden;">
                        <img src="{{ asset('images/assets/pool_sewon.webp') }}" alt="FitLife Studio Sewon" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';">
                        <span style="position: absolute; top: 1rem; left: 1rem; background: rgba(251, 191, 36, 0.95); color: #090d0b; font-weight: 900; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px; text-transform: uppercase; box-shadow: 0 0 12px rgba(251,191,36,0.5);">
                            BANTUL & SEWON BRANCH
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.35rem;">
                            FitLife Branch Sewon (Bantul)
                        </h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-location-dot" style="color: #fbbf24; margin-right: 0.35rem;"></i> Sewon, Kasihan, Banguntapan, Kabupaten Bantul
                        </p>

                        <div style="font-size: 0.825rem; color: #cbd5e1; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-regular fa-clock" style="color: #fbbf24;"></i> Buka Setiap Hari: 06.00 - 22.00 WIB
                        </div>

                        <!-- Facility Badges -->
                        <div style="display: flex; gap: 0.45rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
                            <span style="background: rgba(251,191,36,0.12); color: #fbbf24; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🌿 Atmosphere Nyaman</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🏋️ Area Functional Fitness</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🅿️ Parkir Luas</span>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 0.65rem;">
                            <button type="button" onclick="openTrialModal('FitLife Studio Sewon (Bantul)')" class="btn" style="background: #fbbf24; color: #090d0b; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(251,191,36,0.3);">
                                <i class="fa-solid fa-bolt"></i> Booking Trial Here
                            </button>
                            <a href="https://maps.google.com/?q=FitLife+Studio+Sewon+Bantul" target="_blank" class="btn" style="background: rgba(255,255,255,0.06); color: white; border: 1px solid rgba(255,255,255,0.15); padding: 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-align: center; text-decoration: none;">
                                <i class="fa-solid fa-map-location-dot" style="color: #38bdf8;"></i> Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branch 4: Home Visit -->
            <div class="branch-card-item" data-region="home">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#f472b6'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 200px; background: linear-gradient(135deg, #281923 0%, #0d1310 100%); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <div style="font-size: 5rem; color: #f472b6; opacity: 0.9;">
                            <i class="fa-solid fa-house-user"></i>
                        </div>
                        <span style="position: absolute; top: 1rem; left: 1rem; background: rgba(244, 114, 182, 0.95); color: #ffffff; font-weight: 900; font-size: 0.75rem; padding: 0.35rem 0.85rem; border-radius: 99px; text-transform: uppercase; box-shadow: 0 0 12px rgba(244,114,182,0.5);">
                            HOME VISIT SERVICE
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.35rem;">
                            Private Home Training (Pelatih ke Rumah)
                        </h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-location-dot" style="color: #f472b6; margin-right: 0.35rem;"></i> Melayani seluruh wilayah Kota Jogja, Sleman, & Bantul
                        </p>

                        <div style="font-size: 0.825rem; color: #cbd5e1; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-regular fa-clock" style="color: #f472b6;"></i> Jadwal Fleksibel Disesuaikan
                        </div>

                        <!-- Facility Badges -->
                        <div style="display: flex; gap: 0.45rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
                            <span style="background: rgba(244,114,182,0.12); color: #f472b6; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🏠 Pelatih Membawa Alat</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🔒 100% Privat & Aman</span>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 0.65rem;">
                            <button type="button" onclick="openTrialModal('Private Home Training')" class="btn" style="background: #f472b6; color: #ffffff; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(244,114,182,0.3);">
                                <i class="fa-solid fa-bolt"></i> Booking Home PT
                            </button>
                            <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin%20FitLife,%20saya%20tanya%20layanan%20Home%20PT" target="_blank" class="btn" style="background: #25d366; color: white; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-align: center; text-decoration: none;">
                                <i class="fa-brands fa-whatsapp"></i> WA Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Branch Filter Logic JavaScript -->
<script>
    function filterBranches(region, btnEl) {
        document.querySelectorAll('.branch-filter-pill').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.05)';
            btn.style.borderColor = 'rgba(255,255,255,0.12)';
            btn.style.color = '#cbd5e1';
            btn.classList.remove('active');
        });

        btnEl.style.background = 'rgba(132, 204, 22, 0.15)';
        btnEl.style.borderColor = '#84cc16';
        btnEl.style.color = '#84cc16';
        btnEl.classList.add('active');

        const items = document.querySelectorAll('.branch-card-item');
        items.forEach(item => {
            const itemRegion = item.getAttribute('data-region') || '';
            if (region === 'all' || itemRegion === region) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection
