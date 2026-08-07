@extends('admin.layout')

@section('title', 'Admin Dashboard Analytics - FitLife Gym Jogja')
@section('header_title', 'Dashboard Analytics & Overview')

@section('admin_content')
<!-- Welcome Banner Header -->
<div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2.25rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
    <!-- Decorative Glow Effects -->
    <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.25) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
    <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(6, 182, 212, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

    <div style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.25rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(12px); padding: 0.4rem 1.1rem; border-radius: 99px; font-size: 0.8rem; font-weight: 800; border: 1px solid rgba(132, 204, 22, 0.4); margin-bottom: 0.85rem; color: #84cc16;">
                <i class="fa-solid fa-bolt" style="color: #84cc16;"></i> FITLIFE OPERATIONAL COMMAND CENTER
            </div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 2.1rem; font-weight: 900; margin: 0 0 0.4rem 0; color: #ffffff; letter-spacing: -0.02em;">
                Selamat Datang Kembali, {{ Auth::user()->name ?? 'Admin' }}! 👋
            </h2>
            <p style="color: #cbd5e1; margin: 0; font-size: 0.975rem; font-weight: 500; max-width: 650px; line-height: 1.5;">
                Ringkasan pendaftaran lead, statistik program favorit, transaksi kasir POS, dan laporan performa studio secara real-time.
            </p>
        </div>
        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <a href="{{ route('admin.registrations') }}" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border-radius: 0.85rem; font-weight: 900; padding: 0.75rem 1.25rem; font-size: 0.9rem; text-decoration: none; box-shadow: 0 0 20px rgba(132, 204, 22, 0.35); display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-list-check"></i> Kelola Lead Pendaftar
            </a>
            <a href="{{ route('admin.settings.index') }}" class="btn" style="background: rgba(255, 255, 255, 0.08); color: #ffffff !important; border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; font-weight: 800; padding: 0.75rem 1.25rem; font-size: 0.9rem; backdrop-filter: blur(12px); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-sliders"></i> Pengaturan System
            </a>
        </div>
    </div>
</div>

<!-- Metric Cards Grid (Sleek Glassmorphic Floating Cards) -->
<div class="grid-4" style="margin-bottom: 2.25rem;">
    <!-- Card 1: Pendaftaran Masuk -->
    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #84cc16; background: #0d1410;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Pendaftaran Lead</div>
                <div style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 900; color: #ffffff; line-height: 1;">{{ $stats['total_registrations'] }}</div>
            </div>
            <div style="width: 58px; height: 58px; border-radius: 1.15rem; background: rgba(132, 204, 22, 0.15); border: 1px solid rgba(132, 204, 22, 0.3); color: #84cc16; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.2);">
                <i class="fa-solid fa-address-card"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; color: #84cc16; font-weight: 800; margin-top: 1rem; display: flex; align-items: center; gap: 0.35rem;">
            <span style="background: rgba(132, 204, 22, 0.15); padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid rgba(132, 204, 22, 0.3);"><i class="fa-solid fa-arrow-trend-up"></i> Total Lead Masuk</span>
        </div>
    </div>

    <!-- Card 2: Booking Trial -->
    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #f59e0b; background: #0d1410;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Booking Trial</div>
                <div style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 900; color: #ffffff; line-height: 1;">{{ $stats['total_trials'] }}</div>
            </div>
            <div style="width: 58px; height: 58px; border-radius: 1.15rem; background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: 0 0 20px rgba(245, 158, 11, 0.2);">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; color: #f59e0b; font-weight: 800; margin-top: 1rem; display: flex; align-items: center; gap: 0.35rem;">
            <span style="background: rgba(245, 158, 11, 0.15); padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid rgba(245, 158, 11, 0.3);"><i class="fa-solid fa-bolt"></i> Free Trial Booked</span>
        </div>
    </div>

    <!-- Card 3: Total Program -->
    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #06b6d4; background: #0d1410;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Program Active</div>
                <div style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 900; color: #ffffff; line-height: 1;">{{ $stats['total_programs'] }}</div>
            </div>
            <div style="width: 58px; height: 58px; border-radius: 1.15rem; background: rgba(6, 182, 212, 0.15); border: 1px solid rgba(6, 182, 212, 0.3); color: #06b6d4; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: 0 0 20px rgba(6, 182, 212, 0.2);">
                <i class="fa-solid fa-swatchbook"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; font-weight: 700; margin-top: 1rem;">
            <a href="{{ route('admin.programs.index') }}" style="color: #06b6d4; text-decoration: none; font-weight: 800;">Kelola Program →</a>
        </div>
    </div>

    <!-- Card 4: Pertanyaan FAQ -->
    <div class="admin-card admin-card-hover" style="padding: 1.6rem 1.75rem; border-radius: 1.35rem; border-top: 4px solid #8b5cf6; background: #0d1410;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Pertanyaan FAQ</div>
                <div style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 900; color: #ffffff; line-height: 1;">{{ $stats['total_faqs'] }}</div>
            </div>
            <div style="width: 58px; height: 58px; border-radius: 1.15rem; background: rgba(139, 92, 246, 0.15); border: 1px solid rgba(139, 92, 246, 0.3); color: #a78bfa; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: 0 0 20px rgba(139, 92, 246, 0.2);">
                <i class="fa-solid fa-circle-question"></i>
            </div>
        </div>
        <div style="font-size: 0.8rem; font-weight: 700; margin-top: 1rem;">
            <a href="{{ route('admin.faqs.index') }}" style="color: #a78bfa; text-decoration: none; font-weight: 800;">Kelola FAQ →</a>
        </div>
    </div>
</div>

<!-- Interactive Analytics & Reports Section (Chart.js) -->
<div style="margin-bottom: 2.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
        <div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 1.45rem; color: #ffffff; margin: 0; font-weight: 900; display: flex; align-items: center; gap: 0.6rem;">
                <i class="fa-solid fa-chart-line" style="color: var(--brand-lime);"></i> Laporan & Analitik Pendaftaran Lead
            </h2>
            <p style="color: #94a3b8; font-size: 0.875rem; margin-top: 0.2rem;">Visualisasi perbandingan tren pendaftaran paket, program paling diminati, dan lokasi favorit.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.04); padding: 0.45rem 1rem; border-radius: 0.85rem; border: 1px solid var(--admin-border); font-size: 0.8rem; font-weight: 800; color: #84cc16;">
            <i class="fa-solid fa-arrows-rotate" style="color: #84cc16;"></i> Auto-Sync Realtime DB
        </div>
    </div>

    <!-- Chart Row 1: Line / Grouped Bar Chart Tren Bulanan -->
    <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; margin-bottom: 1.75rem; background: #0d1410; border: 1px solid var(--admin-border);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.5rem; border-bottom: 1px dashed rgba(255,255,255,0.08); padding-bottom: 1rem;">
            <div>
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; color: #ffffff; margin: 0; font-weight: 900;">Grafik Perbandingan Pendaftaran Paket vs Booking Trial ({{ date('Y') }})</h3>
                <span style="font-size: 0.8rem; color: #94a3b8;">Perbandingan dua batang terpisah per bulan (Hijau Neon = Pendaftaran Paket, Oranye Amber = Booking Trial)</span>
            </div>
        </div>
        <div style="position: relative; height: 320px; width: 100%;">
            <canvas id="monthlyTrendChart"></canvas>
        </div>
    </div>

    <!-- Chart Row 2: 2 Column (Pie Program & Bar Lokasi) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">
        <!-- Program Favorit Donut Chart -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #0d1410; border: 1px solid var(--admin-border);">
            <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed rgba(255,255,255,0.08); padding-bottom: 0.85rem;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; color: #ffffff; margin: 0; font-weight: 900;">Program Paling Diminati</h3>
                <span style="font-size: 0.8rem; color: #94a3b8;">Distribusi persentase pilihan program pendaftar</span>
            </div>
            <div style="position: relative; height: 270px; width: 100%; display: flex; align-items: center; justify-content: center;">
                <canvas id="programPieChart"></canvas>
            </div>
        </div>

        <!-- Lokasi Favorit Bar Chart -->
        <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #0d1410; border: 1px solid var(--admin-border);">
            <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed rgba(255,255,255,0.08); padding-bottom: 0.85rem;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; color: #ffffff; margin: 0; font-weight: 900;">Lokasi Studio Gym Terfavorit</h3>
                <span style="font-size: 0.8rem; color: #94a3b8;">Ranking lokasi gym pilihan utama peserta di Yogyakarta</span>
            </div>
            <div style="position: relative; height: 270px; width: 100%;">
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

    // Set Global Chart.js Font Color to White
    Chart.defaults.color = '#94a3b8';
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

    const currentBrandLime = getComputedStyle(document.documentElement).getPropertyValue('--brand-lime').trim() || '#84cc16';
    const currentBrandLimeDark = getComputedStyle(document.documentElement).getPropertyValue('--brand-lime-dark').trim() || '#65a30d';

    // 1. Monthly Trend Grouped Bar Chart
    const ctxTrend = document.getElementById('monthlyTrendChart')?.getContext('2d');
    if (ctxTrend) {
        window.monthlyChartInstance = new Chart(ctxTrend, {
            type: 'bar',
            data: {
                labels: analytics.months,
                datasets: [
                    {
                        label: 'Pendaftaran Paket Resmi',
                        data: analytics.monthly_reg,
                        backgroundColor: currentBrandLime,
                        hoverBackgroundColor: currentBrandLimeDark,
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
                            color: '#ffffff',
                            font: { size: 12, weight: '700' }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        padding: 12,
                        cornerRadius: 8,
                        backgroundColor: '#090e0b',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        titleColor: '#84cc16',
                        bodyColor: '#ffffff',
                        titleFont: { size: 13, weight: '800' }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255,255,255,0.06)' },
                        ticks: { precision: 0, color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
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
                    backgroundColor: ['#84cc16', '#06b6d4', '#ec4899', '#f59e0b', '#10b981', '#8b5cf6'],
                    borderWidth: 2,
                    borderColor: '#0d1410'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, color: '#cbd5e1', font: { size: 11, weight: '700' } }
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
                    backgroundColor: ['#06b6d4', '#84cc16', '#10b981', '#8b5cf6', '#f59e0b'],
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
                        grid: { color: 'rgba(255,255,255,0.06)' },
                        ticks: { precision: 0, color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });
    }
});
</script>

<!-- Recent Registrations Table (Ultra-Clean & Modern Dark Glass) -->
<div style="margin-bottom: 2.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.5rem;">
        <div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 1.4rem; color: #ffffff; margin: 0; font-weight: 900; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-clock-rotate-left" style="color: var(--brand-lime);"></i> Lead Pendaftaran Terbaru
            </h2>
            <p style="color: #94a3b8; font-size: 0.875rem; margin-top: 0.2rem;">Data calon peserta fitness & personal trainer yang baru mendaftar secara real-time.</p>
        </div>
        <a href="{{ route('admin.registrations') }}" class="btn" style="background: rgba(132, 204, 22, 0.15); border: 1.5px solid #84cc16; color: #84cc16; border-radius: 0.85rem; font-weight: 800; padding: 0.5rem 1rem; font-size: 0.85rem; text-decoration: none;">
            Lihat Semua Pendaftar →
        </a>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Jenis Lead</th>
                    <th>Nama Pendaftar</th>
                    <th>WhatsApp</th>
                    <th>Program Pilihan</th>
                    <th>Lokasi Gym</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestLeads as $lead)
                <tr>
                    <td style="color: #94a3b8; font-size: 0.85rem;">{{ $lead->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; border: 1px solid rgba(132, 204, 22, 0.3); padding: 0.35rem 0.85rem; border-radius: 99px; font-weight: 800; font-size: 0.775rem; display: inline-flex; align-items: center; gap: 0.4rem; white-space: nowrap;">
                            <i class="fa-solid {{ $lead->badge_icon }}"></i> {{ $lead->lead_type }}
                        </span>
                    </td>
                    <td style="font-weight: 800; color: #ffffff;">{{ $lead->customer_name }}</td>
                    <td>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}" target="_blank" style="color: #25d366; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(37, 211, 102, 0.15); padding: 0.4rem 0.85rem; border-radius: 99px; border: 1px solid rgba(37, 211, 102, 0.3); box-shadow: 0 0 12px rgba(37, 211, 102, 0.2);">
                            <i class="fa-brands fa-whatsapp" style="font-size: 0.95rem;"></i> {{ $lead->phone }}
                        </a>
                    </td>
                    <td style="font-weight: 800; color: #06b6d4;">{{ $lead->program_name }}</td>
                    <td style="color: #cbd5e1;">📍 {{ $lead->preferred_location }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #94a3b8; padding: 3rem;">
                        <i class="fa-solid fa-inbox" style="font-size: 2.5rem; color: #64748b; margin-bottom: 0.75rem; display: block;"></i>
                        Belum ada data pendaftaran masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Shortcuts Card (Clean Action Grid) -->
<div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #0d1410; border: 1px solid var(--admin-border);">
    <div style="margin-bottom: 1.25rem;">
        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; color: #ffffff; margin: 0; font-weight: 900; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-bolt" style="color: #f59e0b;"></i> Pintasan Cepat Kelola Studio
        </h3>
        <p style="color: #94a3b8; font-size: 0.85rem; margin-top: 0.2rem;">Akses cepat untuk menambahkan program, FAQ, artikel, dan pengaturan studio.</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
        <a href="{{ route('admin.programs.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: rgba(132, 204, 22, 0.08); border: 1px solid rgba(132, 204, 22, 0.25); border-radius: 1rem; text-decoration: none; color: #ffffff; transition: all 0.25s ease;">
            <div style="width: 42px; height: 42px; background: #84cc16; color: #060907; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 900;">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div>
                <div style="font-weight: 800; font-size: 0.9rem; color: #ffffff;">Tambah Program</div>
                <div style="font-size: 0.75rem; color: #84cc16;">Buat paket gym baru</div>
            </div>
        </a>

        <a href="{{ route('admin.faqs.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: rgba(245, 158, 11, 0.08); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 1rem; text-decoration: none; color: #ffffff; transition: all 0.25s ease;">
            <div style="width: 42px; height: 42px; background: #f59e0b; color: #060907; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 900;">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <div>
                <div style="font-weight: 800; font-size: 0.9rem; color: #ffffff;">Tambah FAQ Baru</div>
                <div style="font-size: 0.75rem; color: #f59e0b;">Pertanyaan & jawaban</div>
            </div>
        </a>

        <a href="{{ route('admin.posts.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; background: rgba(6, 182, 212, 0.08); border: 1px solid rgba(6, 182, 212, 0.25); border-radius: 1rem; text-decoration: none; color: #ffffff; transition: all 0.25s ease;">
            <div style="width: 42px; height: 42px; background: #06b6d4; color: #060907; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 900;">
                <i class="fa-solid fa-pen-nib"></i>
            </div>
            <div>
                <div style="font-weight: 800; font-size: 0.9rem; color: #ffffff;">Tulis Artikel Blog</div>
                <div style="font-size: 0.75rem; color: #06b6d4;">Edukasi & berita fitness</div>
            </div>
        </a>
    </div>
</div>
@endsection
