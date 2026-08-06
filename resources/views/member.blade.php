@extends('layouts.app')

@section('title', 'Portal Area Member & Fitur Eksklusif VIP | FitLife Center Yogyakarta')
@section('meta_description', 'Portal resmi member FitLife Center. Fitur eksklusif Workout Generator, Panduan Nutrisi & Defisit Kalori, AI FitBot CS, serta sisa sesi Personal Trainer.')

@section('content')
<!-- Login Auth Gate Container -->
<div id="memberAuthGate" style="display: block; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); padding: 3.5rem 0 5rem; color: white; min-height: 80vh;">
    <div class="container" style="max-width: 520px;">
        
        <div style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.75rem; padding: 2.5rem; box-shadow: 0 25px 60px rgba(0,0,0,0.8), 0 0 35px rgba(132, 204, 22, 0.15); text-align: center;">
            
            <div style="width: 72px; height: 72px; background: rgba(132, 204, 22, 0.12); border: 2px solid #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 2rem; margin: 0 auto 1.5rem; box-shadow: 0 0 20px rgba(132,204,22,0.3);">
                <i class="fa-solid fa-user-lock"></i>
            </div>

            <h2 style="font-size: 1.8rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.5rem;">
                Portal Area Member VIP
            </h2>
            <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.6; margin-bottom: 2rem;">
                Masukkan <strong>ID Member</strong> (contoh: <code>FL-MBR-7782</code>) atau <strong>Nomor WhatsApp</strong> Anda untuk membuka fitur eksklusif Workout, Nutrisi &amp; AI CS.
            </p>

            <form onsubmit="handleMemberLogin(event)">
                <div style="margin-bottom: 1.25rem; text-align: left;">
                    <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.45rem;">
                        ID MEMBER ATAU NO. WHATSAPP <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="position: relative;">
                        <input type="text" id="memberLoginInput" required placeholder="Contoh: FL-MBR-7782 atau 081234567890" value="FL-MBR-7782" style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.18); padding: 0.9rem 1.15rem 0.9rem 2.8rem; border-radius: 0.85rem; color: white; font-size: 0.95rem; outline: none; font-weight: 700;" onfocus="this.style.borderColor='#84cc16'" onblur="this.style.borderColor='rgba(255,255,255,0.18)'">
                        <i class="fa-solid fa-id-card" style="position: absolute; left: 1.1rem; top: 50%; transform: translateY(-50%); color: #84cc16;"></i>
                    </div>
                </div>

                <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.95rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; margin-bottom: 1.25rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk ke Portal Member</span>
                </button>

                <button type="button" onclick="doDemoLogin()" style="width: 100%; background: rgba(255,255,255,0.04); border: 1px dashed rgba(132,204,22,0.5); color: #84cc16; padding: 0.65rem; border-radius: 0.75rem; font-weight: 800; font-size: 0.8rem; cursor: pointer; margin-bottom: 1.75rem; transition: all 0.2s;">
                    ⚡ Klik Coba Demo Login (ID: FL-MBR-7782)
                </button>
            </form>

            <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.25rem; font-size: 0.85rem; color: #94a3b8;">
                Belum menjadi member FitLife Center? <br>
                <a href="javascript:void(0)" onclick="openRegistrationModal()" style="color: #84cc16; font-weight: 800; text-decoration: underline; margin-top: 0.35rem; display: inline-block;">
                    Daftar Member Baru Sekarang &amp; Klaim Diskon 🎟️
                </a>
            </div>

        </div>

    </div>
</div>

<!-- Logged In VIP Member Dashboard Container -->
<div id="memberDashboardContainer" style="display: none;">
    
    <!-- Top Header Banner & Member Card -->
    <section style="background: linear-gradient(180deg, #060907 0%, #0d1310 100%); padding: 3.5rem 0 3rem; color: white; border-bottom: 1px solid rgba(255,255,255,0.08); overflow: hidden;">
        <div class="container">
            
            <div style="display: grid; grid-template-columns: 1.15fr 1fr; gap: 2.5rem; align-items: center;" class="grid-2">
                
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                        <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem;">
                            <i class="fa-solid fa-crown"></i>
                            <span>VIP Exclusive Member Area</span>
                        </div>
                        <button onclick="handleMemberLogout()" style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; padding: 0.4rem 1rem; border-radius: 99px; font-size: 0.8rem; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem;">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar Member
                        </button>
                    </div>

                    <h1 style="font-size: 2.6rem; font-weight: 900; color: #ffffff; margin-bottom: 0.6rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
                        Selamat Datang, <span style="color: #84cc16;" id="displayMemberName">{{ $member->name }}</span>
                    </h1>
                    <p style="font-size: 1.05rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1.5rem;">
                        Gunakan tab di bawah untuk mengakses fitur eksklusif <strong>Workout Generator</strong>, <strong>Panduan Nutrisi</strong>, dan <strong>AI FitBot CS</strong>.
                    </p>
                </div>

                <!-- 3D VIP Card -->
                <div style="perspective: 1000px;">
                    <div class="vip-member-card" style="background: linear-gradient(135deg, #18261c 0%, #0d1310 40%, #09120b 100%); border: 2px solid #84cc16; border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(132, 204, 22, 0.25); position: relative; overflow: hidden; transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform-style: preserve-3d;" onmouseover="this.style.transform='rotateY(6deg) rotateX(-4deg) scale(1.02)'" onmouseout="this.style.transform='rotateY(0deg) rotateX(0deg) scale(1)'">
                        
                        <div style="position: absolute; right: -60px; top: -60px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(132, 204, 22, 0.25) 0%, rgba(0,0,0,0) 70%); border-radius: 50%; pointer-events: none;"></div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem; position: relative; z-index: 2;">
                            <img src="{{ asset('images/logo.png') }}" alt="FitLife VIP Logo" style="height: 36px; width: auto; filter: drop-shadow(0 0 8px rgba(132, 204, 22, 0.5));">
                            <div style="background: linear-gradient(135deg, #84cc16 0%, #a3e635 100%); color: #090d0b; font-weight: 900; font-size: 0.7rem; padding: 0.3rem 0.75rem; border-radius: 99px; letter-spacing: 1px;">
                                <i class="fa-solid fa-crown"></i> VIP ATHLETE PASS
                            </div>
                        </div>

                        <div style="margin-bottom: 1.25rem; position: relative; z-index: 2;">
                            <span style="font-size: 0.65rem; color: #94a3b8; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; display: block;">MEMBER ATHLETE NAME</span>
                            <div style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif;" id="cardMemberName">
                                {{ $member->name }}
                            </div>
                            <div style="font-family: monospace; font-size: 0.95rem; color: #84cc16; font-weight: 800; margin-top: 0.25rem;" id="cardMemberId">
                                8840 •••• •••• {{ substr($member->id, -4) }}
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid rgba(255,255,255,0.12); padding-top: 0.85rem; position: relative; z-index: 2;">
                            <div>
                                <div style="font-size: 0.75rem; color: #cbd5e1; font-weight: 700;">
                                    <span>{{ $member->branch }}</span>
                                </div>
                                <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 0.1rem;">
                                    Status: <strong style="color: #84cc16;">ACTIVE VIP</strong>
                                </div>
                            </div>
                            
                            <div onclick="openQrModal()" title="Klik untuk perbesar QR Code Check-in" style="background: #ffffff; padding: 0.3rem; border-radius: 0.65rem; border: 2px solid #84cc16; box-shadow: 0 0 15px rgba(132, 204, 22, 0.5); cursor: pointer; position: relative; overflow: hidden;">
                                <img id="cardQrImg" src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=http%3A%2F%2Ffitlifehub.site.je%2Fmember%3Fid%3DFL-MBR-7782&color=090d0b&bgcolor=ffffff" alt="Member VIP QR Code" style="width: 46px; height: 46px; display: block; border-radius: 4px;">
                                <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: #84cc16; animation: qrScanLaser 2.2s infinite ease-in-out;"></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- VIP MEMBER NAVIGATION TABS BAR -->
    <section style="background: #0d1310; border-bottom: 1.5px solid rgba(132, 204, 22, 0.3); padding: 0.85rem 0; sticky: top; z-index: 10;">
        <div class="container">
            <div style="display: flex; gap: 0.85rem; justify-content: center; flex-wrap: wrap;" id="memberTabNav">
                <button type="button" class="member-tab-btn active" onclick="switchMemberTab('status', this)" style="background: rgba(132, 204, 22, 0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    💳 Kartu &amp; Sisa Sesi PT
                </button>
                <button type="button" class="member-tab-btn" onclick="switchMemberTab('workout', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    ⚡ Generator Workout Harian
                </button>
                <button type="button" class="member-tab-btn" onclick="switchMemberTab('nutrition', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    🥗 Panduan Nutrisi &amp; Kalori
                </button>
                <button type="button" class="member-tab-btn" onclick="switchMemberTab('referral', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    🎁 Referral &amp; Bonus PT
                </button>
                <button type="button" class="member-tab-btn" onclick="switchMemberTab('hydration', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    💧 Tracker Hidrasi
                </button>
                <button type="button" class="member-tab-btn" onclick="switchMemberTab('evaluation', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    ⭐ Evaluasi Trainer
                </button>
                <button type="button" class="member-tab-btn" onclick="switchMemberTab('classes', this)" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;">
                    🧘‍♀️ Jadwal Kelas Group
                </button>
            </div>
        </div>
    </section>

    <!-- TAB 1: KARTU & SISA SESI PT -->
    <div id="memberTabStatus" class="member-tab-content" style="display: block; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 2rem; align-items: start;" class="grid-2">
                
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <!-- PT Session Counter -->
                    <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                            <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                                <i class="fa-solid fa-stopwatch" style="color: #84cc16;"></i> Sisa Sesi Personal Trainer
                            </h3>
                            <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; font-weight: 900; font-size: 0.85rem; padding: 0.35rem 0.85rem; border-radius: 99px;">
                                {{ $member->remaining_sessions }} Sesi Tersisa
                            </span>
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #94a3b8; font-weight: 700; margin-bottom: 0.5rem;">
                                <span>Progress Sesi Latihan</span>
                                <span>{{ $member->completed_sessions }} dari {{ $member->total_sessions }} Sesi Terpakai (33%)</span>
                            </div>
                            <div style="width: 100%; height: 14px; background: rgba(255,255,255,0.08); border-radius: 99px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
                                <div style="width: 33%; height: 100%; background: linear-gradient(90deg, #84cc16 0%, #a3e635 100%); border-radius: 99px;"></div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; text-align: center;">
                            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1rem;">
                                <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700;">TOTAL PAKET</span>
                                <div style="font-size: 1.5rem; font-weight: 900; color: #ffffff; margin-top: 0.2rem;">{{ $member->total_sessions }} Sesi</div>
                            </div>
                            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1rem;">
                                <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700;">SUDAH SELESAI</span>
                                <div style="font-size: 1.5rem; font-weight: 900; color: #38bdf8; margin-top: 0.2rem;">{{ $member->completed_sessions }} Sesi</div>
                            </div>
                            <div style="background: rgba(132,204,22,0.1); border: 1.5px solid #84cc16; border-radius: 1rem; padding: 1rem;">
                                <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800;">SISA TERSISA</span>
                                <div style="font-size: 1.5rem; font-weight: 900; color: #84cc16; margin-top: 0.2rem;">{{ $member->remaining_sessions }} Sesi</div>
                            </div>
                        </div>

                        <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Coach Hendra, saya mau reservasi jadwal sesi PT berikutnya untuk ID ' . $member->id) }}" target="_blank" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.85rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; text-decoration: none; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                            <i class="fa-solid fa-calendar-plus"></i>
                            <span>Jadwalkan Sesi PT Berikutnya</span>
                        </a>
                    </div>

                    <!-- InBody Progress -->
                    <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
                        <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.5rem;">
                            <i class="fa-solid fa-chart-line" style="color: #84cc16;"></i> Progres Transformasi Fisik (InBody)
                        </h3>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <span style="font-size: 0.8rem; color: #94a3b8; font-weight: 700;">BERAT BADAN</span>
                                    <span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; font-size: 0.75rem; font-weight: 900; padding: 0.15rem 0.5rem; border-radius: 99px;">TURUN 8.5 KG</span>
                                </div>
                                <div style="font-size: 1.8rem; font-weight: 900; color: #ffffff; margin-bottom: 0.35rem;">
                                    {{ $member->current_weight }} <span style="font-size: 1rem; color: #94a3b8;">kg</span>
                                </div>
                                <div style="font-size: 0.775rem; color: #94a3b8;">
                                    Awal: <strong style="color: white;">{{ $member->initial_weight }} kg</strong> • Target: <strong style="color: #84cc16;">{{ $member->target_weight }} kg</strong>
                                </div>
                            </div>

                            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <span style="font-size: 0.8rem; color: #94a3b8; font-weight: 700;">BODY FAT (%)</span>
                                    <span style="background: rgba(56, 189, 248, 0.2); color: #38bdf8; font-size: 0.75rem; font-weight: 900; padding: 0.15rem 0.5rem; border-radius: 99px;">TURUN 7.3%</span>
                                </div>
                                <div style="font-size: 1.8rem; font-weight: 900; color: #38bdf8; margin-bottom: 0.35rem;">
                                    {{ $member->current_bodyfat }}%
                                </div>
                                <div style="font-size: 0.775rem; color: #94a3b8;">
                                    Massa Otot: <strong style="color: #84cc16;">{{ $member->muscle_mass }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <!-- Assigned Coach -->
                    <div style="background: #0d1310; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 1.5rem; padding: 2rem;">
                        <h3 style="font-size: 1.35rem; font-weight: 800; color: #ffffff; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-user-check" style="color: #84cc16;"></i> Personal Trainer Anda
                        </h3>

                        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; padding: 1.25rem; margin-bottom: 1.35rem;">
                            <div style="font-weight: 900; font-size: 1.15rem; color: #ffffff; margin-bottom: 0.25rem;">
                                {{ $member->assigned_coach }}
                            </div>
                            <div style="font-size: 0.85rem; color: #84cc16; font-weight: 700;">
                                Specialist Weight Loss &amp; Posture Correction
                            </div>
                        </div>

                        <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Coach Hendra, saya mau konsultasi jadwal latihan.') }}" target="_blank" class="btn" style="width: 100%; background: #25d366; color: #ffffff; border: none; padding: 0.85rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; text-decoration: none;">
                            <i class="fa-brands fa-whatsapp"></i> Chat Trainer Saya via WA
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- TAB 2: WORKOUT GENERATOR -->
    <div id="memberTabWorkout" class="member-tab-content" style="display: none; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container" style="max-width: 900px;">
            
            <div style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                    <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.25rem;">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                        Generator Jadwal Latihan Harian VIP
                    </h3>
                </div>
                <p style="color: #94a3b8; font-size: 0.95rem; margin-bottom: 1.75rem;">
                    Pilih target &amp; level kebugaran Anda untuk menghasilkan program latihan harian terstruktur dengan rekomendasi set, repetisi, dan instruksi teknik.
                </p>

                <!-- Selectors Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.75rem;" class="grid-2">
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            TARGET UTAMA LATIHAN
                        </label>
                        <select id="workoutGoalSelect" style="width: 100%; background: #0f172a; border: 1px solid rgba(255,255,255,0.18); padding: 0.85rem; border-radius: 0.85rem; color: white; font-size: 0.95rem; outline: none; font-weight: 700;">
                            <option value="fat_loss">🔥 Weight Loss &amp; Fat Burning</option>
                            <option value="muscle">💪 Muscle Building &amp; Hypertrophy</option>
                            <option value="female">🌸 Female Body Shaping (Bohay &amp; Abs)</option>
                            <option value="tni">🛡️ Tes Fisik &amp; Stamina TNI-POLRI</option>
                        </select>
                    </div>

                    <div>
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            LEVEL KEBUGARAN
                        </label>
                        <select id="workoutLevelSelect" style="width: 100%; background: #0f172a; border: 1px solid rgba(255,255,255,0.18); padding: 0.85rem; border-radius: 0.85rem; color: white; font-size: 0.95rem; outline: none; font-weight: 700;">
                            <option value="pemula">🌱 Pemula (0 - 3 Bulan)</option>
                            <option value="menengah">🔥 Menengah (3 - 12 Bulan)</option>
                            <option value="mahir">⚡ Mahir (&gt; 1 Tahun)</option>
                        </select>
                    </div>
                </div>

                <button type="button" onclick="generateWorkoutRoutine()" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.95rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <span>Generate Program Latihan Hari Ini</span>
                </button>
            </div>

            <!-- Workout Results Table Container -->
            <div id="workoutResultBox" style="display: none; background: #0d1310; border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 25px 50px rgba(0,0,0,0.8);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 1rem;">
                    <div>
                        <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">HASIL PROGRAM DISESUAIKAN</span>
                        <h4 style="font-size: 1.4rem; font-weight: 900; color: white; margin: 0.2rem 0 0;" id="workoutResultTitle">Program Fat Loss Harian</h4>
                    </div>
                    <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-weight: 800; font-size: 0.85rem; padding: 0.35rem 0.85rem; border-radius: 99px;" id="workoutResultBadge">
                        45 Menit • 4 Gerakan
                    </span>
                </div>

                <div style="overflow-x: auto; margin-bottom: 1.5rem;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="background: rgba(255,255,255,0.05); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                                <th style="padding: 0.85rem 1rem; border-radius: 0.5rem 0 0 0.5rem;">GERAKAN LATIHAN</th>
                                <th style="padding: 0.85rem 1rem;">SET x REPETISI</th>
                                <th style="padding: 0.85rem 1rem;">ISTIRAHAT</th>
                                <th style="padding: 0.85rem 1rem; border-radius: 0 0.5rem 0.5rem 0;">INSTRUKSI KUNCI</th>
                            </tr>
                        </thead>
                        <tbody id="workoutTableBody" style="color: #cbd5e1;">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>

                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1rem; font-size: 0.85rem; color: #94a3b8; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                    <span>💡 <strong>Tips Trainer:</strong> Pastikan pemanasan 5 menit sebelum latihan &amp; jaga hidrasi air putih!</span>
                    <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text={{ urlencode('Halo Coach Hendra, saya mau tanya panduan gerakan program latihan harian ini.') }}" target="_blank" style="color: #84cc16; font-weight: 800; text-decoration: none;">
                        Tanyakan Teknik ke Trainer WA ➔
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 3: PANDUAN NUTRISI -->
    <div id="memberTabNutrition" class="member-tab-content" style="display: none; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container" style="max-width: 900px;">
            
            <div style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.25rem;">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                            Target Nutrisi &amp; Defisit Kalori Harian
                        </h3>
                        <span style="font-size: 0.85rem; color: #84cc16; font-weight: 700;">Disesuaikan dengan Berat Badan {{ $member->current_weight }} kg</span>
                    </div>
                </div>

                <!-- Macro Breakdown Cards Grid -->
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; text-align: center;" class="grid-2">
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1.15rem;">
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">TARGET KALORI</span>
                        <div style="font-size: 1.5rem; font-weight: 900; color: #84cc16; margin-top: 0.2rem;">1,750 <span style="font-size: 0.8rem;">kcal</span></div>
                    </div>
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1.15rem;">
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">PROTEIN (35%)</span>
                        <div style="font-size: 1.5rem; font-weight: 900; color: #38bdf8; margin-top: 0.2rem;">140 <span style="font-size: 0.8rem;">gram</span></div>
                    </div>
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1.15rem;">
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">KARBO (45%)</span>
                        <div style="font-size: 1.5rem; font-weight: 900; color: #fbbf24; margin-top: 0.2rem;">185 <span style="font-size: 0.8rem;">gram</span></div>
                    </div>
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1.15rem;">
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">LEMAK (20%)</span>
                        <div style="font-size: 1.5rem; font-weight: 900; color: #f472b6; margin-top: 0.2rem;">42 <span style="font-size: 0.8rem;">gram</span></div>
                    </div>
                </div>

                <h4 style="font-size: 1.2rem; font-weight: 800; color: white; font-family: 'Outfit', sans-serif; margin-bottom: 1rem;">
                    🥗 Rekomendasi Menu Sehat Harian Lokal Jogja
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">
                    <!-- Menu 1 -->
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <div style="font-size: 0.75rem; color: #84cc16; font-weight: 800; margin-bottom: 0.35rem;">🍳 MAKAN PAGI</div>
                        <h5 style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0 0 0.35rem;">Omelet 3 Telur &amp; Oatmeal</h5>
                        <p style="font-size: 0.825rem; color: #94a3b8; margin: 0; line-height: 1.5;">
                            3 telur utuh/putih + 50g oatmeal + pisang ambon. <br>
                            <strong style="color: #84cc16;">~ 410 kcal • 28g Protein</strong>
                        </p>
                    </div>

                    <!-- Menu 2 -->
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <div style="font-size: 0.75rem; color: #38bdf8; font-weight: 800; margin-bottom: 0.35rem;">🍗 MAKAN SIANG</div>
                        <h5 style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0 0 0.35rem;">Nasi Merah Dada Ayam Panggang</h5>
                        <p style="font-size: 0.825rem; color: #94a3b8; margin: 0; line-height: 1.5;">
                            150g dada ayam + 100g nasi merah + tumis buncis. <br>
                            <strong style="color: #38bdf8;">~ 520 kcal • 48g Protein</strong>
                        </p>
                    </div>

                    <!-- Menu 3 -->
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <div style="font-size: 0.75rem; color: #fbbf24; font-weight: 800; margin-bottom: 0.35rem;">🐟 MAKAN MALAM</div>
                        <h5 style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0 0 0.35rem;">Ikan Bakar &amp; Gado-Gado Telur</h5>
                        <p style="font-size: 0.825rem; color: #94a3b8; margin: 0; line-height: 1.5;">
                            150g filet ikan/tahu tempe + sayuran rebus. <br>
                            <strong style="color: #fbbf24;">~ 390 kcal • 35g Protein</strong>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- TAB 4: REFERRAL SYSTEM & BONUS PT -->
    <div id="memberTabReferral" class="member-tab-content" style="display: none; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container" style="max-width: 900px;">
            
            <div style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                    <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.25rem;">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                            Program Referral &amp; Bonus Sesi PT Gratis
                        </h3>
                        <span style="font-size: 0.85rem; color: #84cc16; font-weight: 700;">Ajak Teman Bergabung • Anda &amp; Teman Dapat Extra 2 Sesi PT Gratis!</span>
                    </div>
                </div>

                <!-- Referral Code Display Card -->
                <div style="background: linear-gradient(135deg, rgba(132,204,22,0.12) 0%, rgba(13,19,16,0.9) 100%); border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap;">
                    <div>
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">KODE REFERRAL UNIK ANDA</span>
                        <div style="font-size: 1.8rem; font-weight: 900; color: #84cc16; font-family: monospace; letter-spacing: 2px; margin-top: 0.2rem;" id="memberReferralCodeDisplay">
                            FL-REF-7782
                        </div>
                        <div style="font-size: 0.8rem; color: #cbd5e1; margin-top: 0.25rem;">
                            Link: <code style="color: #84cc16;" id="memberReferralLinkDisplay">http://fitlifehub.site.je/?ref=FL-REF-7782</code>
                        </div>
                    </div>

                    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                        <button type="button" onclick="copyReferralLink()" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.75rem 1.25rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; cursor: pointer;">
                            <i class="fa-regular fa-copy"></i> Salin Link
                        </button>
                        <a id="shareWaBtn" href="https://wa.me/?text={{ urlencode('Halo! Yuk gabung gym privat di FitLife Center Jogja dengan kode referral saya FL-REF-7782 & dapatkan diskon 15% + Extra 2 Sesi PT Gratis! Daftar di sini: http://fitlifehub.site.je/?ref=FL-REF-7782') }}" target="_blank" class="btn glow-btn" style="background: #25d366; color: white; border: none; padding: 0.75rem 1.4rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 15px rgba(37,211,102,0.4);">
                            <i class="fa-brands fa-whatsapp" style="font-size: 1.1rem;"></i> Bagikan ke WA
                        </a>
                    </div>
                </div>

                <!-- Referral Reward Stats -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; text-align: center;" class="grid-2">
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">TEMAN BERGABUNG</span>
                        <div style="font-size: 1.8rem; font-weight: 900; color: #ffffff; margin-top: 0.25rem;">3 Orang</div>
                    </div>
                    <div style="background: rgba(132,204,22,0.1); border: 1.5px solid #84cc16; border-radius: 1.15rem; padding: 1.25rem;">
                        <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800;">BONUS PT TERKLAIM</span>
                        <div style="font-size: 1.8rem; font-weight: 900; color: #84cc16; margin-top: 0.25rem;">+6 Sesi Gratis</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 800;">STATUS BONUS</span>
                        <div style="font-size: 1.1rem; font-weight: 900; color: #38bdf8; margin-top: 0.45rem;">Aktif Klaim</div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- TAB 5: TRACKER HIDRASI HARIAN -->
    <div id="memberTabHydration" class="member-tab-content" style="display: none; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container" style="max-width: 900px;">
            
            <div style="background: #0d1310; border: 1.5px solid rgba(56, 189, 248, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(56, 189, 248, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #38bdf8; font-size: 1.25rem;">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                                Tracker Hidrasi Air Putih Harian
                            </h3>
                            <span style="font-size: 0.85rem; color: #38bdf8; font-weight: 700;">Target Hidrasi Optimum: 3.1 Liter / Hari (~12 Gelas)</span>
                        </div>
                    </div>

                    <span style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; font-weight: 900; font-size: 0.9rem; padding: 0.45rem 1.15rem; border-radius: 99px; border: 1px solid rgba(56,189,248,0.4);" id="hydrationProgressText">
                        8 dari 12 Gelas (2.0L / 3.1L)
                    </span>
                </div>

                <!-- Interactive Glass Checklist Grid -->
                <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem; margin-bottom: 1.75rem; text-align: center;" id="hydrationGlassesGrid" class="grid-2">
                    <!-- Populated via JS / Rendered dynamically -->
                </div>

                <div style="background: rgba(56,189,248,0.08); border: 1px solid rgba(56,189,248,0.3); border-radius: 1rem; padding: 1rem; font-size: 0.85rem; color: #cbd5e1; display: flex; align-items: center; gap: 0.65rem;">
                    <i class="fa-solid fa-circle-info" style="color: #38bdf8; font-size: 1.2rem;"></i>
                    <span><strong>Tips Hidrasi:</strong> Klik ikon gelas di atas setiap kali Anda selesai minum 1 gelas air putih (250ml) untuk mencatat progres minum harian!</span>
                </div>

            </div>

        </div>
    </div>

    <!-- TAB 6: EVALUASI TRAINER & RATING SESI -->
    <div id="memberTabEvaluations" class="member-tab-content" style="display: none; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container" style="max-width: 900px;">
            
            <div style="background: #0d1310; border: 1.5px solid rgba(251, 191, 36, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(251, 191, 36, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 1.25rem;">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                                Evaluasi &amp; Rating Sesi Personal Trainer
                            </h3>
                            <span style="font-size: 0.85rem; color: #fbbf24; font-weight: 700;">Trainer Pendamping: Coach Hendra Wijaya (4.9 ★★★★★)</span>
                        </div>
                    </div>
                </div>

                <!-- Star Rating Interactive Selector Card -->
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 1.75rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">BERIKAN RATING SESI LATIHAN HARI INI</span>
                    
                    <div style="display: flex; gap: 0.6rem; justify-content: center; margin: 1rem 0; font-size: 2.2rem; color: #475569;" id="starRatingContainer">
                        <i class="fa-solid fa-star evaluation-star" onclick="setRating(1)" style="cursor: pointer; transition: all 0.2s;" title="Kurang Puas (1/5)"></i>
                        <i class="fa-solid fa-star evaluation-star" onclick="setRating(2)" style="cursor: pointer; transition: all 0.2s;" title="Cukup Puas (2/5)"></i>
                        <i class="fa-solid fa-star evaluation-star" onclick="setRating(3)" style="cursor: pointer; transition: all 0.2s;" title="Bagus (3/5)"></i>
                        <i class="fa-solid fa-star evaluation-star" onclick="setRating(4)" style="cursor: pointer; transition: all 0.2s;" title="Sangat Bagus (4/5)"></i>
                        <i class="fa-solid fa-star evaluation-star" onclick="setRating(5)" style="cursor: pointer; color: #fbbf24; filter: drop-shadow(0 0 10px #fbbf24); transition: all 0.2s;" title="Luar Biasa Puas (5/5)"></i>
                    </div>

                    <div style="font-size: 0.95rem; font-weight: 900; color: #fbbf24;" id="ratingTextLabel">
                        Luar Biasa Puas (5 / 5 Bintang)
                    </div>
                </div>

                <!-- Feedback Form -->
                <form onsubmit="handleEvaluationSubmit(event)">
                    <div style="margin-bottom: 1.25rem;">
                        <label style="font-size: 0.85rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem;">
                            CATATAN &amp; MASUKAN EVALUASI PELATIH
                        </label>
                        <textarea id="evalCommentInput" rows="3" placeholder="Tuliskan umpan balik mengenai penjelasan teknik, keramahan, atau ketepatan waktu pelatih..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.85rem; border-radius: 0.85rem; color: white; font-size: 0.9rem; outline: none; font-family: inherit; resize: vertical;"></textarea>
                    </div>

                    <button type="submit" class="btn glow-btn" style="width: 100%; background: #fbbf24; color: #090d0b; border: none; padding: 0.95rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 0 20px rgba(251,191,36,0.4);">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>KIRIM EVALUASI SESI TRAINER</span>
                    </button>
                </form>

                <!-- Evaluation History Log -->
                <div style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.5rem;">
                    <h4 style="font-size: 1.15rem; font-weight: 800; color: white; font-family: 'Outfit', sans-serif; margin-bottom: 1rem;">
                        📜 Riwayat Evaluasi Sesi Anda
                    </h4>

                    <div style="display: flex; flex-direction: column; gap: 0.85rem;" id="evalHistoryLog">
                        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                                <span style="font-size: 0.85rem; font-weight: 800; color: white;">Sesi #4 - Leg Day &amp; Glute Focus</span>
                                <span style="color: #fbbf24; font-size: 0.8rem; font-weight: 900;">★★★★★ 5/5</span>
                            </div>
                            <p style="font-size: 0.825rem; color: #94a3b8; margin: 0;">
                                "Penjelasan teknik Goblet Squat &amp; RDL sangat jelas. Coach Hendra ramah dan terus memberikan dorongan motivasi!"
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- TAB 7: JADWAL KELAS GROUP & RESERVASI -->
    <div id="memberTabClasses" class="member-tab-content" style="display: none; background: #060907; padding: 3rem 0 6rem; color: white;">
        <div class="container" style="max-width: 900px;">
            
            <div style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.25rem;">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                                Jadwal Kelas Group Fitness Pekan Ini
                            </h3>
                            <span style="font-size: 0.85rem; color: #84cc16; font-weight: 700;">Khusus VIP Member • Gratis Reservasi Tempat</span>
                        </div>
                    </div>

                    <a href="{{ route('kelas') }}" target="_blank" style="color: #84cc16; font-size: 0.85rem; font-weight: 800; text-decoration: underline;">
                        Lihat Jadwal Lengkap Public ➔
                    </a>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">
                    <!-- Class 1 -->
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <div style="font-size: 0.75rem; color: #84cc16; font-weight: 800; margin-bottom: 0.35rem;">📅 SENIN • 17:00 WIB</div>
                        <h5 style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0 0 0.35rem;">Zumba Fitness Party</h5>
                        <div style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.85rem;">Instruktur Maya Indah • Sleman HQ</div>
                        <a href="{{ route('kelas') }}" target="_blank" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.55rem; border-radius: 99px; font-weight: 900; font-size: 0.8rem; text-decoration: none; text-align: center; display: block;">
                            ⚡ Amankan Slot Tempat
                        </a>
                    </div>

                    <!-- Class 2 -->
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                        <div style="font-size: 0.75rem; color: #38bdf8; font-weight: 800; margin-bottom: 0.35rem;">📅 RABU • 18:30 WIB</div>
                        <h5 style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0 0 0.35rem;">Body Combat HIIT</h5>
                        <div style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.85rem;">Coach Hendra Wijaya • Seturan UGM</div>
                        <a href="{{ route('kelas') }}" target="_blank" class="btn glow-btn" style="width: 100%; background: #38bdf8; color: #090d0b; border: none; padding: 0.55rem; border-radius: 99px; font-weight: 900; font-size: 0.8rem; text-decoration: none; text-align: center; display: block;">
                            ⚡ Amankan Slot Tempat
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- FLOATING MEMBER AI FITBOT CS ASSISTANT WIDGET -->
<div id="aiFitbotFloatingWidget" style="display: none; position: fixed; bottom: 85px; right: 25px; z-index: 99990;">
    <button onclick="toggleAiFitbotModal()" style="background: linear-gradient(135deg, #84cc16 0%, #4d7c0f 100%); color: #090d0b; border: 2px solid #ffffff; width: 60px; height: 60px; border-radius: 50%; font-size: 1.6rem; cursor: pointer; box-shadow: 0 10px 25px rgba(132,204,22,0.5); display: flex; align-items: center; justify-content: center; transition: transform 0.25s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="FitBot CS AI Member">
        <i class="fa-solid fa-robot"></i>
    </button>
</div>

<!-- AI FITBOT CHATBOX MODAL -->
<div id="aiFitbotChatModal" style="display: none; position: fixed; bottom: 155px; right: 25px; width: 360px; max-width: 90vw; background: #0d1310; border: 2px solid #84cc16; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(132, 204, 22, 0.3); z-index: 99991; flex-direction: column;">
    
    <!-- Chat Header -->
    <div style="background: linear-gradient(135deg, #18261c 0%, #0d1310 100%); padding: 1rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 0.65rem;">
            <div style="width: 36px; height: 36px; background: #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-weight: 900; font-size: 1.1rem;">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <div style="font-weight: 900; font-size: 0.95rem; color: white;">FitBot CS AI Member</div>
                <div style="font-size: 0.725rem; color: #84cc16; font-weight: 700;">● Online 24/7 Support</div>
            </div>
        </div>
        <button onclick="toggleAiFitbotModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.4rem; cursor: pointer;">&times;</button>
    </div>

    <!-- Chat Messages Box -->
    <div id="fitbotChatBody" style="padding: 1.15rem; height: 260px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.85rem;">
        <div style="background: rgba(132,204,22,0.12); border: 1px solid rgba(132,204,22,0.3); color: #cbd5e1; padding: 0.85rem; border-radius: 1rem 1rem 1rem 0.2rem; line-height: 1.5;">
            Halo! Saya <strong>FitBot AI</strong> 🤖. Ada yang bisa saya bantu terkait jadwal latihan, menu nutrisi, atau sisa sesi PT Anda?
        </div>
    </div>

    <!-- Quick Prompts Bar -->
    <div style="padding: 0.5rem 0.85rem; background: rgba(255,255,255,0.03); border-top: 1px solid rgba(255,255,255,0.08); display: flex; gap: 0.4rem; overflow-x: auto;">
        <button onclick="sendFitbotPrompt('Berapa sisa sesi PT saya?')" style="background: #1e293b; color: #84cc16; border: 1px solid rgba(132,204,22,0.3); font-size: 0.725rem; padding: 0.3rem 0.6rem; border-radius: 99px; white-space: nowrap; cursor: pointer;">
            Sisa sesi PT?
        </button>
        <button onclick="sendFitbotPrompt('Rekomendasi menu makan siang')" style="background: #1e293b; color: #38bdf8; border: 1px solid rgba(56,189,248,0.3); font-size: 0.725rem; padding: 0.3rem 0.6rem; border-radius: 99px; white-space: nowrap; cursor: pointer;">
            Menu makan siang?
        </button>
    </div>

    <!-- Chat Input Form -->
    <form onsubmit="handleFitbotSend(event)" style="padding: 0.75rem; border-top: 1px solid rgba(255,255,255,0.1); display: flex; gap: 0.5rem; background: #060907;">
        <input type="text" id="fitbotInput" placeholder="Tulis pertanyaan Anda..." style="flex: 1; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.6rem 0.85rem; border-radius: 99px; color: white; font-size: 0.825rem; outline: none;">
        <button type="submit" style="background: #84cc16; color: #090d0b; border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>
</div>

<!-- Tabs & Feature Script -->
<script>
    function switchMemberTab(tabName, btnEl) {
        document.querySelectorAll('.member-tab-btn').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.05)';
            btn.style.borderColor = 'rgba(255,255,255,0.12)';
            btn.style.color = '#cbd5e1';
            btn.classList.remove('active');
        });

        btnEl.style.background = 'rgba(132, 204, 22, 0.15)';
        btnEl.style.borderColor = '#84cc16';
        btnEl.style.color = '#84cc16';
        btnEl.classList.add('active');

        document.querySelectorAll('.member-tab-content').forEach(content => {
            content.style.display = 'none';
        });

        if (tabName === 'status') document.getElementById('memberTabStatus').style.display = 'block';
        if (tabName === 'workout') document.getElementById('memberTabWorkout').style.display = 'block';
        if (tabName === 'nutrition') document.getElementById('memberTabNutrition').style.display = 'block';
        if (tabName === 'referral') document.getElementById('memberTabReferral').style.display = 'block';
        if (tabName === 'hydration') {
            document.getElementById('memberTabHydration').style.display = 'block';
            initHydrationGlasses();
        }
        if (tabName === 'evaluation') {
            document.getElementById('memberTabEvaluations').style.display = 'block';
        }
        if (tabName === 'classes') {
            document.getElementById('memberTabClasses').style.display = 'block';
        }
    }

    let selectedStarRating = 5;

    function setRating(val) {
        selectedStarRating = val;
        const stars = document.querySelectorAll('.evaluation-star');
        const labels = ['Sangat Kurang Puas (1/5)', 'Kurang Puas (2/5)', 'Cukup Puas (3/5)', 'Sangat Bagus (4/5)', 'Luar Biasa Puas (5/5)'];
        
        stars.forEach((star, idx) => {
            if (idx < val) {
                star.style.color = '#fbbf24';
                star.style.filter = 'drop-shadow(0 0 10px #fbbf24)';
            } else {
                star.style.color = '#475569';
                star.style.filter = 'none';
            }
        });

        document.getElementById('ratingTextLabel').innerText = labels[val - 1] || 'Luar Biasa Puas (5/5)';
    }

    function handleEvaluationSubmit(e) {
        if (e) e.preventDefault();
        const comment = document.getElementById('evalCommentInput').value.trim();
        const log = document.getElementById('evalHistoryLog');

        const starsStr = '★'.repeat(selectedStarRating) + '☆'.repeat(5 - selectedStarRating);
        const newCard = `<div style="background: rgba(132,204,22,0.08); border: 1.5px solid #84cc16; border-radius: 1rem; padding: 1rem; animation: fadeIn 0.3s ease;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                <span style="font-size: 0.85rem; font-weight: 800; color: white;">Sesi #5 - Hari Ini</span>
                <span style="color: #fbbf24; font-size: 0.8rem; font-weight: 900;">${starsStr} ${selectedStarRating}/5</span>
            </div>
            <p style="font-size: 0.825rem; color: #cbd5e1; margin: 0;">
                "${comment || 'Evaluasi dikirim dengan rating ' + selectedStarRating + '/5 bintang.'}"
            </p>
        </div>`;

        log.innerHTML = newCard + log.innerHTML;
        document.getElementById('evalCommentInput').value = '';
        alert('Terima kasih! Evaluasi & ulasan Anda untuk Coach Hendra Wijaya berhasil dikirim.');
    }

    function generateWorkoutRoutine() {
        const goal = document.getElementById('workoutGoalSelect').value;
        const level = document.getElementById('workoutLevelSelect').value;
        const resultBox = document.getElementById('workoutResultBox');
        const titleEl = document.getElementById('workoutResultTitle');
        const tbody = document.getElementById('workoutTableBody');

        const routines = {
            fat_loss: [
                { name: 'Barbell Back Squat / Goblet Squat', sets: '4 Set x 12 Reps', rest: '60 Detik', tip: 'Jaga dada tetap tegak & lutut sejajar jemari kaki' },
                { name: 'Dumbbell Romanian Deadlift (RDL)', sets: '4 Set x 12 Reps', rest: '60 Detik', tip: 'Fokus dorong pinggul ke belakang, kencangkan hamstring' },
                { name: 'Push-Up / Incline Dumbbell Press', sets: '3 Set x 15 Reps', rest: '45 Detik', tip: 'Kencangkan otot inti (core) saat menurunkan badan' },
                { name: 'Mountain Climbers & HIIT Jump', sets: '3 Set x 45 Detik', rest: '30 Detik', tip: 'Pacu detak jantung untuk pembakaran lemak maksimal' }
            ],
            muscle: [
                { name: 'Barbell Bench Press (Chest Focus)', sets: '4 Set x 8 - 10 Reps', rest: '90 Detik', tip: 'Turunkan beban perlahan (3 detik kontrol)' },
                { name: 'Lat Pulldown / Pull-Up Privat', sets: '4 Set x 8 - 10 Reps', rest: '90 Detik', tip: 'Tarik dengan siku ke arah pinggang' },
                { name: 'Overhead Dumbbell Shoulder Press', sets: '3 Set x 10 - 12 Reps', rest: '75 Detik', tip: 'Jangan mengunci siku penuh di posisi teratas' },
                { name: 'Barbell Bicep Curl & Tricep Pushdown', sets: '3 Set x 12 - 15 Reps', rest: '60 Detik', tip: 'Isolasi kontraksi otot bisep & trisep' }
            ],
            female: [
                { name: 'Glute Bridge / Hip Thrust', sets: '4 Set x 15 Reps', rest: '60 Detik', tip: 'Tahan 2 detik di posisi atas, kencangkan otot glutes' },
                { name: 'Bulgarian Split Squat', sets: '3 Set x 12 Reps / kaki', rest: '60 Detik', tip: 'Beban utama ada di tumit kaki depan' },
                { name: 'Plank & Side Leg Raise', sets: '3 Set x 45 Detik', rest: '45 Detik', tip: 'Bentuk perut rata & kencangkan otot pinggul' },
                { name: 'Dumbbell Sumo Squat', sets: '3 Set x 15 Reps', rest: '45 Detik', tip: 'Lebarkan pijakan kaki 45 derajat' }
            ],
            tni: [
                { name: 'Pull-Up Standar Tes Kesamaptaan', sets: '4 Set x Maksimal Reps', rest: '90 Detik', tip: 'Dagu wajib melewati tiang pull-up' },
                { name: 'Push-Up Militer 1 Menit', sets: '4 Set x 35 - 45 Reps', rest: '60 Detik', tip: 'Dada menyentuh lantai & siku lurus teratas' },
                { name: 'Sit-Up & Shuttle Run Agility', sets: '4 Set x 40 Reps', rest: '60 Detik', tip: 'Kunci otot perut & gerakan eksplosif' },
                { name: 'Lari Ketahanan 12 Menit', sets: '1 Sesi x Target 2,400m+', rest: '- ', tip: 'Atur ritme napas stabil 2 masuk 2 keluar' }
            ]
        };

        const titles = {
            fat_loss: '🔥 Program Fat Loss & Weight Burning Harian',
            muscle: '💪 Program Muscle Building & Hypertrophy',
            female: '🌸 Program Female Body Shaping & Booty Abs',
            tni: '🛡️ Program Tes Fisik & Stamina TNI-POLRI'
        };

        titleEl.innerText = titles[goal] || 'Program Latihan Harian VIP';
        
        let html = '';
        const selectedRoutine = routines[goal] || routines.fat_loss;
        selectedRoutine.forEach(r => {
            html += `<tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                <td style="padding: 0.85rem 1rem; font-weight: 800; color: white;">${r.name}</td>
                <td style="padding: 0.85rem 1rem; color: #84cc16; font-weight: 800;">${r.sets}</td>
                <td style="padding: 0.85rem 1rem; color: #38bdf8;">${r.rest}</td>
                <td style="padding: 0.85rem 1rem; font-size: 0.825rem; color: #94a3b8;">${r.tip}</td>
            </tr>`;
        });

        tbody.innerHTML = html;
        resultBox.style.display = 'block';
        resultBox.scrollIntoView({ behavior: 'smooth' });
    }

    // AI FitBot Chatbot Toggle
    function toggleAiFitbotModal() {
        const modal = document.getElementById('aiFitbotChatModal');
        if (modal) {
            modal.style.display = (modal.style.display === 'flex') ? 'none' : 'flex';
        }
    }

    function sendFitbotPrompt(text) {
        document.getElementById('fitbotInput').value = text;
        handleFitbotSend(null);
    }

    function handleFitbotSend(e) {
        if (e) e.preventDefault();
        const input = document.getElementById('fitbotInput');
        const query = input.value.trim();
        if (!query) return;

        const chatBody = document.getElementById('fitbotChatBody');
        
        // Add User Bubble
        chatBody.innerHTML += `<div style="background: rgba(255,255,255,0.08); color: white; padding: 0.75rem; border-radius: 1rem 1rem 0.2rem 1rem; align-self: flex-end; max-width: 85%;">
            ${query}
        </div>`;

        input.value = '';
        chatBody.scrollTop = chatBody.scrollHeight;

        // Simulate AI Thinking Response
        setTimeout(() => {
            let reply = "Terima kasih atas pertanyaannya! Untuk info lebih rinci, Anda juga bisa langsung berdiskusi dengan Coach Hendra via WhatsApp.";
            const q = query.toLowerCase();

            if (q.includes('sesi') || q.includes('sisa')) {
                reply = "Sisa sesi Personal Trainer Anda saat ini adalah <strong>8 Sesi Tersisa</strong> dari total 12 Sesi Paket VIP.";
            } else if (q.includes('makan') || q.includes('menu') || q.includes('nutrisi')) {
                reply = "Rekomendasi menu hari ini: Nasi merah 100g + Dada ayam panggang 150g + Tumis buncis (Total: ~520 kcal • 48g Protein).";
            } else if (q.includes('jadwal') || q.includes('booking') || q.includes('trainer')) {
                reply = "Jadwal sesi latihan Anda berikutnya terkonfirmasi untuk <strong>Jumat, 8 Agustus 2026 jam 17.00 WIB</strong> bersama Coach Hendra Wijaya.";
            }

            chatBody.innerHTML += `<div style="background: rgba(132,204,22,0.12); border: 1px solid rgba(132,204,22,0.3); color: #cbd5e1; padding: 0.85rem; border-radius: 1rem 1rem 1rem 0.2rem; line-height: 1.5; align-self: flex-start; max-width: 88%;">
                🤖 ${reply}
            </div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 600);
    }

    // Hydration Tracker State
    let glassesState = [true, true, true, true, true, true, true, true, false, false, false, false];

    function initHydrationGlasses() {
        const grid = document.getElementById('hydrationGlassesGrid');
        if (!grid) return;

        let html = '';
        glassesState.forEach((filled, idx) => {
            const timeStr = (8 + idx * 1) + ':00';
            html += `<div onclick="toggleGlass(${idx})" style="background: ${filled ? 'rgba(56, 189, 248, 0.15)' : 'rgba(255,255,255,0.03)'}; border: 1.5px solid ${filled ? '#38bdf8' : 'rgba(255,255,255,0.1)'}; border-radius: 1.15rem; padding: 1.15rem 0.5rem; cursor: pointer; transition: all 0.25s ease;" onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fa-solid fa-glass-water" style="font-size: 2.2rem; color: ${filled ? '#38bdf8' : '#475569'}; margin-bottom: 0.5rem; filter: drop-shadow(0 0 ${filled ? '8px #38bdf8' : '0px transparent'});"></i>
                <div style="font-size: 0.8rem; font-weight: 900; color: ${filled ? 'white' : '#94a3b8'};">Gelas ${idx + 1}</div>
                <div style="font-size: 0.7rem; color: ${filled ? '#38bdf8' : '#64748b'}; font-weight: 700;">${timeStr}</div>
            </div>`;
        });
        grid.innerHTML = html;
        updateHydrationProgressText();
    }

    function toggleGlass(idx) {
        glassesState[idx] = !glassesState[idx];
        initHydrationGlasses();
    }

    function updateHydrationProgressText() {
        const filledCount = glassesState.filter(Boolean).length;
        const totalLiters = (filledCount * 0.25).toFixed(1);
        const textEl = document.getElementById('hydrationProgressText');
        if (textEl) {
            textEl.innerText = `${filledCount} dari 12 Gelas (${totalLiters}L / 3.1L)`;
        }
    }

    function copyReferralLink() {
        const code = document.getElementById('memberReferralCodeDisplay').innerText;
        const link = `http://fitlifehub.site.je/?ref=${code}`;
        navigator.clipboard.writeText(link).then(() => {
            alert('Tautan referral berhasil disalin ke clipboard! Bagikan ke teman Anda untuk mendapatkan bonus 2 sesi PT gratis.');
        });
    }

    function checkMemberAuth() {
        const loggedIn = sessionStorage.getItem('fitlife_member_session');
        const gate = document.getElementById('memberAuthGate');
        const dashboard = document.getElementById('memberDashboardContainer');
        const fitbotWidget = document.getElementById('aiFitbotFloatingWidget');

        if (loggedIn) {
            if (gate) gate.style.display = 'none';
            if (dashboard) dashboard.style.display = 'block';
            if (fitbotWidget) fitbotWidget.style.display = 'block';

            const storedId = sessionStorage.getItem('fitlife_member_id') || 'FL-MBR-7782';
            const storedName = sessionStorage.getItem('fitlife_member_name');
            
            if (storedName) {
                const el1 = document.getElementById('displayMemberName');
                const el2 = document.getElementById('cardMemberName');
                if (el1) el1.innerText = storedName;
                if (el2) el2.innerText = storedName;
            }

            const cardMemberIdEl = document.getElementById('cardMemberId');
            if (cardMemberIdEl) {
                const last4 = storedId.length >= 4 ? storedId.slice(-4) : storedId;
                cardMemberIdEl.innerText = '8840 •••• •••• ' + last4;
                
                // Dynamic Referral Code
                const refCode = 'FL-REF-' + last4;
                const refCodeEl = document.getElementById('memberReferralCodeDisplay');
                const refLinkEl = document.getElementById('memberReferralLinkDisplay');
                const shareWaBtn = document.getElementById('shareWaBtn');
                
                if (refCodeEl) refCodeEl.innerText = refCode;
                if (refLinkEl) refLinkEl.innerText = 'http://fitlifehub.site.je/?ref=' + refCode;
                if (shareWaBtn) {
                    const msg = 'Halo! Yuk gabung gym privat di FitLife Center Jogja dengan kode referral saya ' + refCode + ' & dapatkan diskon 15% + Extra 2 Sesi PT Gratis! Daftar di sini: http://fitlifehub.site.je/?ref=' + refCode;
                    shareWaBtn.href = 'https://wa.me/?text=' + encodeURIComponent(msg);
                }
            }

            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' + encodeURIComponent('http://fitlifehub.site.je/member?id=' + storedId) + '&color=090d0b&bgcolor=ffffff';
            const cardQrImg = document.getElementById('cardQrImg');
            if (cardQrImg) cardQrImg.src = qrUrl;

        } else {
            if (gate) gate.style.display = 'block';
            if (dashboard) dashboard.style.display = 'none';
            if (fitbotWidget) fitbotWidget.style.display = 'none';
        }
    }

    function handleMemberLogin(e) {
        if (e) e.preventDefault();
        const inputVal = document.getElementById('memberLoginInput').value.trim();
        if (!inputVal) return;

        sessionStorage.setItem('fitlife_member_session', '1');
        sessionStorage.setItem('fitlife_member_id', inputVal);
        if (!inputVal.toUpperCase().includes('FL-MBR')) {
            sessionStorage.setItem('fitlife_member_name', inputVal);
        }
        checkMemberAuth();
    }

    function doDemoLogin() {
        document.getElementById('memberLoginInput').value = 'FL-MBR-7782';
        handleMemberLogin(null);
    }

    function handleMemberLogout() {
        sessionStorage.removeItem('fitlife_member_session');
        sessionStorage.removeItem('fitlife_member_name');
        checkMemberAuth();
    }

    document.addEventListener('DOMContentLoaded', checkMemberAuth);
</script>

<style>
    @keyframes qrScanLaser {
        0% { top: 0; opacity: 0.8; }
        50% { top: 90%; opacity: 1; }
        100% { top: 0; opacity: 0.8; }
    }
</style>

<!-- Large QR Code Scan Lightbox Modal -->
<div id="qrCodeModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1310; border: 2px solid #84cc16; border-radius: 1.75rem; padding: 2.25rem; max-width: 420px; width: 100%; text-align: center; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(132, 204, 22, 0.3); position: relative;">
        <button onclick="closeQrModal()" style="position: absolute; top: 1rem; right: 1.25rem; background: none; border: none; color: white; font-size: 1.8rem; cursor: pointer;">&times;</button>
        
        <div style="font-size: 0.8rem; color: #84cc16; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.35rem;">
            <i class="fa-solid fa-qrcode"></i> BARCODE ACCESS PASS
        </div>
        <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 1.25rem;">
            Pindai QR Code Check-in Studio
        </h3>

        <div style="background: #ffffff; padding: 1.25rem; border-radius: 1.25rem; display: inline-block; box-shadow: 0 0 25px rgba(132,204,22,0.4); margin-bottom: 1.25rem;">
            <img id="modalQrImg" src="https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=http%3A%2F%2Ffitlifehub.site.je%2Fmember%3Fid%3DFL-MBR-7782&color=090d0b&bgcolor=ffffff" alt="Member VIP QR Code Big" style="width: 200px; height: 200px; display: block;">
        </div>

        <div style="font-family: monospace; font-size: 1.1rem; color: #84cc16; font-weight: 900; letter-spacing: 2px; margin-bottom: 0.5rem;" id="modalQrCodeText">
            FL-MBR-7782-VIP
        </div>
        <p style="font-size: 0.825rem; color: #94a3b8; margin: 0;">
            Tunjukkan QR Code ini ke scanner di meja resepsionis studio FitLife Center untuk konfirmasi kehadiran &amp; pembuka pintu studio.
        </p>
    </div>
</div>

<script>
    function openQrModal() {
        const modal = document.getElementById('qrCodeModal');
        if (modal) modal.style.display = 'flex';
    }
    function closeQrModal() {
        const modal = document.getElementById('qrCodeModal');
        if (modal) modal.style.display = 'none';
    }
</script>
@endsection
