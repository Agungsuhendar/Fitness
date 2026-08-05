@extends('admin.layout')

@section('title', 'Admin Dashboard Analytics - FitLife Gym Jogja')
@section('header_title', 'Dashboard Analytics & Overview')

@section('admin_content')
<!-- Welcome Banner Header -->
<div class="admin-card" style="background: linear-gradient(135deg, #03045e 0%, #0284c7 100%); color: white; padding: 2rem; border-radius: 1.5rem; margin-bottom: 2.25rem; position: relative; overflow: hidden; box-shadow: 0 15px 35px rgba(2, 132, 199, 0.2);">
    <!-- Decorative Glow Effects -->
    <div style="position: absolute; top: -60px; right: -60px; width: 220px; height: 220px; background: rgba(56, 189, 248, 0.25); border-radius: 50%; filter: blur(50px); pointer-events: none;"></div>
    <div style="position: absolute; bottom: -60px; left: -60px; width: 220px; height: 220px; background: rgba(245, 158, 11, 0.2); border-radius: 50%; filter: blur(50px); pointer-events: none;"></div>

    <div style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.25rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(12px); padding: 0.4rem 1rem; border-radius: 99px; font-size: 0.8rem; font-weight: 800; border: 1px solid rgba(255, 255, 255, 0.25); margin-bottom: 0.85rem;">
                <i class="fa-solid fa-calendar-day" style="color: #38bdf8;"></i> {{ date('l, d F Y') }}
            </div>
            <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem 0; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                Selamat Datang Kembali, Admin! 👋
            </h2>
            <p style="color: #e0f2fe; margin: 0; font-size: 0.95rem; font-weight: 500;">
                Ringkasan pendaftaran lead, statistik program favorit, dan laporan performa website secara real-time.
            </p>
        </div>
        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <a href="{{ route('admin.registrations') }}" class="btn btn-accent" style="border-radius: 0.85rem; font-weight: 800; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);">
                <i class="fa-solid fa-list-check"></i> Kelola Pendaftaran
            </a>
            <a href="{{ route('admin.settings.index') }}" class="btn" style="background: rgba(255, 255, 255, 0.22); color: #ffffff !important; border: 1.5px solid rgba(255, 255, 255, 0.6); border-radius: 0.85rem; font-weight: 800; backdrop-filter: blur(12px);">
                <i class="fa-solid fa-sliders"></i> Pengaturan Web
            </a>
        </div>
    </div>
</div>

<!-- Metric Cards Grid (Sleek Glassmorphic Floating Cards) -->
<div class="grid-4" style="margin-bottom: 2.25rem;">
    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #0284c7; background: #ffffff;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Pendaftaran Masuk</div>
                <div style="font-size: 2.35rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_registrations'] }}</div>
            </div>
            <div style="width: 56px; height: 56px; border-radius: 1.15rem; background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 1.45rem; box-shadow: 0 8px 20px rgba(2, 132, 199, 0.15);">
                <i class="fa-solid fa-address-card"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; color: #10b981; font-weight: 800; margin-top: 0.9rem; display: flex; align-items: center; gap: 0.35rem;">
            <span style="background: #dcfce7; padding: 0.2rem 0.6rem; border-radius: 99px;"><i class="fa-solid fa-arrow-trend-up"></i> Total Lead Pendaftar</span>
        </div>
    </div>

    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #f59e0b; background: #ffffff;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Booking Trial</div>
                <div style="font-size: 2.35rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_trials'] }}</div>
            </div>
            <div style="width: 56px; height: 56px; border-radius: 1.15rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.45rem; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.15);">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; color: #d97706; font-weight: 800; margin-top: 0.9rem; display: flex; align-items: center; gap: 0.35rem;">
            <span style="background: #fef3c7; padding: 0.2rem 0.6rem; border-radius: 99px;"><i class="fa-solid fa-bolt"></i> Request Sesi Uji Coba</span>
        </div>
    </div>

    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #0077b6; background: #ffffff;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Total Program</div>
                <div style="font-size: 2.35rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_programs'] }}</div>
            </div>
            <div style="width: 56px; height: 56px; border-radius: 1.15rem; background: linear-gradient(135deg, #e0f2fe 0%, #93c5fd 100%); color: #0077b6; display: flex; align-items: center; justify-content: center; font-size: 1.45rem; box-shadow: 0 8px 20px rgba(0, 119, 182, 0.15);">
                <i class="fa-solid fa-swatchbook"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; font-weight: 700; margin-top: 0.9rem;">
            <a href="{{ route('admin.programs.index') }}" style="color: #0284c7; text-decoration: none; font-weight: 800;">Kelola Program Aktif →</a>
        </div>
    </div>

    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #10b981; background: #ffffff;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Pertanyaan FAQ</div>
                <div style="font-size: 2.35rem; font-weight: 900; color: #0f172a; line-height: 1;">{{ $stats['total_faqs'] }}</div>
            </div>
            <div style="width: 56px; height: 56px; border-radius: 1.15rem; background: linear-gradient(135deg, #dcfce7 0%, #86efac 100%); color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.45rem; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);">
                <i class="fa-solid fa-circle-question"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; font-weight: 700; margin-top: 0.9rem;">
            <a href="{{ route('admin.faqs.index') }}" style="color: #10b981; text-decoration: none; font-weight: 800;">Kelola Daftar FAQ →</a>
        </div>
    </div>
</div>

<!-- Interactive Analytics & Reports Section (Chart.js) -->
<div style="margin-bottom: 2.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
        <div>
            <h2 style="font-size: 1.4rem; color: #0f172a; margin: 0; font-weight: 900; display: flex; align-items: center; gap: 0.6rem;">
                <i class="fa-solid fa-chart-line" style="color: #0284c7;"></i> Laporan & Analitik Pendaftaran Lead
            </h2>
            <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.2rem;">Visualisasi perbandingan tren pendaftaran paket, program paling diminati, dan lokasi favorit.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 0.5rem; background: #ffffff; padding: 0.4rem 0.9rem; border-radius: 0.85rem; border: 1px solid #cbd5e1; font-size: 0.8rem; font-weight: 800; color: #334155; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
            <i class="fa-solid fa-arrows-rotate" style="color: #0284c7;"></i> Auto-Sync Database
        </div>
    </div>

    <!-- Chart Row 1: Line / Grouped Bar Chart Tren Bulanan -->
    <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; margin-bottom: 1.75rem; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.5rem; border-bottom: 1px dashed #e2e8f0; padding-bottom: 1rem;">
            <div>
                <h3 style="font-size: 1.15rem; color: #0f172a; margin: 0; font-weight: 900;">Grafik Perbandingan Pendaftaran Paket vs Booking Trial ({{ date('Y') }})</h3>
                <span style="font-size: 0.8rem; color: #64748b;">Perbandingan dua batang terpisah per bulan (Biru = Pendaftaran Paket, Oranye = Booking Trial)</span>
            </div>
        </div>
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="monthlyTrendChart"></canvas>
        </div>
    </div>

    <!-- Chart Row 2: 2 Column (Pie Program & Bar Lokasi) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">
        <!-- Program Favorit Donut Chart -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed #e2e8f0; padding-bottom: 0.85rem;">
                <h3 style="font-size: 1.1rem; color: #0f172a; margin: 0; font-weight: 900;">Program Paling Diminati</h3>
                <span style="font-size: 0.8rem; color: #64748b;">Distribusi persentase pilihan program pendaftar</span>
            </div>
            <div style="position: relative; height: 260px; width: 100%; display: flex; align-items: center; justify-content: center;">
                <canvas id="programPieChart"></canvas>
            </div>
        </div>

        <!-- Lokasi Favorit Bar Chart -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed #e2e8f0; padding-bottom: 0.85rem;">
                <h3 style="font-size: 1.1rem; color: #0f172a; margin: 0; font-weight: 900;">Lokasi Studio Gym Terfavorit</h3>
                <span style="font-size: 0.8rem; color: #64748b;">Ranking lokasi gym pilihan utama peserta di Yogyakarta</span>
            </div>
            <div style="position: relative; height: 260px; width: 100%;">
                <canvas id="locationBarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const analytics = @json($analytics);

    // 1. Monthly Trend Grouped Bar Chart
    const ctxTrend = document.getElementById('monthlyTrendChart')?.getContext('2d');
    if (ctxTrend) {
        new Chart(ctxTrend, {
            type: 'bar',
            data: {
                labels: analytics.months,
                datasets: [
                    {
                        label: 'Pendaftaran Paket Resmi',
                        data: analytics.monthly_reg,
                        backgroundColor: '#0284c7',
                        hoverBackgroundColor: '#0369a1',
                        borderRadius: 6,
                        barPercentage: 0.65,
                        categoryPercentage: 0.6
                    },
                    {
                        label: 'Booking Trial Uji Coba',
                        data: analytics.monthly_trial,
                        backgroundColor: '#f59e0b',
                        hoverBackgroundColor: '#d97706',
                        borderRadius: 6,
                        barPercentage: 0.65,
                        categoryPercentage: 0.6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            font: { family: 'Plus Jakarta Sans', size: 12, weight: '700' }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { family: 'Plus Jakarta Sans', size: 13, weight: '800' },
                        bodyFont: { family: 'Plus Jakarta Sans', size: 12 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { precision: 0, font: { family: 'Plus Jakarta Sans' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans' } }
                    }
                }
            }
        });
    }

    // 2. Program Donut Chart
    const ctxProgram = document.getElementById('programPieChart')?.getContext('2d');
    if (ctxProgram) {
        new Chart(ctxProgram, {
            type: 'doughnut',
            data: {
                labels: analytics.program_labels,
                datasets: [{
                    data: analytics.program_data,
                    backgroundColor: ['#0284c7', '#00b4d8', '#ec4899', '#d97706', '#10b981', '#6366f1'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, font: { family: 'Plus Jakarta Sans', size: 11, weight: '700' } }
                    }
                }
            }
        });
    }

    // 3. Location Bar Chart
    const ctxLocation = document.getElementById('locationBarChart')?.getContext('2d');
    if (ctxLocation) {
        new Chart(ctxLocation, {
            type: 'bar',
            data: {
                labels: analytics.location_labels,
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: analytics.location_data,
                    backgroundColor: ['#0077b6', '#0284c7', '#00b4d8', '#38bdf8', '#7dd3fc'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { precision: 0 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }
});
</script>

<!-- Recent Registrations Table (Ultra-Clean & Modern) -->
<div style="margin-bottom: 2.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.5rem;">
        <div>
            <h2 style="font-size: 1.35rem; color: #0f172a; margin: 0; font-weight: 900; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-clock-rotate-left" style="color: #0284c7;"></i> Lead Pendaftaran Terbaru
            </h2>
            <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.2rem;">Data calon peserta fitness & personal trainer yang baru mendaftar secara real-time.</p>
        </div>
        <a href="{{ route('admin.registrations') }}" class="btn btn-outline btn-sm" style="border-radius: 0.85rem; font-weight: 800;">
            Lihat Semua Pendaftar →
        </a>
    </div>

    <div class="table-responsive" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03); overflow: hidden;">
        <table class="admin-table" style="margin: 0;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                    <th style="padding: 1.1rem 1.25rem;">Waktu</th>
                    <th style="padding: 1.1rem 1.25rem;">Jenis Lead</th>
                    <th style="padding: 1.1rem 1.25rem;">Nama Pendaftar</th>
                    <th style="padding: 1.1rem 1.25rem;">WhatsApp</th>
                    <th style="padding: 1.1rem 1.25rem;">Program Pilihan</th>
                    <th style="padding: 1.1rem 1.25rem;">Lokasi Gym</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestLeads as $lead)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="color: #64748b; font-size: 0.85rem; padding: 1rem 1.25rem;">{{ $lead->created_at->format('d M Y H:i') }}</td>
                    <td style="padding: 1rem 1.25rem;">
                        <span style="background: {{ $lead->badge_bg }}; color: {{ $lead->badge_color }}; border: 1px solid {{ $lead->badge_border }}; padding: 0.4rem 0.85rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; white-space: nowrap;">
                            <i class="fa-solid {{ $lead->badge_icon }}"></i> {{ $lead->lead_type }}
                        </span>
                    </td>
                    <td style="font-weight: 800; color: #0f172a; padding: 1rem 1.25rem;">{{ $lead->customer_name }}</td>
                    <td style="padding: 1rem 1.25rem;">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}" target="_blank" style="color: #16a34a; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: #f0fdf4; padding: 0.4rem 0.85rem; border-radius: 99px; border: 1px solid #bbf7d0; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.15);">
                            <i class="fa-brands fa-whatsapp" style="font-size: 0.95rem;"></i> {{ $lead->phone }}
                        </a>
                    </td>
                    <td style="font-weight: 800; color: #0369a1; padding: 1rem 1.25rem;">{{ $lead->program_name }}</td>
                    <td style="color: #475569; padding: 1rem 1.25rem;">📍 {{ $lead->preferred_location }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #64748b; padding: 3rem;">
                        <i class="fa-solid fa-inbox" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 0.75rem; display: block;"></i>
                        Belum ada data pendaftaran masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Shortcuts Card (Clean Action Grid) -->
<div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
    <div style="margin-bottom: 1.25rem;">
        <h3 style="font-size: 1.15rem; color: #0f172a; margin: 0; font-weight: 900; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-bolt" style="color: #f59e0b;"></i> Pintasan Cepat Kelola Konten
        </h3>
        <p style="color: #64748b; font-size: 0.85rem; margin-top: 0.2rem;">Akses cepat untuk menambahkan atau mengedit konten website.</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
        <a href="{{ route('admin.programs.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: #f0f9ff; border: 1.5px solid #bae6fd; border-radius: 1rem; text-decoration: none; color: #0369a1; transition: all 0.25s ease;">
            <div style="width: 40px; height: 40px; background: #0284c7; color: white; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div>
                <div style="font-weight: 800; font-size: 0.9rem;">Tambah Program</div>
                <div style="font-size: 0.75rem; color: #0284c7;">Buat paket les baru</div>
            </div>
        </a>

        <a href="{{ route('admin.faqs.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: #fefce8; border: 1.5px solid #fef08a; border-radius: 1rem; text-decoration: none; color: #a16207; transition: all 0.25s ease;">
            <div style="width: 40px; height: 40px; background: #eab308; color: white; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <div>
                <div style="font-weight: 800; font-size: 0.9rem;">Tambah FAQ Baru</div>
                <div style="font-size: 0.75rem; color: #ca8a04;">Pertanyaan & jawaban</div>
            </div>
        </a>

        <a href="{{ route('admin.posts.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 1rem; text-decoration: none; color: #15803d; transition: all 0.25s ease;">
            <div style="width: 40px; height: 40px; background: #16a34a; color: white; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                <i class="fa-solid fa-pen-nib"></i>
            </div>
            <div>
                <div style="font-weight: 800; font-size: 0.9rem;">Tulis Artikel Blog</div>
                <div style="font-size: 0.75rem; color: #16a34a;">Edukasi & berita fitness</div>
            </div>
        </a>
    </div>
</div>
@endsection
