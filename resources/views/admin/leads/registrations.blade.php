@extends('admin.layout')

@section('title', 'Data Pendaftaran - Admin Panel')
@section('header_title', 'Data Pendaftaran Masuk')

@section('admin_content')
<div style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <h2 style="font-size: 1.35rem; color: #0f172a; margin: 0;">
        <i class="fa-solid fa-address-card" style="color: #0284c7; margin-right: 0.5rem;"></i>
        Semua Lead Pendaftaran Sesi FitLife Fitness & PT
    </h2>
    <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Daftar lengkap peserta yang telah mendaftar melalui formulir website resmi.</p>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Waktu</th>
                <th>Nama Pendaftar</th>
                <th>No. WhatsApp</th>
                <th>Kategori Usia</th>
                <th>Program Pilihan</th>
                <th>Lokasi Gym</th>
                <th>Preferensi Jadwal</th>
                <th>Catatan Khusus</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $reg)
            <tr>
                <td style="font-weight: 700; color: #64748b;">{{ $index + 1 }}</td>
                <td style="font-size: 0.85rem; color: #64748b;">{{ $reg->created_at->format('d M Y H:i') }}</td>
                <td style="font-weight: 800; color: #0f172a;">{{ $reg->name }}</td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->phone) }}" target="_blank" style="color: #16a34a; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: #f0fdf4; padding: 0.35rem 0.75rem; border-radius: 99px; border: 1px solid #bbf7d0; font-size: 0.8rem;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $reg->phone }}
                    </a>
                </td>
                <td>
                    <span style="background: #f1f5f9; color: #475569; padding: 0.3rem 0.75rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem;">
                        {{ $reg->age_category }}
                    </span>
                </td>
                <td style="font-weight: 800; color: #0369a1;">{{ $reg->program_name }}</td>
                <td style="color: #334155;">{{ $reg->preferred_location }}</td>
                <td style="font-size: 0.85rem; color: #475569;">{{ $reg->preferred_schedule }}</td>
                <td style="font-size: 0.85rem; color: #64748b; max-width: 200px;">{{ $reg->notes ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; color: #64748b; padding: 3rem;">Belum ada pendaftaran masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.75rem;">
    {{ $registrations->links() }}
</div>
@endsection
