@extends('layouts.app')

@section('title', 'AI Posture & Body Composition Vision Scanner - FitLife Center')

@section('content')
<section style="padding: 3rem 0; background: #060907; color: white; min-height: 85vh;">
    <div class="container">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: 1.5px solid #0284c7; border-radius: 1.5rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(2, 132, 199, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="background: rgba(2, 132, 199, 0.2); color: #38bdf8; padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid #0284c7; display: inline-block; margin-bottom: 0.5rem;">
                        📷 AI COMPUTER VISION ANALYZER
                    </span>
                    <h2 style="font-size: 1.85rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem;">
                        AI Posture &amp; Body Alignment Scanner
                    </h2>
                    <p style="color: #cbd5e1; font-size: 0.925rem; margin: 0;">
                        Unggah foto posisi berdiri Anda untuk analisis keseimbangan postur tubuh, tulang belakang, dan saran latihan korektif!
                    </p>
                </div>

                <a href="{{ route('member.dashboard') }}" class="btn" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 0.65rem 1.25rem; border-radius: 0.75rem; font-weight: 800; text-decoration: none; font-size: 0.85rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;" class="grid-2">
            
            <!-- Upload Box -->
            <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; font-weight: 900; color: #38bdf8; font-family: 'Outfit', sans-serif; margin-bottom: 1.25rem;">
                    📷 Unggah Foto Postur Tubuh
                </h3>

                <form id="visionForm" onsubmit="handleScanVision(event)" enctype="multipart/form-data">
                    @csrf
                    
                    <div style="margin-bottom: 1.25rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">SUDUT PENGAMBILAN FOTO *</label>
                        <select name="view_type" required style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                            <option value="front">🧍 Tampak Depan (Front View)</option>
                            <option value="side">🚶 Tampak Samping (Side View)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">PILIH FILE FOTO (JPG / PNG) *</label>
                        <input type="file" name="photo" accept="image/*" required style="width: 100%; background: #060907; border: 1px dashed #0284c7; border-radius: 0.65rem; padding: 1rem; color: white; font-size: 0.85rem;">
                    </div>

                    <button type="submit" id="visionBtn" class="btn glow-btn" style="width: 100%; background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); color: #090d0b !important; border: none; padding: 0.9rem; border-radius: 0.85rem; font-weight: 900; font-size: 0.95rem; cursor: pointer;">
                        📷 ANALISIS POSTUR DENGAN AI VISION
                    </button>
                </form>
            </div>

            <!-- Analysis Output -->
            <div>
                <div id="visionPlaceholder" style="background: #0d1310; border: 1px dashed rgba(255,255,255,0.15); border-radius: 1.5rem; padding: 4rem 2rem; text-align: center; color: #94a3b8;">
                    <i class="fa-solid fa-camera-retro" style="font-size: 2.5rem; color: #38bdf8; margin-bottom: 1rem;"></i>
                    <h4 style="color: white; font-weight: 900; margin-bottom: 0.25rem;">AI Computer Vision Siap Menganalisis</h4>
                    <p style="font-size: 0.85rem; margin: 0;">Unggah foto postur berdiri Anda untuk melihat hasil analisis.</p>
                </div>

                <div id="visionResults" style="display: none; flex-direction: column; gap: 1.25rem;">
                    
                    <div style="background: #0d1310; border: 1.5px solid #0284c7; border-radius: 1.25rem; padding: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4 style="font-size: 1.2rem; font-weight: 900; color: white; margin: 0;">Hasil Scanner Postur AI</h4>
                            <span style="background: rgba(56,189,248,0.2); color: #38bdf8; font-weight: 900; padding: 0.3rem 0.85rem; border-radius: 99px; border: 1px solid #0284c7;" id="outScore">SCORE 88/100</span>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.875rem; color: #cbd5e1;">
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed rgba(255,255,255,0.1); padding-bottom: 0.4rem;">
                                <span>Posisi Kepala &amp; Leher:</span> <strong id="outHead" style="color: white;">-</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed rgba(255,255,255,0.1); padding-bottom: 0.4rem;">
                                <span>Simetri Bahu Kiri-Kanan:</span> <strong id="outShoulder" style="color: white;">-</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed rgba(255,255,255,0.1); padding-bottom: 0.4rem;">
                                <span>Kelengkungan Tulang Belakang:</span> <strong id="outSpine" style="color: white;">-</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding-bottom: 0.4rem;">
                                <span>Keseimbangan Panggul (Pelvis):</span> <strong id="outPelvis" style="color: white;">-</strong>
                            </div>
                        </div>
                    </div>

                    <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.5rem;">
                        <h5 style="font-weight: 900; color: #84cc16; margin-bottom: 0.85rem; font-size: 1rem;">🏋️ AI Rekomendasi Latihan Koreksi Postur</h5>
                        <div id="outExercises" style="display: flex; flex-direction: column; gap: 0.65rem;"></div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<script>
    function handleScanVision(e) {
        e.preventDefault();
        const form = document.getElementById('visionForm');
        const btn = document.getElementById('visionBtn');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> AI Vision Memindai Postur...';

        fetch("{{ route('member.ai-vision.process') }}", {
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
            btn.innerHTML = '📷 ANALISIS POSTUR DENGAN AI VISION';

            if (res.success) {
                document.getElementById('visionPlaceholder').style.display = 'none';
                const container = document.getElementById('visionResults');
                container.style.display = 'flex';

                const d = res.data;
                document.getElementById('outScore').innerText = 'SCORE POSTUR ' + d.posture_score + '/100';
                document.getElementById('outHead').innerText = d.head_alignment;
                document.getElementById('outShoulder').innerText = d.shoulder_symmetry;
                document.getElementById('outSpine').innerText = d.spine_curvature;
                document.getElementById('outPelvis').innerText = d.pelvic_tilt;

                let exHtml = '';
                d.corrective_exercises.forEach(ex => {
                    exHtml += `<div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 0.85rem; border-radius: 0.65rem;">
                        <strong style="color: white; font-size: 0.875rem;">${ex.name} (${ex.sets})</strong>
                        <div style="font-size: 0.775rem; color: #94a3b8;">Tujuan: ${ex.purpose}</div>
                    </div>`;
                });
                document.getElementById('outExercises').innerHTML = exHtml;
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '📷 ANALISIS POSTUR DENGAN AI VISION';
            alert('Gagal memproses AI Vision.');
        });
    }
</script>
@endsection
