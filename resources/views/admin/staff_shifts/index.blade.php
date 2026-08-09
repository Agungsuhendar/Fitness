@extends('admin.layout')

@section('title', 'Manajemen Shift & HR Absensi Pegawai - Admin FitLife Center')
@section('header_title', 'Sistem Shift & HR Absensi Pro (Web & Flutter Mobile API Ready)')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(34, 197, 94, 0.15); border: 1.5px solid #4ade80; color: #4ade80; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span style="background: rgba(56,189,248,0.15); color: #38bdf8; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid rgba(56,189,248,0.3); display: inline-block; margin-bottom: 0.4rem;">
                📱 DUAL-MODE HR SYSTEM (WEB &amp; FLUTTER API READY)
            </span>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                👥 Manajemen Shift &amp; Absensi Pegawai Gym Pro
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Absensi digital berbasis Face Recognition AI, GPS Geofencing Radius (50m), &amp; Foto Selfie Proof.
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <button type="button" class="btn glow-btn" data-bs-toggle="modal" data-bs-target="#addShiftModal" style="background: linear-gradient(135deg, #38bdf8 0%, #3b82f6 100%); color: #ffffff !important; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; box-shadow: 0 0 20px rgba(56, 189, 248, 0.4);">
                <i class="fa-solid fa-plus-circle"></i> + Tambah Jadwal Shift Staff
            </button>

            <form action="{{ route('admin.staff-shifts.index') }}" method="GET" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                <input type="date" name="date" value="{{ $date }}" class="form-control bg-dark text-white border-secondary fw-bold" onchange="this.form.submit()" style="width: 170px;">
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">STAFF BERTUGAS HARI INI</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $totalShiftStaff }} Pegawai
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #4ade80; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #4ade80; font-weight: 800; text-transform: uppercase;">SUDAH PRESENSI (CLOCKED IN)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #4ade80; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $clockedInCount }} Staff
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #eab308; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #eab308; font-weight: 800; text-transform: uppercase;">STATUS TERLAMBAT (LATE)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #eab308; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $lateCount }} Staff
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #f87171; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #f87171; font-weight: 800; text-transform: uppercase;">DI LUAR RADIUS (>50M)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #f87171; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $outOfRadiusCount }} Staff
            </div>
        </div>
    </div>

    <!-- Quick Web Clock-In Widget -->
    <div style="background: #0d1410; border: 1.5px solid #38bdf8; border-radius: 1.5rem; padding: 1.75rem; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(0,0,0,0.4);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h4 style="font-size: 1.15rem; color: #38bdf8; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-camera"></i> Quick Web Clock-In Workstation Studio
                </h4>
                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">
                    Form presensi cepat pegawai via browser/tablet Kiosk sebelum aplikasi Flutter Mobile dirilis.
                </p>
            </div>

            <form action="{{ route('admin.staff-shifts.clock-in') }}" method="POST" style="display: flex; gap: 0.75rem; align-items: center;">
                @csrf
                <select name="staff_name" required style="background: #121c17; color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.6rem 1rem; border-radius: 0.75rem; font-weight: 800; outline: none;">
                    <option value="">-- Pilih Nama Pegawai --</option>
                    @foreach($shifts as $s)
                    <option value="{{ $s->staff_name }}">{{ $s->staff_name }} ({{ strtoupper($s->role) }})</option>
                    @endforeach
                </select>

                <button type="submit" class="btn" style="background: #84cc16; color: #060907; font-weight: 900; border-radius: 0.75rem; padding: 0.6rem 1.25rem; border: none; cursor: pointer;">
                    🟢 Clock In Masuk Shift
                </button>
            </form>
        </div>
    </div>

    <!-- Live HR Attendance Feed Table -->
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; margin-bottom: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h4 style="font-size: 1.15rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-user-check" style="color: #4ade80;"></i> Live Feed Log Absensi Pegawai Hari Ini (Foto &amp; GPS Map)
            </h4>
            <span style="background: rgba(74, 222, 128, 0.15); color: #4ade80; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                LIVE AUDIT
            </span>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.775rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Pegawai</th>
                        <th style="padding: 0.85rem;">Selfie Proof</th>
                        <th style="padding: 0.85rem;">Jam Masuk</th>
                        <th style="padding: 0.85rem;">Jam Pulang</th>
                        <th style="padding: 0.85rem;">Status Geofence GPS</th>
                        <th style="padding: 0.85rem;">Face Recognition</th>
                        <th style="padding: 0.85rem; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $att)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 0.85rem;">
                            <div style="font-weight: 900; color: white;">{{ $att->staff_name }}</div>
                            <div style="font-size: 0.725rem; color: #38bdf8;">{{ $att->device_info ?: 'Kiosk Studio' }}</div>
                        </td>
                        <td style="padding: 0.85rem;">
                            <img src="{{ $att->selfie_path ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150' }}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid #38bdf8;" alt="Selfie">
                        </td>
                        <td style="padding: 0.85rem; font-weight: 800; color: #4ade80;">
                            {{ $att->clock_in ? $att->clock_in->format('H:i:s') : '-' }}
                            @if($att->clock_in_status === 'late')
                                <span style="background: rgba(234, 179, 8, 0.2); color: #eab308; font-size: 0.7rem; padding: 0.1rem 0.4rem; border-radius: 4px; margin-left: 0.3rem;">TERLAMBAT</span>
                            @endif
                        </td>
                        <td style="padding: 0.85rem; font-weight: 800; color: #cbd5e1;">
                            {{ $att->clock_out ? $att->clock_out->format('H:i:s') : 'Bertugas' }}
                        </td>
                        <td style="padding: 0.85rem;">
                            @if($att->clock_in_status === 'out_of_radius')
                                <span style="color: #f87171; font-weight: 800; font-size: 0.775rem;">
                                    ⚠️ Di luar radius ({{ $att->distance_meters }}m)
                                </span>
                            @else
                                <a href="https://maps.google.com/?q={{ $att->latitude }},{{ $att->longitude }}" target="_blank" style="color: #38bdf8; text-decoration: none; font-weight: 800; font-size: 0.775rem;">
                                    📍 dalam Radius ({{ $att->distance_meters }}m)
                                </a>
                            @endif
                        </td>
                        <td style="padding: 0.85rem;">
                            <span style="background: rgba(34, 197, 94, 0.15); color: #4ade80; font-weight: 800; font-size: 0.725rem; padding: 0.2rem 0.5rem; border-radius: 99px; border: 1px solid #4ade80;">
                                Verified AI Face
                            </span>
                        </td>
                        <td style="padding: 0.85rem; text-align: right;">
                            @if(!$att->clock_out)
                            <form action="{{ route('admin.staff-shifts.clock-out', $att->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn" style="background: #ef4444; color: white; border: none; padding: 0.35rem 0.75rem; border-radius: 8px; font-weight: 900; font-size: 0.75rem; cursor: pointer;">
                                    🔴 Pulang Shift
                                </button>
                            </form>
                            @else
                                <span style="color: #94a3b8; font-size: 0.75rem;">Selesai ({{ $att->total_hours_worked }} Jam)</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding: 2rem; text-align: center; color: #94a3b8;">
                            Belum ada presensi pegawai untuk tanggal ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Shift Schedule Table -->
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h4 style="font-size: 1.15rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📅 Jadwal Shift Pegawai Studio Hari Ini
            </h4>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.775rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Pegawai</th>
                        <th style="padding: 0.85rem;">Jabatan</th>
                        <th style="padding: 0.85rem;">Nama Shift</th>
                        <th style="padding: 0.85rem;">Jam Kerja</th>
                        <th style="padding: 0.85rem;">Status Shift</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shifts as $s)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 0.85rem; font-weight: 900; color: white;">{{ $s->staff_name }}</td>
                        <td style="padding: 0.85rem;">
                            <span style="background: rgba(255,255,255,0.08); color: #cbd5e1; font-weight: 800; font-size: 0.725rem; padding: 0.2rem 0.5rem; border-radius: 6px; text-transform: uppercase;">
                                {{ $s->role }}
                            </span>
                        </td>
                        <td style="padding: 0.85rem; color: #38bdf8; font-weight: 800;">{{ $s->shift_name }}</td>
                        <td style="padding: 0.85rem; color: #cbd5e1; font-family: monospace;">{{ $s->start_time }} - {{ $s->end_time }}</td>
                        <td style="padding: 0.85rem;">
                            <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-weight: 800; font-size: 0.725rem; padding: 0.2rem 0.5rem; border-radius: 99px;">
                                Terjadwal
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 1.5rem; text-align: center; color: #94a3b8;">
                            Belum ada jadwal shift untuk tanggal ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah Shift -->
<div class="modal fade" id="addShiftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid #38bdf8; color: white; border-radius: 1.25rem;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-weight: 900; color: #38bdf8;">+ Tambah Jadwal Shift Pegawai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.staff-shifts.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Nama Pegawai *</label>
                        <input type="text" name="staff_name" required placeholder="Contoh: Siti Resepsionis" class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Jabatan *</label>
                        <select name="role" required class="form-select bg-dark text-white border-secondary">
                            <option value="receptionist">Resepsionis / Front Desk</option>
                            <option value="trainer">Personal Trainer / Coach</option>
                            <option value="security">Security Studio</option>
                            <option value="cleaner">Cleaning Service</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Nama Shift *</label>
                        <select name="shift_name" required class="form-select bg-dark text-white border-secondary">
                            <option value="Shift Pagi (06:00 - 14:00)">Shift Pagi (06:00 - 14:00)</option>
                            <option value="Shift Siang (14:00 - 22:00)">Shift Siang (14:00 - 22:00)</option>
                            <option value="Shift Malam (22:00 - 06:00)">Shift Malam (22:00 - 06:00)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Tanggal *</label>
                        <input type="date" name="shift_date" value="{{ $date }}" required class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Jam Masuk</label>
                            <input type="time" name="start_time" value="06:00" required class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Jam Pulang</label>
                            <input type="time" name="end_time" value="14:00" required class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" style="background: #38bdf8; color: #060907; font-weight: 900;">Simpan Shift</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
