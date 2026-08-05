<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Location;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Registration;
use App\Models\TrialBooking;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_registrations' => Registration::count(),
            'total_trials' => TrialBooking::count(),
            'total_programs' => Program::count(),
            'total_locations' => Location::count(),
            'total_faqs' => Faq::count(),
            'total_posts' => Post::count(),
            'total_testimonials' => Testimonial::count(),
        ];

        // Combine Latest Registrations & Trial Bookings with clear type badges
        $latestRegs = Registration::latest()->take(5)->get()->map(function($item) {
            $item->lead_type = 'Pendaftaran Paket';
            $item->badge_color = '#0284c7';
            $item->badge_bg = '#e0f2fe';
            $item->badge_border = '#bae6fd';
            $item->badge_icon = 'fa-box-archive';
            $item->customer_name = $item->name;
            return $item;
        });

        $latestTrials = TrialBooking::latest()->take(5)->get()->map(function($item) {
            $item->lead_type = 'Booking Trial 30m';
            $item->badge_color = '#d97706';
            $item->badge_bg = '#fef3c7';
            $item->badge_border = '#fde68a';
            $item->badge_icon = 'fa-bolt';
            $item->customer_name = $item->participant_name . ($item->parent_name ? ' (Wali: ' . $item->parent_name . ')' : '');
            return $item;
        });

        $latestLeads = $latestRegs->concat($latestTrials)
            ->sortByDesc('created_at')
            ->take(8);

        // 1. Monthly Registration & Trial Trend (Januari - Desember)
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $monthlyRegData = array_fill(0, 12, 0);
        $monthlyTrialData = array_fill(0, 12, 0);

        $allRegistrations = Registration::all();
        $allTrials = TrialBooking::all();

        foreach ($allRegistrations as $reg) {
            if ($reg->created_at) {
                $m = (int) $reg->created_at->format('n');
                if ($m >= 1 && $m <= 12) {
                    $monthlyRegData[$m - 1]++;
                }
            }
        }

        foreach ($allTrials as $tr) {
            if ($tr->created_at) {
                $m = (int) $tr->created_at->format('n');
                if ($m >= 1 && $m <= 12) {
                    $monthlyTrialData[$m - 1]++;
                }
            }
        }

        // If no data exists yet, fill with realistic trend demo data for visual preview
        if (array_sum($monthlyRegData) == 0 && array_sum($monthlyTrialData) == 0) {
            $monthlyRegData = [4, 6, 8, 12, 15, 18, 22, 19, 24, 28, 31, 35];
            $monthlyTrialData = [2, 4, 5, 8, 10, 12, 16, 14, 17, 20, 23, 26];
        }

        // 2. Program Favorit Distribution (Registration + Trial Combined)
        $programChart = [];
        foreach ($allRegistrations as $reg) {
            $p = $reg->program_name;
            if ($p) $programChart[$p] = ($programChart[$p] ?? 0) + 1;
        }
        foreach ($allTrials as $tr) {
            $p = $tr->program_name;
            if ($p) $programChart[$p] = ($programChart[$p] ?? 0) + 1;
        }

        if (empty($programChart)) {
            $programChart = [
                'Les Renang Anak' => 18,
                'Les Renang Dewasa Pemula' => 12,
                'Les Renang Khusus Wanita' => 10,
                'Persiapan Tes TNI/POLRI' => 7,
                'Terapi Renang Medis' => 4
            ];
        }

        // 3. Lokasi Kolam Renang Favorit (Registration + Trial Combined)
        $locationChart = [];
        foreach ($allRegistrations as $reg) {
            $l = $reg->preferred_location;
            if ($l) $locationChart[$l] = ($locationChart[$l] ?? 0) + 1;
        }
        foreach ($allTrials as $tr) {
            $l = $tr->preferred_location;
            if ($l) $locationChart[$l] = ($locationChart[$l] ?? 0) + 1;
        }

        if (empty($locationChart)) {
            $locationChart = [
                'FIK UNY Sleman' => 20,
                'Depok Sport Center (Seturan)' => 15,
                'Umbulharjo / Kota Jogja' => 9,
                'Tirta Tamansari Bantul' => 7
            ];
        }

        $analytics = [
            'months' => $months,
            'monthly_reg' => $monthlyRegData,
            'monthly_trial' => $monthlyTrialData,
            'program_labels' => array_keys($programChart),
            'program_data' => array_values($programChart),
            'location_labels' => array_keys($locationChart),
            'location_data' => array_values($locationChart),
        ];

        return view('admin.dashboard', compact('stats', 'latestLeads', 'analytics'));
    }
}
