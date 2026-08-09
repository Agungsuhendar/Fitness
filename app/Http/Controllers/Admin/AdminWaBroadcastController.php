<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class AdminWaBroadcastController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $expiringMembers = User::whereNotNull('phone')
            ->where(function($q) {
                $q->where('status', 'like', '%Active%')
                  ->orWhere('status', 'like', '%LUNAS%')
                  ->orWhere('status', 'like', '%Approved%')
                  ->orWhere('status', 'like', '%Aktif%');
            })
            ->where(function($q) use ($today) {
                $q->whereBetween('membership_expires_at', [$today, $today->copy()->addDays(7)])
                  ->orWhere('remaining_sessions', '<=', 2);
            })
            ->get();

        $targetCounts = [
            'all' => User::whereNotNull('phone')->count(),
            'active' => User::where('status', 'like', '%Aktif%')->orWhere('status', 'like', '%Active%')->whereNotNull('phone')->count(),
            'low_sessions' => User::where('remaining_sessions', '<=', 2)->whereNotNull('phone')->count(),
            'expiring_soon' => $expiringMembers->count(),
            'members' => User::where('role', 'member')->whereNotNull('phone')->count(),
        ];

        return view('admin.wa_broadcast.index', compact('targetCounts', 'expiringMembers'));
    }

    public function sendBroadcast(Request $request)
    {
        $validated = $request->validate([
            'target_group' => 'required|string',
            'message_template' => 'required|string|min:10',
        ]);

        $group = $validated['target_group'];
        $template = $validated['message_template'];

        $query = User::whereNotNull('phone')->where('phone', '!=', '');

        if ($group === 'active') {
            $query->where(function($q) {
                $q->where('status', 'like', '%Aktif%')->orWhere('status', 'like', '%Active%');
            });
        } elseif ($group === 'low_sessions') {
            $query->where('remaining_sessions', '<=', 2);
        } elseif ($group === 'members') {
            $query->where('role', 'member');
        }

        $recipients = $query->get();
        $successCount = 0;
        $failedCount = 0;

        foreach ($recipients as $user) {
            $customMessage = str_replace(
                ['{name}', '{sessions}', '{card_id}', '{phone}'],
                [$user->name, $user->remaining_sessions ?? 0, $user->member_card_id ?? 'MEMBER', $user->phone],
                $template
            );

            $sent = WhatsAppService::sendMessage($user->phone, $customMessage);
            if ($sent) {
                $successCount++;
            } else {
                $failedCount++;
            }
        }

        return redirect()->route('admin.wa-broadcast.index')
            ->with('success', "Broadcast WhatsApp BERHASIL DITERUSKAN! {$successCount} Pesan Terkirim Sukses, {$failedCount} Gagal.");
    }

    public function triggerRenewalAlerts(Request $request)
    {
        Artisan::call('fitness:send-renewal-alerts');
        $output = Artisan::output();

        return redirect()->route('admin.wa-broadcast.index')
            ->with('success', "Engine Auto-Alert WA Perpanjangan (Renewal Alerts) Sukses Dijalankan! Rincian: " . trim($output));
    }
}
