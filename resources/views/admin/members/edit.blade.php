@extends('layouts.app')

@section('title', 'Top-Up Kuota & Edit Member | Admin FitLife Center')

@section('content')
<section style="background: #060907; padding: 3.5rem 0 6rem; color: white; min-height: 85vh;">
    <div class="container" style="max-width: 680px;">
        
        <div style="margin-bottom: 1.5rem;">
            <a href="{{ route('admin.members.index') }}" style="color: #94a3b8; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Member
            </a>
        </div>

        <div style="background: #0d1310; border: 1.5px solid rgba(132,204,22,0.4); border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
            
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 1.25rem;">
                <div style="width: 56px; height: 56px; background: rgba(132,204,22,0.15); border: 2px solid #84cc16; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.5rem;">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                        Edit Member: {{ $member->name }}
                    </h1>
                    <span style="font-family: monospace; color: #84cc16; font-weight: 800; font-size: 0.85rem;">
                        ID: {{ $member->member_card_id ?: ('FL-MBR-' . str_pad($member->id, 4, '0', STR_PAD_LEFT)) }}
                    </span>
                </div>
            </div>

            @if ($errors->any())
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 0.85rem; padding: 0.85rem 1rem; margin-bottom: 1.5rem; color: #fca5a5; font-size: 0.875rem;">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.members.update', $member->id) }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf
                @method('PUT')

                <!-- Nama & Email Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;" class="grid-2">
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">NAMA MEMBER *</label>
                        <input type="text" name="name" value="{{ old('name', $member->name) }}" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">EMAIL *</label>
                        <input type="email" name="email" value="{{ old('email', $member->email) }}" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                    </div>
                </div>

                <!-- Phone & Branch Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;" class="grid-2">
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">NOMOR WHATSAPP</label>
                        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">LOKASI CABANG STUDIO</label>
                        <input type="text" name="branch" value="{{ old('branch', $member->branch ?: 'Sleman HQ (Jl. Kaliurang)') }}" style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                    </div>
                </div>

                <!-- Membership Type & Status -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;" class="grid-2">
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">PAKET MEMBERSHIP *</label>
                        <input type="text" name="membership_type" value="{{ old('membership_type', $member->membership_type ?: 'VIP Personal Trainer Pass 1-on-1') }}" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">STATUS MEMBERSHIP *</label>
                        <select name="status" style="width: 100%; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                            <option value="Aktif (Berlaku)" {{ str_contains($member->status ?? '', 'Aktif') ? 'selected' : '' }}>Aktif (Berlaku)</option>
                            <option value="Non-Aktif (Kadaluarsa)" {{ str_contains($member->status ?? '', 'Non-Aktif') ? 'selected' : '' }}>Non-Aktif (Kadaluarsa)</option>
                            <option value="Pending Verifikasi" {{ str_contains($member->status ?? '', 'Pending') ? 'selected' : '' }}>Pending Verifikasi</option>
                        </select>
                    </div>
                </div>

                <!-- TOP UP KUOTA SESI BOX -->
                <div style="background: rgba(132,204,22,0.1); border: 2px solid #84cc16; border-radius: 1rem; padding: 1.25rem; margin: 0.5rem 0;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #84cc16; font-weight: 900; font-size: 0.95rem; margin-bottom: 0.85rem;">
                        <i class="fa-solid fa-square-plus"></i> TOP-UP / TAMBAH KUOTA SESI LATIHAN
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;" class="grid-2">
                        <div>
                            <label style="display: block; font-size: 0.775rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.35rem;">SISA SESI SAAT INI</label>
                            <input type="number" name="remaining_sessions" value="{{ old('remaining_sessions', $member->remaining_sessions ?? 8) }}" required style="width: 100%; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem 0.85rem; color: #84cc16; font-weight: 900; font-size: 1.1rem; outline: none;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.775rem; font-weight: 800; color: #84cc16; margin-bottom: 0.35rem;">+ TAMBAH SESI BARU (TOP-UP)</label>
                            <input type="number" name="topup_sessions" value="0" placeholder="e.g. 12" style="width: 100%; background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; border-radius: 0.65rem; padding: 0.65rem 0.85rem; color: white; font-weight: 900; font-size: 1.1rem; outline: none;">
                        </div>
                    </div>
                </div>

                <!-- Personal Trainer & Next Session -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;" class="grid-2">
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">PERSONAL TRAINER ASSIGNED</label>
                        <select name="assigned_coach" style="width: 100%; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                            <option value="Coach Hendra Wijaya (APKI Certified)" {{ ($member->assigned_coach ?? '') === 'Coach Hendra Wijaya (APKI Certified)' ? 'selected' : '' }}>Coach Hendra Wijaya (Senior APKI)</option>
                            <option value="Coach Danu Prasetya (Militer PT)" {{ ($member->assigned_coach ?? '') === 'Coach Danu Prasetya (Militer PT)' ? 'selected' : '' }}>Coach Danu Prasetya (Persiapan TNI POLRI)</option>
                            <option value="Coach Rina Safitri (Female Trainer)" {{ ($member->assigned_coach ?? '') === 'Coach Rina Safitri (Female Trainer)' ? 'selected' : '' }}>Coach Rina Safitri (Female Fitness)</option>
                            <option value="Coach Bima Wijaya" {{ ($member->assigned_coach ?? '') === 'Coach Bima Wijaya' ? 'selected' : '' }}>Coach Bima Wijaya</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: #cbd5e1; margin-bottom: 0.4rem;">JADWAL SESI BERIKUTNYA</label>
                        <input type="text" name="next_session" value="{{ old('next_session', $member->next_session ?: 'Jumat, 8 Agustus 2026 • 17.00 WIB') }}" style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; outline: none;">
                    </div>
                </div>

                <!-- Submit Action Bar -->
                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <button type="submit" class="btn glow-btn" style="flex: 1; background: #84cc16; color: #090d0b; border: none; padding: 0.9rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>SIMPAN PEMBARUAN &amp; TOP-UP</span>
                    </button>
                </div>
            </form>

        </div>

    </div>
</section>
@endsection
