@extends('admin.layout')

@section('title', 'Pendaftaran Member Baru | Admin FitLife Studio')
@section('header_title', 'Pendaftaran Member Gym Baru')

@section('admin_content')
<div style="width: 100%;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('admin.members.index') }}" class="btn" style="background: rgba(255,255,255,0.06); color: #94a3b8; border: 1px solid rgba(255,255,255,0.12); border-radius: 99px; font-size: 0.85rem; font-weight: 700; padding: 0.45rem 1.1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Member
        </a>
    </div>

    @if (isset($errors) && $errors->any())
        <div style="background: rgba(239, 68, 68, 0.15); border: 1.5px solid #ef4444; color: #fca5a5; padding: 1rem 1.25rem; border-radius: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="width: 100%;">
        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 2.25rem; box-shadow: 0 25px 50px rgba(0,0,0,0.6); width: 100%;">
            
            <div style="margin-bottom: 2rem; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 1.25rem;">
                <h3 style="font-size: 1.5rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem; display: flex; align-items: center; gap: 0.65rem;">
                    <i class="fa-solid fa-user-plus" style="color: var(--brand-lime, #84cc16);"></i>
                    <span>Pendaftaran Member Gym Baru (Manual / Walk-In)</span>
                </h3>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Daftarkan akun member baru di studio gym. Kartu ID Card Digital QR Code akan dibuatkan otomatis oleh sistem.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.members.store') }}">
                @csrf

                <!-- Section 1: Informasi Profil -->
                <h5 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-address-card" style="color: var(--brand-lime, #84cc16);"></i> Informasi Akun &amp; Kontak Member
                </h5>
                <div class="row g-3" style="margin-bottom: 2rem;">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NAMA LENGKAP MEMBER *</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name') }}" placeholder="Misal: Budi Pratama" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">EMAIL MEMBER *</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email') }}" placeholder="Misal: budi@gmail.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NOMOR WHATSAPP</label>
                        <input type="text" name="phone" class="form-control bg-dark text-white border-secondary" value="{{ old('phone') }}" placeholder="e.g. 08123456789">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">PASSWORD AKSES APPS (OPSIONAL)</label>
                        <input type="password" name="password" class="form-control bg-dark text-white border-secondary" placeholder="Default: 12345678">
                    </div>
                </div>

                <!-- Section 2: Paket Membership -->
                <h5 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-id-card" style="color: #38bdf8;"></i> Paket Membership &amp; Lokasi Cabang
                </h5>
                <div class="row g-3" style="margin-bottom: 2rem;">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">PAKET MEMBERSHIP *</label>
                        <select name="membership_type" id="membershipTypeSelect" class="form-select bg-dark text-white border-secondary" required onchange="autoFillMembershipPlan(this)">
                            @if((isset($membershipPlans) && $membershipPlans->count() > 0) || (isset($programs) && $programs->count() > 0))
                                @if(isset($membershipPlans) && $membershipPlans->count() > 0)
                                    <optgroup label="💳 PAKET KEANGGOTAAN GYM (MEMBERSHIP PLANS)">
                                        @foreach($membershipPlans as $plan)
                                            <option value="{{ $plan->name }}" data-price="{{ $plan->promo_price ?: $plan->price }}" data-sessions="{{ $plan->session_count ?: 0 }}" data-duration="{{ $plan->duration_days ?: 30 }}">
                                                {{ $plan->name }} — Rp {{ number_format($plan->promo_price ?: $plan->price, 0, ',', '.') }} ({{ $plan->duration_days ?: 30 }} Hari) {{ $plan->badge ? '('.$plan->badge.')' : '' }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif

                                @if(isset($programs) && $programs->count() > 0)
                                    <optgroup label="🏋️ PROGRAM FITNESS & PT KHUSUS (PROGRAMS)">
                                        @foreach($programs as $prog)
                                            <option value="Program: {{ $prog->title }}" data-price="{{ $prog->price_start ?: 450000 }}" data-sessions="12" data-duration="30">
                                                Program {{ $prog->title }} — Rp {{ number_format($prog->price_start ?: 450000, 0, ',', '.') }} {{ $prog->badge ? '('.$prog->badge.')' : '' }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @else
                                <option value="Regular Gym Pass (Bulanan)" data-price="300000" data-sessions="0" data-duration="30">Regular Gym Pass (Bulanan) — Rp 300.000 (30 Hari)</option>
                                <option value="VIP Personal Trainer Pass 1-on-1" data-price="1200000" data-sessions="12" data-duration="30">VIP Personal Trainer Pass 1-on-1 — Rp 1.200.000 (30 Hari)</option>
                                <option value="Daily Pass (Harian)" data-price="35000" data-sessions="1" data-duration="1">Daily Pass (Harian) — Rp 35.000 (1 Hari)</option>
                                <option value="Student Promo Gym Pass" data-price="200000" data-sessions="0" data-duration="30">Student Promo Gym Pass — Rp 200.000 (30 Hari)</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #fbbf24; text-transform: uppercase;">
                            <i class="fa-solid fa-calendar-days"></i> MASA BERLAKU / KADALUARSA MEMBER *
                        </label>
                        <input type="date" name="membership_expires_at" id="membershipExpiresAtInput" class="form-control bg-dark text-white border-secondary fw-bold" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required style="color: #fbbf24 !important;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">STATUS KEANGGOTAAN * (OTOMATIS)</label>
                        <input type="text" id="statusDisplayInput" class="form-control bg-dark border-secondary fw-bold" readonly style="color: #4ade80; cursor: not-allowed;" value="Active (Berlaku Lunas)">
                        <input type="hidden" name="status" id="statusHiddenInput" value="Active">
                        <div id="statusHelpText" style="font-size: 0.75rem; margin-top: 0.35rem;">
                            <span style="color:#4ade80;"><i class="fa-solid fa-lock"></i> Otomatis ACTIVE: Pembayaran tunai/transfer/EDC langsung disahkan lunas.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">CABANG STUDIO GYM *</label>
                        <select name="branch" class="form-select bg-dark text-white border-secondary" required>
                            @if(isset($branches) && $branches->count() > 0)
                                @foreach($branches as $b)
                                    <option value="{{ $b->name }}{{ $b->city ? ' ('.$b->city.')' : '' }}">
                                        🏢 {{ $b->name }} {{ $b->city ? ' ('.$b->city.')' : '' }}
                                    </option>
                                @endforeach
                            @else
                                <option value="Sleman HQ (Jl. Kaliurang)">🏢 Sleman HQ (Jl. Kaliurang KM 5.5)</option>
                                <option value="UGM Kampus Branch">🏢 UGM Kampus Branch (Jl. Pancasila)</option>
                                <option value="Malioboro Studio">🏢 Malioboro Studio Center</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">KUOTA SESI PT AWAL (JIKA ADA PT)</label>
                        <input type="number" name="remaining_sessions" id="remainingSessionsInput" class="form-control bg-dark text-white border-secondary" value="0" placeholder="e.g. 10">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); text-transform: uppercase;">BIAYA PAKET / NOMINAL BAYAR (RP) *</label>
                        <input type="number" name="membership_price" id="membershipPriceInput" class="form-control bg-dark text-white border-secondary fw-bold" value="300000" placeholder="e.g. 300000" required style="color: var(--brand-lime, #84cc16) !important;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">METODE PEMBAYARAN *</label>
                        <select name="payment_method" id="paymentMethodSelect" class="form-select bg-dark text-white border-secondary" required onchange="updateStatusByPaymentMethod()">
                            <option value="Cash (Tunai)">Cash (Tunai di Kasir Studio)</option>
                            <option value="QRIS / GoPay / OVO">QRIS / GoPay / OVO</option>
                            <option value="Transfer Bank BCA/Mandiri">Transfer Bank BCA/Mandiri</option>
                            <option value="EDC Debit / Kartu Kredit">EDC Debit / Kartu Kredit</option>
                        </select>
                    </div>
                </div>

                <!-- Section 3: Personal Trainer -->
                <h5 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-user-ninja" style="color: #fbbf24;"></i> Personal Trainer &amp; Data Fisik Initial
                </h5>
                <div class="row g-3" style="margin-bottom: 2rem;">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">PERSONAL TRAINER ASSIGNED (OPSIONAL)</label>
                        <select name="assigned_coach" class="form-select bg-dark text-white border-secondary">
                            <option value="">-- Belum Ditempatkan (Unassigned) --</option>
                            @if(isset($coaches) && $coaches->count() > 0)
                                @foreach($coaches as $coach)
                                    <option value="{{ $coach->name }}">🏋️ {{ $coach->name }} {{ $coach->specialty ? '('.$coach->specialty.')' : '' }}</option>
                                @endforeach
                            @else
                                <option value="Coach Hendra APKI">🏋️ Coach Hendra APKI (Senior PT)</option>
                                <option value="Coach Rina Kusuma, S.Gz.">🏋️ Coach Rina Kusuma, S.Gz. (Nutritionist)</option>
                                <option value="Coach Danu Prasetya">🏋️ Coach Danu Prasetya (Persiapan TNI/POLRI)</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">BERAT BADAN AWAL (KG)</label>
                        <input type="number" step="0.1" name="initial_weight" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 75">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">TARGET BERAT BADAN (KG)</label>
                        <input type="number" step="0.1" name="target_weight" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 68">
                    </div>
                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-lime" style="width: 100%; border: none; padding: 1rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; box-shadow: 0 0 25px var(--brand-glow, rgba(132, 204, 22, 0.35)); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-user-check"></i> DAFTARKAN MEMBER BARU &amp; TERBITKAN CARD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function autoFillMembershipPlan(selectEl) {
    if (!selectEl) return;
    const selectedOption = selectEl.options[selectEl.selectedIndex];
    if (!selectedOption) return;
    const price = selectedOption.getAttribute('data-price');
    const sessions = selectedOption.getAttribute('data-sessions');
    const durationDays = selectedOption.getAttribute('data-duration') || 30;
    
    if (price !== null && price !== undefined && price !== '') {
        document.getElementById('membershipPriceInput').value = price;
    }
    if (sessions !== null && sessions !== undefined && sessions !== '') {
        document.getElementById('remainingSessionsInput').value = sessions;
    }

    if (durationDays && document.getElementById('membershipExpiresAtInput')) {
        const expDate = new Date();
        expDate.setDate(expDate.getDate() + parseInt(durationDays));
        const yyyy = expDate.getFullYear();
        const mm = String(expDate.getMonth() + 1).padStart(2, '0');
        const dd = String(expDate.getDate()).padStart(2, '0');
        document.getElementById('membershipExpiresAtInput').value = `${yyyy}-${mm}-${dd}`;
    }
}

function updateStatusByPaymentMethod() {
    const payMethodEl = document.getElementById('paymentMethodSelect');
    if (!payMethodEl) return;
    const val = payMethodEl.value.toLowerCase();
    const displayInput = document.getElementById('statusDisplayInput');
    const hiddenInput = document.getElementById('statusHiddenInput');
    const statusHelp = document.getElementById('statusHelpText');

    if (val.includes('qris') || val.includes('gopay') || val.includes('ovo')) {
        if (displayInput) {
            displayInput.value = 'Pending Verifikasi (Menunggu Scan QRIS)';
            displayInput.style.color = '#fbbf24';
            displayInput.style.borderColor = '#fbbf24';
        }
        if (hiddenInput) hiddenInput.value = 'Pending Verifikasi';
        if (statusHelp) statusHelp.innerHTML = '<span style="color:#fbbf24;"><i class="fa-solid fa-lock"></i> Otomatis PENDING: Member akan diarahkan ke layar QRIS Kuitansi untuk bayar mandiri.</span>';
    } else {
        if (displayInput) {
            displayInput.value = 'Active (Berlaku Lunas)';
            displayInput.style.color = '#4ade80';
            displayInput.style.borderColor = '#4ade80';
        }
        if (hiddenInput) hiddenInput.value = 'Active';
        if (statusHelp) statusHelp.innerHTML = '<span style="color:#4ade80;"><i class="fa-solid fa-lock"></i> Otomatis ACTIVE: Pembayaran tunai/transfer/EDC langsung disahkan lunas.</span>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const sel = document.getElementById('membershipTypeSelect');
    if (sel) {
        autoFillMembershipPlan(sel);
    }
    updateStatusByPaymentMethod();
});
</script>
@endsection
