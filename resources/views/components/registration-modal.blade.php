<div class="modal-overlay" id="registrationModal" style="z-index: 9999999 !important; padding: 2.5rem 1rem 1.5rem 1rem;">
    <div class="modal-card" style="max-width: 640px; width: 100%; padding: 2rem; background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); color: #ffffff; border-radius: 1.75rem; max-height: 85vh; overflow-y: auto; scrollbar-width: thin; position: relative; margin-top: auto; margin-bottom: auto;">
        <button class="modal-close" onclick="closeRegistrationModal()" style="color: #ffffff; background: rgba(255,255,255,0.1); border-radius: 50%; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; top: 1.25rem; right: 1.25rem;">&times;</button>
        
        @php
            $modalPlans = collect();
            $modalProgs = collect();
            $modalLocs = collect();
            try { $modalPlans = \App\Models\MembershipPlan::all(); } catch(\Throwable $e) {}
            try { $modalProgs = \App\Models\Program::all(); } catch(\Throwable $e) {}
            try { $modalLocs = \App\Models\Location::all(); } catch(\Throwable $e) {}
        @endphp

        <div style="text-align: center; margin-bottom: 1.25rem;">
            <div style="display: inline-flex; width: 52px; height: 52px; background: rgba(132, 204, 22, 0.15); border: 2px solid #84cc16; border-radius: 50%; color: #84cc16; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.3);">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h3 style="font-size: 1.6rem; font-weight: 900; margin-bottom: 0.2rem; color: #ffffff; font-family: 'Outfit', sans-serif;">Pendaftaran &amp; Buat Akun Member</h3>
            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Lengkapi data diri Anda untuk membuka akses Kartu Member Digital &amp; Dashboard FitLife.</p>
        </div>

        <form action="{{ route('register') }}" method="POST" id="formRegistration" onsubmit="handleRegistrationSubmit(event)">
            @csrf

            <!-- 1. Data Diri (Nama, Phone, Email) -->
            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 0.85rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" required placeholder="contoh: Bima Perkasa" class="form-control" style="padding: 0.65rem 0.85rem; font-size: 0.9rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none; width: 100%;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">No. WhatsApp <span style="color:#ef4444;">*</span></label>
                    <input type="tel" name="phone" required placeholder="081234567890" class="form-control" style="padding: 0.65rem 0.85rem; font-size: 0.9rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none; width: 100%;">
                </div>
            </div>

            <!-- 2. Email & Password -->
            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 0.85rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">Alamat Email <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" required placeholder="nama@email.com" class="form-control" style="padding: 0.65rem 0.85rem; font-size: 0.9rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none; width: 100%;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 700;">Password Login <span style="color:#ef4444;">*</span></label>
                    <input type="password" name="password" required placeholder="•••••••• (Min 6 Karakter)" class="form-control" style="padding: 0.65rem 0.85rem; font-size: 0.9rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; font-weight: 600; outline: none; width: 100%;">
                    <input type="hidden" name="password_confirmation" id="modalPasswordConfirm">
                </div>
            </div>

            <!-- 3. Paket Membership / Program -->
            <div style="margin-bottom: 0.85rem;">
                <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">
                    Pilih Paket Membership / PT <span style="color:#ef4444;">*</span>
                </label>
                <select name="membership_type" id="modalMembershipSelect" required onchange="updateModalPriceDisplay(this)"
                    style="width: 100%; background: #161f19; border: 1.5px solid rgba(132, 204, 22, 0.5); border-radius: 0.65rem; padding: 0.65rem 0.85rem; color: #ffffff; font-size: 0.875rem; font-weight: 700; outline: none;">
                    <optgroup label="💳 PAKET KEANGGOTAAN GYM (MEMBERSHIP PLANS)" style="background: #0d1310; color: #84cc16; font-weight: 800;">
                        <option value="Regular Gym Pass (Bulanan)" data-price="300000" data-duration="30" style="background: #161f19; color: #ffffff;">Regular Gym Pass (Bulanan) — Rp 300.000 (30 Hari)</option>
                        <option value="VIP Personal Trainer Pass 1-on-1" data-price="1200000" data-duration="30" style="background: #161f19; color: #ffffff;">VIP Personal Trainer Pass 1-on-1 — Rp 1.200.000 (30 Hari)</option>
                        <option value="Student Promo Gym Pass" data-price="200000" data-duration="30" style="background: #161f19; color: #ffffff;">Student Promo Gym Pass — Rp 200.000 (30 Hari)</option>
                        <option value="Daily Pass (Harian)" data-price="35000" data-duration="1" style="background: #161f19; color: #ffffff;">Daily Pass (Harian) — Rp 35.000 (1 Hari)</option>
                        @if($modalPlans->count() > 0)
                            @foreach($modalPlans as $plan)
                                <option value="{{ $plan->name }}" data-price="{{ $plan->promo_price ?: $plan->price }}" data-duration="{{ $plan->duration_days ?: 30 }}" style="background: #161f19; color: #ffffff;">
                                    {{ $plan->name }} — Rp {{ number_format($plan->promo_price ?: $plan->price, 0, ',', '.') }} ({{ $plan->duration_days ?: 30 }} Hari) {{ $plan->badge ? '('.$plan->badge.')' : '' }}
                                </option>
                            @endforeach
                        @endif
                    </optgroup>

                    <optgroup label="🏋️ PROGRAM FITNESS & PT KHUSUS (PROGRAMS)" style="background: #0d1310; color: #84cc16; font-weight: 800;">
                        <option value="Program: Weight Loss & Fat Burn" data-price="450000" data-duration="30" style="background: #161f19; color: #ffffff;">Program Weight Loss & Fat Burn — Rp 450.000 (30 Hari)</option>
                        <option value="Program: Muscle Building & Hypertrophy" data-price="500000" data-duration="30" style="background: #161f19; color: #ffffff;">Program Muscle Building & Bulking — Rp 500.000 (30 Hari)</option>
                        <option value="Program: Female Fitness & Body Shaping" data-price="450000" data-duration="30" style="background: #161f19; color: #ffffff;">Program Female Fitness (Khusus Wanita) — Rp 450.000 (30 Hari)</option>
                        <option value="Program: Persiapan Fisik TNI / POLRI" data-price="600000" data-duration="30" style="background: #161f19; color: #ffffff;">Program Persiapan Fisik TNI / POLRI — Rp 600.000 (30 Hari)</option>
                        @if($modalProgs->count() > 0)
                            @foreach($modalProgs as $prog)
                                <option value="Program: {{ $prog->title }}" data-price="{{ $prog->price_start ?: 450000 }}" data-duration="30" style="background: #161f19; color: #ffffff;">
                                    Program {{ $prog->title }} — Rp {{ number_format($prog->price_start ?: 450000, 0, ',', '.') }} {{ $prog->badge ? '('.$prog->badge.')' : '' }}
                                </option>
                            @endforeach
                        @endif
                    </optgroup>
                </select>
            </div>

            <!-- 4. Cabang Studio & Metode Pembayaran -->
            <div class="grid-2" style="gap: 0.85rem; margin-bottom: 0.85rem;">
                <div>
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Cabang Studio Gym <span style="color:#ef4444;">*</span></label>
                    <select name="branch" required style="width: 100%; background: #161f19; border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem 0.85rem; color: #ffffff; font-size: 0.875rem; font-weight: 700; outline: none;">
                        <option value="Sleman HQ (Jl. Kaliurang KM 5.5)" style="background: #161f19; color: #ffffff;">🏢 Sleman HQ (Jl. Kaliurang KM 5.5)</option>
                        <option value="FitLife Studio Seturan (UGM)" style="background: #161f19; color: #ffffff;">🏢 Seturan Studio (UGM)</option>
                        <option value="FitLife Branch Sewon (Bantul)" style="background: #161f19; color: #ffffff;">🏢 Sewon Bantul</option>
                        @if($modalLocs->count() > 0)
                            @foreach($modalLocs as $b)
                                <option value="{{ $b->name }}{{ $b->city ? ' ('.$b->city.')' : '' }}" style="background: #161f19; color: #ffffff;">
                                    🏢 {{ $b->name }} {{ $b->city ? ' ('.$b->city.')' : '' }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.35rem;">Metode Pembayaran <span style="color:#ef4444;">*</span></label>
                    <select name="payment_method" required style="width: 100%; background: #161f19; border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem 0.85rem; color: #ffffff; font-size: 0.875rem; font-weight: 700; outline: none;">
                        <option value="QRIS (GoPay/OVO/ShopeePay/DANA)" style="background: #161f19; color: #ffffff;">📱 QRIS Instant (Langsung Aktif)</option>
                        <option value="Transfer Bank BCA / Mandiri" style="background: #161f19; color: #ffffff;">🏦 Transfer Bank (Pending Verifikasi)</option>
                        <option value="EDC Debit / Kartu Kredit" style="background: #161f19; color: #ffffff;">💳 Kartu Kredit / Debit (Langsung Aktif)</option>
                        <option value="Bayar di Kasir Studio (Walk-In)" style="background: #161f19; color: #ffffff;">💵 Bayar Cash di Kasir Studio (Pending)</option>
                    </select>
                </div>
            </div>

            <!-- 5. Total Price & Status Display Box -->
            <div style="background: rgba(132, 204, 22, 0.08); border: 1.5px solid #84cc16; border-radius: 0.85rem; padding: 0.85rem; text-align: center; margin-bottom: 0.85rem;">
                <span style="font-size: 0.725rem; color: #94a3b8; font-weight: 800; text-transform: uppercase; display: block;">TOTAL ESTIMASI INVESTASI KESEHATAN</span>
                <div style="font-size: 1.45rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif; margin-top: 0.15rem;" id="modalPriceText">
                    Rp 300.000
                </div>
                <span style="font-size: 0.75rem; color: #cbd5e1; display: block; margin-top: 0.15rem;">
                    Masa Berlaku: <strong id="modalExpDays">30 Hari</strong> • Bonus ID Kartu Member Digital
                </span>
            </div>

            <!-- Hidden values -->
            <input type="hidden" name="membership_price" id="modalPriceInput" value="300000">

            <!-- 6. Voucher Promo Section -->
            <div style="margin-bottom: 1rem; background: rgba(255,255,255,0.03); border: 1px dashed rgba(132,204,22,0.4); border-radius: 0.85rem; padding: 0.75rem;">
                <label style="font-size: 0.8rem; color: #cbd5e1; font-weight: 700; display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;">
                    <span><i class="fa-solid fa-ticket" style="color: #84cc16;"></i> Kode Voucher Promo (Opsional)</span>
                </label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="promo_code" id="modalPromoCodeInput" placeholder="Contoh: FITLIFE10 / MAHASISWA15" style="padding: 0.5rem 0.85rem; font-size: 0.85rem; background: #161f19; border: 1.5px solid rgba(255,255,255,0.15); color: #ffffff; border-radius: 0.65rem; text-transform: uppercase; font-weight: 800; flex: 1; outline: none;">
                    <button type="button" onclick="verifyModalPromoCode()" style="background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.5rem 0.85rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.825rem; cursor: pointer; white-space: nowrap;">
                        Gunakan
                    </button>
                </div>
                <div id="modalPromoMsg" style="margin-top: 0.35rem; font-size: 0.775rem; display: none;"></div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                <button type="submit" class="btn glow-btn" style="width: 100%; padding: 0.85rem; font-weight: 900; border-radius: 99px; background: #84cc16; border: none; color: #060907 !important; box-shadow: 0 0 20px rgba(132,204,22,0.4); font-size: 0.9rem; cursor: pointer;">
                    <i class="fa-solid fa-user-check"></i> DAFTAR AKUN MEMBER
                </button>
                <button type="button" onclick="submitModalToWA()" class="btn" style="width: 100%; padding: 0.85rem; font-weight: 900; border-radius: 99px; background: #25d366; border: none; color: white; box-shadow: 0 0 20px rgba(37,211,102,0.4); font-size: 0.9rem; cursor: pointer;">
                    <i class="fa-brands fa-whatsapp"></i> CHAT ADMIN WA
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateModalPriceDisplay(selectEl) {
        const selectedOpt = selectEl.options[selectEl.selectedIndex];
        const price = parseInt(selectedOpt.getAttribute('data-price') || 300000);
        const duration = selectedOpt.getAttribute('data-duration') || 30;

        document.getElementById('modalPriceText').innerText = 'Rp ' + price.toLocaleString('id-ID');
        document.getElementById('modalPriceInput').value = price;
        document.getElementById('modalExpDays').innerText = duration + ' Hari';
    }

    function verifyModalPromoCode() {
        const input = document.getElementById('modalPromoCodeInput');
        const msgDiv = document.getElementById('modalPromoMsg');
        const code = input.value.trim();

        if (!code) {
            msgDiv.style.display = 'block';
            msgDiv.style.color = '#f87171';
            msgDiv.innerText = 'Masukkan kode voucher terlebih dahulu.';
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
                msgDiv.style.color = '#84cc16';
                msgDiv.innerHTML = `<i class="fa-solid fa-circle-check"></i> <strong>${data.title}</strong>: ${data.description}`;
            } else {
                msgDiv.style.color = '#f87171';
                msgDiv.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> ${data.message || 'Kode promo tidak valid.'}`;
            }
        })
        .catch(err => {
            msgDiv.style.display = 'block';
            msgDiv.style.color = '#f87171';
            msgDiv.innerText = 'Gagal memverifikasi kode promo.';
        });
    }

    function handleRegistrationSubmit(e) {
        const form = document.getElementById('formRegistration');
        const pass = form.querySelector('[name="password"]').value;
        document.getElementById('modalPasswordConfirm').value = pass;
    }

    function submitModalToWA() {
        const form = document.getElementById('formRegistration');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        const name = form.querySelector('[name="name"]').value;
        const phone = form.querySelector('[name="phone"]').value;
        const email = form.querySelector('[name="email"]').value;
        const plan = form.querySelector('[name="membership_type"]').value;
        const branch = form.querySelector('[name="branch"]').value;
        const pay = form.querySelector('[name="payment_method"]').value;
        const promo = form.querySelector('[name="promo_code"]').value.trim();

        const text = `Halo Admin FitLife Gym Jogja, saya ingin mendaftar Akun Member Baru:\n` +
                     `• Nama: *${name}*\n` +
                     `• No. WA: *${phone}*\n` +
                     `• Email: *${email}*\n` +
                     `• Paket Pilihan: *${plan}*\n` +
                     `• Cabang Studio: *${branch}*\n` +
                     `• Metode Pembayaran: *${pay}*\n` +
                     (promo ? `• *KODE PROMO VOUCHER:* *${promo}*\n` : '') +
                     `\nMohon petunjuk pembayaran & pengaktifan akun member saya!`;

        const waNum = "{{ site_setting('whatsapp_number', '6281234567890') }}";
        window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
    }
</script>
