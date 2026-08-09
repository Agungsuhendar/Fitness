@extends('admin.layout')

@section('title', 'Laporan Rekap Keuangan & Omset - Admin FitLife Center')
@section('header_title', 'Laporan Rekap Keuangan & Analytic Omset')

@section('admin_content')
<div style="width: 100%;">

    <!-- Header Section & Filter Bar -->
    <div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
        <!-- Decorative Glow Effects -->
        <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

        <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.25rem;">
            <div>
                <span style="background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(132, 204, 22, 0.4); color: var(--brand-lime, #84cc16); margin-bottom: 0.75rem; display: inline-block;">
                    📊 EXECUTIVE FINANCIAL REPORT
                </span>
                <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif; color: #ffffff;">
                    Laporan Rekapitulasi Pendapatan &amp; Omset
                </h2>
                <p style="color: #cbd5e1; margin: 0; font-size: 0.925rem;">
                    Gabungan pendapatan Kasir POS Ritel + Penjualan Paket VIP Membership &amp; Sesi Personal Trainer.
                </p>
            </div>

            <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
                <a href="{{ route('admin.reports.export', request()->all()) }}" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border-radius: 0.85rem; font-weight: 900; box-shadow: 0 0 20px rgba(132, 204, 22, 0.35); text-decoration: none; padding: 0.75rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-file-csv"></i> Export Laporan Keuangan (CSV)
                </a>
                <button type="button" onclick="window.print()" class="btn" style="background: rgba(255, 255, 255, 0.08); color: white !important; border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; font-weight: 800; cursor: pointer; padding: 0.75rem 1.25rem; backdrop-filter: blur(10px);">
                    <i class="fa-solid fa-print"></i> Cetak Laporan PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Date Filter Bar -->
    <div class="admin-card" style="padding: 1.25rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); margin-bottom: 2rem;">
        <form method="GET" action="{{ route('admin.reports.index') }}" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; gap: 0.65rem; align-items: center; flex-wrap: wrap;">
                <span style="font-weight: 800; font-size: 0.85rem; color: #94a3b8;">Periode:</span>
                <a href="{{ route('admin.reports.index', ['period' => 'today']) }}" class="btn" style="background: {{ $period === 'today' ? 'var(--brand-lime, #84cc16)' : 'rgba(255,255,255,0.06)' }}; color: {{ $period === 'today' ? '#060907' : '#cbd5e1' }}; border: {{ $period === 'today' ? 'none' : '1px solid rgba(255,255,255,0.1)' }}; padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Hari Ini
                </a>
                <a href="{{ route('admin.reports.index', ['period' => 'this_week']) }}" class="btn" style="background: {{ $period === 'this_week' ? 'var(--brand-lime, #84cc16)' : 'rgba(255,255,255,0.06)' }}; color: {{ $period === 'this_week' ? '#060907' : '#cbd5e1' }}; border: {{ $period === 'this_week' ? 'none' : '1px solid rgba(255,255,255,0.1)' }}; padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Pekan Ini
                </a>
                <a href="{{ route('admin.reports.index', ['period' => 'this_month']) }}" class="btn" style="background: {{ $period === 'this_month' ? 'var(--brand-lime, #84cc16)' : 'rgba(255,255,255,0.06)' }}; color: {{ $period === 'this_month' ? '#060907' : '#cbd5e1' }}; border: {{ $period === 'this_month' ? 'none' : '1px solid rgba(255,255,255,0.1)' }}; padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Bulan Ini
                </a>
            </div>

            <div style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="date" name="start_date" value="{{ $startDate }}" style="background: #121c17; color: #ffffff; border: 1px solid rgba(255,255,255,0.15); border-radius: 0.65rem; padding: 0.45rem; font-size: 0.8rem; font-weight: 700; color-scheme: dark;">
                <span style="font-size: 0.8rem; color: #94a3b8;">s/d</span>
                <input type="date" name="end_date" value="{{ $endDate }}" style="background: #121c17; color: #ffffff; border: 1px solid rgba(255,255,255,0.15); border-radius: 0.65rem; padding: 0.45rem; font-size: 0.8rem; font-weight: 700; color-scheme: dark;">
                <input type="hidden" name="period" value="custom">
                <button type="submit" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border-radius: 0.65rem; font-weight: 800; padding: 0.45rem 0.85rem; font-size: 0.8rem; border: none; cursor: pointer;">
                    Filter Custom
                </button>
            </div>
        </form>
    </div>

    <!-- Summary Metrics Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; margin-bottom: 2rem;" class="grid-2">
        <div class="admin-card admin-card-hover" style="padding: 1.35rem; border-radius: 1.25rem; border-top: 4px solid var(--brand-lime, #84cc16); background: var(--admin-card-bg, #0d1410); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.725rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">TOTAL OMSET GABUNGAN</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalCombinedRevenue, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.75rem; color: var(--brand-lime, #84cc16); font-weight: 800; margin-top: 0.35rem;">
                <i class="fa-solid fa-circle-check"></i> Total Kasir + Membership
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.35rem; border-radius: 1.25rem; border-top: 4px solid #06b6d4; background: var(--admin-card-bg, #0d1410); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.725rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">OMSET POS KASIR</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalPosRevenue, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.75rem; color: #06b6d4; font-weight: 800; margin-top: 0.35rem;">
                {{ $posTransactions->count() }} Transaksi Kasir
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.35rem; border-radius: 1.25rem; border-top: 4px solid #10b981; background: var(--admin-card-bg, #0d1410); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.725rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">LABA KOTOR POS (PROFIT)</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #10b981; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalPosGrossProfit, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.725rem; color: #94a3b8; font-weight: 700; margin-top: 0.35rem;">
                HPP Produk: Rp {{ number_format($totalPosCost, 0, ',', '.') }}
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.35rem; border-radius: 1.25rem; border-top: 4px solid #f59e0b; background: var(--admin-card-bg, #0d1410); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.725rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">OMSET MEMBERSHIP &amp; PT</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                Rp {{ number_format($totalMembershipRevenue, 0, ',', '.') }}
            </div>
            <div style="font-size: 0.75rem; color: #f59e0b; font-weight: 800; margin-top: 0.35rem;">
                {{ $payments->count() }} Paket Terjual
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.35rem; border-radius: 1.25rem; border-top: 4px solid #8b5cf6; background: var(--admin-card-bg, #0d1410); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.725rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">PRESENSI CHECK-IN</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.25rem;">
                {{ $totalAttendances }} Kunjungan
            </div>
            <div style="font-size: 0.75rem; color: #8b5cf6; font-weight: 800; margin-top: 0.35rem;">
                Log Kiosk Studio
            </div>
        </div>
    </div>

    <!-- Chart.js Visual Analytics Canvas Box -->
    <div class="admin-card" style="padding: 1.75rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); margin-bottom: 2rem;">
        <h4 style="font-size: 1.15rem; color: #ffffff; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-chart-line" style="color: var(--brand-lime, #84cc16);"></i> Grafik Visualisasi Tren Pendapatan &amp; Omset
        </h4>
        <div style="position: relative; height: 280px; width: 100%;">
            <canvas id="revenueTrendChart"></canvas>
        </div>
    </div>

    <!-- Data Tables: POS Sales & Membership Sales -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;" class="grid-2">
        
        <!-- Table 1: Penjualan POS Kasir -->
        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
            <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-cart-shopping" style="color: #06b6d4;"></i> Rincian Penjualan POS Kasir
            </h4>

            <div style="overflow-x: auto; max-height: 380px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.8rem;">
                    <thead>
                        <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8;">
                            <th style="padding: 0.65rem 0.75rem;">INVOICE</th>
                            <th style="padding: 0.65rem 0.75rem;">PELANGGAN</th>
                            <th style="padding: 0.65rem 0.75rem;">BAYAR</th>
                            <th style="padding: 0.65rem 0.75rem; text-align: right;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posTransactions as $pos)
                        <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <td style="padding: 0.65rem 0.75rem; font-weight: 800; font-family: monospace; color: #06b6d4;">
                                {{ $pos->invoice_number }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-weight: 700; color: #f8fafc;">
                                {{ $pos->member_name }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-size: 0.75rem; color: #94a3b8;">
                                {{ $pos->payment_method }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; text-align: right; font-weight: 900; color: var(--brand-lime, #84cc16);">
                                Rp {{ number_format($pos->total, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 1.5rem; text-align: center; color: #64748b;">Belum ada transaksi POS pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 0.85rem; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.03); padding: 0.55rem 0.85rem; border-radius: 0.65rem; border: 1px solid rgba(255,255,255,0.06); flex-wrap: wrap; gap: 0.5rem;">
                <div style="font-size: 0.775rem; color: #94a3b8; font-weight: 700;">
                    Showing {{ $posTransactions->firstItem() ?? 0 }} to {{ $posTransactions->lastItem() ?? 0 }} of {{ $posTransactions->total() }} results (Hal {{ $posTransactions->currentPage() }} dari {{ $posTransactions->lastPage() }})
                </div>
                <div>
                    @if($posTransactions->hasPages())
                        {{ $posTransactions->links('pagination::bootstrap-5') }}
                    @else
                        <nav role="navigation" aria-label="Pagination Navigation">
                            <ul class="pagination mb-0" style="margin: 0;">
                                <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
                                    <span class="page-link" aria-hidden="true" style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1); color: #64748b; cursor: not-allowed; border-radius: 0.4rem 0 0 0.4rem;">&lsaquo;</span>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link" style="background: var(--brand-lime, #84cc16); border-color: var(--brand-lime, #84cc16); color: #000000; font-weight: 900;">1</span>
                                </li>
                                <li class="page-item disabled" aria-disabled="true" aria-label="Next &raquo;">
                                    <span class="page-link" aria-hidden="true" style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1); color: #64748b; cursor: not-allowed; border-radius: 0 0.4rem 0.4rem 0;">&rsaquo;</span>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>

        <!-- Table 2: Penjualan Membership & PT -->
        <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
            <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-receipt" style="color: #f59e0b;"></i> Rincian Pembayaran Membership &amp; PT
            </h4>

            <div style="overflow-x: auto; max-height: 380px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.8rem;">
                    <thead>
                        <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8;">
                            <th style="padding: 0.65rem 0.75rem;">ORDER ID</th>
                            <th style="padding: 0.65rem 0.75rem;">MEMBER</th>
                            <th style="padding: 0.65rem 0.75rem;">PAKET</th>
                            <th style="padding: 0.65rem 0.75rem; text-align: right;">NOMINAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $pay)
                        <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                            <td style="padding: 0.65rem 0.75rem; font-weight: 800; font-family: monospace; color: #f59e0b;">
                                {{ $pay->order_id }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-weight: 700; color: #f8fafc;">
                                {{ $pay->member_name }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; font-size: 0.75rem; color: #94a3b8;">
                                {{ $pay->package_name }}
                            </td>
                            <td style="padding: 0.65rem 0.75rem; text-align: right; font-weight: 900; color: var(--brand-lime, #84cc16);">
                                Rp {{ number_format($pay->net_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 1.5rem; text-align: center; color: #64748b;">Belum ada pembayaran membership pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 0.85rem; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.03); padding: 0.55rem 0.85rem; border-radius: 0.65rem; border: 1px solid rgba(255,255,255,0.06); flex-wrap: wrap; gap: 0.5rem;">
                <div style="font-size: 0.775rem; color: #94a3b8; font-weight: 700;">
                    Showing {{ $payments->firstItem() ?? 0 }} to {{ $payments->lastItem() ?? 0 }} of {{ $payments->total() }} results (Hal {{ $payments->currentPage() }} dari {{ $payments->lastPage() }})
                </div>
                <div>
                    @if($payments->hasPages())
                        {{ $payments->links('pagination::bootstrap-5') }}
                    @else
                        <nav role="navigation" aria-label="Pagination Navigation">
                            <ul class="pagination mb-0" style="margin: 0;">
                                <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
                                    <span class="page-link" aria-hidden="true" style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1); color: #64748b; cursor: not-allowed; border-radius: 0.4rem 0 0 0.4rem;">&lsaquo;</span>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link" style="background: var(--brand-lime, #84cc16); border-color: var(--brand-lime, #84cc16); color: #000000; font-weight: 900;">1</span>
                                </li>
                                <li class="page-item disabled" aria-disabled="true" aria-label="Next &raquo;">
                                    <span class="page-link" aria-hidden="true" style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1); color: #64748b; cursor: not-allowed; border-radius: 0 0.4rem 0.4rem 0;">&rsaquo;</span>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
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
                labels: {!! json_encode($weeklyLabels) !!},
                datasets: [
                    {
                        label: 'Omset Toko POS Kasir (Rp)',
                        data: {!! json_encode($weeklyPosChart) !!},
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.15)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    },
                    {
                        label: 'Omset Membership & PT (Rp)',
                        data: {!! json_encode($weeklyMemChart) !!},
                        borderColor: '#84cc16',
                        backgroundColor: 'rgba(132, 204, 22, 0.15)',
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
                        labels: { font: { family: 'Outfit', weight: 'bold' }, color: '#cbd5e1' }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#94a3b8' },
                        grid: { color: 'rgba(255, 255, 255, 0.08)' }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#94a3b8',
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + ' Jt';
                            }
                        },
                        grid: { color: 'rgba(255, 255, 255, 0.08)' }
                    }
                }
            }
        });
    });
</script>
@endsection
