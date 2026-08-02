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

        $latestRegistrations = Registration::orderBy('created_at', 'desc')->take(5)->get();
        $latestTrials = TrialBooking::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestRegistrations', 'latestTrials'));
    }
}
