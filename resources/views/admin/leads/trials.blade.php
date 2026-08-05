@extends('admin.layout')

@section('title', 'Data Booking Trial - Admin Panel')
@section('header_title', 'Data Booking Trial Gratis')

@section('admin_content')
<div style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <h2 style="font-size: 1.35rem; color: #0f172a; margin: 0;">
        <i class="fa-solid fa-calendar-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>
        Semua Booking Trial Uji Coba Gratis
    </h2>
    <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Daftar lengkap pemohon uji coba sesi fitness 30 menit gratis.</p>
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
                <th>Tgl & Jam Trial</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trials as $index => $t)
            <tr>
                <td style="font-weight: 700; color: #64748b;">{{ $index + 1 }}</td>
                <td style="font-size: 0.85rem; color: #64748b;">{{ $t->created_at->format('d M Y H:i') }}</td>
                <td style="font-weight: 800; color: #0f172a;">{{ $t->parent_name }}</td>
                <td style="font-size: 0.875rem; color: #334155; font-weight: 700;">{{ $t->participant_name }} <span style="color: #64748b; font-size: 0.8rem;">({{ $t->participant_age }})</span></td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t->phone) }}" target="_blank" style="color: #16a34a; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: #f0fdf4; padding: 0.35rem 0.75rem; border-radius: 99px; border: 1px solid #bbf7d0; font-size: 0.8rem;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $t->phone }}
                    </a>
                </td>
                <td style="font-weight: 800; color: #0369a1;">{{ $t->program_name }}</td>
                <td style="color: #334155;">{{ $t->preferred_location }}</td>
                <td>
                    <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-weight: 800; padding: 0.35rem 0.75rem; border-radius: 99px; font-size: 0.8rem;">
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
