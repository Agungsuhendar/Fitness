@extends('admin.layout')

@section('title', 'Edit Member & Top-Up Sesi | Admin FitLife Center')
@section('header_title', 'Edit Member & Top-Up Sesi')

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
                    <i class="fa-solid fa-user-gear" style="color: var(--brand-lime, #84cc16);"></i>
                    <span>Edit Member: {{ $member->name }}</span>
                </h3>
                <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">
                    ID Card: <span style="color: var(--brand-lime, #84cc16); font-weight: 800;">{{ $member->member_card_id ?: ('FL-MBR-' . str_pad($member->id, 4, '0', STR_PAD_LEFT)) }}</span> • Terdaftar sejak: {{ $member->created_at ? $member->created_at->format('d M Y, H:i') : 'Baru saja' }}
                </p>
            </div>

            <form method="POST" action="{{ route('admin.members.update', $member->id) }}">
                @csrf
                @method('PUT')

                <!-- Section 1: Profil Member -->
                <h5 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-address-card" style="color: var(--brand-lime, #84cc16);"></i> Informasi Profil Member
                </h5>
                <div class="row g-3" style="margin-bottom: 2rem;">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NAMA MEMBER *</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name', $member->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">EMAIL *</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email', $member->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NOMOR WHATSAPP</label>
                        <input type="text" name="phone" class="form-control bg-dark text-white border-secondary" value="{{ old('phone', $member->phone) }}" placeholder="e.g. 08123456789">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">LOKASI CABANG STUDIO</label>
                        <select name="branch" class="form-select bg-dark text-white border-secondary">
                            @if(isset($branches) && $branches->count() > 0)
                                @foreach($branches as $b)
                                    @php $bVal = $b->name . ($b->city ? ' ('.$b->city.')' : ''); @endphp
                                    <option value="{{ $bVal }}" {{ str_contains(strtolower($member->branch ?? ''), strtolower($b->name)) ? 'selected' : '' }}>
                                        🏢 {{ $bVal }}
                                    </option>
                                @endforeach
                            @else
                                <option value="{{ $member->branch ?: 'Sleman HQ (Jl. Kaliurang)' }}">🏢 {{ $member->branch ?: 'Sleman HQ (Jl. Kaliurang)' }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">PAKET MEMBERSHIP *</label>
                        <select name="membership_type" id="membershipTypeSelect" class="form-select bg-dark text-white border-secondary" required onchange="autoFillMembershipPlan(this)">
                            @if((isset($membershipPlans) && $membershipPlans->count() > 0) || (isset($programs) && $programs->count() > 0))
                                @if(isset($membershipPlans) && $membershipPlans->count() > 0)
                                    <optgroup label="💳 PAKET KEANGGOTAAN GYM (MEMBERSHIP PLANS)">
                                        @foreach($membershipPlans as $plan)
                                            <option value="{{ $plan->name }}" data-price="{{ $plan->promo_price ?: $plan->price }}" data-sessions="{{ $plan->session_count ?: 0 }}" data-duration="{{ $plan->duration_days ?: 30 }}" {{ str_contains(strtolower($member->membership_type ?? ''), strtolower($plan->name)) ? 'selected' : '' }}>
                                                {{ $plan->name }} — Rp {{ number_format($plan->promo_price ?: $plan->price, 0, ',', '.') }} ({{ $plan->duration_days ?: 30 }} Hari) {{ $plan->badge ? '('.$plan->badge.')' : '' }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif

                                @if(isset($programs) && $programs->count() > 0)
                                    <optgroup label="🏋️ PROGRAM FITNESS & PT KHUSUS (PROGRAMS)">
                                        @foreach($programs as $prog)
                                            <option value="Program: {{ $prog->title }}" data-price="{{ $prog->price_start ?: 450000 }}" data-sessions="12" data-duration="30" {{ str_contains(strtolower($member->membership_type ?? ''), strtolower($prog->title)) ? 'selected' : '' }}>
                                                Program {{ $prog->title }} — Rp {{ number_format($prog->price_start ?: 450000, 0, ',', '.') }} {{ $prog->badge ? '('.$prog->badge.')' : '' }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @else
                                <option value="Regular Gym Pass (Bulanan)" data-price="300000" data-sessions="0" data-duration="30" {{ str_contains(strtolower($member->membership_type ?? ''), 'regular') ? 'selected' : '' }}>Regular Gym Pass (Bulanan) — Rp 300.000 (30 Hari)</option>
                                <option value="VIP Personal Trainer Pass 1-on-1" data-price="1200000" data-sessions="12" data-duration="30" {{ str_contains(strtolower($member->membership_type ?? ''), 'vip') ? 'selected' : '' }}>VIP Personal Trainer Pass 1-on-1 — Rp 1.200.000 (30 Hari)</option>
                                <option value="Daily Pass (Harian)" data-price="35000" data-sessions="1" data-duration="1" {{ str_contains(strtolower($member->membership_type ?? ''), 'daily') ? 'selected' : '' }}>Daily Pass (Harian) — Rp 35.000 (1 Hari)</option>
                                <option value="Student Promo Gym Pass" data-price="200000" data-sessions="0" data-duration="30" {{ str_contains(strtolower($member->membership_type ?? ''), 'student') ? 'selected' : '' }}>Student Promo Gym Pass — Rp 200.000 (30 Hari)</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">STATUS MEMBERSHIP *</label>
                        @php
                            $st = strtolower($member->status ?? 'active');
                            $isAktif = str_contains($st, 'act') || str_contains($st, 'aktif');
                            $isNonAktif = str_contains($st, 'non') || str_contains($st, 'inact') || str_contains($st, 'kadal');
                            $isPending = str_contains($st, 'pend');
                        @endphp
                        <select name="status" class="form-select bg-dark text-white border-secondary">
                            <option value="Active" {{ $isAktif ? 'selected' : '' }}>Aktif (Berlaku)</option>
                            <option value="Non-Aktif" {{ $isNonAktif ? 'selected' : '' }}>Non-Aktif (Kadaluarsa)</option>
                            <option value="Pending" {{ $isPending ? 'selected' : '' }}>Pending Verifikasi</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); text-transform: uppercase;">BIAYA PAKET / NOMINAL BAYAR (RP)</label>
                        <input type="number" name="membership_price" id="membershipPriceInput" class="form-control bg-dark text-white border-secondary fw-bold" value="{{ old('membership_price', $member->membership_price ?: 300000) }}" placeholder="e.g. 300000" style="color: var(--brand-lime, #84cc16) !important;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">METODE PEMBAYARAN</label>
                        <input type="text" name="payment_method" class="form-control bg-dark text-white border-secondary" value="{{ old('payment_method', $member->payment_method ?: 'Cash (Tunai)') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #fbbf24; text-transform: uppercase;">
                            <i class="fa-solid fa-calendar-days"></i> MASA BERLAKU / TANGGAL KADALUARSA MEMBER
                        </label>
                        <input type="date" name="membership_expires_at" id="membershipExpiresAtInput" class="form-control bg-dark text-white border-secondary fw-bold" value="{{ old('membership_expires_at', $member->membership_expires_at ? $member->membership_expires_at->format('Y-m-d') : date('Y-m-d', strtotime('+30 days'))) }}" style="color: #fbbf24 !important;">
                    </div>
                </div>

                <!-- Section 2: Top Up Sesi Box -->
                <div style="background: rgba(132, 204, 22, 0.08); border: 1.5px solid var(--brand-lime, #84cc16); border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 2rem;">
                    <h6 style="font-size: 0.95rem; font-weight: 900; color: var(--brand-lime, #84cc16); margin: 0 0 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-square-plus"></i> TOP-UP / TAMBAH KUOTA SESI LATIHAN PT
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">SISA SESI SAAT INI</label>
                            <input type="number" name="remaining_sessions" id="remainingSessionsInput" class="form-control bg-dark text-white border-secondary fw-bold fs-5" value="{{ old('remaining_sessions', $member->remaining_sessions ?? 0) }}" required style="color: var(--brand-lime, #84cc16) !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); text-transform: uppercase;">+ TAMBAH SESI BARU (TOP-UP)</label>
                            <input type="number" name="topup_sessions" class="form-control bg-dark text-white border-secondary fw-bold fs-5" value="0" placeholder="e.g. 10">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Gamifikasi & Points -->
                <h5 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-trophy" style="color: #fbbf24;"></i> Poin FitPoints &amp; Streak Member
                </h5>
                <div class="row g-3" style="margin-bottom: 2rem;">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">SALDO FITPOINTS (XP)</label>
                        <input type="number" name="reward_points" class="form-control bg-dark text-white border-secondary fw-bold" value="{{ old('reward_points', $member->reward_points ?? 0) }}" style="color: #fbbf24 !important;">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">LENCANA / BADGE</label>
                        <input type="text" name="level_badge" class="form-control bg-dark text-white border-secondary" value="{{ old('level_badge', $member->level_badge ?: '🔥 VIP Platinum') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">STREAK GYM (HARI)</label>
                        <input type="number" name="streak_days" class="form-control bg-dark text-white border-secondary fw-bold" value="{{ old('streak_days', $member->streak_days ?? 0) }}" style="color: #38bdf8 !important;">
                    </div>
                </div>

                <!-- Section 4: Personal Trainer Assigned -->
                <h5 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-user-ninja" style="color: #38bdf8;"></i> Personal Trainer &amp; Jadwal
                </h5>
                <div class="row g-3" style="margin-bottom: 2rem;">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">PERSONAL TRAINER ASSIGNED</label>
                        <select name="assigned_coach" class="form-select bg-dark text-white border-secondary">
                            <option value="">-- Belum Ditempatkan (Unassigned) --</option>
                            @if(isset($coaches) && $coaches->count() > 0)
                                @foreach($coaches as $coach)
                                    <option value="{{ $coach->name }}" {{ str_contains(strtolower($member->assigned_coach ?? ''), strtolower($coach->name)) ? 'selected' : '' }}>
                                        🏋️ {{ $coach->name }} {{ $coach->specialty ? '('.$coach->specialty.')' : '' }}
                                    </option>
                                @endforeach
                            @else
                                <option value="Coach Hendra APKI" {{ str_contains($member->assigned_coach ?? '', 'Hendra') ? 'selected' : '' }}>🏋️ Coach Hendra APKI (Senior PT)</option>
                                <option value="Coach Rina Kusuma, S.Gz." {{ str_contains($member->assigned_coach ?? '', 'Rina') ? 'selected' : '' }}>🏋️ Coach Rina Kusuma, S.Gz. (Nutritionist)</option>
                                <option value="Coach Danu Prasetya" {{ str_contains($member->assigned_coach ?? '', 'Danu') ? 'selected' : '' }}>🏋️ Coach Danu Prasetya (Persiapan TNI/POLRI)</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">JADWAL SESI BERIKUTNYA</label>
                        <input type="text" name="next_session" class="form-control bg-dark text-white border-secondary" value="{{ old('next_session', $member->next_session ?: 'Senin, 10 Agustus 2026 • 17.00 WIB') }}" placeholder="Misal: Senin, 10 Agustus 2026 jam 17.00">
                    </div>
                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-lime" style="width: 100%; border: none; padding: 1rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; box-shadow: 0 0 25px var(--brand-glow, rgba(132, 204, 22, 0.35)); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-floppy-disk"></i> SIMPAN PEMBARUAN &amp; TOP-UP MEMBER
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
</script>
@endsection
