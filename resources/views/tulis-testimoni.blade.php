@extends('layouts.app')

@section('title', 'Tulis Ulasan & Bagikan Pengalaman Latihan | FitLife Center Yogyakarta')
@section('meta_description', 'Bagikan testimoni & cerita inspiratif pengalaman latihan Anda bersama Personal Trainer FitLife Center Yogyakarta.')

@section('content')
<!-- Header Banner -->
<section style="background: linear-gradient(180deg, #090d0b 0%, #0d1310 100%); padding: 6rem 0 3rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="text-align: center; max-width: 800px;">
        <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.25rem;">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Suara & Transformasi Member FitLife</span>
        </div>
        <h1 style="font-size: 2.8rem; font-weight: 900; color: #ffffff; margin-bottom: 1rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
            Bagikan <span style="color: #84cc16;">Kisah Suksesmu</span>
        </h1>
        <p style="font-size: 1.1rem; color: #94a3b8; line-height: 1.7;">
            Ulasan dan pengalaman latihanmu sangat berharga untuk menginspirasi calon member lainnya dalam memulai gaya hidup sehat & bugar.
        </p>
    </div>
</section>

<!-- Form & Live Preview Section -->
<section style="background: #060907; padding: 4rem 0 6rem; color: white;">
    <div class="container">
        
        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 2.5rem; align-items: start;" class="grid-2">
            
            <!-- LEFT COLUMN: Interactive Form -->
            <div style="background: #0d1310; border: 1.5px solid rgba(255, 255, 255, 0.12); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
                
                <h3 style="font-size: 1.5rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.35rem;">
                    Formulir Ulasan Member
                </h3>
                <p style="font-size: 0.875rem; color: #94a3b8; margin-bottom: 2rem;">
                    Isi data ulasan di bawah ini. Ulasan yang dikirim akan langsung masuk ke sistem verifikasi Admin FitLife.
                </p>

                @if(session()->has('success'))
                    <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid #4ade80; color: #4ade80; padding: 1rem 1.25rem; border-radius: 1rem; font-size: 0.9rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.75rem;">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.3rem;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('testimoni.store') }}" method="POST">
                    @csrf

                    <!-- Rating Star Picker -->
                    <div style="margin-bottom: 1.75rem;">
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            PENILAIAN BINTANG (RATING) <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="hidden" name="rating" id="ratingInput" value="5">
                        
                        <div style="display: flex; gap: 0.6rem; color: #fbbf24; font-size: 2rem; cursor: pointer;" id="starPicker">
                            <i class="fa-solid fa-star" data-val="1" onclick="setStarRating(1)" onmouseover="hoverStarRating(1)" onmouseout="resetStarHover()"></i>
                            <i class="fa-solid fa-star" data-val="2" onclick="setStarRating(2)" onmouseover="hoverStarRating(2)" onmouseout="resetStarHover()"></i>
                            <i class="fa-solid fa-star" data-val="3" onclick="setStarRating(3)" onmouseover="hoverStarRating(3)" onmouseout="resetStarHover()"></i>
                            <i class="fa-solid fa-star" data-val="4" onclick="setStarRating(4)" onmouseover="hoverStarRating(4)" onmouseout="resetStarHover()"></i>
                            <i class="fa-solid fa-star" data-val="5" onclick="setStarRating(5)" onmouseover="hoverStarRating(5)" onmouseout="resetStarHover()"></i>
                        </div>
                        <span style="font-size: 0.8rem; color: #84cc16; font-weight: 700; margin-top: 0.35rem; display: block;" id="starLabel">5.0 - Sangat Puas & Memuaskan!</span>
                    </div>

                    <!-- Input Nama -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            NAMA LENGKAP MEMBER <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="name" id="inputName" required placeholder="Contoh: Rian Pratama" oninput="updateLivePreview()" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.85rem 1.15rem; border-radius: 0.85rem; color: white; font-size: 0.95rem; outline: none;" onfocus="this.style.borderColor='#84cc16'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                    </div>

                    <!-- Select Program -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            PROGRAM YANG DIIKUTI
                        </label>
                        <select name="program_name" id="inputProgram" onchange="updateLivePreview()" style="width: 100%; background: #0f172a; border: 1px solid rgba(255,255,255,0.15); padding: 0.85rem 1.15rem; border-radius: 0.85rem; color: white; font-size: 0.95rem; outline: none;">
                            <option value="1-on-1 Personal Training">1-on-1 Personal Training Privat</option>
                            <option value="Weight Loss & Fat Burn">Weight Loss & Fat Burning</option>
                            <option value="Muscle Building & Shaping">Muscle Building & Body Shaping</option>
                            <option value="Female Fitness & Body Shaping">Female Fitness & Body Shaping</option>
                            <option value="Persiapan Fisik TNI-POLRI">Persiapan Fisik TNI / POLRI</option>
                            <option value="Posture Correction & Rehab">Posture Correction & Rehab</option>
                        </select>
                    </div>

                    <!-- Weight Loss Stats (Optional) -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.4rem;">
                                BERAT AWAL (KG)
                            </label>
                            <input type="text" name="before_weight" id="inputBeforeWeight" placeholder="Misal: 82 kg" oninput="updateLivePreview()" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem 1rem; border-radius: 0.75rem; color: white; font-size: 0.9rem; outline: none;">
                        </div>
                        <div>
                            <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.4rem;">
                                BERAT SEKARANG (KG)
                            </label>
                            <input type="text" name="after_weight" id="inputAfterWeight" placeholder="Misal: 73 kg" oninput="updateLivePreview()" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem 1rem; border-radius: 0.75rem; color: white; font-size: 0.9rem; outline: none;">
                        </div>
                    </div>

                    <!-- Review Textarea -->
                    <div style="margin-bottom: 2rem;">
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            ULASAN & PENGALAMAN LATIHAN <span style="color: #ef4444;">*</span>
                        </label>
                        <textarea name="review" id="inputReview" rows="5" required placeholder="Ceritakan bagaimana pengalaman latihanmu, keramahan trainer, serta hasil transformasi yang kamu dapatkan di FitLife Center..." oninput="updateLivePreview()" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.85rem 1.15rem; border-radius: 0.85rem; color: white; font-size: 0.95rem; outline: none; line-height: 1.6;" onfocus="this.style.borderColor='#84cc16'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.95rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Kirim Ulasan Testimoni</span>
                    </button>

                </form>

            </div>

            <!-- RIGHT COLUMN: Real-Time Live Preview Card -->
            <div>
                <div style="position: sticky; top: 100px;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #84cc16; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">
                        <i class="fa-solid fa-eye"></i> Live Preview Ulasan Anda
                    </div>

                    <div style="background: #0d1310; border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.7), 0 0 25px rgba(132,204,22,0.25);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.25rem;">
                            <div style="display: flex; align-items: center; gap: 0.85rem;">
                                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #84cc16 0%, #4d7c0f 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-weight: 900; font-size: 1.25rem;">
                                    <i class="fa-solid fa-user-check"></i>
                                </div>
                                <div>
                                    <h4 style="font-size: 1.15rem; font-weight: 900; color: #ffffff; margin: 0;" id="previewName">Rian Pratama</h4>
                                    <div style="font-size: 0.8rem; color: #84cc16; font-weight: 700;" id="previewProgram">1-on-1 Personal Training</div>
                                </div>
                            </div>
                            <div style="color: #fbbf24; font-size: 0.9rem;" id="previewStars">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                        <!-- Transformation Badge (If entered) -->
                        <div id="previewWeightBadge" style="background: rgba(34, 197, 94, 0.15); border: 1px solid #4ade80; color: #4ade80; padding: 0.4rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; display: inline-flex; align-items: center; gap: 0.35rem; margin-bottom: 1rem;">
                            <i class="fa-solid fa-weight-scale"></i>
                            <span id="previewWeightText">Hasil: 82 kg ➔ 73 kg (Turun 9 kg)</span>
                        </div>

                        <p style="color: #cbd5e1; font-size: 0.925rem; line-height: 1.6; font-style: italic; margin-bottom: 1.25rem;" id="previewReview">
                            "Pelatih sangat sabar & profesional. Gerakan diajarkan dari nol dengan teknik aman tanpa cedera. Hasilnya badan terasa jauh lebih bugar dan lemak perut pangkas banyak!"
                        </p>

                        <div style="font-size: 0.75rem; color: #64748b; font-weight: 700; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 0.85rem; display: flex; justify-content: space-between;">
                            <span>Status: Verified Member</span>
                            <span>FitLife Center Jogja</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Interactive Rating & Live Preview JavaScript -->
<script>
    let currentRating = 5;

    function setStarRating(val) {
        currentRating = val;
        document.getElementById('ratingInput').value = val;
        renderStars(val);

        const labels = {
            1: '1.0 - Buruk',
            2: '2.0 - Cukup',
            3: '3.0 - Baik',
            4: '4.0 - Sangat Baik & Bagus!',
            5: '5.0 - Sangat Puas & Memuaskan!'
        };
        document.getElementById('starLabel').innerText = labels[val] || '';
    }

    function hoverStarRating(val) {
        renderStars(val);
    }

    function resetStarHover() {
        renderStars(currentRating);
    }

    function renderStars(count) {
        const stars = document.querySelectorAll('#starPicker i');
        stars.forEach((star, index) => {
            if (index < count) {
                star.style.color = '#fbbf24';
            } else {
                star.style.color = '#334155';
            }
        });

        // Update preview stars
        let previewHtml = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= count) {
                previewHtml += '<i class="fa-solid fa-star"></i>';
            } else {
                previewHtml += '<i class="fa-regular fa-star" style="color:#475569"></i>';
            }
        }
        document.getElementById('previewStars').innerHTML = previewHtml;
    }

    function updateLivePreview() {
        const name = document.getElementById('inputName').value.trim();
        const program = document.getElementById('inputProgram').value;
        const beforeW = document.getElementById('inputBeforeWeight').value.trim();
        const afterW = document.getElementById('inputAfterWeight').value.trim();
        const review = document.getElementById('inputReview').value.trim();

        document.getElementById('previewName').innerText = name ? name : 'Rian Pratama';
        document.getElementById('previewProgram').innerText = program;
        document.getElementById('previewReview').innerText = review ? '"' + review + '"' : '"Pelatih sangat sabar & profesional. Gerakan diajarkan dari nol dengan teknik aman..."';

        const weightBadge = document.getElementById('previewWeightBadge');
        if (beforeW || afterW) {
            weightBadge.style.display = 'inline-flex';
            document.getElementById('previewWeightText').innerText = `Hasil: ${beforeW || '-'} kg ➔ ${afterW || '-'} kg`;
        } else {
            weightBadge.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        setStarRating(5);
        updateLivePreview();
    });
</script>
@endsection
