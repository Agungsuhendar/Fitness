<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\WhatsAppService;
use Carbon\Carbon;

class SendMembershipRenewalAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness:send-renewal-alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pindai member yang akan berakhir dalam H-7, H-3, atau H-1 dan kirim notifikasi perpanjangan WA otomatis.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pemindaian member mendekati masa berlaku habis (Renewal Alert Engine)...');

        $activeUsers = User::where(function($q) {
            $q->where('status', 'like', '%Active%')
              ->orWhere('status', 'like', '%LUNAS%')
              ->orWhere('status', 'like', '%Approved%');
        })->get();

        $sentCount = 0;
        $today = Carbon::today();

        foreach ($activeUsers as $user) {
            $daysRemaining = null;

            if ($user->membership_expires_at) {
                $expiryDate = Carbon::parse($user->membership_expires_at)->startOfDay();
                $diffDays = (int) $today->diffInDays($expiryDate, false);

                if ($diffDays >= 0 && $diffDays <= 7) {
                    $daysRemaining = $diffDays;
                }
            }

            // Also alert if remaining sessions are 2 or fewer
            if ($daysRemaining === null && ($user->remaining_sessions ?? 0) <= 2 && ($user->remaining_sessions ?? 0) > 0) {
                $daysRemaining = 2;
            }

            if ($daysRemaining !== null) {
                // Avoid sending multiple times on the same day
                $alreadySentToday = $user->last_renewal_alert_at && Carbon::parse($user->last_renewal_alert_at)->isToday();

                if (!$alreadySentToday) {
                    $success = WhatsAppService::sendMembershipExpiryWarningNotification($user, max(1, $daysRemaining));
                    if ($success) {
                        $user->last_renewal_alert_at = now();
                        $user->save();
                        $sentCount++;
                        $this->info("Notifikasi WA Renewal terkirim ke {$user->name} ({$user->member_card_id}) - sisa {$daysRemaining} hari.");
                    }
                }
            }
        }

        $this->info("Pemindaian selesai! Total {$sentCount} notifikasi WA perpanjangan berhasil dikirim.");
        return 0;
    }
}
