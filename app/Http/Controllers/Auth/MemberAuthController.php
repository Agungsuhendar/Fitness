<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            // Convert e.g. 08123456789 to standard format or search directly
            $user = User::where('phone', $loginInput)
                ->orWhere('phone', preg_replace('/[^0-9]/', '', $loginInput))
                ->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user, $request->boolean('remember'));
                $request->session()->regenerate();
                return redirect()->intended(route('member.dashboard'))
                    ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }
        } else {
            // Attempt login via email
            if (Auth::attempt(['email' => $loginInput, 'password' => $password], $request->boolean('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('member.dashboard'))
                    ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
            }
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
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'program_name' => ['nullable', 'string'],
        ]);

        $randomCardId = 'FL-MBR-' . rand(1000, 9999);
        $program = $request->input('program_name', 'VIP Personal Trainer Pass 1-on-1');

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower(trim($request->email)),
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'password' => Hash::make($request->password),
            'role' => 'member',
            'member_card_id' => $randomCardId,
            'membership_type' => $program,
            'status' => 'Aktif (Baru Terdaftar)',
            'branch' => 'FitLife Center Jogja (HQ Kaliurang)',
            'total_sessions' => 8,
            'completed_sessions' => 0,
            'remaining_sessions' => 8,
            'assigned_coach' => 'Coach Hendra Wijaya (APKI Certified)',
            'next_session' => 'Sabtu, ' . date('d M Y', strtotime('+2 days')) . ' • 16:00 WIB',
            'initial_weight' => null,
            'current_weight' => null,
            'target_weight' => null,
            'initial_bodyfat' => null,
            'current_bodyfat' => null,
            'muscle_mass' => null,
        ]);

        Auth::login($user);

        try {
            \App\Services\WhatsAppService::sendWelcomeNotification($user);
        } catch (\Exception $e) {}

        return redirect()->route('member.dashboard')
            ->with('success', 'Pendaftaran akun member berhasil! Selamat bergabung di FitLife Center Jogja.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari akun member.');
    }
}
