@extends('layouts.app')

@section('title', 'Kalkulator Fitness & Kebutuhan Kalori (TDEE & BMI) | FitLife Center')
@section('meta_description', 'Hitung Body Mass Index (BMI), BMR, dan kebutuhan kalori harian (TDEE) secara gratis & akurat di FitLife Yogyakarta. Dapatkan rekomendasi target kalori dan program latihan yang tepat!')

@section('content')
<!-- Header Banner -->
<section style="background: linear-gradient(180deg, #090d0b 0%, #0d1310 100%); padding: 6rem 0 3rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="text-align: center; max-width: 800px;">
        <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.25rem;">
            <i class="fa-solid fa-calculator"></i>
            <span>Tools Kebugaran Interaktif</span>
        </div>
        <h1 style="font-size: 2.8rem; font-weight: 900; color: #ffffff; margin-bottom: 1rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
            Kalkulator Fitness & <span style="color: #84cc16;">Target Kalori</span>
        </h1>
        <p style="font-size: 1.1rem; color: #94a3b8; line-height: 1.7;">
            Ketahui indeks massa tubuh (BMI), metabolisme basal (BMR), dan estimasi kebutuhan kalori harian (TDEE) milikmu untuk mencapai target tubuh ideal lebih cepat & terukur!
        </p>
    </div>
</section>

<!-- Calculator & Results Section -->
<section style="background: #060907; padding: 4rem 0 6rem; color: white; min-height: 600px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 2.5rem; align-items: stretch;" class="grid-2">
            
            <!-- Left: Form Inputs Card -->
            <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); display: flex; flex-direction: column; height: 100%;">
                <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; margin-bottom: 1.5rem; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.6rem;">
                    <i class="fa-solid fa-sliders" style="color: #84cc16;"></i> Masukkan Data Fisikmu
                </h3>

                <form id="fitnessCalcForm" onsubmit="calculateFitness(event)" style="display: flex; flex-direction: column; flex: 1;">
                    <!-- 1. Gender -->
                    <div style="margin-bottom: 1.35rem;">
                        <label style="display: block; font-weight: 700; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.6rem;">Jenis Kelamin</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <label style="display: flex; align-items: center; justify-content: center; gap: 0.6rem; background: rgba(255,255,255,0.05); border: 2px solid rgba(255,255,255,0.12); border-radius: 0.85rem; padding: 0.75rem; cursor: pointer; transition: all 0.2s;" id="genderMaleLabel">
                                <input type="radio" name="calc_gender" value="male" checked style="accent-color: #84cc16;" onchange="updateGenderStyle()">
                                <i class="fa-solid fa-mars" style="color: #38bdf8; font-size: 1.1rem;"></i>
                                <span style="font-weight: 800; font-size: 0.95rem; color: white;">Pria</span>
                            </label>
                            <label style="display: flex; align-items: center; justify-content: center; gap: 0.6rem; background: rgba(255,255,255,0.05); border: 2px solid rgba(255,255,255,0.12); border-radius: 0.85rem; padding: 0.75rem; cursor: pointer; transition: all 0.2s;" id="genderFemaleLabel">
                                <input type="radio" name="calc_gender" value="female" style="accent-color: #84cc16;" onchange="updateGenderStyle()">
                                <i class="fa-solid fa-venus" style="color: #f472b6; font-size: 1.1rem;"></i>
                                <span style="font-weight: 800; font-size: 0.95rem; color: white;">Wanita</span>
                            </label>
                        </div>
                    </div>

                    <!-- 2. Age, Weight, Height Grid -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.35rem;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.4rem;">Usia (Thn)</label>
                            <input type="number" id="calc_age" value="25" min="10" max="90" required style="width: 100%; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem; color: white; font-weight: 700; font-size: 1rem; outline: none;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.4rem;">Berat (kg)</label>
                            <input type="number" id="calc_weight" value="70" min="30" max="250" required style="width: 100%; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem; color: white; font-weight: 700; font-size: 1rem; outline: none;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 0.825rem; color: #cbd5e1; margin-bottom: 0.4rem;">Tinggi (cm)</label>
                            <input type="number" id="calc_height" value="170" min="100" max="230" required style="width: 100%; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem; color: white; font-weight: 700; font-size: 1rem; outline: none;">
                        </div>
                    </div>

                    <!-- 3. Activity Level -->
                    <div style="margin-bottom: 1.35rem;">
                        <label style="display: block; font-weight: 700; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Tingkat Aktivitas Harian</label>
                        <select id="calc_activity" style="width: 100%; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem; color: white; font-weight: 700; font-size: 0.9rem; outline: none;">
                            <option value="1.2">Jarang Olahraga / Duduk Seharian (Sedentary)</option>
                            <option value="1.375">Olahraga Ringan (1 - 3 hari / minggu)</option>
                            <option value="1.55" selected>Olahraga Sedang (3 - 5 hari / minggu)</option>
                            <option value="1.725">Olahraga Berat (6 - 7 hari / minggu)</option>
                            <option value="1.9">Aktivitas Sangat Berat / Atlet Profesional</option>
                        </select>
                    </div>

                    <!-- 4. Primary Fitness Goal -->
                    <div style="margin-bottom: 1.75rem;">
                        <label style="display: block; font-weight: 700; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.4rem;">Target Utama Kamu</label>
                        <select id="calc_goal" style="width: 100%; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem; color: white; font-weight: 700; font-size: 0.9rem; outline: none;">
                            <option value="lose" selected>Turun Berat Badan / Defisit Kalori (Weight Loss & Fat Burning)</option>
                            <option value="maintain">Menjaga Kebugaran & Berat Badan (Maintenance)</option>
                            <option value="gain">Menambah Otot / Surplus Kalori (Muscle Building & Bulking)</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #ffffff !important; border: none; padding: 0.95rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 0 25px rgba(132,204,22,0.4); margin-top: auto;">
                        <i class="fa-solid fa-calculator"></i>
                        <span>Hitung Target Kalori Saya</span>
                    </button>
                </form>
            </div>

            <!-- Right: Results Card -->
            <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); display: flex; flex-direction: column; height: 100%;" id="resultsCard">
                <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; margin-bottom: 1.5rem; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.6rem;">
                    <i class="fa-solid fa-chart-pie" style="color: #84cc16;"></i> Hasil Analisis Tubuhmu
                </h3>

                <!-- Top Metric Display Cards Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <!-- BMI Card -->
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem; padding: 1.15rem; text-align: center;">
                        <span style="font-size: 0.775rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Indeks Masa Tubuh (BMI)</span>
                        <div style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin: 0.25rem 0;" id="resBMI">24.2</div>
                        <div style="display: inline-block; background: rgba(132, 204, 22, 0.2); color: #84cc16; font-weight: 800; font-size: 0.75rem; padding: 0.2rem 0.75rem; border-radius: 99px;" id="resBMIBadge">Normal / Ideal</div>
                    </div>

                    <!-- Recommended Daily Calories Card -->
                    <div style="background: rgba(132, 204, 22, 0.1); border: 1.5px solid #84cc16; border-radius: 1rem; padding: 1.15rem; text-align: center; position: relative;">
                        <span style="font-size: 0.775rem; color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Target Kalori / Hari</span>
                        <div style="font-size: 2.2rem; font-weight: 900; color: #84cc16; margin: 0.25rem 0;" id="resTargetCal">1.850</div>
                        <span style="font-size: 0.75rem; color: #cbd5e1; font-weight: 700;">Kcal / hari</span>
                    </div>
                </div>

                <!-- Detail Breakdown List -->
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <span style="color: #94a3b8; font-size: 0.875rem; font-weight: 600;">Metabolisme Basal (BMR):</span>
                        <strong style="color: #ffffff; font-size: 1rem;" id="resBMR">1.620 Kcal</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 0.75rem;">
                        <span style="color: #94a3b8; font-size: 0.875rem; font-weight: 600;">Total Energi Harian (TDEE):</span>
                        <strong style="color: #ffffff; font-size: 1rem;" id="resTDEE">2.350 Kcal</strong>
                    </div>
                </div>

                <!-- Program Recommendation Box -->
                <div style="background: linear-gradient(135deg, rgba(132,204,22,0.12) 0%, rgba(10,15,13,0.8) 100%); border: 1px solid rgba(132,204,22,0.3); border-radius: 1.25rem; padding: 1.35rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #84cc16; font-weight: 800; font-size: 0.85rem; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-star"></i> Rekomendasi Program FitLife
                    </div>
                    <h4 style="font-size: 1.2rem; font-weight: 800; color: #ffffff; margin-bottom: 0.35rem;" id="recProgTitle">Weight Loss & Fat Burning Program</h4>
                    <p style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.5; margin-bottom: 1rem;" id="recProgDesc">
                        Program privat 1-on-1 bersama Personal Trainer tersertifikasi untuk membakar lemak tubuh secara konsisten dengan pola makan terpandu.
                    </p>
                </div>

                <!-- WA Action Button -->
                <a href="#" id="waConsultBtn" target="_blank" class="btn" style="width: 100%; background: #25d366; color: #ffffff; border: none; padding: 0.9rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; text-decoration: none; box-shadow: 0 0 20px rgba(37,211,102,0.4); margin-top: auto;">
                    <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i>
                    <span>Konsultasi Hasil Ini via WA</span>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Additional Information Section -->
<section style="background: #090d0b; padding: 4rem 0; color: white; border-top: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="max-width: 900px;">
        <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; text-align: center; margin-bottom: 2rem; font-family: 'Outfit', sans-serif;">
            Memahami Istilah Penting Dalam Fitness
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
            <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.5rem;">
                <div style="color: #84cc16; font-size: 1.5rem; margin-bottom: 0.6rem;"><i class="fa-solid fa-weight-scale"></i></div>
                <h4 style="font-size: 1.1rem; font-weight: 800; color: white; margin-bottom: 0.4rem;">BMI (Body Mass Index)</h4>
                <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6;">Indikator rasio berat terhadap tinggi badan untuk mengelompokkan apakah tubuh tergolong kurus, ideal, atau kelebihan berat badan.</p>
            </div>

            <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.5rem;">
                <div style="color: #84cc16; font-size: 1.5rem; margin-bottom: 0.6rem;"><i class="fa-solid fa-heart-pulse"></i></div>
                <h4 style="font-size: 1.1rem; font-weight: 800; color: white; margin-bottom: 0.4rem;">BMR (Basal Metabolic Rate)</h4>
                <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6;">Jumlah kalori minimum yang dibutuhkan tubuh untuk menjalankan fungsi organ vital saat beristirahat total.</p>
            </div>

            <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.5rem;">
                <div style="color: #84cc16; font-size: 1.5rem; margin-bottom: 0.6rem;"><i class="fa-solid fa-bolt"></i></div>
                <h4 style="font-size: 1.1rem; font-weight: 800; color: white; margin-bottom: 0.4rem;">TDEE (Total Energy Expenditure)</h4>
                <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6;">Total kalori nyata yang dibakar tubuh dalam sehari setelah memperhitungkan seluruh aktivitas fisik dan olahraga harian.</p>
            </div>
        </div>
    </div>
</section>

<!-- Calculator JavaScript Logic -->
<script>
    function updateGenderStyle() {
        const isMale = document.querySelector('input[name="calc_gender"]:checked').value === 'male';
        const maleLabel = document.getElementById('genderMaleLabel');
        const femaleLabel = document.getElementById('genderFemaleLabel');
        if (isMale) {
            maleLabel.style.borderColor = '#84cc16';
            maleLabel.style.background = 'rgba(132, 204, 22, 0.15)';
            femaleLabel.style.borderColor = 'rgba(255,255,255,0.12)';
            femaleLabel.style.background = 'rgba(255,255,255,0.05)';
        } else {
            femaleLabel.style.borderColor = '#84cc16';
            femaleLabel.style.background = 'rgba(132, 204, 22, 0.15)';
            maleLabel.style.borderColor = 'rgba(255,255,255,0.12)';
            maleLabel.style.background = 'rgba(255,255,255,0.05)';
        }
    }

    function calculateFitness(e) {
        if (e) e.preventDefault();

        const gender = document.querySelector('input[name="calc_gender"]:checked').value;
        const age = parseFloat(document.getElementById('calc_age').value) || 25;
        const weight = parseFloat(document.getElementById('calc_weight').value) || 70;
        const height = parseFloat(document.getElementById('calc_height').value) || 170;
        const activity = parseFloat(document.getElementById('calc_activity').value) || 1.55;
        const goal = document.getElementById('calc_goal').value;

        // 1. BMI Calculation
        const heightMeters = height / 100;
        const bmi = (weight / (heightMeters * heightMeters)).toFixed(1);

        let bmiCategory = 'Ideal / Normal';
        let bmiColor = '#84cc16';
        if (bmi < 18.5) {
            bmiCategory = 'Kekurangan Berat (Underweight)';
            bmiColor = '#38bdf8';
        } else if (bmi >= 18.5 && bmi < 25.0) {
            bmiCategory = 'Ideal / Normal';
            bmiColor = '#84cc16';
        } else if (bmi >= 25.0 && bmi < 30.0) {
            bmiCategory = 'Kelebihan Berat (Overweight)';
            bmiColor = '#fbbf24';
        } else {
            bmiCategory = 'Obesitas (Obese)';
            bmiColor = '#f87171';
        }

        // 2. BMR Calculation (Mifflin-St Jeor)
        let bmr = (10 * weight) + (6.25 * height) - (5 * age);
        if (gender === 'male') {
            bmr += 5;
        } else {
            bmr -= 161;
        }
        bmr = Math.round(bmr);

        // 3. TDEE Calculation
        const tdee = Math.round(bmr * activity);

        // 4. Target Calories
        let targetCal = tdee;
        let progTitle = 'Weight Loss & Fat Burning Program';
        let progDesc = 'Program privat 1-on-1 bersama Personal Trainer tersertifikasi untuk membakar lemak tubuh secara konsisten dengan pola makan terpandu.';

        if (goal === 'lose') {
            targetCal = Math.round(tdee - 500);
            if (gender === 'female') {
                progTitle = 'Female Fitness & Body Shaping';
                progDesc = 'Program privat khusus wanita untuk membentuk lekuk tubuh ideal, membakar lemak, dan mengencangkan otot secara aman.';
            } else {
                progTitle = 'Weight Loss & Fat Burning Program';
                progDesc = 'Program fat loss intensif dengan pendampingan Personal Trainer untuk pangkas lemak tubuh tanpa kehilangan massa otot.';
            }
        } else if (goal === 'gain') {
            targetCal = Math.round(tdee + 350);
            progTitle = 'Muscle Building & Hypertrophy Program';
            progDesc = 'Program hipertrofi dan kekuatan fisik terstruktur untuk menaikkan berat badan bersih (massa otot) secara cepat & terukur.';
        } else {
            targetCal = tdee;
            progTitle = 'General Fitness & Posture Correction';
            progDesc = 'Program kebugaran harian untuk menjaga vitalitas, kesehatan jantung, serta memperbaiki postur tubuh.';
        }

        // Render to UI
        document.getElementById('resBMI').innerText = bmi;
        const bmiBadge = document.getElementById('resBMIBadge');
        bmiBadge.innerText = bmiCategory;
        bmiBadge.style.color = bmiColor;
        bmiBadge.style.background = bmiColor + '25';

        document.getElementById('resBMR').innerText = bmr.toLocaleString('id-ID') + ' Kcal';
        document.getElementById('resTDEE').innerText = tdee.toLocaleString('id-ID') + ' Kcal';
        document.getElementById('resTargetCal').innerText = targetCal.toLocaleString('id-ID');

        document.getElementById('recProgTitle').innerText = progTitle;
        document.getElementById('recProgDesc').innerText = progDesc;

        // Build WhatsApp Message
        const genderText = gender === 'male' ? 'Pria' : 'Wanita';
        const goalText = goal === 'lose' ? 'Turun Berat Badan (Weight Loss)' : (goal === 'gain' ? 'Nambah Massa Otot (Muscle Gain)' : 'Menjaga Kebugaran');
        const waMsg = `Halo Admin FitLife, saya sudah menghitung data tubuh di Kalkulator Fitness Website:
- Gender: ${genderText}, Usia: ${age} th
- Berat: ${weight} kg, Tinggi: ${height} cm
- BMI: ${bmi} (${bmiCategory})
- Estimasi TDEE: ${tdee} Kcal
- Target Kalori Harian: ${targetCal} Kcal
- Target: ${goalText}

Saya berminat konsultasi & daftar program ${progTitle}. Mohon info selengkapnya. Terima kasih!`;

        const waUrl = "https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=" + encodeURIComponent(waMsg);
        document.getElementById('waConsultBtn').href = waUrl;
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateGenderStyle();
        calculateFitness();
    });
</script>
@endsection
