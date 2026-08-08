<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminNotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::with('user')->orderBy('created_at', 'desc')->paginate(15);
        $totalSent = Notification::count();
        $unreadTotal = Notification::where('is_read', false)->count();

        return view('admin.notifications.index', compact('notifications', 'totalSent', 'unreadTotal'));
    }

    public function sendBroadcast(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'message' => 'required|string',
            'category' => 'required|string',
        ]);

        $category = $validated['category'];
        $iconKey = 'fitness_center';
        $colorKey = 'limePrimary';

        if ($category === 'reward') {
            $iconKey = 'emoji_events';
            $colorKey = 'goldAccent';
        } elseif ($category === 'hydration') {
            $iconKey = 'water_drop';
            $colorKey = 'cyanAccent';
        } elseif ($category === 'announcement') {
            $iconKey = 'campaign';
            $colorKey = 'purpleAccent';
        }

        Notification::create([
            'user_id' => null, // Broadcast to all members
            'title' => $validated['title'],
            'message' => $validated['message'],
            'category' => $category,
            'icon_key' => $iconKey,
            'color_key' => $colorKey,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Notifikasi broadcast "' . $validated['title'] . '" berhasil dikirim ke seluruh member!');
    }

    public function destroy($id)
    {
        $notif = Notification::findOrFail($id);
        $notif->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
