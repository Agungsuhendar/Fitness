@extends('admin.layout')

@section('title', 'Class Auto-Waitlist & Booking - Admin FitLife Center')
@section('header_title', 'Sistem Booking & Antrean Otomatis Kelas Studio (Auto-Waitlist)')

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
            <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid rgba(132,204,22,0.3); display: inline-block; margin-bottom: 0.4rem;">
                🧘 CLASS AUTO-WAITLIST &amp; PROMOTION ENGINE
            </span>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🏋️ Jadwal Kelas Studio &amp; Auto-Waitlist Antrean
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Otomatisasi antrean saat kelas penuh &amp; notifikasi WhatsApp real-time saat peserta dipromosikan.
            </p>
        </div>

        <button type="button" class="btn glow-btn" data-bs-toggle="modal" data-bs-target="#addClassModal" style="background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #060907 !important; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4);">
            <i class="fa-solid fa-calendar-plus"></i> + Buat Jadwal Kelas Baru
        </button>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">TOTAL KELAS AKTIF</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $totalClasses }} Sesi Kelas
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #4ade80; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #4ade80; font-weight: 800; text-transform: uppercase;">PESERTA TERKONFIRMASI</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #4ade80; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $totalConfirmed }} Member
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #eab308; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #eab308; font-weight: 800; text-transform: uppercase;">ANTREAN WAITLIST</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #eab308; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $totalWaitlist }} Antrean
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #38bdf8; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">PROMOSI DARI ANTREAN</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #38bdf8; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $totalPromoted }} Promosi
            </div>
        </div>
    </div>

    <!-- Active Classes Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        @foreach($classes as $c)
        @php
            $isCurrent = ($activeClass && $activeClass->id === $c->id);
            $confirmedCount = \App\Models\ClassBooking::where('fitness_class_id', $c->id)->where('booking_type', 'confirmed')->where('status', '!=', 'cancelled')->count();
            $waitlistCount = \App\Models\ClassBooking::where('fitness_class_id', $c->id)->where('booking_type', 'waitlist')->where('status', '!=', 'cancelled')->count();
            $isFull = ($confirmedCount >= ($c->max_capacity ?: 15));
        @endphp
        <div style="background: #0d1410; border: {{ $isCurrent ? '2px solid #84cc16' : '1px solid rgba(255,255,255,0.1)' }}; border-radius: 1.25rem; padding: 1.25rem; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-weight: 800; font-size: 0.725rem; padding: 0.2rem 0.6rem; border-radius: 99px;">
                    {{ $c->category }}
                </span>
                @if($isFull)
                    <span style="background: rgba(234, 179, 8, 0.2); color: #eab308; font-weight: 900; font-size: 0.7rem; padding: 0.2rem 0.5rem; border-radius: 99px;">
                        ⚠️ FULL (WAITLIST {{ $waitlistCount }})
                    </span>
                @else
                    <span style="background: rgba(74, 222, 128, 0.2); color: #4ade80; font-weight: 900; font-size: 0.7rem; padding: 0.2rem 0.5rem; border-radius: 99px;">
                        🟢 KUOTA TERSEDIA
                    </span>
                @endif
            </div>

            <h4 style="font-size: 1.15rem; font-weight: 900; color: white; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif;">
                {{ $c->name }}
            </h4>
            <div style="font-size: 0.825rem; color: #94a3b8; margin-bottom: 0.85rem;">
                🧘 <strong>Coach:</strong> {{ $c->coach_name ?: 'Coach Studio' }}<br>
                ⏰ <strong>Waktu:</strong> {{ substr($c->start_time, 0, 5) }} - {{ substr($c->end_time, 0, 5) }} WIB
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 0.75rem;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1;">
                    👥 {{ $confirmedCount }} / {{ $c->max_capacity ?: 15 }} Kursi
                </span>

                <a href="{{ route('admin.classes.index', ['class_id' => $c->id]) }}" class="btn" style="background: {{ $isCurrent ? '#84cc16' : 'rgba(255,255,255,0.1)' }}; color: {{ $isCurrent ? '#060907' : 'white' }}; border-radius: 0.6rem; font-weight: 900; font-size: 0.775rem; text-decoration: none; padding: 0.35rem 0.75rem;">
                    {{ $isCurrent ? '● Dipilih' : 'Kelola Antrean' }}
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Active Selected Class Booking Control Panel -->
    @if($activeClass)
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; margin-bottom: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="color: #84cc16; font-size: 0.775rem; font-weight: 800; text-transform: uppercase;">KELOLA KELAS DIPILIH</span>
                <h3 style="font-size: 1.35rem; color: white; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                    {{ $activeClass->name }} (Kuota: {{ $confirmedBookings->count() }} / {{ $activeClass->max_capacity ?: 15 }})
                </h3>
            </div>

            <!-- Quick Add Participant Form -->
            <form action="{{ route('admin.classes.book') }}" method="POST" style="display: flex; gap: 0.65rem; align-items: center; flex-wrap: wrap;">
                @csrf
                <input type="hidden" name="fitness_class_id" value="{{ $activeClass->id }}">
                <input type="text" name="member_name" required placeholder="Nama Member..." style="background: #121c17; color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.55rem 0.85rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.85rem; outline: none; width: 170px;">
                <input type="text" name="member_phone" placeholder="No. WA (0812...)" style="background: #121c17; color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.55rem 0.85rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.85rem; outline: none; width: 150px;">
                <button type="submit" class="btn" style="background: #84cc16; color: #060907; font-weight: 900; border-radius: 0.65rem; padding: 0.55rem 1rem; border: none; font-size: 0.85rem; cursor: pointer;">
                    + Daftarkan Peserta
                </button>
            </form>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;" class="grid-2">
            <!-- Confirmed Participants Column -->
            <div style="background: rgba(255,255,255,0.02); border: 1.5px solid #4ade80; border-radius: 1.15rem; padding: 1.25rem;">
                <h4 style="font-size: 1.05rem; color: #4ade80; margin: 0 0 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    🟢 Peserta Resmi Terkonfirmasi ({{ $confirmedBookings->count() }})
                </h4>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                        <thead>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.725rem;">
                                <th style="padding: 0.6rem;">Member</th>
                                <th style="padding: 0.6rem;">No. WA</th>
                                <th style="padding: 0.6rem; text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($confirmedBookings as $cb)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 0.6rem; font-weight: 800; color: white;">
                                    {{ $cb->member_name }}
                                    @if($cb->status === 'promoted')
                                        <span style="background: rgba(56, 189, 248, 0.2); color: #38bdf8; font-size: 0.675rem; padding: 0.1rem 0.35rem; border-radius: 4px; display: inline-block;">PROMOSI WA</span>
                                    @endif
                                </td>
                                <td style="padding: 0.6rem; color: #cbd5e1; font-family: monospace;">{{ $cb->member_phone }}</td>
                                <td style="padding: 0.6rem; text-align: right;">
                                    <form action="{{ route('admin.classes.cancel', $cb->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Batalkan pendaftaran {{ $cb->member_name }}? Antrean Waitlist #1 otomatis akan dipromosikan & dikirimi notifikasi WA!')" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid #ef4444; padding: 0.25rem 0.65rem; border-radius: 6px; font-weight: 800; font-size: 0.725rem; cursor: pointer;">
                                            ❌ Batalkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 1rem; text-align: center; color: #94a3b8;">
                                    Belum ada peserta resmi terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Waitlist Queue Column -->
            <div style="background: rgba(255,255,255,0.02); border: 1.5px solid #eab308; border-radius: 1.15rem; padding: 1.25rem;">
                <h4 style="font-size: 1.05rem; color: #eab308; margin: 0 0 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    ⏳ Daftar Antrean Waitlist ({{ $waitlistBookings->count() }})
                </h4>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                        <thead>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.725rem;">
                                <th style="padding: 0.6rem;">Posisi</th>
                                <th style="padding: 0.6rem;">Member</th>
                                <th style="padding: 0.6rem;">No. WA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($waitlistBookings as $wb)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 0.6rem;">
                                    <span style="background: rgba(234, 179, 8, 0.2); color: #eab308; font-weight: 900; font-size: 0.75rem; padding: 0.15rem 0.5rem; border-radius: 99px;">
                                        #{{ $wb->waitlist_position }}
                                    </span>
                                </td>
                                <td style="padding: 0.6rem; font-weight: 800; color: white;">{{ $wb->member_name }}</td>
                                <td style="padding: 0.6rem; color: #cbd5e1; font-family: monospace;">{{ $wb->member_phone }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 1rem; text-align: center; color: #94a3b8;">
                                    Tidak ada peserta dalam antrean waitlist.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

<!-- Modal Tambah Kelas -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid #84cc16; color: white; border-radius: 1.25rem;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-weight: 900; color: #84cc16;">+ Buat Sesi Kelas Studio Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Nama Kelas *</label>
                        <input type="text" name="name" required placeholder="Contoh: Yoga Sunset Harmony" class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Kategori *</label>
                        <select name="category" required class="form-select bg-dark text-white border-secondary">
                            <option value="Yoga & Pilates">🧘 Yoga &amp; Pilates</option>
                            <option value="Crossfit & Strength">🏋️ Crossfit &amp; Strength</option>
                            <option value="Zumba & Dance">💃 Zumba &amp; Dance</option>
                            <option value="Spinning Cardio">🚴 Spinning Cardio</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Instruktur / Coach *</label>
                        <input type="text" name="coach_name" required placeholder="Contoh: Coach Maya Putri" class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Maks Kapasitas (Kursi) *</label>
                            <input type="number" name="max_capacity" value="5" required class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Harga Tiket (Rp) *</label>
                            <input type="number" name="price" value="50000" required class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Tanggal Sesi *</label>
                        <input type="date" name="class_date" value="{{ date('Y-m-d') }}" required class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Jam Mulai</label>
                            <input type="time" name="start_time" value="17:00" required class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label font-weight-bold" style="color: #cbd5e1; font-size: 0.85rem;">Jam Selesai</label>
                            <input type="time" name="end_time" value="18:15" required class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>

                    <input type="hidden" name="branch" value="Sleman HQ">
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" style="background: #84cc16; color: #060907; font-weight: 900;">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
