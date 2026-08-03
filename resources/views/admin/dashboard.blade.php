@extends('admin.layout')

@section('title', 'Admin Dashboard Overview - Les Renang Jogja')
@section('header_title', 'Dashboard Overview')

@section('admin_content')
<!-- Metric Cards Grid -->
<div class="grid-4" style="margin-bottom: 2.25rem;">
    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-left: 4px solid #0284c7;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Pendaftaran Masuk</div>
                <div style="font-size: 2.25rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_registrations'] }}</div>
            </div>
            <div style="width: 52px; height: 52px; border-radius: 1rem; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-address-card"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; color: #10b981; font-weight: 700; margin-top: 0.85rem; display: flex; align-items: center; gap: 0.35rem;">
            <i class="fa-solid fa-arrow-trend-up"></i> Total Lead Pendaftar
        </div>
    </div>

    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-left: 4px solid #f59e0b;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Booking Trial</div>
                <div style="font-size: 2.25rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_trials'] }}</div>
            </div>
            <div style="width: 52px; height: 52px; border-radius: 1rem; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; color: #f59e0b; font-weight: 700; margin-top: 0.85rem; display: flex; align-items: center; gap: 0.35rem;">
            <i class="fa-solid fa-bolt"></i> Total Request Trial
        </div>
    </div>

    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-left: 4px solid #0077b6;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Total Program</div>
                <div style="font-size: 2.25rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_programs'] }}</div>
            </div>
            <div style="width: 52px; height: 52px; border-radius: 1rem; background: #e0f2fe; color: #0077b6; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-swatchbook"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; font-weight: 700; margin-top: 0.85rem;">
            <a href="{{ route('admin.programs.index') }}" style="color: #0284c7; text-decoration: none;">Kelola Program →</a>
        </div>
    </div>

    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-left: 4px solid #10b981;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Pertanyaan FAQ</div>
                <div style="font-size: 2.25rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_faqs'] }}</div>
            </div>
            <div style="width: 52px; height: 52px; border-radius: 1rem; background: #dcfce7; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-circle-question"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; font-weight: 700; margin-top: 0.85rem;">
            <a href="{{ route('admin.faqs.index') }}" style="color: #10b981; text-decoration: none;">Kelola FAQ →</a>
        </div>
    </div>
</div>

<!-- Recent Registrations Table -->
<div style="margin-bottom: 2.25rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.15rem;">
        <div>
            <h2 style="font-size: 1.35rem; color: #0f172a; margin: 0;">Lead Pendaftaran Terbaru</h2>
            <p style="color: #64748b; font-size: 0.85rem; margin-top: 0.2rem;">Data pendaftar les renang masuk secara real-time.</p>
        </div>
        <a href="{{ route('admin.registrations') }}" class="btn btn-outline btn-sm" style="border-radius: 0.75rem;">Lihat Semua Data</a>
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
                    <td style="color: #64748b; font-size: 0.85rem;">{{ $reg->created_at->format('d M Y H:i') }}</td>
                    <td style="font-weight: 800; color: #0f172a;">{{ $reg->name }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->phone) }}" target="_blank" style="color: #16a34a; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: #f0fdf4; padding: 0.35rem 0.75rem; border-radius: 99px; border: 1px solid #bbf7d0;">
                            <i class="fa-brands fa-whatsapp"></i> {{ $reg->phone }}
                        </a>
                    </td>
                    <td><span style="background: #f1f5f9; color: #475569; padding: 0.3rem 0.7rem; border-radius: 99px; font-weight: 700; font-size: 0.8rem;">{{ $reg->age_category }}</span></td>
                    <td style="font-weight: 700; color: #0369a1;">{{ $reg->program_name }}</td>
                    <td>{{ $reg->preferred_location }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #64748b; padding: 2.5rem;">Belum ada pendaftaran masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Shortcuts -->
<div class="admin-card" style="padding: 2rem;">
    <h3 style="font-size: 1.2rem; color: #0f172a; margin-bottom: 1rem;">Pintasan Cepat Kelola Konten</h3>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm" style="border-radius: 0.75rem; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
            <i class="fa-solid fa-plus"></i> Tambah Program Baru
        </a>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-accent btn-sm" style="border-radius: 0.75rem;">
            <i class="fa-solid fa-plus"></i> Tambah FAQ Baru
        </a>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-outline btn-sm" style="border-radius: 0.75rem;">
            <i class="fa-solid fa-plus"></i> Tulis Artikel Blog
        </a>
    </div>
</div>
@endsection
