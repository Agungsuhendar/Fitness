<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\TrialBooking;

class AdminLeadController extends Controller
{
    public function registrations()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.leads.registrations', compact('registrations'));
    }

    public function trials()
    {
        $trials = TrialBooking::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.leads.trials', compact('trials'));
    }
}
