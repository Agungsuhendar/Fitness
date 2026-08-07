<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class AdminWaBroadcastController extends Controller
{
    public function index()
    {
        $targetCounts = [
            'all' => User::whereNotNull('phone')->count(),
            'active' => User::where('status', 'like', '%Aktif%')->whereNotNull('phone')->count(),
            'low_sessions' => User::where('remaining_sessions', '<=', 2)->whereNotNull('phone')->count(),
            'members' => User::where('role', 'member')->whereNotNull('phone')->count(),
        ];

        return view('admin.wa_broadcast.index', compact('targetCounts'));
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
            $query->where('status', 'like', '%Aktif%');
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
}
