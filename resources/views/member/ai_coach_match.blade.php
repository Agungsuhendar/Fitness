@extends('layouts.app')

@section('title', 'AI Personal Trainer Matchmaker - FitLife Center')

@section('content')
<section style="padding: 3rem 0; background: #060907; color: white; min-height: 85vh;">
    <div class="container">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%); border: 1.5px solid #818cf8; border-radius: 1.5rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(99, 102, 241, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="background: rgba(255,255,255,0.2); color: white; padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(255,255,255,0.3); display: inline-block; margin-bottom: 0.5rem;">
                        🎯 AI MATCHMAKER ALGORITHM
                    </span>
                    <h2 style="font-size: 1.85rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem;">
                        AI Personal Trainer Matchmaker
                    </h2>
                    <p style="color: #e0e7ff; font-size: 0.925rem; margin: 0;">
                        Temukan Personal Trainer (Coach) terbaik yang paling cocok dengan preferensi, target fitness, dan jadwal Anda!
                    </p>
                </div>

                <a href="{{ route('member.dashboard') }}" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 0.65rem 1.25rem; border-radius: 0.75rem; font-weight: 800; text-decoration: none; font-size: 0.85rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;" class="grid-2">
            
            <!-- Assessment Form -->
            <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem;">
                <h3 style="font-size: 1.2rem; font-weight: 900; color: #818cf8; font-family: 'Outfit', sans-serif; margin-bottom: 1.25rem;">
                    🎯 Isikan Preferensi Pelatih Anda
                </h3>

                <form id="matchForm" onsubmit="handleFindCoach(event)">
                    @csrf
                    
                    <div style="margin-bottom: 1.15rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">PREFERENSI GENDER COACH *</label>
                        <select name="gender_pref" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                            <option value="any">🤝 Pria atau Wanita (Bebas)</option>
                            <option value="female">👩 Khusus Pelatih Wanita (Muslimah / Female Only)</option>
                            <option value="male">👨 Khusus Pelatih Pria</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 1.15rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">SPESIALISASI TARGET FITNESS *</label>
                        <select name="goal" style="width: 100%; background: #060907; border: 1.5px solid #818cf8; border-radius: 0.65rem; padding: 0.65rem; color: #818cf8; font-weight: 900; outline: none;">
                            <option value="fat_loss">🔥 Fat Loss &amp; Bimbingan Pemula Dewasa</option>
                            <option value="muscle">💪 Bodybuilding &amp; Pembentukan Otot</option>
                            <option value="posture">🧘 Koreksi Postur &amp; Keamanan Tulang Belakang</option>
                            <option value="tni_polri">👮 Persiapan Tes Fisik TNI / POLRI &amp; Kedinasan</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">PILIHAN JAM LATIHAN FAVORIT *</label>
                        <select name="time_slot" style="width: 100%; background: #060907; border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                            <option value="pagi">🌅 Pagi Hari (07:00 - 10:00 WIB)</option>
                            <option value="siang">☀️ Siang Hari (12:00 - 15:00 WIB)</option>
                            <option value="sore">🌆 Sore / Malam Hari (16:00 - 20:00 WIB)</option>
                        </select>
                    </div>

                    <button type="submit" id="matchBtn" class="btn glow-btn" style="width: 100%; background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%); color: white !important; border: none; padding: 0.9rem; border-radius: 0.85rem; font-weight: 900; font-size: 0.95rem; cursor: pointer;">
                        ✨ CARIKAN COACH TERBAIK SAYA
                    </button>
                </form>
            </div>

            <!-- Matches Display -->
            <div>
                <div id="matchPlaceholder" style="background: #0d1310; border: 1px dashed rgba(255,255,255,0.15); border-radius: 1.5rem; padding: 4rem 2rem; text-align: center; color: #94a3b8;">
                    <i class="fa-solid fa-user-astronaut" style="font-size: 2.5rem; color: #818cf8; margin-bottom: 1rem;"></i>
                    <h4 style="color: white; font-weight: 900; margin-bottom: 0.25rem;">AI Siap Mencari Match Coach</h4>
                    <p style="font-size: 0.85rem; margin: 0;">Isi form preferensi di kiri lalu klik tombol cari.</p>
                </div>

                <div id="matchResults" style="display: none; flex-direction: column; gap: 1rem;"></div>
            </div>

        </div>

    </div>
</section>

<script>
    function handleFindCoach(e) {
        e.preventDefault();
        const form = document.getElementById('matchForm');
        const btn = document.getElementById('matchBtn');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> AI Memadankan Data Coach...';

        fetch("{{ route('member.ai-coach-match.process') }}", {
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
            btn.innerHTML = '✨ CARIKAN COACH TERBAIK SAYA';

            if (res.success) {
                document.getElementById('matchPlaceholder').style.display = 'none';
                const container = document.getElementById('matchResults');
                container.style.display = 'flex';

                let html = '';
                res.matches.forEach(c => {
                    html += `<div style="background: #0d1310; border: 1.5px solid #818cf8; border-radius: 1.25rem; padding: 1.35rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                        <div>
                            <span style="background: rgba(129,140,248,0.2); color: #818cf8; font-size: 0.725rem; font-weight: 900; padding: 0.2rem 0.6rem; border-radius: 99px; border: 1px solid #818cf8;">🏆 MATCH SCORE ${c.match_score}%</span>
                            <h4 style="font-size: 1.15rem; font-weight: 900; color: white; margin: 0.4rem 0 0.2rem; font-family: 'Outfit', sans-serif;">${c.name}</h4>
                            <p style="font-size: 0.825rem; color: #cbd5e1; margin: 0;">Spesialisasi: ${c.specialty || 'Personal Trainer Sertifikasi'}</p>
                        </div>
                        <a href="${"{{ route('pelatih') }}"}" class="btn" style="background: #818cf8; color: #0f172a; padding: 0.6rem 1.15rem; border-radius: 0.65rem; font-weight: 900; font-size: 0.825rem; text-decoration: none;">Booking Sesi PT</a>
                    </div>`;
                });
                container.innerHTML = html;
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '✨ CARIKAN COACH TERBAIK SAYA';
            alert('Gagal memproses AI Matchmaker.');
        });
    }
</script>
@endsection
