@extends('admin.layout')

@section('title', 'Admin Dashboard Overview - Les Renang Jogja')
@section('header_title', 'Dashboard Overview')

@section('admin_content')
<!-- Metric Cards Grid -->
<div class="grid-4" style="margin-bottom: 2.5rem;">
    <div class="glass-card" style="padding: 1.75rem;">
        <div style="font-size: 0.85rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Pendaftaran Masuk</div>
        <div style="font-size: 2.25rem; font-weight: 900; color: var(--primary-dark);">{{ $stats['total_registrations'] }}</div>
        <div style="font-size: 0.8rem; color: var(--emerald); font-weight: 700; margin-top: 0.4rem;">
            <i class="fa-solid fa-arrow-up"></i> Total Lead Pendaftar
        </div>
    </div>

    <div class="glass-card" style="padding: 1.75rem;">
        <div style="font-size: 0.85rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Booking Trial</div>
        <div style="font-size: 2.25rem; font-weight: 900; color: var(--accent-hover);">{{ $stats['total_trials'] }}</div>
        <div style="font-size: 0.8rem; color: var(--accent); font-weight: 700; margin-top: 0.4rem;">
            <i class="fa-solid fa-bolt"></i> Total Request Trial
        </div>
    </div>

    <div class="glass-card" style="padding: 1.75rem;">
        <div style="font-size: 0.85rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Total Program</div>
        <div style="font-size: 2.25rem; font-weight: 900; color: var(--primary);">{{ $stats['total_programs'] }}</div>
        <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 700; margin-top: 0.4rem;">
            <a href="{{ route('admin.programs.index') }}" style="color: var(--primary); text-decoration: none;">Kelola Program →</a>
        </div>
    </div>

    <div class="glass-card" style="padding: 1.75rem;">
        <div style="font-size: 0.85rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Pertanyaan FAQ</div>
        <div style="font-size: 2.25rem; font-weight: 900; color: var(--emerald);">{{ $stats['total_faqs'] }}</div>
        <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 700; margin-top: 0.4rem;">
            <a href="{{ route('admin.faqs.index') }}" style="color: var(--emerald); text-decoration: none;">Kelola FAQ →</a>
        </div>
    </div>
</div>

<!-- Recent Registrations Table -->
<div style="margin-bottom: 2.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
        <h2 style="font-size: 1.4rem;">Lead Pendaftaran Terbaru</h2>
        <a href="{{ route('admin.registrations') }}" class="btn btn-outline btn-sm">Lihat Semua Data</a>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Nama Pendaftar</th>
                    <th>WhatsApp</th>
                    <th>Kategori Usia</th>
                    <th>Program Pilihan</th>
                    <th>Lokasi Kolam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestRegistrations as $reg)
                <tr>
                    <td>{{ $reg->created_at->format('d M Y H:i') }}</td>
                    <td style="font-weight: 800;">{{ $reg->name }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->phone) }}" target="_blank" style="color: #25d366; font-weight: 800; text-decoration: none;">
                            <i class="fa-brands fa-whatsapp"></i> {{ $reg->phone }}
                        </a>
                    </td>
                    <td>{{ $reg->age_category }}</td>
                    <td>{{ $reg->program_name }}</td>
                    <td>{{ $reg->preferred_location }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">Belum ada pendaftaran masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Shortcuts -->
<div class="glass-card" style="padding: 2rem;">
    <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Pintasan Cepat Kelola Konten</h3>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> Tambah Program Baru
        </a>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-accent btn-sm">
            <i class="fa-solid fa-plus"></i> Tambah FAQ Baru
        </a>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-plus"></i> Tulis Artikel Blog
        </a>
    </div>
</div>
@endsection
