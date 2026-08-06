@extends('layouts.app')

@section('title', 'Tim Personal Trainer Berlisensi APKI | FitLife Center Yogyakarta')
@section('meta_description', 'Pelatih privat 1-on-1 tersertifikasi APKI di Yogyakarta. Spesialis Weight Loss & Fat Burning, Muscle Building, Female Body Shaping, serta Tes Fisik TNI POLRI.')

@section('content')
<!-- Header Banner -->
<section style="background: linear-gradient(180deg, #090d0b 0%, #0d1310 100%); padding: 6rem 0 3rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="text-align: center; max-width: 850px;">
        <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.25rem;">
            <i class="fa-solid fa-award"></i>
            <span>Sertifikasi Resmi APKI (Asosiasi Pelatih Kebugaran Indonesia)</span>
        </div>
        <h1 style="font-size: 2.8rem; font-weight: 900; color: #ffffff; margin-bottom: 1rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
            Tim <span style="color: #84cc16;">Personal Trainer</span> Profesional
        </h1>
        <p style="font-size: 1.1rem; color: #94a3b8; line-height: 1.7;">
            Bimbingan privat 1-on-1 bersama pelatih berpengalaman yang siap merancang program latihan, pola makan terstruktur, dan teknik aman bebas cedera demi hasil terukur.
        </p>
    </div>
</section>

<!-- Filter & Coaches Gallery Section -->
<section style="background: #060907; padding: 4rem 0 6rem; color: white; min-height: 600px;">
    <div class="container">
        
        <!-- Specialty Filter Pills Bar -->
        <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 3rem;" id="coachFilterBar">
            <button type="button" class="coach-filter-pill active" onclick="filterCoaches('all', this)" style="background: rgba(132, 204, 22, 0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 800; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🌟 Semua Pelatih
            </button>
            <button type="button" class="coach-filter-pill" onclick="filterCoaches('fat_loss', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🔥 Fat Loss & Weight Loss
            </button>
            <button type="button" class="coach-filter-pill" onclick="filterCoaches('muscle', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                💪 Muscle Building
            </button>
            <button type="button" class="coach-filter-pill" onclick="filterCoaches('female', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🌸 Trainer Wanita (Privat)
            </button>
            <button type="button" class="coach-filter-pill" onclick="filterCoaches('tni', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🛡️ Persiapan TNI / POLRI
            </button>
            <button type="button" class="coach-filter-pill" onclick="filterCoaches('rehab', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                🩺 Posture Rehab
            </button>
        </div>

        <!-- Coaches Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;" id="coachesGrid">
            
            <!-- Coach 1: Hendra Wijaya -->
            <div class="coach-card-item" data-tags="fat_loss muscle">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#84cc16'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 260px; background: linear-gradient(135deg, #162019 0%, #0d1310 100%); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <div style="width: 130px; height: 130px; background: linear-gradient(135deg, #84cc16 0%, #3f6212 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-size: 4rem; font-weight: 900; box-shadow: 0 0 30px rgba(132,204,22,0.4); border: 4px solid #ffffff;">
                            <i class="fa-solid fa-user-ninja"></i>
                        </div>
                        <span style="position: absolute; top: 1rem; right: 1rem; background: rgba(132, 204, 22, 0.9); color: #090d0b; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px; box-shadow: 0 0 12px rgba(132,204,22,0.5);">
                            <i class="fa-solid fa-award"></i> APKI CERTIFIED
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                            <h3 style="font-size: 1.3rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">Coach Hendra Wijaya, S.Or</h3>
                            <div style="color: #fbbf24; font-size: 0.85rem; font-weight: 800;">
                                <i class="fa-solid fa-star"></i> 4.9 <span style="color: #64748b; font-size: 0.75rem;">(180+ review)</span>
                            </div>
                        </div>
                        <div style="color: #84cc16; font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem;">
                            Head Personal Trainer & Hypertrophy Specialist
                        </div>

                        <!-- Metrics Grid -->
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.15rem;">
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🔥 Fat Loss & Weight Loss</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">💪 Muscle Building</span>
                            <span style="background: rgba(132,204,22,0.12); color: #84cc16; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">7+ Thn Pengalaman</span>
                        </div>

                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1.5rem;">
                            Spesialis pangkas lemak & pembentukan massa otot bersih dengan metode latihan beban progresif terpandu serta penyusunan pola makro nutrisi harian.
                        </p>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                            <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Admin FitLife, saya berminat konsultasi privat 1-on-1 bersama Coach Hendra Wijaya.') }}" target="_blank" class="btn" style="background: #25d366; color: white; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                                <i class="fa-brands fa-whatsapp"></i> Chat WA
                            </a>
                            <button type="button" onclick="openTrialModal('Weight Loss & Fat Burn')" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(132,204,22,0.3);">
                                Booking Trial
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coach 2: Rina Febriana -->
            <div class="coach-card-item" data-tags="female fat_loss">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#f472b6'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 260px; background: linear-gradient(135deg, #281923 0%, #0d1310 100%); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <div style="width: 130px; height: 130px; background: linear-gradient(135deg, #f472b6 0%, #db2777 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 4rem; font-weight: 900; box-shadow: 0 0 30px rgba(244,114,182,0.4); border: 4px solid #ffffff;">
                            <i class="fa-solid fa-person-dress"></i>
                        </div>
                        <span style="position: absolute; top: 1rem; right: 1rem; background: rgba(244, 114, 182, 0.9); color: #ffffff; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px; box-shadow: 0 0 12px rgba(244,114,182,0.5);">
                            <i class="fa-solid fa-award"></i> FEMALE TRAINER APKI
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                            <h3 style="font-size: 1.3rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">Coach Rina Febriana</h3>
                            <div style="color: #fbbf24; font-size: 0.85rem; font-weight: 800;">
                                <i class="fa-solid fa-star"></i> 5.0 <span style="color: #64748b; font-size: 0.75rem;">(140+ review)</span>
                            </div>
                        </div>
                        <div style="color: #f472b6; font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem;">
                            Female Fitness & Body Shaping Specialist
                        </div>

                        <!-- Metrics Grid -->
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.15rem;">
                            <span style="background: rgba(244,114,182,0.12); color: #f472b6; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🌸 Trainer Wanita Privat</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">✨ Shaping Pinggul & Perut</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">5+ Thn Pengalaman</span>
                        </div>

                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1.5rem;">
                            Spesialis pendampingan privat wanita untuk pembentukan tubuh ideal, mengecilkan paha & lengan, serta latihan pasca melahirkan secara aman.
                        </p>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                            <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Admin FitLife, saya mau konsultasi privat wanita dengan Coach Rina Febriana.') }}" target="_blank" class="btn" style="background: #25d366; color: white; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                                <i class="fa-brands fa-whatsapp"></i> Chat WA
                            </a>
                            <button type="button" onclick="openTrialModal('Female Fitness & Body Shaping')" class="btn" style="background: #f472b6; color: #ffffff; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(244,114,182,0.3);">
                                Booking Trial
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coach 3: Bima Prasetyo -->
            <div class="coach-card-item" data-tags="tni muscle">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#fbbf24'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 260px; background: linear-gradient(135deg, #262116 0%, #0d1310 100%); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <div style="width: 130px; height: 130px; background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-size: 4rem; font-weight: 900; box-shadow: 0 0 30px rgba(251,191,36,0.4); border: 4px solid #ffffff;">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <span style="position: absolute; top: 1rem; right: 1rem; background: rgba(251, 191, 36, 0.9); color: #090d0b; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px; box-shadow: 0 0 12px rgba(251,191,36,0.5);">
                            <i class="fa-solid fa-award"></i> TACTICAL COACH
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                            <h3 style="font-size: 1.3rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">Coach Bima Prasetyo</h3>
                            <div style="color: #fbbf24; font-size: 0.85rem; font-weight: 800;">
                                <i class="fa-solid fa-star"></i> 4.9 <span style="color: #64748b; font-size: 0.75rem;">(110+ review)</span>
                            </div>
                        </div>
                        <div style="color: #fbbf24; font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem;">
                            Strength & Tes Fisik TNI-POLRI Specialist
                        </div>

                        <!-- Metrics Grid -->
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.15rem;">
                            <span style="background: rgba(251,191,36,0.12); color: #fbbf24; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🛡️ Tes Kesamaptaan TNI/POLRI</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🤸 Calisthenics & Push-Pull</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">6+ Thn Pengalaman</span>
                        </div>

                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1.5rem;">
                            Pelatih khusus fisik militer & Polri. Berpengalaman membimbing peserta mencapai target push-up 45+, pull-up 18+, sit-up, dan lari 12 menit.
                        </p>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                            <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Admin FitLife, saya mau konsultasi persiapan tes fisik TNI POLRI bersama Coach Bima Prasetyo.') }}" target="_blank" class="btn" style="background: #25d366; color: white; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                                <i class="fa-brands fa-whatsapp"></i> Chat WA
                            </a>
                            <button type="button" onclick="openTrialModal('Strength & Persiapan TNI-POLRI')" class="btn" style="background: #fbbf24; color: #090d0b; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(251,191,36,0.3);">
                                Booking Trial
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coach 4: Dr. Aris Subagyo -->
            <div class="coach-card-item" data-tags="rehab fat_loss">
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.12); border-radius: 1.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6); transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.borderColor='#38bdf8'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.transform='translateY(0)'">
                    <div style="position: relative; height: 260px; background: linear-gradient(135deg, #16222b 0%, #0d1310 100%); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <div style="width: 130px; height: 130px; background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 4rem; font-weight: 900; box-shadow: 0 0 30px rgba(56,189,248,0.4); border: 4px solid #ffffff;">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <span style="position: absolute; top: 1rem; right: 1rem; background: rgba(56, 189, 248, 0.9); color: #ffffff; font-weight: 900; font-size: 0.75rem; padding: 0.3rem 0.75rem; border-radius: 99px; box-shadow: 0 0 12px rgba(56,189,248,0.5);">
                            <i class="fa-solid fa-stethoscope"></i> REHAB SPECIALIST
                        </span>
                    </div>

                    <div style="padding: 1.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                            <h3 style="font-size: 1.3rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">Coach Aris Subagyo, S.Ft</h3>
                            <div style="color: #fbbf24; font-size: 0.85rem; font-weight: 800;">
                                <i class="fa-solid fa-star"></i> 4.9 <span style="color: #64748b; font-size: 0.75rem;">(95+ review)</span>
                            </div>
                        </div>
                        <div style="color: #38bdf8; font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem;">
                            Posture Correction & Functional Rehab Specialist
                        </div>

                        <!-- Metrics Grid -->
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.15rem;">
                            <span style="background: rgba(56,189,248,0.12); color: #38bdf8; padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; font-weight: 700;">🩺 Posture Correction</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">🦴 Nyeri Pinggang & Sendi</span>
                            <span style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.3rem 0.65rem; border-radius: 8px; font-size: 0.775rem; color: #cbd5e1;">8+ Thn Pengalaman</span>
                        </div>

                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1.5rem;">
                            Fisioterapis & pelatih rehab fungsional untuk mengatasi bungkuk (kyphosis), skoliosis ringan, nyeri pinggang bawah (HNP), dan pemulihan cedera olahraga.
                        </p>

                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                            <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Admin FitLife, saya mau konsultasi posture correction & rehab dengan Coach Aris Subagyo.') }}" target="_blank" class="btn" style="background: #25d366; color: white; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                                <i class="fa-brands fa-whatsapp"></i> Chat WA
                            </a>
                            <button type="button" onclick="openTrialModal('Posture Correction & Rehab')" class="btn" style="background: #38bdf8; color: #090d0b; border: none; padding: 0.75rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; box-shadow: 0 0 15px rgba(56,189,248,0.3);">
                                Booking Trial
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Filter JavaScript Logic -->
<script>
    function filterCoaches(tag, btnEl) {
        document.querySelectorAll('.coach-filter-pill').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.05)';
            btn.style.borderColor = 'rgba(255,255,255,0.12)';
            btn.style.color = '#cbd5e1';
            btn.classList.remove('active');
        });

        btnEl.style.background = 'rgba(132, 204, 22, 0.15)';
        btnEl.style.borderColor = '#84cc16';
        btnEl.style.color = '#84cc16';
        btnEl.classList.add('active');

        const items = document.querySelectorAll('.coach-card-item');
        items.forEach(item => {
            const tags = item.getAttribute('data-tags') || '';
            if (tag === 'all' || tags.includes(tag)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection
