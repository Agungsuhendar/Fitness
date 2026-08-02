@extends('admin.layout')

@section('title', 'Data Booking Trial - Admin Panel')
@section('header_title', 'Data Booking Trial Gratis')

@section('admin_content')
<div style="margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.35rem;">Semua Booking Trial Uji Coba Gratis</h2>
    <p style="color: var(--text-muted); font-size: 0.9rem;">Daftar pemohon uji coba sesi 30 menit gratis.</p>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Booking</th>
                <th>Nama Orang Tua / Pendaftar</th>
                <th>Nama Peserta (Usia)</th>
                <th>No. WhatsApp</th>
                <th>Program</th>
                <th>Lokasi Kolam</th>
                <th>Tgl & Jam Trial</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trials as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td style="font-weight: 800;">{{ $t->parent_name }}</td>
                <td>{{ $t->participant_name }} ({{ $t->participant_age }})</td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t->phone) }}" target="_blank" class="btn btn-whatsapp btn-sm" style="padding: 0.35rem 0.75rem; font-size: 0.8rem;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $t->phone }}
                    </a>
                </td>
                <td style="font-weight: 800; color: var(--primary);">{{ $t->program_name }}</td>
                <td>{{ $t->preferred_location }}</td>
                <td><span style="background: #fef3c7; color: #b45309; font-weight: 800; padding: 0.3rem 0.65rem; border-radius: 99px; font-size: 0.8rem;">{{ $t->trial_date }} @ {{ $t->trial_time }}</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 2.5rem;">Belum ada booking trial masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $trials->links() }}
</div>
@endsection
