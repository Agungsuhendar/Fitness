@extends('admin.layout')

@section('title', 'Data Pendaftaran - Admin Panel')
@section('header_title', 'Data Pendaftaran Masuk')

@section('admin_content')
<div style="margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.35rem;">Semua Lead Pendaftaran Sesi Les Renang</h2>
    <p style="color: var(--text-muted); font-size: 0.9rem;">Daftar lengkap pendaftar melalui formulir web dan modal registration.</p>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal & Waktu</th>
                <th>Nama Pendaftar</th>
                <th>No. WhatsApp</th>
                <th>Kategori Usia</th>
                <th>Program Pilihan</th>
                <th>Lokasi Kolam</th>
                <th>Preferensi Jadwal</th>
                <th>Catatan Khusus</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $reg)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $reg->created_at->format('d/m/Y H:i') }}</td>
                <td style="font-weight: 800;">{{ $reg->name }}</td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->phone) }}" target="_blank" class="btn btn-whatsapp btn-sm" style="padding: 0.35rem 0.75rem; font-size: 0.8rem;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $reg->phone }}
                    </a>
                </td>
                <td>{{ $reg->age_category }}</td>
                <td style="font-weight: 800; color: var(--primary);">{{ $reg->program_name }}</td>
                <td>{{ $reg->preferred_location }}</td>
                <td>{{ $reg->preferred_schedule }}</td>
                <td style="font-size: 0.875rem; color: var(--text-muted);">{{ $reg->notes ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; color: var(--text-muted); padding: 2.5rem;">Belum ada pendaftaran masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $registrations->links() }}
</div>
@endsection
