@extends('layouts.app')

@section('title', 'Quiz Cari Program Fitness Ideal | FitLife Center Yogyakarta')
@section('meta_description', 'Temukan program latihan & Personal Trainer FitLife yang 100% pas dengan target kebugaranmu hanya dalam 3 langkah cepat!')

@section('content')
<!-- Header Banner -->
<section style="background: linear-gradient(180deg, #090d0b 0%, #0d1310 100%); padding: 6rem 0 3rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="text-align: center; max-width: 800px;">
        <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.25rem;">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
            <span>FitFinder Quiz 3-Langkah</span>
        </div>
        <h1 style="font-size: 2.8rem; font-weight: 900; color: #ffffff; margin-bottom: 1rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
            Cari Program Fitness <span style="color: #84cc16;">Paling Pas</span>
        </h1>
        <p style="font-size: 1.1rem; color: #94a3b8; line-height: 1.7;">
            Jawab 3 pertanyaan singkat di bawah ini dan dapatkan rekomendasi program latihan + Personal Trainer yang 100% cocok untukmu!
        </p>
    </div>
</section>

<!-- Quiz Wizard Section -->
<section style="background: #060907; padding: 4rem 0 6rem; color: white; min-height: 600px;">
    <div class="container" style="max-width: 850px;">
        
        <!-- Progress Bar Indicator -->
        <div style="margin-bottom: 2.5rem;" id="progressContainer">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                <span style="font-weight: 800; font-size: 0.875rem; color: #84cc16; text-transform: uppercase; letter-spacing: 1px;" id="progressStepText">Langkah 1 dari 3</span>
                <span style="font-weight: 900; font-size: 0.95rem; color: #ffffff;" id="progressPercentText">33% Completed</span>
            </div>
            <div style="width: 100%; height: 10px; background: rgba(255,255,255,0.08); border-radius: 99px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
                <div id="progressBarFill" style="width: 33%; height: 100%; background: linear-gradient(90deg, #84cc16 0%, #a3e635 100%); border-radius: 99px; transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1);"></div>
            </div>
        </div>

        <!-- STEP 1: Target Utama -->
        <div id="quizStep1" class="quiz-step-card" style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.75rem; padding: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-size: 0.8rem; font-weight: 800; padding: 0.35rem 0.9rem; border-radius: 99px; text-transform: uppercase;">Langkah 1</span>
                <h3 style="font-size: 1.8rem; font-weight: 900; color: #ffffff; margin-top: 0.6rem; font-family: 'Outfit', sans-serif;">Apa Target Utama Kebugaranmu Saat Ini?</h3>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 0.35rem;">Pilih satu tujuan utama yang paling ingin kamu capai.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                <button type="button" class="quiz-option-btn" onclick="selectStep1('fat_loss', 'Weight Loss & Fat Burning')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.5rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease;">
                    <div style="width: 48px; height: 48px; background: rgba(132, 204, 22, 0.15); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.35rem; margin-bottom: 1rem;">
                        <i class="fa-solid fa-fire-flame-curved"></i>
                    </div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.35rem;">Turun Berat & Bakar Lemak</div>
                    <div style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5;">Pangkas lemak perut & kurangi BB dengan pendampingan kalori.</div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep1('muscle', 'Muscle Building & Hypertrophy')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.5rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease;">
                    <div style="width: 48px; height: 48px; background: rgba(56, 189, 248, 0.15); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #38bdf8; font-size: 1.35rem; margin-bottom: 1rem;">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.35rem;">Bentuk Otot & Naikkan Berat</div>
                    <div style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5;">Tambah massa otot bersih dan bentuk dada, bahu & lengan.</div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep1('female', 'Female Fitness & Body Shaping')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.5rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease;">
                    <div style="width: 48px; height: 48px; background: rgba(244, 114, 182, 0.15); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #f472b6; font-size: 1.35rem; margin-bottom: 1rem;">
                        <i class="fa-solid fa-person-dress"></i>
                    </div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.35rem;">Kebugaran & Shaping Wanita</div>
                    <div style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5;">Kencangkan otot paha, pinggul, perut & privat female trainer.</div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep1('tni', 'Persiapan Fisik TNI POLRI & Calisthenics')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.5rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease;">
                    <div style="width: 48px; height: 48px; background: rgba(251, 191, 36, 0.15); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 1.35rem; margin-bottom: 1rem;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.35rem;">Tes Fisik TNI / POLRI</div>
                    <div style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5;">Latihan ketahanan push-up, pull-up, sit-up & stamina fisik.</div>
                </button>
            </div>
        </div>

        <!-- STEP 2: Pengalaman Gym -->
        <div id="quizStep2" class="quiz-step-card" style="display: none; background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.75rem; padding: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-size: 0.8rem; font-weight: 800; padding: 0.35rem 0.9rem; border-radius: 99px; text-transform: uppercase;">Langkah 2</span>
                <h3 style="font-size: 1.8rem; font-weight: 900; color: #ffffff; margin-top: 0.6rem; font-family: 'Outfit', sans-serif;">Sejauh Mana Pengalaman Olahragamu?</h3>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 0.35rem;">Bantu kami memahami tingkat kesiapan fisikmu.</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.15rem;">
                <button type="button" class="quiz-option-btn" onclick="selectStep2('beginner', 'Pemula Total (Belum Pernah Gym)')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.35rem 1.6rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease; display: flex; align-items: center; gap: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(132,204,22,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.2rem;">Pemula Total (Belum Pernah Gym)</div>
                        <div style="font-size: 0.85rem; color: #94a3b8;">Belum menguasai teknik alat & butuh bimbingan 100% aman dari nol.</div>
                    </div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep2('intermediate', 'Pernah Olahraga Tapi Kurang Konsisten')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.35rem 1.6rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease; display: flex; align-items: center; gap: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(56, 189, 248, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #38bdf8; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-person-running"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.2rem;">Pernah Olahraga Tapi Angin-anginan</div>
                        <div style="font-size: 0.85rem; color: #94a3b8;">Tahu dasar fitness tapi sering berhenti di tengah jalan karena bingung program.</div>
                    </div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep2('advanced', 'Sering Gym Tapi Hasil Stagnan')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.35rem 1.6rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease; display: flex; align-items: center; gap: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(251, 191, 36, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.2rem;">Sering Gym Tapi Hasil Stagnan</div>
                        <div style="font-size: 0.85rem; color: #94a3b8;">Pengalaman gym ada, butuh variasi beban & evaluasi nutrisi ketat dari Trainer.</div>
                    </div>
                </button>
            </div>
            
            <div style="margin-top: 1.75rem; text-align: left;">
                <button type="button" onclick="prevStep(1)" style="background: transparent; border: none; color: #94a3b8; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Langkah 1
                </button>
            </div>
        </div>

        <!-- STEP 3: Preferensi Pendampingan & Waktu -->
        <div id="quizStep3" class="quiz-step-card" style="display: none; background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.75rem; padding: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-size: 0.8rem; font-weight: 800; padding: 0.35rem 0.9rem; border-radius: 99px; text-transform: uppercase;">Langkah 3</span>
                <h3 style="font-size: 1.8rem; font-weight: 900; color: #ffffff; margin-top: 0.6rem; font-family: 'Outfit', sans-serif;">Bagaimana Gaya Pendampingan yang Kamu Sukai?</h3>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 0.35rem;">Pilih metode latihan yang paling cocok dengan ritme harimu.</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.15rem;">
                <button type="button" class="quiz-option-btn" onclick="selectStep3('private_pt', 'Privat 1-on-1 Personal Trainer')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.35rem 1.6rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease; display: flex; align-items: center; gap: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(132,204,22,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.2rem;">Privat 1-on-1 Personal Trainer</div>
                        <div style="font-size: 0.85rem; color: #94a3b8;">Fokus penuh didampingi trainer tiap sesi untuk hasil paling cepat & terukur.</div>
                    </div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep3('combo_pt', 'Bundling Sesi PT + Defisit Kalori')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.35rem 1.6rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease; display: flex; align-items: center; gap: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(56, 189, 248, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #38bdf8; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.2rem;">Bundling Sesi PT + Panduan Nutrisi</div>
                        <div style="font-size: 0.85rem; color: #94a3b8;">Kombinasi latihan beban + bimbingan menu makan harian tanpa rasa lapar berlebih.</div>
                    </div>
                </button>

                <button type="button" class="quiz-option-btn" onclick="selectStep3('gym_pass', 'Gym Pass Bulanan Mandiri')" style="background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.12); border-radius: 1.25rem; padding: 1.35rem 1.6rem; text-align: left; color: white; cursor: pointer; transition: all 0.25s ease; display: flex; align-items: center; gap: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(251, 191, 36, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <div style="font-weight: 900; font-size: 1.1rem; color: #ffffff; margin-bottom: 0.2rem;">Gym Pass Membership Mandiri</div>
                        <div style="font-size: 0.85rem; color: #94a3b8;">Akses bebas tanpa batas ke semua cabang & fasilitas FitLife Jogja.</div>
                    </div>
                </button>
            </div>

            <div style="margin-top: 1.75rem; text-align: left;">
                <button type="button" onclick="prevStep(2)" style="background: transparent; border: none; color: #94a3b8; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Langkah 2
                </button>
            </div>
        </div>

        <!-- RESULT SCREEN (Matched Program & Coach) -->
        <div id="quizResult" style="display: none; background: #0d1310; border: 1.5px solid #84cc16; border-radius: 1.75rem; padding: 2.5rem; box-shadow: 0 25px 50px rgba(132, 204, 22, 0.25); text-align: center;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132,204,22,0.15); border: 1px solid rgba(132,204,22,0.4); color: #84cc16; padding: 0.45rem 1.1rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; margin-bottom: 1.25rem;">
                <i class="fa-solid fa-circle-check"></i>
                <span id="matchPercentText">98% Perfect Match Found!</span>
            </div>

            <h2 style="font-size: 2.2rem; font-weight: 900; color: #ffffff; margin-bottom: 0.5rem; font-family: 'Outfit', sans-serif;">
                Program Terbaik Untukmu: <br>
                <span style="color: #84cc16;" id="resProgramName">Weight Loss & Fat Burning</span>
            </h2>

            <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.7; max-width: 650px; margin: 0.75rem auto 2rem;" id="resProgramDescription">
                Berdasarkan target & ritme fisikmu, kamu sangat cocok mengikuti bimbingan privat Personal Trainer dengan evaluasi komposisi lemak & otot berkala.
            </p>

            <!-- Quiz Summary Badge Row -->
            <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2rem;">
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 99px; font-size: 0.85rem; color: #94a3b8;" id="sumTargetBadge">🎯 Target: Fat Loss</div>
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 99px; font-size: 0.85rem; color: #94a3b8;" id="sumExpBadge">🌱 Level: Pemula</div>
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 99px; font-size: 0.85rem; color: #94a3b8;" id="sumMethodBadge">🤝 Metode: 1-on-1 PT</div>
            </div>

            <!-- Action Buttons Grid -->
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <button type="button" onclick="claimMatchedTrial()" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.9rem 2.2rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 0.6rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.5);">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Klaim Free Trial 7 Hari</span>
                </button>

                <a href="#" id="waQuizBtn" target="_blank" class="btn" style="background: #25d366; color: #ffffff; border: none; padding: 0.9rem 2rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 0.6rem; text-decoration: none; box-shadow: 0 0 20px rgba(37,211,102,0.4);">
                    <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i>
                    <span>Konsultasi Quiz via WA</span>
                </a>
            </div>

            <div style="margin-top: 2rem;">
                <button type="button" onclick="restartQuiz()" style="background: transparent; border: none; color: #94a3b8; font-size: 0.875rem; cursor: pointer; text-decoration: underline;">
                    <i class="fa-solid fa-rotate-left"></i> Ulangi Quiz Dari Awal
                </button>
            </div>
        </div>

    </div>
</section>

<!-- Quiz Interactive Script -->
<script>
    const quizState = {
        step1Key: '',
        step1Title: '',
        step2Key: '',
        step2Title: '',
        step3Key: '',
        step3Title: ''
    };

    function selectStep1(key, title) {
        quizState.step1Key = key;
        quizState.step1Title = title;
        
        document.getElementById('quizStep1').style.display = 'none';
        document.getElementById('quizStep2').style.display = 'block';
        
        document.getElementById('progressStepText').innerText = 'Langkah 2 dari 3';
        document.getElementById('progressPercentText').innerText = '66% Completed';
        document.getElementById('progressBarFill').style.width = '66%';
    }

    function selectStep2(key, title) {
        quizState.step2Key = key;
        quizState.step2Title = title;
        
        document.getElementById('quizStep2').style.display = 'none';
        document.getElementById('quizStep3').style.display = 'block';

        document.getElementById('progressStepText').innerText = 'Langkah 3 dari 3';
        document.getElementById('progressPercentText').innerText = '90% Completed';
        document.getElementById('progressBarFill').style.width = '90%';
    }

    function selectStep3(key, title) {
        quizState.step3Key = key;
        quizState.step3Title = title;

        document.getElementById('quizStep3').style.display = 'none';
        document.getElementById('progressContainer').style.display = 'none';
        document.getElementById('quizResult').style.display = 'block';

        calculateQuizResult();
    }

    function prevStep(targetStep) {
        if (targetStep === 1) {
            document.getElementById('quizStep2').style.display = 'none';
            document.getElementById('quizStep1').style.display = 'block';
            document.getElementById('progressStepText').innerText = 'Langkah 1 dari 3';
            document.getElementById('progressPercentText').innerText = '33% Completed';
            document.getElementById('progressBarFill').style.width = '33%';
        } else if (targetStep === 2) {
            document.getElementById('quizStep3').style.display = 'none';
            document.getElementById('quizStep2').style.display = 'block';
            document.getElementById('progressStepText').innerText = 'Langkah 2 dari 3';
            document.getElementById('progressPercentText').innerText = '66% Completed';
            document.getElementById('progressBarFill').style.width = '66%';
        }
    }

    function restartQuiz() {
        document.getElementById('quizResult').style.display = 'none';
        document.getElementById('progressContainer').style.display = 'block';
        document.getElementById('quizStep1').style.display = 'block';
        document.getElementById('progressStepText').innerText = 'Langkah 1 dari 3';
        document.getElementById('progressPercentText').innerText = '33% Completed';
        document.getElementById('progressBarFill').style.width = '33%';
    }

    function calculateQuizResult() {
        let progName = 'Weight Loss & Fat Burning Program';
        let progDesc = 'Program privat 1-on-1 bersama Personal Trainer tersertifikasi APKI untuk membakar lemak tubuh secara konsisten dengan pola makan terpandu.';
        let matchScore = '98% Perfect Match!';

        if (quizState.step1Key === 'female') {
            progName = 'Female Fitness & Body Shaping';
            progDesc = 'Program privat khusus wanita untuk merampingkan pinggang, mengencangkan otot paha & perut, serta menjaga bentuk tubuh ideal secara aman.';
            matchScore = '99% Perfect Match!';
        } else if (quizState.step1Key === 'tni') {
            progName = 'Persiapan Fisik TNI POLRI & Calisthenics';
            progDesc = 'Program latihan fisik intensif melatih ketahanan push-up, pull-up, sit-up & lari untuk lulus tes kesamaptaan fisik resmi.';
            matchScore = '97% Match!';
        } else if (quizState.step1Key === 'muscle') {
            progName = 'Muscle Building & Hypertrophy Program';
            progDesc = 'Program pembentukan massa otot bersih & kekuatan fisik terstruktur bagi pria/wanita yang ingin menaikkan berat badan ideal.';
            matchScore = '96% Match!';
        } else {
            progName = 'Weight Loss & Fat Burning Program';
            progDesc = 'Program penurunan berat badan terukur dengan kombinasi latihan beban + bimbingan defisit kalori harian.';
            matchScore = '98% Match!';
        }

        document.getElementById('resProgramName').innerText = progName;
        document.getElementById('resProgramDescription').innerText = progDesc;
        document.getElementById('matchPercentText').innerText = matchScore;

        document.getElementById('sumTargetBadge').innerText = '🎯 Target: ' + quizState.step1Title;
        document.getElementById('sumExpBadge').innerText = '🌱 Level: ' + quizState.step2Title;
        document.getElementById('sumMethodBadge').innerText = '🤝 Metode: ' + quizState.step3Title;

        // Build WhatsApp Message
        const waMsg = `Halo Admin FitLife Center Jogja, saya sudah mengisi FitFinder Quiz di Website:
- Target Utama: ${quizState.step1Title}
- Pengalaman: ${quizState.step2Title}
- Metode Pilihan: ${quizState.step3Title}

Rekomendasi Quiz: *${progName}*.
Saya berminat klaim Free Trial & konsultasi jadwal latihan. Mohon bantuannya!`;

        const waUrl = "https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=" + encodeURIComponent(waMsg);
        document.getElementById('waQuizBtn').href = waUrl;
    }

    function claimMatchedTrial() {
        const matchedName = document.getElementById('resProgramName').innerText;
        openTrialModal(matchedName);
    }
</script>
@endsection
