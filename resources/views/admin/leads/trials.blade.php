@extends('admin.layout')

@section('title', 'Data Booking Trial - Admin Panel')
@section('header_title', 'Data Booking Trial Gratis')

@section('admin_content')
<div class="admin-card" style="padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <h2 style="font-size: 1.35rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
        <i class="fa-solid fa-calendar-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>
        Semua Booking Trial Uji Coba Gratis
    </h2>
    <p style="color: #cbd5e1; font-size: 0.875rem; margin-top: 0.35rem;">Daftar lengkap pemohon uji coba sesi fitness 30 menit gratis.</p>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Waktu Booking</th>
                <th>Nama Orang Tua / Pendaftar</th>
                <th>Nama Peserta (Usia)</th>
                <th>No. WhatsApp</th>
                <th>Program</th>
                <th>Lokasi Gym</th>
                <th>Tgl &amp; Jam Trial</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trials as $index => $t)
            <tr>
                <td style="font-weight: 700; color: #94a3b8;">{{ $index + 1 }}</td>
                <td style="font-size: 0.85rem; color: #94a3b8;">{{ $t->created_at->format('d M Y H:i') }}</td>
                <td style="font-weight: 800; color: #f8fafc;">{{ $t->parent_name }}</td>
                <td style="font-size: 0.875rem; color: #e2e8f0; font-weight: 700;">{{ $t->participant_name }} <span style="color: #94a3b8; font-size: 0.8rem;">({{ $t->participant_age }})</span></td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t->phone) }}" target="_blank" style="color: #10b981; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(16, 185, 129, 0.15); padding: 0.35rem 0.75rem; border-radius: 99px; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 0.8rem;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $t->phone }}
                    </a>
                </td>
                <td style="font-weight: 800; color: #06b6d4;">{{ $t->program_name }}</td>
                <td style="color: #e2e8f0;">{{ $t->preferred_location }}</td>
                <td>
                    <span style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); font-weight: 800; padding: 0.35rem 0.75rem; border-radius: 99px; font-size: 0.8rem;">
                        <i class="fa-solid fa-clock" style="font-size: 0.75rem;"></i> {{ $t->trial_date }} @ {{ $t->trial_time }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: #64748b; padding: 3rem;">Belum ada booking trial masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.75rem;">
    {{ $trials->links() }}
</div>
@endsection
