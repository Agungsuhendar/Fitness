<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;

class MemberApiController extends Controller
{
    /**
     * Get Member Card & Session Dashboard Stats
     */
    public function dashboard(Request $request)
    {
        $user = $request->user();

        // Fallback default member data if accessed without token/demo mode
        $memberId = $user ? ($user->member_card_id ?? 'FL-MBR-' . sprintf('%04d', $user->id)) : 'FL-MBR-7782';
        $memberName = $user ? $user->name : 'Member VIP FitLife';
        $referralCode = 'FL-REF-' + (strlen($memberId) >= 4 ? substr($memberId, -4) : '7782');

        $data = [
            'member_id' => $memberId,
            'name' => $memberName,
            'status' => $user->status ?? 'ACTIVE VIP',
            'membership_type' => $user->membership_type ?? '12-Session PT Pass',
            'referral_code' => 'FL-REF-7782',
            'referral_link' => url('/?ref=FL-REF-7782'),
            'referral_bonus' => 'Dapatkan diskon 15% + Extra 2 Sesi PT Gratis!',
            'session_stats' => [
                'total_sessions' => $user->total_sessions ?? 12,
                'completed_sessions' => $user->completed_sessions ?? 3,
                'remaining_sessions' => $user->remaining_sessions ?? 9,
                'next_session' => $user->next_session ?? 'Senin, 10 Aug 2026 - 09:00 WIB',
                'assigned_coach' => $user->assigned_coach ?? 'Coach Dimas Wibowo, S.Or.',
            ],
            'body_metrics' => [
                'initial_weight' => $user->initial_weight ?? 78.5,
                'current_weight' => $user->current_weight ?? 73.2,
                'target_weight' => $user->target_weight ?? 68.0,
                'current_bodyfat' => $user->current_bodyfat ?? 18.4,
                'muscle_mass' => $user->muscle_mass ?? 34.1,
            ]
        ];

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data dashboard member.',
            'data' => $data
        ]);
    }
}
