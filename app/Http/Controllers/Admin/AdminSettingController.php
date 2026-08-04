<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = [
            'whatsapp_number' => Setting::get('whatsapp_number', '6281234567890'),
            'whatsapp_message' => Setting::get('whatsapp_message', 'Halo Admin Les Renang Jogja, saya ingin bertanya info dan pendaftaran.'),
            'site_email' => Setting::get('site_email', 'info@lesrenangjogja.com'),
            'site_phone' => Setting::get('site_phone', '+62 812-3456-7890'),
            'office_address' => Setting::get('office_address', 'Sleman, D.I. Yogyakarta'),
            'instagram_url' => Setting::get('instagram_url', 'https://instagram.com'),
            'tiktok_url' => Setting::get('tiktok_url', 'https://tiktok.com'),
            'youtube_url' => Setting::get('youtube_url', 'https://youtube.com'),
            'office_hours' => Setting::get('office_hours', 'Buka Setiap Hari: 06.00 - 20.00 WIB'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_number' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string|max:255',
            'site_email' => 'required|email|max:100',
            'site_phone' => 'nullable|string|max:50',
            'office_address' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'office_hours' => 'nullable|string|max:100',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}
