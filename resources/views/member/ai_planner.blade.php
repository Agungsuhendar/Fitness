@extends('layouts.app')

@section('title', 'AI Fitness & Nutrition Planner - FitLife Center')

@section('content')
<section style="padding: 3rem 0; background: #060907; color: white; min-height: 85vh;">
    <div class="container">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #0d1310 0%, #17241c 100%); border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(132, 204, 22, 0.15);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="background: rgba(132,204,22,0.2); color: #84cc16; padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid #84cc16; display: inline-block; margin-bottom: 0.5rem;">
                        🤖 AI GENERATIVE HEALTH ENGINE
                    </span>
                    <h2 style="font-size: 1.85rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem;">
                        AI Personal Trainer &amp; Nutrition Planner Generator
                    </h2>
                    <p style="color: #cbd5e1; font-size: 0.925rem; margin: 0;">
                        Kalkulasi kebutuhan kalori harian BMR/TDEE &amp; buat jadwal latihan + menu makan sehat khas masakan Indonesia secara instan!
                    </p>
                </div>

                <a href="{{ route('member.dashboard') }}" class="btn" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 0.65rem 1.25rem; border-radius: 0.75rem; font-weight: 800; text-decoration: none; font-size: 0.85rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1.6fr; gap: 2rem;" class="grid-2">
            
            <!-- Left Column: Assessment Form -->
            <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-sliders"></i> Input Data Fisik &amp; Target Anda
                </h3>

                <form id="aiPlannerForm" onsubmit="handleGenerateAiPlan(event)">
                    @csrf
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">JENIS KELAMIN *</label>
                            <select name="gender" required style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                                <option value="male">👨 Pria</option>
                                <option value="female">👩 Wanita</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">UMUR (TAHUN) *</label>
                            <input type="number" name="age" value="25" required min="12" max="90" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">BERAT BADAN (KG) *</label>
                            <input type="number" name="weight" value="{{ $user->current_weight ?? 70 }}" required step="0.5" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                        </div>
                        <div>
                            <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">TINGGI BADAN (CM) *</label>
                            <input type="number" name="height" value="172" required step="1" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                        </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">TARGET UTAMA FITNESS *</label>
                        <select name="goal" required style="width: 100%; background: #060907; border: 1.5px solid #84cc16; border-radius: 0.65rem; padding: 0.65rem; color: #84cc16; font-weight: 900; outline: none;">
                            <option value="fat_loss">🔥 Pemangkasan Lemak &amp; Defisit Kalori (Fat Loss)</option>
                            <option value="muscle_gain">💪 Pembentukan Otot &amp; Surplus Kalori (Muscle Gain)</option>
                            <option value="maintenance">⚡ Pemeliharaan Kebugaran &amp; Stamina Tubuh</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">PENGALAMAN *</label>
                            <select name="level" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                                <option value="beginner">🌱 Pemula (Beginner)</option>
                                <option value="intermediate">🔥 Menengah</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">HARI LATIHAN *</label>
                            <select name="days" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                                <option value="3">3 Hari / Minggu</option>
                                <option value="4" selected>4 Hari / Minggu</option>
                                <option value="5">5 Hari / Minggu</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" id="generateBtn" class="btn glow-btn" style="width: 100%; background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #090d0b !important; border: none; padding: 0.95rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 0 25px rgba(132,204,22,0.4);">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> GENERATE RENCANA LATIHAN AI
                    </button>
                </form>
            </div>

            <!-- Right Column: AI Generated Output Display -->
            <div>
                <!-- Empty Placeholder State -->
                <div id="aiEmptyState" style="background: #0d1310; border: 1px dashed rgba(255,255,255,0.15); border-radius: 1.5rem; padding: 4rem 2rem; text-align: center; color: #94a3b8;">
                    <div style="width: 64px; height: 64px; background: rgba(132,204,22,0.1); border: 1px solid #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.8rem; margin: 0 auto 1.25rem;">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <h4 style="font-size: 1.2rem; font-weight: 900; color: white; margin-bottom: 0.35rem;">
                        Sistem AI Siap Menyusunkan Rencana Anda
                    </h4>
                    <p style="font-size: 0.875rem; margin: 0;">
                        Isi form data fisik di sebelah kiri lalu klik tombol "Generate Rencana Latihan AI" untuk melihat hasilnya.
                    </p>
                </div>

                <!-- AI Output Content Container (Hidden Initially) -->
                <div id="aiOutputContainer" style="display: none; flex-direction: column; gap: 1.5rem;">
                    
                    <!-- Metrics Summary Cards -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        <div style="background: #0d1310; border: 1.5px solid #84cc16; border-radius: 1.15rem; padding: 1.15rem; text-align: center;">
                            <span style="font-size: 0.725rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">TARGET KALORI</span>
                            <div style="font-size: 1.45rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;" id="outCalories">
                                2.100 kcal
                            </div>
                        </div>

                        <div style="background: #0d1310; border: 1.5px solid #0284c7; border-radius: 1.15rem; padding: 1.15rem; text-align: center;">
                            <span style="font-size: 0.725rem; color: #0284c7; font-weight: 800; text-transform: uppercase;">TARGET PROTEIN</span>
                            <div style="font-size: 1.45rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;" id="outProtein">
                                140g / Hari
                            </div>
                        </div>

                        <div style="background: #0d1310; border: 1.5px solid #8b5cf6; border-radius: 1.15rem; padding: 1.15rem; text-align: center;">
                            <span style="font-size: 0.725rem; color: #8b5cf6; font-weight: 800; text-transform: uppercase;">METABOLISME (TDEE)</span>
                            <div style="font-size: 1.45rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;" id="outTdee">
                                2.450 kcal
                            </div>
                        </div>
                    </div>

                    <!-- AI Workout Plan Box -->
                    <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem;">
                        <h4 style="font-size: 1.15rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-dumbbell"></i> AI Workout Schedule (Jadwal Latihan Mingguan)
                        </h4>
                        <div id="outWorkoutList" style="display: flex; flex-direction: column; gap: 1rem;"></div>
                    </div>

                    <!-- AI Meal Plan Box -->
                    <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem;">
                        <h4 style="font-size: 1.15rem; font-weight: 900; color: #0284c7; font-family: 'Outfit', sans-serif; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-utensils"></i> AI Nutrition &amp; Local Meal Plan (Rekomendasi Makanan)
                        </h4>
                        <div id="outMealList" style="display: flex; flex-direction: column; gap: 0.85rem;"></div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<script>
    function handleGenerateAiPlan(e) {
        e.preventDefault();
        const form = document.getElementById('aiPlannerForm');
        const btn = document.getElementById('generateBtn');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> AI Sedang Menganalisis...';

        fetch("{{ route('member.ai-planner.generate') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles"></i> GENERATE RENCANA LATIHAN AI';

            if (res.success) {
                const data = res.data;
                document.getElementById('aiEmptyState').style.display = 'none';
                document.getElementById('aiOutputContainer').style.display = 'flex';

                document.getElementById('outCalories').innerText = data.target_calories + ' kcal';
                document.getElementById('outProtein').innerText = data.target_protein + 'g / Hari';
                document.getElementById('outTdee').innerText = data.tdee + ' kcal';

                // Render Workout Schedule
                let wHtml = '';
                data.workout_plan.forEach(w => {
                    wHtml += `<div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1.15rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                            <strong style="color: #84cc16; font-size: 1rem;">${w.day}: ${w.focus}</strong>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 0.4rem;">`;
                    w.exercises.forEach(ex => {
                        wHtml += `<div style="display: flex; justify-content: space-between; font-size: 0.825rem; color: #cbd5e1; border-bottom: 1px dashed rgba(255,255,255,0.06); padding-bottom: 0.3rem;">
                            <span>🏋️ <strong>${ex.name}</strong></span>
                            <span>${ex.sets} x ${ex.reps} (Rest ${ex.rest})</span>
                        </div>`;
                    });
                    wHtml += `</div></div>`;
                });
                document.getElementById('outWorkoutList').innerHTML = wHtml;

                // Render Meal Plan
                let mHtml = '';
                Object.values(data.meal_plan).forEach(m => {
                    mHtml += `<div style="background: rgba(255,255,255,0.03); border-left: 4px solid #0284c7; padding: 1rem; border-radius: 0.75rem;">
                        <div style="font-weight: 800; color: white; font-size: 0.9rem; margin-bottom: 0.25rem;">${m.title} <span style="font-size: 0.75rem; color: #38bdf8;">(${m.est_calories} • ${m.est_protein})</span></div>
                        <div style="font-size: 0.825rem; color: #cbd5e1;">${m.menu}</div>
                    </div>`;
                });
                document.getElementById('outMealList').innerHTML = mHtml;

                // Smooth scroll to results
                document.getElementById('aiOutputContainer').scrollIntoView({ behavior: 'smooth' });
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles"></i> GENERATE RENCANA LATIHAN AI';
            alert('Terjadi kesalahan sistem saat memproses AI.');
        });
    }
</script>
@endsection
