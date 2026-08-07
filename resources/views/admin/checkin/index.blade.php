@extends('layouts.app')

@section('title', 'Pemindai QR Code & Kiosk Check-in Studio Resepsionis | FitLife Center Yogyakarta')
@section('meta_description', 'Kiosk meja resepsionis studio FitLife Center untuk pemindaian QR Code member, verifikasi keanggotaan aktif, & pemotongan otomatis sisa sesi PT.')

@section('content')
<!-- Receptionist Header Banner -->
<section style="padding: 3.5rem 0 2.5rem; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.35rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; margin-bottom: 0.75rem;">
                    <i class="fa-solid fa-qrcode"></i>
                    <span>STUDIO RECEPTION KIOSK SYSTEM</span>
                </div>
                <h1 style="font-size: 2.2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem;">
                    Pemindai QR &amp; Log Kehadiran Resepsionis
                </h1>
                <p style="color: #94a3b8; font-size: 0.95rem; margin: 0;">
                    Pindai QR Code dari HP member atau ketik ID Member untuk mengonfirmasi kehadiran &amp; pemotongan otomatis sesi PT.
                </p>
            </div>

            <div style="display: flex; gap: 0.85rem; align-items: center; flex-wrap: wrap;">
                <button type="button" onclick="toggleKioskFullscreen()" id="fullscreenKioskBtn" style="background: rgba(132, 204, 22, 0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: all 0.25s ease;" title="Tampilkan Layar Penuh Kiosk Presensi">
                    <i class="fa-solid fa-expand" id="kioskFsIcon"></i> <span id="kioskFsText">Mode Fullscreen Kiosk</span>
                </button>

                <label style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132,204,22,0.12); border: 1px solid rgba(132,204,22,0.3); padding: 0.5rem 1rem; border-radius: 99px; cursor: pointer; font-size: 0.825rem; font-weight: 800; color: #84cc16;">
                    <input type="checkbox" id="ttsToggle" checked style="accent-color: #84cc16; width: 16px; height: 16px;">
                    <i class="fa-solid fa-volume-high"></i> Suara TTS
                </label>
                <span style="background: rgba(132,204,22,0.15); color: #84cc16; border: 1.5px solid #84cc16; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-signal"></i> KIOSK READY
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Check-in Scanner Section -->
<section style="background: #060907; padding: 3rem 0 6rem; color: white;">
    <div class="container">
        
        <div style="display: grid; grid-template-columns: 1.15fr 1fr; gap: 2rem; align-items: start;" class="grid-2">
            
            <!-- Left Column: Scanner Form & Live Access Result -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                
                <!-- Scanner Input Card -->
                <div style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
                    
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                        <div style="width: 46px; height: 46px; background: rgba(132, 204, 22, 0.15); border: 1px solid #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.3rem;">
                            <i class="fa-solid fa-barcode"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                                Input / Scan Barcode Member
                            </h3>
                            <span style="font-size: 0.8rem; color: #94a3b8;">Format: <code>FL-MBR-7782</code> atau URL QR Code</span>
                        </div>
                    </div>

                    <form onsubmit="handleCheckinSubmit(event)">
                        <div style="margin-bottom: 1.25rem;">
                            <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.45rem;">
                                HASIL PEMINDAIAN BARCODE / ID MEMBER <span style="color: #84cc16;">*</span>
                            </label>
                            <div style="position: relative;">
                                <input type="text" id="checkinMemberInput" required placeholder="Arahkan scanner ke QR Code atau ketik FL-MBR-7782..." value="FL-MBR-7782" style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid #84cc16; padding: 1rem 1.15rem 1rem 2.9rem; border-radius: 0.85rem; color: white; font-size: 1.05rem; outline: none; font-weight: 800; font-family: monospace; letter-spacing: 1px; box-shadow: 0 0 15px rgba(132,204,22,0.2);">
                                <i class="fa-solid fa-qrcode" style="position: absolute; left: 1.1rem; top: 50%; transform: translateY(-50%); color: #84cc16; font-size: 1.2rem;"></i>
                            </div>
                        </div>

                        <!-- Dual Scanning Mode Switcher: Physical Scanner vs Kamera HP/Webcam -->
                        <div style="margin-bottom: 1.25rem; display: flex; gap: 0.75rem;">
                            <button type="button" onclick="startCameraScanner()" class="btn" style="flex: 1; background: rgba(56,189,248,0.15); border: 1.5px solid #38bdf8; color: #38bdf8; padding: 0.65rem; border-radius: 0.75rem; font-weight: 800; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                <i class="fa-solid fa-camera"></i> Aktifkan Kamera HP / Webcam
                            </button>
                            <button type="button" onclick="stopCameraScanner()" id="stopCamBtn" style="display: none; background: rgba(239,68,68,0.15); border: 1.5px solid #ef4444; color: #ef4444; padding: 0.65rem; border-radius: 0.75rem; font-weight: 800; font-size: 0.85rem; cursor: pointer;">
                                Matikan Cam
                            </button>
                        </div>

                        <!-- Live Camera Reader Viewport -->
                        <div id="cameraReaderBox" style="display: none; width: 100%; height: 260px; background: #000; border: 2px dashed #38bdf8; border-radius: 1rem; margin-bottom: 1.25rem; overflow: hidden; position: relative;">
                            <div id="reader" style="width: 100%; height: 100%;"></div>
                        </div>

                        <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 1rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; margin-bottom: 1rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                            <i class="fa-solid fa-bolt"></i>
                            <span>PROSES CHECK-IN STUDIO &amp; VERIFIKASI</span>
                        </button>

                        <div style="display: flex; gap: 0.5rem; justify-content: center; font-size: 0.8rem; color: #94a3b8;">
                            <span>Contoh Demo:</span>
                            <a href="javascript:void(0)" onclick="quickScan('FL-MBR-7782')" style="color: #84cc16; font-weight: 800;">[FL-MBR-7782]</a>
                            <a href="javascript:void(0)" onclick="quickScan('FL-MBR-9988')" style="color: #38bdf8; font-weight: 800;">[FL-MBR-9988]</a>
                        </div>
                    </form>
                </div>

                <!-- Live Access Result Banner -->
                <div id="checkinResultCard" style="display: none; background: #0d1310; border: 2.5px solid #84cc16; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 0 35px rgba(132, 204, 22, 0.35);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                        <div style="width: 54px; height: 54px; background: #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #090d0b; font-size: 1.8rem; font-weight: 900; box-shadow: 0 0 20px rgba(132,204,22,0.5);">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <div style="background: rgba(132,204,22,0.2); color: #84cc16; font-weight: 900; font-size: 0.75rem; padding: 0.2rem 0.65rem; border-radius: 99px; display: inline-block; margin-bottom: 0.2rem;">
                                ● ACCESS GRANTED - PINDAI BERHASIL
                            </div>
                            <h3 style="font-size: 1.5rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;" id="resMemberName">
                                Bima Prasetya
                            </h3>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1rem;">
                            <span style="font-size: 0.725rem; color: #94a3b8; font-weight: 800;">STATUS SESI PT</span>
                            <div style="font-size: 1.1rem; font-weight: 900; color: #ef4444; margin-top: 0.2rem;" id="resPtDeducted">
                                -1 Sesi Terpakai
                            </div>
                        </div>

                        <div style="background: rgba(132,204,22,0.1); border: 1.5px solid #84cc16; border-radius: 1rem; padding: 1rem;">
                            <span style="font-size: 0.725rem; color: #84cc16; font-weight: 800;">SISA SESI TERSISA</span>
                            <div style="font-size: 1.1rem; font-weight: 900; color: #84cc16; margin-top: 0.2rem;" id="resRemainingSessions">
                                6 Sesi Tersisa
                            </div>
                        </div>
                    </div>

                    <div style="font-size: 0.825rem; color: #cbd5e1; line-height: 1.5; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 0.85rem;">
                        📍 <strong>Lokasi:</strong> <span id="resBranch">Sleman HQ (Jl. Kaliurang)</span> • 🏋️ <strong>Trainer:</strong> <span id="resCoach">Coach Hendra Wijaya</span>
                    </div>
                </div>

            </div>

            <!-- Right Column: Reception Attendance Log Table -->
            <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0;">
                        <i class="fa-solid fa-clock-rotate-left" style="color: #84cc16;"></i> Log Kehadiran Studio Hari Ini
                    </h3>
                    <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-weight: 800; font-size: 0.775rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                        LIVE LOG
                    </span>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;">
                        <thead>
                            <tr style="background: rgba(255,255,255,0.04); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                                <th style="padding: 0.75rem 0.85rem;">MEMBER</th>
                                <th style="padding: 0.75rem 0.85rem;">JAM MASUK</th>
                                <th style="padding: 0.75rem 0.85rem;">SESI PT</th>
                            </tr>
                        </thead>
                        <tbody id="checkinLogTbody" style="color: #cbd5e1;">
                            @foreach($recentCheckins as $chk)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                                <td style="padding: 0.85rem;">
                                    <div style="font-weight: 800; color: white;">{{ $chk->name }}</div>
                                    <div style="font-size: 0.725rem; font-family: monospace; color: #84cc16;">{{ $chk->member_id }}</div>
                                </td>
                                <td style="padding: 0.85rem; font-size: 0.8rem; color: #cbd5e1;">
                                    {{ $chk->checkin_time }}
                                </td>
                                <td style="padding: 0.85rem;">
                                    <span style="background: rgba(132,204,22,0.12); color: #84cc16; font-weight: 800; font-size: 0.725rem; padding: 0.2rem 0.5rem; border-radius: 99px;">
                                        {{ $chk->pt_deducted }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
</section>

<script>
    function quickScan(code) {
        document.getElementById('checkinMemberInput').value = code;
        handleCheckinSubmit(null);
    }

    function handleCheckinSubmit(e) {
        if (e) e.preventDefault();
        const input = document.getElementById('checkinMemberInput');
        const memberId = input.value.trim().toUpperCase();
        if (!memberId) return;

        fetch('{{ route("admin.checkin.scan") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ member_id: memberId })
        })
        .then(res => {
            return res.json().then(data => ({ status: res.status, body: data }));
        })
        .then(res => {
            const data = res.body;
            const card = document.getElementById('checkinResultCard');

            if (data.success && data.access_granted) {
                card.style.borderColor = '#84cc16';
                card.style.boxShadow = '0 0 35px rgba(132, 204, 22, 0.35)';
                document.getElementById('resMemberName').innerHTML = `<span style="color:#ffffff;">${data.name}</span> <span style="font-size:0.9rem; color:#84cc16;">(${data.member_id})</span>`;
                document.getElementById('resPtDeducted').innerText = data.pt_deducted;
                document.getElementById('resRemainingSessions').innerText = data.remaining_sessions;
                document.getElementById('resBranch').innerText = data.branch || 'Sleman HQ';
                document.getElementById('resCoach').innerText = data.assigned_coach || 'Coach Hendra Wijaya';

                card.style.display = 'block';

                // TTS Voice Announcement
                if (document.getElementById('ttsToggle') && document.getElementById('ttsToggle').checked) {
                    speakAnnouncement(`Selamat Datang Kak ${data.name}! Akses pintu studio diizinkan. ${data.remaining_sessions}.`);
                }

                // Add to Log Table
                const tbody = document.getElementById('checkinLogTbody');
                const newRow = `<tr style="border-bottom: 1px solid rgba(255,255,255,0.06); background: rgba(132,204,22,0.08);">
                    <td style="padding: 0.85rem;">
                        <div style="font-weight: 800; color: white;">${data.name}</div>
                        <div style="font-size: 0.725rem; font-family: monospace; color: #84cc16;">${data.member_id}</div>
                    </td>
                    <td style="padding: 0.85rem; font-size: 0.8rem; color: #cbd5e1;">${data.checkin_time}</td>
                    <td style="padding: 0.85rem;">
                        <span style="background: rgba(132,204,22,0.12); color: #84cc16; font-weight: 800; font-size: 0.725rem; padding: 0.2rem 0.5rem; border-radius: 99px;">
                            ${data.pt_deducted}
                        </span>
                    </td>
                </tr>`;
                tbody.innerHTML = newRow + tbody.innerHTML;
            } else {
                // Access Denied / Quota 0
                card.style.borderColor = '#ef4444';
                card.style.boxShadow = '0 0 35px rgba(239, 68, 68, 0.4)';
                document.getElementById('resMemberName').innerHTML = `<span style="color:#f87171;">⛔ AKSES DITOLAK: ${data.name || memberId}</span>`;
                document.getElementById('resPtDeducted').innerText = '0 Sesi (Kuota Habis)';
                document.getElementById('resRemainingSessions').innerText = '0 Sesi Tersisa';
                document.getElementById('resBranch').innerText = 'Sleman HQ';
                document.getElementById('resCoach').innerText = 'Silakan Perpanjang Paket';

                card.style.display = 'block';

                // TTS Voice Announcement Denied
                if (document.getElementById('ttsToggle') && document.getElementById('ttsToggle').checked) {
                    speakAnnouncement(`Maaf ${data.name || 'Member'}, akses ditolak. Kuota sesi personal trainer Anda telah habis. Silakan melakukan isi ulang sesi di kasir.`);
                } else {
                    alert(data.message || 'Check-in ditolak: Kuota sesi member sudah habis.');
                }
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan koneksi saat memproses check-in.');
        });
    }

    function speakAnnouncement(text) {
        if (!('speechSynthesis' in window)) return;
        window.speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 1.0;
        utterance.pitch = 1.0;

        const voices = window.speechSynthesis.getVoices();
        const idVoice = voices.find(v => v.lang.includes('id') || v.lang.includes('ID'));
        if (idVoice) utterance.voice = idVoice;

        window.speechSynthesis.speak(utterance);
    }

    let html5QrCodeScanner = null;

    function startCameraScanner() {
        document.getElementById('cameraReaderBox').style.display = 'block';
        document.getElementById('stopCamBtn').style.display = 'inline-block';

        if (!html5QrCodeScanner) {
            html5QrCodeScanner = new Html5Qrcode("reader");
        }

        html5QrCodeScanner.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: { width: 220, height: 220 } },
            (decodedText, decodedResult) => {
                // On QR decoded successfully
                document.getElementById('checkinMemberInput').value = decodedText;
                stopCameraScanner();
                speakAnnouncement('QR Code berhasil terdeteksi dari kamera.');
                handleCheckinSubmit();
            },
            (errorMessage) => {
                // scan errors, ignore
            }
        ).catch(err => {
            alert('Tidak dapat mengaktifkan kamera: ' + err);
        });
    }

    function stopCameraScanner() {
        if (html5QrCodeScanner) {
            html5QrCodeScanner.stop().then(() => {
                document.getElementById('cameraReaderBox').style.display = 'none';
                document.getElementById('stopCamBtn').style.display = 'none';
            }).catch(err => {
                document.getElementById('cameraReaderBox').style.display = 'none';
                document.getElementById('stopCamBtn').style.display = 'none';
            });
        }
    }

    function toggleKioskFullscreen() {
        const isFs = document.body.classList.contains('is-fullscreen-mode') || !!document.fullscreenElement;
        const icon = document.getElementById('kioskFsIcon');
        const text = document.getElementById('kioskFsText');
        
        if (!isFs) {
            document.body.classList.add('is-fullscreen-mode');
            if (icon) icon.className = 'fa-solid fa-compress';
            if (text) text.innerText = 'Keluar Fullscreen';
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen().catch(err => {
                    console.log("Native Fullscreen Error:", err);
                });
            }
        } else {
            document.body.classList.remove('is-fullscreen-mode');
            if (icon) icon.className = 'fa-solid fa-expand';
            if (text) text.innerText = 'Mode Fullscreen Kiosk';
            if (document.fullscreenElement && document.exitFullscreen) {
                document.exitFullscreen().catch(err => {
                    console.log("Exit Fullscreen Error:", err);
                });
            }
        }
    }

    document.addEventListener('fullscreenchange', function() {
        const icon = document.getElementById('kioskFsIcon');
        const text = document.getElementById('kioskFsText');
        const isFs = !!document.fullscreenElement;
        
        if (isFs) {
            document.body.classList.add('is-fullscreen-mode');
            if (icon) icon.className = 'fa-solid fa-compress';
            if (text) text.innerText = 'Keluar Fullscreen';
        } else {
            document.body.classList.remove('is-fullscreen-mode');
            if (icon) icon.className = 'fa-solid fa-expand';
            if (text) text.innerText = 'Mode Fullscreen Kiosk';
        }
    });
</script>

<style>
/* Fullscreen Standalone Kiosk Terminal Mode */
body.is-fullscreen-mode {
    background-color: #060907 !important;
    overflow-x: hidden !important;
}

body.is-fullscreen-mode .admin-sidebar,
body.is-fullscreen-mode .admin-header,
body.is-fullscreen-mode footer,
body.is-fullscreen-mode header,
body.is-fullscreen-mode nav,
body.is-fullscreen-mode .sidebar-backdrop,
body.is-fullscreen-mode .floating-action-stack,
body.is-fullscreen-mode #aiChatbotModal,
body.is-fullscreen-mode #pwaInstallBanner,
body.is-fullscreen-mode #pwaInstructionModal {
    display: none !important;
    height: 0 !important;
    width: 0 !important;
    opacity: 0 !important;
    visibility: hidden !important;
}

body.is-fullscreen-mode .admin-wrapper {
    grid-template-columns: 1fr !important;
    display: block !important;
    padding: 0 !important;
    margin: 0 !important;
    width: 100% !important;
}

body.is-fullscreen-mode .admin-main {
    padding: 0.75rem 1rem !important;
    margin: 0 !important;
    width: 100% !important;
}
</style>
<script src="https://unpkg.com/html5-qrcode"></script>
@endsection
