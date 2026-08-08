<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Auth Login for Member / User
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($validated['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($fieldType, $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kredensial login tidak cocok dengan data kami.',
            ], 401);
        }

        // Generate token response
        $token = method_exists($user, 'createToken') 
            ? $user->createToken('flutter-app-token')->plainTextToken 
            : Str::random(60);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil login ke aplikasi!',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                    'member_card_id' => $user->member_card_id ?? 'FL-MBR-' . sprintf('%04d', $user->id),
                    'membership_type' => $user->membership_type ?? 'VIP Pass Member',
                    'status' => $user->status ?? 'Active',
                    'branch' => $user->branch ?? 'HQ Sleman Jogja',
                    'total_sessions' => $user->total_sessions ?? 12,
                    'completed_sessions' => $user->completed_sessions ?? 3,
                    'remaining_sessions' => $user->remaining_sessions ?? 9,
                    'assigned_coach' => $user->assigned_coach ?? 'Coach Dimas Wibowo, S.Or.',
                ]
            ]
        ], 200);
    }

    /**
     * Auth Register for New Member
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'member',
            'status' => 'Active',
            'membership_type' => 'Regular Gym Pass',
            'total_sessions' => 0,
            'completed_sessions' => 0,
            'remaining_sessions' => 0,
        ]);

        $token = method_exists($user, 'createToken') 
            ? $user->createToken('flutter-app-token')->plainTextToken 
            : Str::random(60);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran akun member berhasil!',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                    'member_card_id' => 'FL-MBR-' . sprintf('%04d', $user->id),
                    'membership_type' => $user->membership_type,
                    'status' => $user->status,
                ]
            ]
        ], 201);
    }

    /**
     * Get Current Authenticated User Info
     */
    public function me(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak terautentikasi.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->role,
                'member_card_id' => $user->member_card_id ?? 'FL-MBR-' . sprintf('%04d', $user->id),
                'membership_type' => $user->membership_type ?? 'VIP Pass Member',
                'status' => $user->status ?? 'Active',
                'total_sessions' => $user->total_sessions ?? 12,
                'completed_sessions' => $user->completed_sessions ?? 3,
                'remaining_sessions' => $user->remaining_sessions ?? 9,
                'assigned_coach' => $user->assigned_coach ?? 'Coach Dimas Wibowo, S.Or.',
            ]
        ]);
    }

    /**
     * Logout Member
     */
    public function logout(Request $request)
    {
        if ($request->user() && method_exists($request->user(), 'currentAccessToken')) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout dari aplikasi.',
        ]);
    }
}
