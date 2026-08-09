<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PosTransaction;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    private function getFilteredQueries(Request $request)
    {
        $period = $request->input('period', 'this_month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $todayWib = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $startOfWeekWib = Carbon::now('Asia/Jakarta')->startOfWeek()->format('Y-m-d 00:00:00');
        $endOfWeekWib = Carbon::now('Asia/Jakarta')->endOfWeek()->format('Y-m-d 23:59:59');

        $queryPos = PosTransaction::query();
        $queryPayments = Payment::where('transaction_status', 'settlement');
        $queryAttendance = Attendance::query();

        if ($period === 'today') {
            $queryPos->where(function($q) use ($todayWib) {
                $q->whereDate('transacted_at', $todayWib)
                  ->orWhereDate('created_at', $todayWib);
            });
            $queryPayments->where(function($q) use ($todayWib) {
                $q->whereDate('paid_at', $todayWib)
                  ->orWhereDate('created_at', $todayWib);
            });
            $queryAttendance->whereDate('created_at', $todayWib);
        } elseif ($period === 'this_week') {
            $queryPos->where(function($q) use ($startOfWeekWib, $endOfWeekWib) {
                $q->whereBetween('transacted_at', [$startOfWeekWib, $endOfWeekWib])
                  ->orWhereBetween('created_at', [$startOfWeekWib, $endOfWeekWib]);
            });
            $queryPayments->whereBetween('created_at', [$startOfWeekWib, $endOfWeekWib]);
            $queryAttendance->whereBetween('created_at', [$startOfWeekWib, $endOfWeekWib]);
        } elseif ($period === 'custom' && $startDate && $endDate) {
            $queryPos->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $queryPayments->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $queryAttendance->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } else {
            // default this_month (WIB timezone aware)
            $monthWib = Carbon::now('Asia/Jakarta')->month;
            $yearWib = Carbon::now('Asia/Jakarta')->year;
            $queryPos->whereMonth('created_at', $monthWib)->whereYear('created_at', $yearWib);
            $queryPayments->whereMonth('created_at', $monthWib)->whereYear('created_at', $yearWib);
            $queryAttendance->whereMonth('created_at', $monthWib)->whereYear('created_at', $yearWib);
        }

        // Only count paid POS transactions (exclude pending QRIS)
        $queryPos->where(function($q) {
            $q->where('payment_status', 'paid')
              ->orWhere('payment_status', 'settlement')
              ->orWhereNull('payment_status');
        });

        return [$queryPos, $queryPayments, $queryAttendance, $period, $startDate, $endDate];
    }

    public function index(Request $request)
    {
        list($queryPos, $queryPayments, $queryAttendance, $period, $startDate, $endDate) = $this->getFilteredQueries($request);

        // Calculate Totals across full filtered period for KPI Metric Cards
        $totalPosRevenue = (float) (clone $queryPos)->sum('total');
        
        // Calculate HPP (Cost of Goods Sold)
        $allPosTxIds = (clone $queryPos)->pluck('id');
        $totalPosCost = (float) \App\Models\PosTransactionItem::whereIn('pos_transaction_id', $allPosTxIds)
            ->join('products', 'pos_transaction_items.product_id', '=', 'products.id')
            ->sum(\Illuminate\Support\Facades\DB::raw('pos_transaction_items.qty * products.cost_price'));

        $totalPosGrossProfit = max(0, $totalPosRevenue - $totalPosCost);

        $totalMembershipRevenue = (float) (clone $queryPayments)->sum('net_amount');
        $totalCombinedRevenue = $totalPosRevenue + $totalMembershipRevenue;
        $totalAttendances = (int) (clone $queryAttendance)->count();

        // Paginate items for data tables (10 items per page with query string preserved)
        $posTransactions = $queryPos->with('items.product')->latest()->paginate(10, ['*'], 'pos_page')->withQueryString();
        $payments = $queryPayments->latest()->paginate(10, ['*'], 'mem_page')->withQueryString();
        $attendances = $queryAttendance->latest()->get();

        // Calculate Real Weekly Chart Data for last 4 weeks + current
        $weeklyLabels = [];
        $weeklyPosChart = [];
        $weeklyMemChart = [];

        for ($i = 4; $i >= 0; $i--) {
            $start = Carbon::now('Asia/Jakarta')->subWeeks($i)->startOfWeek();
            $end = Carbon::now('Asia/Jakarta')->subWeeks($i)->endOfWeek();

            $label = ($i === 0) ? 'Pekan Ini' : 'W-' . (4 - $i + 1) . ' (' . $start->format('d/m') . ')';
            $weeklyLabels[] = $label;

            $posSum = PosTransaction::where(function($q) {
                $q->where('payment_status', 'paid')->orWhere('payment_status', 'settlement')->orWhereNull('payment_status');
            })->whereBetween('created_at', [$start, $end])->sum('total');

            $memSum = Payment::where('transaction_status', 'settlement')->whereBetween('created_at', [$start, $end])->sum('net_amount');

            $weeklyPosChart[] = (int) $posSum;
            $weeklyMemChart[] = (int) $memSum;
        }

        return view('admin.reports.index', compact(
            'posTransactions', 'payments', 'attendances',
            'totalPosRevenue', 'totalPosCost', 'totalPosGrossProfit', 'totalMembershipRevenue', 'totalCombinedRevenue', 'totalAttendances',
            'period', 'startDate', 'endDate',
            'weeklyLabels', 'weeklyPosChart', 'weeklyMemChart'
        ));
    }

    public function exportCsv(Request $request)
    {
        list($queryPos, $queryPayments, $queryAttendance, $period) = $this->getFilteredQueries($request);

        $fileName = 'Laporan_Keuangan_FitLife_' . $period . '_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $posTransactions = $queryPos->latest()->get();
        $payments = $queryPayments->latest()->get();

        $callback = function() use($posTransactions, $payments, $period) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['REKAPITULASI KEUANGAN FITLIFE CENTER JOGJA']);
            fputcsv($file, ['Periode Filter', strtoupper($period)]);
            fputcsv($file, ['Tanggal Export', date('d M Y H:i:s')]);
            fputcsv($file, []);

            fputcsv($file, ['--- 1. PENJUALAN TOKO POS KASIR ---']);
            fputcsv($file, ['No Invoice', 'Tanggal', 'Pelanggan', 'Metode Bayar', 'Subtotal', 'Diskon', 'Total Lunas']);
            foreach ($posTransactions as $pos) {
                fputcsv($file, [
                    $pos->invoice_number,
                    $pos->created_at ? $pos->created_at->format('d/m/Y H:i') : '-',
                    $pos->member_name,
                    $pos->payment_method,
                    $pos->subtotal,
                    $pos->discount,
                    $pos->total
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['--- 2. PEMBAYARAN MEMBERSHIP & PT (MIDTRANS/IPAYMU) ---']);
            fputcsv($file, ['Order ID', 'Tanggal', 'Member Name', 'Paket', 'Nominal', 'Status']);
            foreach ($payments as $pay) {
                fputcsv($file, [
                    $pay->order_id,
                    $pay->created_at ? $pay->created_at->format('d/m/Y H:i') : '-',
                    $pay->member_name,
                    $pay->package_name,
                    $pay->net_amount,
                    $pay->transaction_status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
