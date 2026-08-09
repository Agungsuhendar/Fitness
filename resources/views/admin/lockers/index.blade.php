@extends('admin.layout')

@section('title', 'Manajemen Loker Gym - Admin FitLife Center')
@section('header_title', 'Sistem Manajemen Loker Gym & Pinjam Kunci Interaktif')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(34, 197, 94, 0.15); border: 1.5px solid #4ade80; color: #4ade80; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 1rem 1.25rem; background: rgba(239, 68, 68, 0.15); border: 1.5px solid #ef4444; color: #fca5a5; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <!-- Header Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🔑 Control Panel Loker Gym Studio
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Otomatisasi peminjaman kunci loker saat Kiosk Check-In, kontrol status terpakai, &amp; generator loker massal.
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <button type="button" onclick="openAssignModal()" class="btn glow-btn" style="background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #060907 !important; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer;">
                <i class="fa-solid fa-key"></i> + Pinjamkan Loker Manual
            </button>

            <button type="button" onclick="openBatchModal()" class="btn" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1.5px solid #38bdf8; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <i class="fa-solid fa-plus-minus"></i> + Batch Generator Loker
            </button>

            <a href="{{ route('admin.checkin.index') }}" class="btn" style="background: rgba(255, 255, 255, 0.1); color: white; border: 1.5px solid rgba(255, 255, 255, 0.2); border-radius: 99px; font-weight: 900; text-decoration: none; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-qrcode"></i> Buka Kiosk Presensi QR ➔
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">TOTAL UNIT LOKER</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($totalLockers) }} Unit
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">SIAP PAKAI (KOSONG)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($availableCount) }} Loker
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #f87171; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #f87171; font-weight: 800; text-transform: uppercase;">SEDANG TERPAKAI MEMBER</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #f87171; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($occupiedCount) }} Loker
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #eab308; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #eab308; font-weight: 800; text-transform: uppercase;">PERBAIKAN (MAINTENANCE)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #eab308; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($maintenanceCount) }} Loker
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('admin.lockers.index', ['gender' => 'all', 'status' => $statusFilter]) }}" class="btn" style="background: {{ $genderFilter === 'all' ? '#84cc16' : 'rgba(255,255,255,0.08)' }}; color: {{ $genderFilter === 'all' ? '#060907' : 'white' }}; border: none; font-weight: 800; border-radius: 99px; padding: 0.45rem 1rem; text-decoration: none; font-size: 0.825rem;">
                🌐 Semua Loker
            </a>
            <a href="{{ route('admin.lockers.index', ['gender' => 'male', 'status' => $statusFilter]) }}" class="btn" style="background: {{ $genderFilter === 'male' ? '#38bdf8' : 'rgba(255,255,255,0.08)' }}; color: {{ $genderFilter === 'male' ? '#060907' : 'white' }}; border: none; font-weight: 800; border-radius: 99px; padding: 0.45rem 1rem; text-decoration: none; font-size: 0.825rem;">
                🚹 Loker Pria (Male)
            </a>
            <a href="{{ route('admin.lockers.index', ['gender' => 'female', 'status' => $statusFilter]) }}" class="btn" style="background: {{ $genderFilter === 'female' ? '#f472b6' : 'rgba(255,255,255,0.08)' }}; color: {{ $genderFilter === 'female' ? '#060907' : 'white' }}; border: none; font-weight: 800; border-radius: 99px; padding: 0.45rem 1rem; text-decoration: none; font-size: 0.825rem;">
                🚺 Loker Wanita (Female)
            </a>
        </div>

        <form action="{{ route('admin.lockers.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
            <input type="hidden" name="gender" value="{{ $genderFilter }}">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari No. Loker / Nama Member..." class="form-control bg-dark text-white border-secondary fw-bold" style="width: 240px; font-size: 0.85rem;">
            <button type="submit" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.45rem 0.85rem; border-radius: 8px; font-weight: 800; cursor: pointer;">
                🔍 Cari
            </button>
        </form>
    </div>

    <!-- Interactive Locker Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.25rem;">
        @forelse($lockers as $l)
        @php
            $isOccupied = ($l->status === 'occupied');
            $isMaint = ($l->status === 'maintenance');
            $genderColor = ($l->gender_category === 'male') ? '#38bdf8' : (($l->gender_category === 'female') ? '#f472b6' : '#a855f7');
        @endphp
        <div style="background: #0d1410; border: 2px solid {{ $isOccupied ? '#f87171' : ($isMaint ? '#eab308' : '#84cc16') }}; border-radius: 1.25rem; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between; min-height: 190px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="font-weight: 900; font-family: monospace; font-size: 1.3rem; color: #ffffff;">
                        {{ $l->locker_number }}
                    </span>
                    <span style="font-size: 0.7rem; font-weight: 800; color: {{ $genderColor }}; background: rgba(255,255,255,0.08); padding: 0.15rem 0.45rem; border-radius: 99px; text-transform: uppercase;">
                        {{ $l->gender_category === 'male' ? '🚹 Pria' : ($l->gender_category === 'female' ? '🚺 Wanita' : '🌐 Unisex') }}
                    </span>
                </div>

                <div style="margin-top: 0.75rem;">
                    @if($isOccupied)
                        <span style="background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid #f87171; font-size: 0.7rem; font-weight: 900; padding: 0.15rem 0.5rem; border-radius: 99px;">
                            🔴 TERPAKAI
                        </span>
                        <div style="font-weight: 900; color: #ffffff; font-size: 0.875rem; margin-top: 0.5rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $l->member_name }}
                        </div>
                        <div style="font-size: 0.725rem; color: #94a3b8; margin-top: 0.2rem;">
                            🕒 {{ $l->assigned_at ? $l->assigned_at->format('H:i WIB') : '-' }}
                        </div>
                    @elseif($isMaint)
                        <span style="background: rgba(234, 179, 8, 0.15); color: #eab308; border: 1px solid #eab308; font-size: 0.7rem; font-weight: 900; padding: 0.15rem 0.5rem; border-radius: 99px;">
                            🟡 PERBAIKAN
                        </span>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.5rem;">
                            Dalam perawatan studio
                        </div>
                    @else
                        <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; border: 1px solid #84cc16; font-size: 0.7rem; font-weight: 900; padding: 0.15rem 0.5rem; border-radius: 99px;">
                            🟢 SIAP PAKAI
                        </span>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.5rem;">
                            Kunci Loker Kosong
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 0.75rem; margin-top: 0.75rem; display: flex; gap: 0.35rem; justify-content: space-between;">
                @if($isOccupied)
                <form action="{{ route('admin.lockers.release', $l->id) }}" method="POST" style="width: 100%;">
                    @csrf
                    <button type="submit" style="width: 100%; background: #84cc16; color: #060907; border: none; padding: 0.4rem 0.5rem; border-radius: 8px; font-weight: 900; font-size: 0.75rem; cursor: pointer;">
                        🔓 KEMBALIKAN
                    </button>
                </form>
                @else
                <form action="{{ route('admin.lockers.maintenance', $l->id) }}" method="POST" style="width: 100%;">
                    @csrf
                    <button type="submit" style="width: 100%; background: rgba(255,255,255,0.08); color: #cbd5e1; border: 1px solid rgba(255,255,255,0.2); padding: 0.4rem 0.5rem; border-radius: 8px; font-weight: 800; font-size: 0.725rem; cursor: pointer;">
                        {{ $isMaint ? '✅ Siap Pakai' : '🛠️ Maintenance' }}
                    </button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: #94a3b8; background: #0d1410; border-radius: 1.5rem;">
            Belum ada nomor loker yang terdaftar. Klik <strong>+ Batch Generator Loker</strong> di atas untuk membuat loker otomatis!
        </div>
        @endforelse
    </div>

</div>

<!-- Modal Manual Assign Locker -->
<div id="assignLockerModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #0d1410; border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 2rem; width: 90%; max-width: 480px; box-shadow: 0 25px 50px rgba(0,0,0,0.9);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h4 style="font-size: 1.2rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🔑 Pinjamkan Kunci Loker Manual
            </h4>
            <button onclick="closeAssignModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>

        <form action="{{ route('admin.lockers.assign') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.15rem;">
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">PILIH LOKER KOSONG *</label>
                <select name="locker_id" required class="form-control bg-dark text-white border-secondary fw-bold">
                    <option value="">-- Pilih Loker Available --</option>
                    @foreach($lockers->where('status', 'available') as $l)
                        <option value="{{ $l->id }}">{{ $l->locker_number }} ({{ strtoupper($l->gender_category) }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">PILIH MEMBER AKTIF *</label>
                <select name="user_id" required class="form-control bg-dark text-white border-secondary fw-bold">
                    <option value="">-- Pilih Member --</option>
                    @foreach($activeMembers as $m)
                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->member_card_id }})</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                <button type="button" onclick="closeAssignModal()" style="background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #84cc16; color: #060907; border: none; padding: 0.65rem 1.5rem; border-radius: 99px; font-weight: 900; cursor: pointer;">🔑 Pinjamkan Loker</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Batch Generator Lockers -->
<div id="batchLockerModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #0d1410; border: 1.5px solid #38bdf8; border-radius: 1.5rem; padding: 2rem; width: 90%; max-width: 480px; box-shadow: 0 25px 50px rgba(0,0,0,0.9);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h4 style="font-size: 1.2rem; color: #38bdf8; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                ⚡ Batch Generator Nomor Loker
            </h4>
            <button onclick="closeBatchModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>

        <form action="{{ route('admin.lockers.batch') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.15rem;">
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">PREFIX KODE LOKER (e.g. L, W, M) *</label>
                <input type="text" name="prefix" value="L" required class="form-control bg-dark text-white border-secondary fw-bold">
            </div>

            <div style="margin-bottom: 1.15rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">ANGKA AWAL *</label>
                    <input type="number" name="start_num" value="1" min="1" required class="form-control bg-dark text-white border-secondary fw-bold">
                </div>
                <div>
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">JUMLAH LOKER *</label>
                    <input type="number" name="count" value="20" min="1" max="100" required class="form-control bg-dark text-white border-secondary fw-bold">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">KATEGORI GENDER *</label>
                <select name="gender_category" class="form-control bg-dark text-white border-secondary fw-bold">
                    <option value="male">🚹 Loker Pria (Male)</option>
                    <option value="female">🚺 Loker Wanita (Female)</option>
                    <option value="all" selected>🌐 Unisex (Bebas / Campur)</option>
                </select>
            </div>

            <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                <button type="button" onclick="closeBatchModal()" style="background: rgba(255,255,255,0.1); color: white; border: none; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #38bdf8; color: #060907; border: none; padding: 0.65rem 1.5rem; border-radius: 99px; font-weight: 900; cursor: pointer;">⚡ Generate Loker Massal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAssignModal() {
        document.getElementById('assignLockerModal').style.display = 'flex';
    }
    function closeAssignModal() {
        document.getElementById('assignLockerModal').style.display = 'none';
    }
    function openBatchModal() {
        document.getElementById('batchLockerModal').style.display = 'flex';
    }
    function closeBatchModal() {
        document.getElementById('batchLockerModal').style.display = 'none';
    }
</script>
@endsection
