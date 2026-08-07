@extends('admin.layout')

@section('title', 'Data Pendaftaran - Admin Panel')
@section('header_title', 'Data Pendaftaran Masuk')

@section('admin_content')
<div class="admin-card" style="padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <h2 style="font-size: 1.35rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
        <i class="fa-solid fa-address-card" style="color: var(--brand-lime, #84cc16); margin-right: 0.5rem;"></i>
        Semua Lead Pendaftaran Sesi FitLife Fitness &amp; PT
    </h2>
    <p style="color: #cbd5e1; font-size: 0.875rem; margin-top: 0.35rem;">Daftar lengkap peserta yang telah mendaftar melalui formulir website resmi.</p>
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
                <td style="font-weight: 700; color: #94a3b8;">{{ $index + 1 }}</td>
                <td style="font-size: 0.85rem; color: #94a3b8;">{{ $reg->created_at->format('d M Y H:i') }}</td>
                <td style="font-weight: 800; color: #f8fafc;">{{ $reg->name }}</td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->phone) }}" target="_blank" style="color: #10b981; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(16, 185, 129, 0.15); padding: 0.35rem 0.75rem; border-radius: 99px; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 0.8rem;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $reg->phone }}
                    </a>
                </td>
                <td>
                    <span style="background: rgba(255, 255, 255, 0.06); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.1); padding: 0.3rem 0.75rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem;">
                        {{ $reg->age_category }}
                    </span>
                </td>
                <td style="font-weight: 800; color: #06b6d4;">{{ $reg->program_name }}</td>
                <td style="color: #e2e8f0;">{{ $reg->preferred_location }}</td>
                <td style="font-size: 0.85rem; color: #cbd5e1;">{{ $reg->preferred_schedule }}</td>
                <td style="font-size: 0.85rem; color: #94a3b8; max-width: 200px;">{{ $reg->notes ?? '-' }}</td>
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
