<div class="modal-overlay" id="trialModal" style="z-index: 9999999 !important; padding: 2.5rem 1rem 1.5rem 1rem;">
    <div class="modal-card" style="background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); color: #ffffff; max-width: 620px; width: 100%; border-radius: 1.75rem; padding: 2rem; box-shadow: 0 25px 50px rgba(0,0,0,0.85); max-height: 82vh; overflow-y: auto; scrollbar-width: thin; position: relative; margin-top: auto; margin-bottom: auto;">
        <button class="modal-close" onclick="closeTrialModal()" style="color: #ffffff; background: rgba(255,255,255,0.1); border-radius: 50%; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; top: 1.25rem; right: 1.25rem;">&times;</button>
        
        <!-- Booking Form Container -->
        <div id="trialFormContainer">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div style="display: inline-flex; width: 48px; height: 48px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; color: #84cc16; align-items: center; justify-content: center; font-size: 1.35rem; margin-bottom: 0.6rem; box-shadow: 0 0 15px rgba(132, 204, 22, 0.3);">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; margin-bottom: 0.2rem; font-family: 'Outfit', sans-serif;">Reservasi Sesi Trial 7 Hari</h3>
                <p style="color: #94a3b8; font-size: 0.875rem;">Pilih tanggal, jam latihan, dan lokasi studio sesuai jadwalmu.</p>
            </div>

            <form action="{{ route('lead.trial') }}" method="POST" id="formTrial" onsubmit="handleTrialSubmit(event)">
                @csrf
                
                <!-- 1. Name & WA Phone -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.15rem;" class="grid-2">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 0.35rem;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="parent_name" id="trialInputName" class="form-control" placeholder="Contoh: Bima Perkasa" required style="background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.75rem; padding: 0.65rem 0.85rem; font-weight: 600; font-size: 0.9rem; outline: none; width: 100%;">
                        <input type="hidden" name="participant_name" id="trialInputPartName">
                        <input type="hidden" name="participant_age" value="Dewasa">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 0.35rem;">No. WhatsApp <span style="color:#ef4444;">*</span></label>
                        <input type="tel" name="phone" id="trialInputPhone" class="form-control" placeholder="081234567890" required style="background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.75rem; padding: 0.65rem 0.85rem; font-weight: 600; font-size: 0.9rem; outline: none; width: 100%;">
                    </div>
                </div>

                @php
                    $dbLocations = \App\Models\Location::all();
                    $dbPrograms = \App\Models\Program::all();
                    $firstLocName = $dbLocations->first() ? $dbLocations->first()->name . ' (' . ($dbLocations->first()->city ?: 'Yogyakarta') . ')' : 'FitLife HQ Kaliurang (Sleman)';
                @endphp

                <!-- 2. Program Selection -->
                <div style="margin-bottom: 1.15rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 0.35rem;">Program Fitness Pilihan <span style="color:#ef4444;">*</span></label>
                    <select name="program_name" id="trialProgramSelect" class="form-control" required style="background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.75rem; padding: 0.65rem 0.85rem; font-weight: 700; font-size: 0.9rem; outline: none; width: 100%;">
                        @if($dbPrograms->count() > 0)
                            @foreach($dbPrograms as $prog)
                                <option value="{{ $prog->title ?: $prog->name }}">{{ $prog->title ?: $prog->name }} ({{ $prog->category ?: 'Program FitLife' }})</option>
                            @endforeach
                        @else
                            <option value="Weight Loss & Fat Burn">Weight Loss & Fat Burn (Defisit Kalori)</option>
                            <option value="Muscle Building & Hypertrophy">Muscle Building & Hypertrophy (Massa Otot)</option>
                            <option value="Female Fitness & Body Shaping">Female Fitness & Shaping (Privat Wanita)</option>
                            <option value="Strength & Persiapan TNI-POLRI">Persiapan Fisik TNI / POLRI</option>
                            <option value="Posture Correction & Rehab">Posture Correction & Rehab Fungsional</option>
                        @endif
                    </select>
                </div>

                <!-- 3. Studio Branch Location Pills -->
                <div style="margin-bottom: 1.15rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 0.35rem;">Pilih Lokasi Studio Gym <span style="color:#ef4444;">*</span></label>
                    <input type="hidden" name="preferred_location" id="trialInputLoc" value="{{ $firstLocName }}">
                    <div style="display: grid; grid-template-columns: repeat({{ count($dbLocations) > 0 ? min(count($dbLocations), 3) : 3 }}, 1fr); gap: 0.6rem;">
                        @if($dbLocations->count() > 0)
                            @foreach($dbLocations as $idx => $loc)
                                @php $fullName = $loc->name . ' (' . ($loc->city ?: 'Jogja') . ')'; @endphp
                                <button type="button" class="loc-pill-btn {{ $idx === 0 ? 'active' : '' }}" onclick="selectLocPill(this, '{{ addslashes($fullName) }}')" style="background: {{ $idx === 0 ? 'rgba(132,204,22,0.15)' : 'rgba(255,255,255,0.05)' }}; border: 1.5px solid {{ $idx === 0 ? '#84cc16' : 'rgba(255,255,255,0.12)' }}; color: {{ $idx === 0 ? 'white' : '#cbd5e1' }}; border-radius: 0.75rem; padding: 0.65rem 0.5rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                                    🏢 {{ $loc->name }}
                                </button>
                            @endforeach
                        @else
                            <button type="button" class="loc-pill-btn active" onclick="selectLocPill(this, 'FitLife HQ Kaliurang (Sleman)')" style="background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: white; border-radius: 0.75rem; padding: 0.65rem 0.5rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                                🏢 Sleman HQ
                            </button>
                            <button type="button" class="loc-pill-btn" onclick="selectLocPill(this, 'FitLife Studio Seturan (UGM/Depok)')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; border-radius: 0.75rem; padding: 0.65rem 0.5rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                                🎓 Seturan UGM
                            </button>
                            <button type="button" class="loc-pill-btn" onclick="selectLocPill(this, 'FitLife Studio Sewon (Bantul)')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: #cbd5e1; border-radius: 0.75rem; padding: 0.65rem 0.5rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                                📍 Sewon Bantul
                            </button>
                        @endif
                    </div>
                </div>

                <!-- 4. Interactive Date Selector Pills Carousel -->
                <div style="margin-bottom: 1.15rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                        <label style="font-weight: 700; font-size: 0.8rem; color: #cbd5e1;">Pilih Tanggal Kedatangan <span style="color:#ef4444;">*</span></label>
                        <span style="font-size: 0.75rem; color: #84cc16; font-weight: 700;" id="selectedDateDisplay">Hari Ini</span>
                    </div>
                    <input type="hidden" name="trial_date" id="trialInputDate">
                    
                    <div style="display: flex; gap: 0.5rem; overflow-x: auto; padding-bottom: 0.4rem; scrollbar-width: none;" id="datePillsWrapper">
                        <!-- Populated dynamically via Javascript below -->
                    </div>
                </div>

                <!-- 5. Time Slot Grid (Pagi, Siang/Sore, Malam) -->
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 0.4rem;">Pilih Jam Sesi Latihan (WIB) <span style="color:#ef4444;">*</span></label>
                    <input type="hidden" name="trial_time" id="trialInputTime" value="17.00 WIB">

                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;" id="timeSlotGrid">
                        <button type="button" class="time-slot-btn" onclick="selectTimeSlot(this, '08.00 WIB')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: white; border-radius: 0.65rem; padding: 0.55rem 0.3rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                            🌅 08.00
                        </button>
                        <button type="button" class="time-slot-btn" onclick="selectTimeSlot(this, '10.00 WIB')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: white; border-radius: 0.65rem; padding: 0.55rem 0.3rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                            🌅 10.00
                        </button>
                        <button type="button" class="time-slot-btn" onclick="selectTimeSlot(this, '14.00 WIB')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: white; border-radius: 0.65rem; padding: 0.55rem 0.3rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                            ☀️ 14.00
                        </button>
                        <button type="button" class="time-slot-btn active" onclick="selectTimeSlot(this, '17.00 WIB')" style="background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: #84cc16; border-radius: 0.65rem; padding: 0.55rem 0.3rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 800; transition: all 0.2s;">
                            ☀️ 17.00
                        </button>
                        <button type="button" class="time-slot-btn" onclick="selectTimeSlot(this, '19.00 WIB')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: white; border-radius: 0.65rem; padding: 0.55rem 0.3rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                            🌙 19.00
                        </button>
                        <button type="button" class="time-slot-btn" onclick="selectTimeSlot(this, '20.30 WIB')" style="background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: white; border-radius: 0.65rem; padding: 0.55rem 0.3rem; text-align: center; cursor: pointer; font-size: 0.775rem; font-weight: 700; transition: all 0.2s;">
                            🌙 20.30
                        </button>
                    </div>
                </div>

                <!-- 6. Interactive Promo Code Section -->
                <div style="margin-bottom: 1.25rem; background: rgba(255,255,255,0.03); border: 1px dashed rgba(132,204,22,0.4); border-radius: 0.85rem; padding: 0.85rem;">
                    <label style="display: flex; justify-content: space-between; align-items: center; font-weight: 700; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 0.4rem;">
                        <span><i class="fa-solid fa-ticket" style="color: #84cc16;"></i> Punya Kode Voucher Promo?</span>
                        <span style="font-size: 0.75rem; color: #84cc16;">Opsional</span>
                    </label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="promo_code" id="trialPromoCodeInput" class="form-control" placeholder="Contoh: TRIALFREE / FITLIFE10" style="padding: 0.55rem 0.85rem; font-size: 0.875rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; text-transform: uppercase; font-weight: 800; flex: 1; outline: none;">
                        <button type="button" onclick="verifyTrialPromoCode()" style="background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.55rem 1rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.85rem; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                            Gunakan Kode
                        </button>
                    </div>
                    <div id="trialPromoMessage" style="margin-top: 0.45rem; font-size: 0.8rem; display: none;"></div>
                </div>

                <!-- Submit Action Buttons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #ffffff !important; border: none; padding: 0.85rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>KIRIM PENDAFTARAN TRIAL</span>
                    </button>
                    <button type="button" onclick="submitTrialToWA()" class="btn" style="width: 100%; background: #25d366; color: #ffffff; border: none; padding: 0.85rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(37,211,102,0.4);">
                        <i class="fa-brands fa-whatsapp" style="font-size: 1.1rem;"></i> Booking via WA
                    </button>
                </div>
            </form>
        </div>

        <!-- E-Voucher Ticket Confirmation Screen (Shown after booking) -->
        <div id="trialTicketContainer" style="display: none; text-align: center; padding: 0.5rem 0;">
            <div style="display: inline-flex; width: 56px; height: 56px; background: rgba(132, 204, 22, 0.2); border-radius: 50%; color: #84cc16; align-items: center; justify-content: center; font-size: 1.75rem; margin-bottom: 0.75rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4);">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h3 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; margin-bottom: 0.2rem; font-family: 'Outfit', sans-serif;">Reservasi Berhasil Dibuat!</h3>
            <p style="color: #94a3b8; font-size: 0.875rem; margin-bottom: 1.25rem;">Tunjukkan E-Voucher tiket di bawah ini kepada admin/resepsionis FitLife.</p>

            <!-- Digital Ticket Card -->
            <div style="background: linear-gradient(135deg, #162019 0%, #0d1310 100%); border: 2px dashed #84cc16; border-radius: 1.25rem; padding: 1.5rem; text-align: left; margin-bottom: 1.5rem; position: relative;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.75rem; margin-bottom: 0.85rem;">
                    <div>
                        <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Kode E-Voucher Trial</span>
                        <div style="font-size: 1.3rem; font-weight: 900; color: #84cc16; font-family: monospace;" id="ticketCode">FL-TRIAL-8921</div>
                    </div>
                    <div style="background: rgba(132,204,22,0.15); color: #84cc16; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 99px;" id="ticketBadgeText">
                        STATUS: ACTIVE
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem;" class="grid-2">
                    <div>
                        <span style="color: #94a3b8;">Pendaftar:</span>
                        <div style="color: #ffffff; font-weight: 800;" id="ticketName">Bima Perkasa</div>
                    </div>
                    <div>
                        <span style="color: #94a3b8;">Program:</span>
                        <div style="color: #ffffff; font-weight: 800;" id="ticketProgram">Weight Loss</div>
                    </div>
                    <div>
                        <span style="color: #94a3b8;">Jadwal Tanggal & Jam:</span>
                        <div style="color: #84cc16; font-weight: 800;" id="ticketDateTime">Hari Ini, 17.00 WIB</div>
                    </div>
                    <div>
                        <span style="color: #94a3b8;">Lokasi Gym:</span>
                        <div style="color: #ffffff; font-weight: 800;" id="ticketLoc">Sleman HQ</div>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Direct Confirmation Button -->
            <a href="#" id="waTicketBtn" target="_blank" class="btn" style="width: 100%; background: #25d366; color: #ffffff; border: none; padding: 0.95rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; text-decoration: none; box-shadow: 0 0 25px rgba(37,211,102,0.4);">
                <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i>
                <span>Konfirmasi Jadwal Ini ke WA Admin</span>
            </a>
        </div>

    </div>
</div>

<script>
    let activeTrialPromoCode = '';

    function verifyTrialPromoCode() {
        const input = document.getElementById('trialPromoCodeInput');
        const msgDiv = document.getElementById('trialPromoMessage');
        const code = input.value.trim();

        if (!code) {
            msgDiv.style.display = 'block';
            msgDiv.style.color = '#f87171';
            msgDiv.innerText = 'Silakan masukkan kode voucher promo terlebih dahulu.';
            return;
        }

        fetch('/check-promo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        })
        .then(res => res.json())
        .then(data => {
            msgDiv.style.display = 'block';
            if (data.success && data.valid) {
                activeTrialPromoCode = data.code;
                msgDiv.style.color = '#84cc16';
                msgDiv.innerHTML = `<i class="fa-solid fa-circle-check"></i> <strong>${data.title}</strong>: ${data.description}`;
            } else {
                activeTrialPromoCode = '';
                msgDiv.style.color = '#f87171';
                msgDiv.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> ${data.message || 'Kode promo tidak valid.'}`;
            }
        })
        .catch(err => {
            msgDiv.style.display = 'block';
            msgDiv.style.color = '#f87171';
            msgDiv.innerText = 'Gagal memverifikasi kode promo. Silakan coba lagi.';
        });
    }

    // Generate 7-Day Date Pills Dynamically
    function initDatePills() {
        const wrapper = document.getElementById('datePillsWrapper');
        if (!wrapper) return;
        wrapper.innerHTML = '';

        const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
        
        const today = new Date();

        for (let i = 0; i < 7; i++) {
            const d = new Date(today);
            d.setDate(today.getDate() + i);

            const yearStr = d.getFullYear();
            const monthStr = String(d.getMonth() + 1).padStart(2, '0');
            const dayStr = String(d.getDate()).padStart(2, '0');
            const isoDate = `${yearStr}-${monthStr}-${dayStr}`;

            let labelDay = days[d.getDay()];
            let labelNum = d.getDate() + ' ' + months[d.getMonth()];
            if (i === 0) labelDay = 'Hari Ini';
            if (i === 1) labelDay = 'Besok';
            if (i === 2) labelDay = 'Lusa';

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'date-pill-btn' + (i === 0 ? ' active' : '');
            btn.style.cssText = (i === 0) 
                ? 'background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: #84cc16; border-radius: 0.75rem; padding: 0.55rem 0.85rem; text-align: center; cursor: pointer; flex-shrink: 0; min-width: 76px; transition: all 0.2s;'
                : 'background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: white; border-radius: 0.75rem; padding: 0.55rem 0.85rem; text-align: center; cursor: pointer; flex-shrink: 0; min-width: 76px; transition: all 0.2s;';
            
            btn.onclick = function() {
                document.querySelectorAll('.date-pill-btn').forEach(b => {
                    b.style.background = 'rgba(255,255,255,0.05)';
                    b.style.borderColor = 'rgba(255,255,255,0.12)';
                    b.style.color = 'white';
                    b.classList.remove('active');
                });
                btn.style.background = 'rgba(132,204,22,0.15)';
                btn.style.borderColor = '#84cc16';
                btn.style.color = '#84cc16';
                btn.classList.add('active');

                document.getElementById('trialInputDate').value = isoDate;
                document.getElementById('selectedDateDisplay').innerText = labelDay + ', ' + labelNum;
            };

            btn.innerHTML = `<div style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase;">${labelDay}</div><div style="font-size: 0.85rem; font-weight: 900;">${labelNum}</div>`;
            wrapper.appendChild(btn);

            if (i === 0) {
                document.getElementById('trialInputDate').value = isoDate;
                document.getElementById('selectedDateDisplay').innerText = labelDay + ', ' + labelNum;
            }
        }
    }

    function selectLocPill(btn, locValue) {
        document.querySelectorAll('.loc-pill-btn').forEach(b => {
            b.style.background = 'rgba(255,255,255,0.05)';
            b.style.borderColor = 'rgba(255,255,255,0.12)';
            b.style.color = '#cbd5e1';
            b.classList.remove('active');
        });
        btn.style.background = 'rgba(132,204,22,0.15)';
        btn.style.borderColor = '#84cc16';
        btn.style.color = 'white';
        btn.classList.add('active');
        document.getElementById('trialInputLoc').value = locValue;
    }

    function selectTimeSlot(btn, timeValue) {
        document.querySelectorAll('.time-slot-btn').forEach(b => {
            b.style.background = 'rgba(255,255,255,0.05)';
            b.style.borderColor = 'rgba(255,255,255,0.12)';
            b.style.color = 'white';
            b.classList.remove('active');
        });
        btn.style.background = 'rgba(132,204,22,0.15)';
        btn.style.borderColor = '#84cc16';
        btn.style.color = '#84cc16';
        btn.classList.add('active');
        document.getElementById('trialInputTime').value = timeValue;
    }

    function handleTrialSubmit(e) {
        e.preventDefault();
        const form = document.getElementById('formTrial');
        const name = document.getElementById('trialInputName').value;
        const phone = document.getElementById('trialInputPhone').value;
        const prog = document.getElementById('trialProgramSelect').value;
        const loc = document.getElementById('trialInputLoc').value;
        const dateDisplay = document.getElementById('selectedDateDisplay').innerText;
        const time = document.getElementById('trialInputTime').value;
        const promo = activeTrialPromoCode || document.getElementById('trialPromoCodeInput').value.trim();
        
        document.getElementById('trialInputPartName').value = name;

        // Generate E-Voucher Ticket
        const randCode = 'FL-TRIAL-' + Math.floor(1000 + Math.random() * 9000);
        document.getElementById('ticketCode').innerText = randCode;
        document.getElementById('ticketName').innerText = name;
        document.getElementById('ticketProgram').innerText = prog;
        document.getElementById('ticketDateTime').innerText = dateDisplay + ' jam ' + time;
        document.getElementById('ticketLoc').innerText = loc;

        if (promo) {
            document.getElementById('ticketBadgeText').innerText = 'PROMO: ' + promo;
        }

        const waMsg = `Halo Admin FitLife Gym Jogja, saya baru saja melakukan *Booking Sesi Trial 7 Hari* di Website:
- Kode E-Voucher: *${randCode}*
- Nama Pendaftar: *${name}*
- No. WhatsApp: *${phone}*
- Program Pilihan: *${prog}*
- Tanggal & Waktu: *${dateDisplay} jam ${time}*
- Lokasi Gym: *${loc}*` +
(promo ? `\n- *KODE VOUCHER PROMO:* *${promo}*` : '') +
`\n\nMohon konfirmasi ketersediaan slot & pelatih trial saya. Terima kasih!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        document.getElementById('waTicketBtn').href = `https://wa.me/${waNum}?text=${encodeURIComponent(waMsg)}`;

        // Switch to ticket view
        document.getElementById('trialFormContainer').style.display = 'none';
        document.getElementById('trialTicketContainer').style.display = 'block';

        // Submit form via fetch / AJAX
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        }).catch(err => console.log('Lead logged:', err));
    }

    function submitTrialToWA() {
        const form = document.getElementById('formTrial');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        handleTrialSubmit(new Event('submit'));
    }

    document.addEventListener('DOMContentLoaded', function() {
        initDatePills();
    });
</script>
