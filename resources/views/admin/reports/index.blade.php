@extends('admin.layout')

@section('title', 'Laporan Rekap Keuangan & Omset - Admin FitLife Center')
@section('header_title', 'Laporan Rekap Keuangan & Analytic Omset')

@section('admin_content')
<div style="width: 100%;">

    <!-- Header Section & Filter Bar -->
    <div style="background: linear-gradient(135deg, #03045e 0%, #0284c7 100%); color: white; padding: 2rem; border-radius: 1.5rem; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(2, 132, 199, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.25rem;">
            <div>
                <span style="background: rgba(255,255,255,0.18); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 0.75rem; display: inline-block;">
                    📊 EXECUTIVE FINANCIAL REPORT
                </span>
                <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif;">
                    Laporan Rekapitulasi Pendapatan &amp; Omset
                </h2>
                <p style="color: #e0f2fe; margin: 0; font-size: 0.925rem;">
                    Gabungan pendapatan Kasir POS Ritel + Penjualan Paket VIP Membership &amp; Sesi Personal Trainer.
                </p>
            </div>

            <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
                <a href="{{ route('admin.reports.export') }}" class="btn btn-accent" style="border-radius: 0.85rem; font-weight: 900; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35); text-decoration: none; padding: 0.75rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-file-csv"></i> Export Laporan Keuangan (CSV)
                </a>
                <button type="button" onclick="window.print()" class="btn" style="background: rgba(255, 255, 255, 0.22); color: white; border: 1.5px solid rgba(255, 255, 255, 0.5); border-radius: 0.85rem; font-weight: 800; cursor: pointer; padding: 0.75rem 1.25rem;">
                    <i class="fa-solid fa-print"></i> Cetak Laporan PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Date Filter Bar -->
    <div class="admin-card" style="padding: 1.25rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <form method="GET" action="{{ route('admin.reports.index') }}" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; gap: 0.65rem; align-items: center; flex-wrap: wrap;">
                <span style="font-weight: 800; font-size: 0.85rem; color: #475569;">Periode:</span>
                <a href="{{ route('admin.reports.index', ['period' => 'today']) }}" class="btn" style="background: {{ $period === 'today' ? '#0284c7' : '#f1f5f9' }}; color: {{ $period === 'today' ? 'white' : '#334155' }}; padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Hari Ini
                </a>
                <a href="{{ route('admin.reports.index', ['period' => 'this_week']) }}" class="btn" style="background: {{ $period === 'this_week' ? '#0284c7' : '#f1f5f9' }}; color: {{ $period === 'this_week' ? 'white' : '#334155' }}; padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Pekan Ini
                </a>
                <a href="{{ route('admin.reports.index', ['period' => 'this_month']) }}" class="btn" style="background: {{ $period === 'this_month' ? '#0284c7' : '#f1f5f9' }}; color: {{ $period === 'this_month' ? 'white' : '#334155' }}; padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Bulan Ini
                </a>
            </div>

            <div style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="start_date" value="{{ $startDate }}" style="border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.45rem; font-size: 0.8rem; font-weight: 700;">
                <span style="font-size: 0.8rem; color: #94a3b8;">s/d</span>
                <input type="date" name="end_date" value="{{ $endDate }}" style="border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.45rem; font-size: 0.8rem; font-weight: 700;">
                <input type="hidden" name="period" value="custom">
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; font-weight: 800; padding: 0.45rem 0.85rem; font-size: 0.8rem;">
                    Filter Custom
                </button>
            </div>
        </form>
    </div>

    <!-- Summary Metrics Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; border-top: 4px solid #16a34a; background: #ffffff;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">TOTAL OMSET GABUNGAN</span>
            <div style="font-size: 1.85rem; font-weight: 900; color: #16a34a; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalCombinedRevenue, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.775rem; color: #16a34a; font-weight: 800; margin-top: 0.4rem;">
                <i class="fa-solid fa-circle-check"></i> Total Kasir + Membership
            </div>
        </div>

        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; border-top: 4px solid #0284c7; background: #ffffff;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">OMSET POS KASIR RITEL</span>
            <div style="font-size: 1.85rem; font-weight: 900; color: #0284c7; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalPosRevenue, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.775rem; color: #0284c7; font-weight: 800; margin-top: 0.4rem;">
                {{ $posTransactions->count() }} Transaksi Kasir
            </div>
        </div>

        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; border-top: 4px solid #f59e0b; background: #ffffff;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">OMSET MEMBERSHIP &amp; PT</span>
            <div style="font-size: 1.85rem; font-weight: 900; color: #d97706; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalMembershipRevenue, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.775rem; color: #d97706; font-weight: 800; margin-top: 0.4rem;">
                {{ $payments->count() }} Paket Terjual
            </div>
        </div>

        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; border-top: 4px solid #8b5cf6; background: #ffffff;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">TOTAL PRESENSI CHECK-IN</span>
            <div style="font-size: 1.85rem; font-weight: 900; color: #8b5cf6; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                {{ $totalAttendances }} Kunjungan
            </div>
            <div style="font-size: 0.775rem; color: #8b5cf6; font-weight: 800; margin-top: 0.4rem;">
                Log Kiosk Studio
            </div>
        </div>
    </div>

    <!-- Chart.js Visual Analytics Canvas Box -->
    <div class="admin-card" style="padding: 1.75rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <h4 style="font-size: 1.15rem; color: #0f172a; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-chart-line" style="color: #16a34a;"></i> Grafik Visualisasi Tren Pendapatan &amp; Omset
        </h4>
        <div style="position: relative; height: 280px; width: 100%;">
            <canvas id="revenueTrendChart"></canvas>
        </div>
    </div>

    <!-- Data Tables: POS Sales & Membership Sales -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;" class="grid-2">
        
        <!-- Table 1: Penjualan POS Kasir -->
        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0;">
            <h4 style="font-size: 1.1rem; color: #0f172a; margin-bottom: 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-cart-shopping" style="color: #0284c7;"></i> Rincian Penjualan POS Kasir
            </h4>

            <div style="overflow-x: auto; max-height: 380px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.8rem;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0; color: #475569;">
                            <th style="padding: 0.65rem 0.75rem;">INVOICE</th>
                            <th style="padding: 0.65rem 0.75rem;">PELANGGAN</th>
                            <th style="padding: 0.65rem 0.75rem;">BAYAR</th>
                            <th style="padding: 0.65rem 0.75rem; text-align: right;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posTransactions as $pos)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 0.65rem 0.75rem; font-weight: 800; font-family: monospace; color: #0284c7;">
                                {{ $pos->invoice_number }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-weight: 700; color: #0f172a;">
                                {{ $pos->member_name }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-size: 0.75rem; color: #64748b;">
                                {{ $pos->payment_method }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; text-align: right; font-weight: 900; color: #16a34a;">
                                Rp {{ number_format($pos->total, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 1.5rem; text-align: center; color: #94a3b8;">Belum ada transaksi POS pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table 2: Penjualan Membership & PT -->
        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0;">
            <h4 style="font-size: 1.1rem; color: #0f172a; margin-bottom: 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-receipt" style="color: #f59e0b;"></i> Rincian Pembayaran Membership &amp; PT
            </h4>

            <div style="overflow-x: auto; max-height: 380px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.8rem;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0; color: #475569;">
                            <th style="padding: 0.65rem 0.75rem;">ORDER ID</th>
                            <th style="padding: 0.65rem 0.75rem;">MEMBER</th>
                            <th style="padding: 0.65rem 0.75rem;">PAKET</th>
                            <th style="padding: 0.65rem 0.75rem; text-align: right;">NOMINAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $pay)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 0.65rem 0.75rem; font-weight: 800; font-family: monospace; color: #d97706;">
                                {{ $pay->order_id }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-weight: 700; color: #0f172a;">
                                {{ $pay->member_name }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-size: 0.75rem; color: #64748b;">
                                {{ $pay->package_name }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; text-align: right; font-weight: 900; color: #16a34a;">
                                Rp {{ number_format($pay->net_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 1.5rem; text-align: center; color: #94a3b8;">Belum ada pembayaran membership pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('revenueTrendChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Hari Ini'],
                datasets: [
                    {
                        label: 'Omset Toko POS Kasir (Rp)',
                        data: [1250000, 2100000, 1850000, 3200000, {{ (int)$totalPosRevenue }}],
                        borderColor: '#0284c7',
                        backgroundColor: 'rgba(2, 132, 199, 0.12)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    },
                    {
                        label: 'Omset Membership & PT (Rp)',
                        data: [7500000, 12500000, 9800000, 15000000, {{ (int)$totalMembershipRevenue }}],
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22, 163, 74, 0.12)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { family: 'Outfit', weight: 'bold' } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + ' Jt';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
