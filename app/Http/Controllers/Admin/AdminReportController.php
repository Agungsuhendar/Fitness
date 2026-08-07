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
    public function index(Request $request)
    {
        $period = $request->input('period', 'this_month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $queryPos = PosTransaction::query();
        $queryPayments = Payment::where('transaction_status', 'settlement');
        $queryAttendance = Attendance::query();

        if ($period === 'today') {
            $queryPos->whereDate('created_at', Carbon::today());
            $queryPayments->whereDate('created_at', Carbon::today());
            $queryAttendance->whereDate('created_at', Carbon::today());
        } elseif ($period === 'this_week') {
            $queryPos->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            $queryPayments->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            $queryAttendance->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($period === 'custom' && $startDate && $endDate) {
            $queryPos->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $queryPayments->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $queryAttendance->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } else {
            // default this_month
            $queryPos->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            $queryPayments->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            $queryAttendance->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        }

        $posTransactions = $queryPos->latest()->get();
        $payments = $queryPayments->latest()->get();
        $attendances = $queryAttendance->latest()->get();

        $totalPosRevenue = $posTransactions->sum('total');
        $totalMembershipRevenue = $payments->sum('net_amount');
        $totalCombinedRevenue = $totalPosRevenue + $totalMembershipRevenue;
        $totalAttendances = $attendances->count();

        return view('admin.reports.index', compact(
            'posTransactions', 'payments', 'attendances',
            'totalPosRevenue', 'totalMembershipRevenue', 'totalCombinedRevenue', 'totalAttendances',
            'period', 'startDate', 'endDate'
        ));
    }

    public function exportCsv(Request $request)
    {
        $fileName = 'Laporan_Keuangan_FitLife_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $posTransactions = PosTransaction::latest()->get();
        $payments = Payment::latest()->get();

        $callback = function() use($posTransactions, $payments) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['REKAPITULASI KEUANGAN FITLIFE CENTER JOGJA']);
            fputcsv($file, ['Tanggal Export', date('d M Y H:i:s')]);
            fputcsv($file, []);

            fputcsv($file, ['--- 1. PENJUALAN TOKO POS KASIR ---']);
            fputcsv($file, ['No Invoice', 'Tanggal', 'Pelanggan', 'Metode Bayar', 'Subtotal', 'Diskon', 'Total Lunas']);
            foreach ($posTransactions as $pos) {
                fputcsv($file, [
                    $pos->invoice_number,
                    $pos->created_at->format('d/m/Y H:i'),
                    $pos->member_name,
                    $pos->payment_method,
                    $pos->subtotal,
                    $pos->discount,
                    $pos->total
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['--- 2. PEMBAYARAN MEMBERSHIP & PT (MIDTRANS) ---']);
            fputcsv($file, ['Order ID', 'Tanggal', 'Member Name', 'Paket', 'Nominal', 'Status']);
            foreach ($payments as $pay) {
                fputcsv($file, [
                    $pay->order_id,
                    $pay->created_at->format('d/m/Y H:i'),
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
