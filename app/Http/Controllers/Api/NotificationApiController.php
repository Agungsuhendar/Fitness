<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationApiController extends Controller
{
    /**
     * Get Member Notifications & Reminders Inbox
     * GET /api/v1/notifications
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 1;

        $dbNotifs = Notification::where(function ($q) use ($userId) {
            $q->where('user_id', $userId)->orWhereNull('user_id');
        })->orderBy('created_at', 'desc')->get();

        if ($dbNotifs->isEmpty()) {
            $notifications = [
                [
                    'id' => 1,
                    'title' => '🔥 Waktunya Leg & Push Day!',
                    'message' => 'Halo Bima, jadwal latihan Leg Day jam 17.00 WIB di Cabang Sleman HQ.',
                    'time' => '5 Menit lalu',
                    'icon_key' => 'fitness_center',
                    'color_key' => 'limePrimary',
                    'isRead' => false,
                ],
                [
                    'id' => 2,
                    'title' => '💧 Target Hydration Air Putih',
                    'message' => 'Minum 500ml air putih sekarang untuk menjaga hidrasi otot Anda.',
                    'time' => '1 Jam lalu',
                    'icon_key' => 'water_drop',
                    'color_key' => 'cyanAccent',
                    'isRead' => false,
                ],
                [
                    'id' => 3,
                    'title' => '🏆 Bonus 200 XP FitPoints Klaim!',
                    'message' => 'Selamat! Streak gym Anda berhasil mencapai 14 Hari berturut-turut.',
                    'time' => 'Kemarin',
                    'icon_key' => 'emoji_events',
                    'color_key' => 'goldAccent',
                    'isRead' => false,
                ],
                [
                    'id' => 4,
                    'title' => '🎟️ Konfirmasi Booking PT Coach Rina',
                    'message' => 'Sesi PT 1-on-1 Sabtu jam 16.00 WIB telah dikonfirmasi oleh Coach Rina.',
                    'time' => '2 Hari lalu',
                    'icon_key' => 'event_available',
                    'color_key' => 'purpleAccent',
                    'isRead' => true,
                ],
            ];
            $unreadCount = 3;
        } else {
            $notifications = $dbNotifs->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'title' => $notif->title,
                    'message' => $notif->message,
                    'time' => $notif->created_at ? $notif->created_at->diffForHumans() : 'Baru saja',
                    'icon_key' => $notif->icon_key ?: 'fitness_center',
                    'color_key' => $notif->color_key ?: 'limePrimary',
                    'isRead' => (bool) $notif->is_read,
                ];
            });
            $unreadCount = $dbNotifs->where('is_read', false)->count();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data notifikasi & pengingat member.',
            'unread_count' => $unreadCount,
            'reminders_settings' => [
                'workout_reminder' => true,
                'hydration_reminder' => true,
                'points_reminder' => true,
            ],
            'data' => $notifications,
        ]);
    }

    /**
     * Mark all notifications or specific notification as read
     * POST /api/v1/notifications/mark-read
     */
    public function markRead(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 1;
        $id = $request->input('id');

        if ($id) {
            Notification::where('id', $id)->update(['is_read' => true]);
        } else {
            Notification::where(function ($q) use ($userId) {
                $q->where('user_id', $userId)->orWhereNull('user_id');
            })->update(['is_read' => true]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Seluruh notifikasi berhasil ditandai telah dibaca.',
        ]);
    }
}
