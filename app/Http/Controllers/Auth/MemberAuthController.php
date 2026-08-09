<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Coach;
use App\Models\Location;
use App\Models\MembershipPlan;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class MemberAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('member.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = trim($request->input('login'));
        $password = $request->input('password');

        // Check if input is email or phone number
        $loginType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Sanitize phone number if logging in with phone
        if ($loginType === 'phone') {
            $user = User::where('phone', $loginInput)
                ->orWhere('phone', preg_replace('/[^0-9]/', '', $loginInput))
                ->first();
        } else {
            $user = User::where('email', $loginInput)->first();
        }

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->route('member.dashboard')
                ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return back()->withErrors([
            'login' => 'Email/WhatsApp atau Password yang Anda masukkan tidak cocok.',
        ])->onlyInput('login');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('member.dashboard');
        }

        $membershipPlans = collect();
        $programs = collect();
        $branches = collect();

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('membership_plans')) {
                $membershipPlans = MembershipPlan::all();
            }
        } catch (\Throwable $e) {}

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('programs')) {
                $programs = Program::all();
            }
        } catch (\Throwable $e) {}

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('locations')) {
                $branches = Location::all();
            }
        } catch (\Throwable $e) {}

        return view('auth.register', compact('membershipPlans', 'programs', 'branches'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'membership_type' => ['nullable', 'string'],
            'branch' => ['nullable', 'string'],
            'payment_method' => ['nullable', 'string'],
            'membership_price' => ['nullable', 'numeric'],
            'remaining_sessions' => ['nullable', 'integer'],
        ]);

        try {
            $lastUser = User::orderBy('id', 'desc')->first();
            $nextId = $lastUser ? ($lastUser->id + 1) : 1;
        } catch (\Throwable $e) {
            $nextId = rand(10, 9999);
        }
        $randomCardId = 'FL-MBR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $membershipType = $request->input('membership_type', 'Regular Gym Pass (Bulanan)');
        $price = (float) $request->input('membership_price', 300000);
        $sessions = (int) $request->input('remaining_sessions', 0);
        $paymentMethod = $request->input('payment_method', 'QRIS (GoPay/OVO/ShopeePay/DANA)');
        $branch = $request->input('branch', 'Sleman HQ (Jl. Kaliurang KM 5.5)');
        $expiresAt = $request->input('membership_expires_at', date('Y-m-d', strtotime('+30 days')));

        // Determine member status dynamically based on payment method
        $paymentLower = strtolower($paymentMethod);
        if (str_contains($paymentLower, 'transfer') || str_contains($paymentLower, 'bank')) {
            $status = 'Pending Verifikasi (Transfer Bank)';
        } elseif (str_contains($paymentLower, 'kasir') || str_contains($paymentLower, 'cash') || str_contains($paymentLower, 'tunai')) {
            $status = 'Pending (Bayar di Kasir)';
        } elseif (str_contains($paymentLower, 'qris') || str_contains($paymentLower, 'edc') || str_contains($paymentLower, 'kredit') || str_contains($paymentLower, 'debit')) {
            $status = 'Pending Verifikasi (Menunggu Scan QRIS)';
        } else {
            $status = 'Pending Verifikasi';
        }

        $allPossibleData = [
            'name' => $request->name,
            'email' => strtolower(trim($request->email)),
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'password' => Hash::make($request->password),
            'role' => 'member',
            'member_card_id' => $randomCardId,
            'membership_type' => $membershipType,
            'membership_price' => $price,
            'membership_expires_at' => $expiresAt,
            'payment_method' => $paymentMethod,
            'status' => $status,
            'branch' => $branch,
            'total_sessions' => $sessions,
            'completed_sessions' => 0,
            'remaining_sessions' => 0,
            'assigned_coach' => $sessions > 0 ? 'Coach Hendra Wijaya (APKI Certified)' : null,
            'reward_points' => 50,
            'level_badge' => '🔥 Member Baru',
            'streak_days' => 1,
        ];

        // Filter keys against actual database table schema to guarantee 0 SQL errors
        $userData = [];
        try {
            $existingColumns = \Illuminate\Support\Facades\Schema::getColumnListing('users');
            if (empty($existingColumns)) {
                $userData = [
                    'name' => $request->name,
                    'email' => strtolower(trim($request->email)),
                    'password' => Hash::make($request->password),
                ];
            } else {
                foreach ($allPossibleData as $key => $value) {
                    if (in_array($key, $existingColumns)) {
                        $userData[$key] = $value;
                    }
                }
            }
        } catch (\Throwable $e) {
            $userData = [
                'name' => $request->name,
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
            ];
        }

        $user = User::create($userData);

        Auth::login($user);

        try {
            \App\Services\WhatsAppService::sendWelcomeNotification($user);
        } catch (\Throwable $e) {}

        return redirect()->route('invoice.show', ['id' => $user->member_card_id])
            ->with('success', 'Pendaftaran akun member berhasil! Silakan lakukan pemindaian QRIS untuk mengaktifkan keanggotaan Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari akun member.');
    }
}
