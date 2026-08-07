@extends('admin.layout')

@section('title', 'Jadwal & Kalender Kelas Studio - Admin FitLife Center')
@section('header_title', 'Kelola Jadwal & Kalender Kelas Kelompok Studio')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.35rem; color: #ffffff; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🏋️ Kalender &amp; Jadwal Kelas Kelompok Studio
            </h3>
            <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                Kelola jadwal kelas kelompok (Yoga, HIIT, Aerobic, Aquarobics) &amp; pantau sisa kuota peserta.
            </p>
        </div>
    </div>

    <!-- Create Class Form Box -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <h4 style="font-size: 1.05rem; color: #ffffff; margin-bottom: 1rem; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-calendar-plus" style="color: #8b5cf6;"></i> + Tambah Jadwal Sesi Kelas Baru
        </h4>

        <form action="{{ route('admin.classes.store') }}" method="POST" style="display: grid; grid-template-columns: 2fr 1.2fr 1.5fr 1.2fr 1fr 1fr auto; gap: 1rem; align-items: end;">
            @csrf
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">NAMA KELAS *</label>
                <input type="text" name="name" placeholder="e.g. Yoga Morning Stretch" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">KATEGORI *</label>
                <select name="category" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                    <option value="Yoga & Pilates">🧘 Yoga &amp; Pilates</option>
                    <option value="HIIT & Fat Burn">🔥 HIIT &amp; Fat Burn</option>
                    <option value="Aerobic & Dance">💃 Aerobic &amp; Dance</option>
                    <option value="Aquarobics Pool">🏊 Aquarobics Pool</option>
                    <option value="Spinning Cardio">🚴 Spinning Cardio</option>
                </select>
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">INSTRUKTUR / COACH *</label>
                <input type="text" name="coach_name" placeholder="e.g. Coach Rina Kartika" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">TANGGAL *</label>
                <input type="date" name="class_date" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">JAM MULAI *</label>
                <input type="time" name="start_time" value="08:00" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">JAM SELESAI *</label>
                <input type="time" name="end_time" value="09:30" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <input type="hidden" name="max_capacity" value="15">
                <input type="hidden" name="price" value="50000">
                <input type="hidden" name="branch" value="Sleman HQ (Jl. Kaliurang)">
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; font-weight: 900; padding: 0.65rem 1.15rem;">
                    + Simpan Sesi
                </button>
            </div>
        </form>
    </div>

    <!-- Classes Table -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid #e2e8f0;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8;">
                        <th style="padding: 0.85rem 1rem;">NAMA KELAS</th>
                        <th style="padding: 0.85rem 1rem;">KATEGORI</th>
                        <th style="padding: 0.85rem 1rem;">INSTRUKTUR</th>
                        <th style="padding: 0.85rem 1rem;">TANGGAL &amp; WAKTU</th>
                        <th style="padding: 0.85rem 1rem;">KUOTA TERISI</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $c)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: #ffffff;">
                            🏋️ {{ $c->name }}
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="background: #f3e8ff; color: #6b21a8; font-weight: 800; font-size: 0.775rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                                {{ $c->category }}
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 800; color: #0284c7;">
                            {{ $c->coach_name }}
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <div style="font-weight: 800; color: #cbd5e1;">📅 {{ $c->class_date->format('d M Y') }}</div>
                            <div style="font-size: 0.75rem; color: #64748b;">⏰ {{ substr($c->start_time, 0, 5) }} - {{ substr($c->end_time, 0, 5) }} WIB</div>
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="background: #e0f2fe; color: #0369a1; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px;">
                                Terisi {{ $c->booked_count }} / {{ $c->max_capacity }} Kursi
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            <form action="{{ route('admin.classes.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus kelas {{ $c->name }}?')" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background: #fee2e2; color: #ef4444; border: none; padding: 0.35rem 0.65rem; border-radius: 0.4rem; font-weight: 800; font-size: 0.75rem; cursor: pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
