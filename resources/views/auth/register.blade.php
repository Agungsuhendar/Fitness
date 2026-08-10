@extends('layouts.app')

@section('title', 'Daftar Akun Member | FitLife Center Jogja')
@section('meta_description', 'Pendaftaran akun baru member FitLife Center Jogja. Dapatkan akses ke dashboard member, jadwal personal trainer, dan statistik kebugaran Anda.')

@section('content')
<section style="min-height: 85vh; padding: 7rem 1rem 4rem; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; background: radial-gradient(circle at 50% 20%, rgba(132, 204, 22, 0.08) 0%, rgba(10, 15, 13, 0.98) 70%);">
    
    <!-- Decorative Ambient Glow -->
    <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 600px; height: 600px; background: radial-gradient(circle, rgba(132, 204, 22, 0.15) 0%, rgba(0,0,0,0) 70%); filter: blur(60px); pointer-events: none;"></div>

    <div class="container" style="max-width: 520px; width: 100%; position: relative; z-index: 2;">
        
        <div style="background: rgba(13, 19, 16, 0.92); backdrop-filter: blur(20px); border: 1.5px solid rgba(132, 204, 22, 0.3); border-radius: 1.5rem; padding: 2.5rem 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.9), 0 0 30px rgba(132, 204, 22, 0.15);">
            
            <!-- Card Header -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 64px; height: 64px; background: rgba(132, 204, 22, 0.15); border: 2px solid #84cc16; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.3);">
                    <i class="fa-solid fa-user-plus" style="font-size: 1.75rem; color: #84cc16;"></i>
                </div>
                <h1 style="font-size: 1.75rem; font-weight: 900; color: #ffffff; margin: 0 0 0.5rem; letter-spacing: -0.02em;">Buat Akun Member Baru</h1>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">Lengkapi data diri Anda untuk membuka akses Dashboard Member FitLife</p>
            </div>

            <!-- Error Alerts -->
            @if (isset($errors) && method_exists($errors, 'any') && $errors->any())
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 0.85rem; padding: 0.85rem 1rem; margin-bottom: 1.5rem; color: #fca5a5; font-size: 0.875rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 700; margin-bottom: 0.25rem;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Pendaftaran Belum Lengkap:</span>
                    </div>
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Nama Lengkap
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-id-card"></i>
                        </span>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="contoh: Bima Perkasa"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Alamat Email
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            placeholder="nama@email.com"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label for="phone" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Nomor WhatsApp Aktif
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </span>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                            placeholder="081234567890"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Paket Membership & Harga -->
                @php
                    if (!isset($membershipPlans) || $membershipPlans->isEmpty()) {
                        try { $membershipPlans = \App\Models\MembershipPlan::all(); } catch (\Throwable $e) { $membershipPlans = collect(); }
                    }
                    if (!isset($programs) || $programs->isEmpty()) {
                        try { $programs = \App\Models\Program::all(); } catch (\Throwable $e) { $programs = collect(); }
                    }
                    if (!isset($branches) || $branches->isEmpty()) {
                        try { $branches = \App\Models\Location::all(); } catch (\Throwable $e) { $branches = collect(); }
                    }
                @endphp
                <div>
                    <label for="membershipTypeSelect" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Paket Membership &amp; Harga *
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16; z-index: 2;">
                            <i class="fa-solid fa-id-card"></i>
                        </span>
                        <select id="membershipTypeSelect" name="membership_type" required onchange="autoFillMembershipRegister(this)"
                            style="width: 100%; background: rgba(13, 19, 16, 0.95); border: 1.5px solid rgba(132, 204, 22, 0.5); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.9rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)';">
                            <optgroup label="💳 PAKET KEANGGOTAAN GYM (MEMBERSHIP PLANS)" style="background: #0d1310; color: #84cc16; font-weight: 800;">
                                <option value="Regular Gym Pass (Bulanan)" data-price="300000" data-sessions="0" data-duration="30" style="background: #161f19; color: #ffffff;">Regular Gym Pass (Bulanan) — Rp 300.000 (30 Hari)</option>
                                <option value="VIP Personal Trainer Pass 1-on-1" data-price="1200000" data-sessions="12" data-duration="30" style="background: #161f19; color: #ffffff;">VIP Personal Trainer Pass 1-on-1 — Rp 1.200.000 (30 Hari)</option>
                                <option value="Student Promo Gym Pass" data-price="200000" data-sessions="0" data-duration="30" style="background: #161f19; color: #ffffff;">Student Promo Gym Pass — Rp 200.000 (30 Hari)</option>
                                <option value="Daily Pass (Harian)" data-price="35000" data-sessions="1" data-duration="1" style="background: #161f19; color: #ffffff;">Daily Pass (Harian) — Rp 35.000 (1 Hari)</option>
                                @if(isset($membershipPlans) && $membershipPlans->count() > 0)
                                    @foreach($membershipPlans as $plan)
                                        <option value="{{ $plan->name }}" data-price="{{ $plan->promo_price ?: $plan->price }}" data-sessions="{{ $plan->session_count ?: 0 }}" data-duration="{{ $plan->duration_days ?: 30 }}" style="background: #161f19; color: #ffffff;">
                                            {{ $plan->name }} — Rp {{ number_format($plan->promo_price ?: $plan->price, 0, ',', '.') }} ({{ $plan->duration_days ?: 30 }} Hari) {{ $plan->badge ? '('.$plan->badge.')' : '' }}
                                        </option>
                                    @endforeach
                                @endif
                            </optgroup>

                            <optgroup label="🏋️ PROGRAM FITNESS & PT KHUSUS (PROGRAMS)" style="background: #0d1310; color: #84cc16; font-weight: 800;">
                                <option value="Program: Weight Loss & Fat Burn" data-price="450000" data-sessions="12" data-duration="30" style="background: #161f19; color: #ffffff;">Program Weight Loss & Fat Burn — Rp 450.000 (30 Hari)</option>
                                <option value="Program: Muscle Building & Hypertrophy" data-price="500000" data-sessions="12" data-duration="30" style="background: #161f19; color: #ffffff;">Program Muscle Building & Bulking — Rp 500.000 (30 Hari)</option>
                                <option value="Program: Female Fitness & Body Shaping" data-price="450000" data-sessions="12" data-duration="30" style="background: #161f19; color: #ffffff;">Program Female Fitness (Khusus Wanita) — Rp 450.000 (30 Hari)</option>
                                <option value="Program: Persiapan Fisik TNI / POLRI" data-price="600000" data-sessions="16" data-duration="30" style="background: #161f19; color: #ffffff;">Program Persiapan Fisik TNI / POLRI — Rp 600.000 (30 Hari)</option>
                                @if(isset($programs) && $programs->count() > 0)
                                    @foreach($programs as $prog)
                                        <option value="Program: {{ $prog->title }}" data-price="{{ $prog->price_start ?: 450000 }}" data-sessions="12" data-duration="30" style="background: #161f19; color: #ffffff;">
                                            Program {{ $prog->title }} — Rp {{ number_format($prog->price_start ?: 450000, 0, ',', '.') }} {{ $prog->badge ? '('.$prog->badge.')' : '' }}
                                        </option>
                                    @endforeach
                                @endif
                            </optgroup>
                        </select>
                    </div>
                </div>

                <!-- Pilihan Cabang Gym -->
                <div>
                    <label for="branch" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Pilih Cabang Studio Gym *
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16; z-index: 2;">
                            <i class="fa-solid fa-building"></i>
                        </span>
                        <select id="branch" name="branch" required
                            style="width: 100%; background: rgba(13, 19, 16, 0.95); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.9rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)';">
                            <option value="Sleman HQ (Jl. Kaliurang KM 5.5)" style="background: #161f19; color: #ffffff;">🏢 Sleman HQ (Jl. Kaliurang KM 5.5)</option>
                            <option value="FitLife Studio Seturan (UGM)" style="background: #161f19; color: #ffffff;">🏢 Seturan Studio (UGM)</option>
                            <option value="FitLife Branch Sewon (Bantul)" style="background: #161f19; color: #ffffff;">🏢 Sewon Bantul</option>
                            @if(isset($branches) && $branches->count() > 0)
                                @foreach($branches as $b)
                                    <option value="{{ $b->name }}{{ $b->city ? ' ('.$b->city.')' : '' }}" style="background: #161f19; color: #ffffff;">
                                        🏢 {{ $b->name }} {{ $b->city ? ' ('.$b->city.')' : '' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Metode Pembayaran Online -->
                <div>
                    <label for="payment_method" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Metode Pembayaran *
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16; z-index: 2;">
                            <i class="fa-solid fa-wallet"></i>
                        </span>
                        <select id="payment_method" name="payment_method" required onchange="updatePaymentStatusBadge()"
                            style="width: 100%; background: rgba(13, 19, 16, 0.95); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.9rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)';">
                            <option value="QRIS (GoPay/OVO/ShopeePay/DANA)" style="background: #161f19; color: #ffffff;">📱 QRIS Instant (Langsung Aktif)</option>
                            <option value="Transfer Bank BCA / Mandiri" style="background: #161f19; color: #ffffff;">🏦 Transfer Bank (Pending Verifikasi)</option>
                            <option value="EDC Debit / Kartu Kredit" style="background: #161f19; color: #ffffff;">💳 Kartu Kredit / Debit (Langsung Aktif)</option>
                            <option value="Bayar di Kasir Studio (Walk-In)" style="background: #161f19; color: #ffffff;">💵 Bayar Cash di Kasir Studio (Pending Bayar)</option>
                        </select>
                    </div>
                </div>

                <!-- Total Biaya Box Display -->
                <div style="background: rgba(132, 204, 22, 0.1); border: 1.5px solid #84cc16; border-radius: 0.85rem; padding: 1rem; text-align: center;">
                    <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 0.2rem;">TOTAL BIAYA PEMBAYARAN</span>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;" id="displayPriceText">
                        Rp 300.000
                    </div>
                    <span style="font-size: 0.725rem; color: #cbd5e1; display: block; margin-top: 0.25rem;" id="displayDetailText">
                        Masa Berlaku: <strong id="displayExpDate">30 Hari</strong>
                    </span>
                    <div style="margin-top: 0.5rem;" id="displayStatusBadgeContainer">
                        <span id="displayStatusBadge" style="background: rgba(132, 204, 22, 0.2); color: #84cc16; border: 1px solid #84cc16; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 99px; display: inline-block;">
                            ⚡ Status: Active (Lunas Instant)
                        </span>
                    </div>
                </div>

                <!-- Hidden inputs for backend submission -->
                <input type="hidden" name="membership_price" id="regPriceInput" value="300000">
                <input type="hidden" name="remaining_sessions" id="regSessionsInput" value="0">
                <input type="hidden" name="membership_expires_at" id="regExpInput" value="{{ date('Y-m-d', strtotime('+30 days')) }}">

                <!-- Password -->
                <div>
                    <label for="password" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Password Akses Portal (Min 6 Karakter) *
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" required
                            placeholder="••••••••"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Ulangi Password *
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="••••••••"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907; border: none; padding: 0.95rem; border-radius: 0.85rem; font-size: 1rem; font-weight: 900; cursor: pointer; transition: all 0.25s ease; box-shadow: 0 0 25px rgba(132, 204, 22, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 0.5rem;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 35px rgba(132, 204, 22, 0.6)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 25px rgba(132, 204, 22, 0.4)';">
                    <span style="color: #060907 !important;">PROSES PENDAFTARAN &amp; TERBITKAN ID CARD</span>
                    <i class="fa-solid fa-arrow-right" style="color: #060907 !important;"></i>
                </button>

            </form>

            <script>
            function autoFillMembershipRegister(selectEl) {
                if (!selectEl) return;
                const selectedOption = selectEl.options[selectEl.selectedIndex];
                if (!selectedOption) return;
                
                const price = selectedOption.getAttribute('data-price') || '300000';
                const sessions = selectedOption.getAttribute('data-sessions') || '0';
                const durationDays = selectedOption.getAttribute('data-duration') || '30';

                document.getElementById('regPriceInput').value = price;
                document.getElementById('regSessionsInput').value = sessions;

                const formattedPrice = 'Rp ' + parseInt(price).toLocaleString('id-ID');
                if (document.getElementById('displayPriceText')) {
                    document.getElementById('displayPriceText').innerText = formattedPrice;
                }

                const expDate = new Date();
                expDate.setDate(expDate.getDate() + parseInt(durationDays));
                const yyyy = expDate.getFullYear();
                const mm = String(expDate.getMonth() + 1).padStart(2, '0');
                const dd = String(expDate.getDate()).padStart(2, '0');
                
                const expDateFormatted = `${dd}/${mm}/${yyyy}`;
                if (document.getElementById('regExpInput')) {
                    document.getElementById('regExpInput').value = `${yyyy}-${mm}-${dd}`;
                }
                if (document.getElementById('displayExpDate')) {
                    document.getElementById('displayExpDate').innerText = `${durationDays} Hari (Berlaku s.d ${expDateFormatted})`;
                }
            }

            function updatePaymentStatusBadge() {
                const payMethodEl = document.getElementById('payment_method');
                if (!payMethodEl) return;
                const val = payMethodEl.value.toLowerCase();
                const badgeEl = document.getElementById('displayStatusBadge');
                if (!badgeEl) return;

                if (val.includes('transfer') || val.includes('bank')) {
                    badgeEl.style.background = 'rgba(251, 191, 36, 0.2)';
                    badgeEl.style.color = '#fbbf24';
                    badgeEl.style.borderColor = '#fbbf24';
                    badgeEl.innerText = '⏳ Status: Pending (Menunggu Verifikasi Transfer)';
                } else if (val.includes('kasir') || val.includes('cash') || val.includes('tunai')) {
                    badgeEl.style.background = 'rgba(251, 191, 36, 0.2)';
                    badgeEl.style.color = '#fbbf24';
                    badgeEl.style.borderColor = '#fbbf24';
                    badgeEl.innerText = '💵 Status: Pending (Bayar di Kasir Studio)';
                } else {
                    badgeEl.style.background = 'rgba(132, 204, 22, 0.2)';
                    badgeEl.style.color = '#84cc16';
                    badgeEl.style.borderColor = '#84cc16';
                    badgeEl.innerText = '⚡ Status: Active (Lunas Instant)';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const sel = document.getElementById('membershipTypeSelect');
                if (sel) {
                    autoFillMembershipRegister(sel);
                }
                updatePaymentStatusBadge();
            });
            </script>

            <!-- Login Footer Link -->
            <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Sudah memiliki akun member? 
                    <a href="{{ route('login') }}" style="color: #84cc16; font-weight: 800; text-decoration: none;">
                        Masuk ke Akun Anda
                    </a>
                </p>
            </div>

        </div>

    </div>
</section>
@endsection
