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
        Setting::ensureTable();

        $settings = [
            'site_logo' => Setting::get('site_logo', 'images/assets/fitlife_models_cutout.png'),
            'site_logo_footer' => Setting::get('site_logo_footer', 'images/assets/fitlife_models_cutout.png'),
            'hero_image' => Setting::get('hero_image', 'images/assets/fitlife_hero_gym_bg.png'),
            'hero_title' => Setting::get('hero_title', 'FitLife Fitness & PT Privat Jogja'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Bimbingan privat 1-on-1 bergaransi cepat bisa! Melayani fitness & personal trainer anak, dewasa pemula, khusus wanita/muslimah, serta persiapan tes TNI/POLRI.'),
            'whatsapp_number' => Setting::get('whatsapp_number', '6281234567890'),
            'whatsapp_message' => Setting::get('whatsapp_message', 'Halo Admin FitLife Gym Jogja, saya ingin bertanya info dan pendaftaran.'),
            'site_email' => Setting::get('site_email', 'info@fitlifecenter.id'),
            'site_phone' => Setting::get('site_phone', '+62 812-3456-7890'),
            'office_address' => Setting::get('office_address', 'Sleman, D.I. Yogyakarta'),
            'instagram_url' => Setting::get('instagram_url', 'https://instagram.com/apexfitness.id'),
            'tiktok_url' => Setting::get('tiktok_url', 'https://tiktok.com/@apexfitness.id'),
            'youtube_url' => Setting::get('youtube_url', 'https://youtube.com/@apexfitnessid'),
            'office_hours' => Setting::get('office_hours', 'Buka Setiap Hari: 06.00 - 22.00 WIB'),
            'stat_alumni' => Setting::get('stat_alumni', '2.500+'),
            'stat_alumni_label' => Setting::get('stat_alumni_label', 'Member Aktif'),
            'stat_experience' => Setting::get('stat_experience', '10+ Th'),
            'stat_experience_label' => Setting::get('stat_experience_label', 'Pengalaman Pelatihan'),
            'stat_trainers' => Setting::get('stat_trainers', '15+'),
            'stat_trainers_label' => Setting::get('stat_trainers_label', 'Pelatih Sertifikasi'),
            'stat_rating' => Setting::get('stat_rating', '4.9 / 5'),
            'stat_rating_label' => Setting::get('stat_rating_label', 'Rating Kepuasan Member'),
            'site_seo_title' => Setting::get('site_seo_title', 'FitLife Gym Jogja - Privat Anak, Dewasa, Wanita & Persiapan TNI POLRI'),
            'site_seo_description' => Setting::get('site_seo_description', 'FitLife Gym Jogja profesional & privat di Yogyakarta. Melayani fitness & personal trainer anak, dewasa pemula, khusus wanita/muslimah, & persiapan tes TNI/POLRI.'),
            'site_share_image' => Setting::get('site_share_image', 'images/assets/fitlife_hero_gym_bg.png'),
            'site_footer_about' => Setting::get('site_footer_about', 'Pusat kebugaran fitness gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta. Menyediakan program Weight Loss & Fat Burning, Muscle Building, Female Body Shaping, serta Persiapan Fisik TNI POLRI & Rehabilitasi Postur.'),
            'promo_text' => Setting::get('promo_text', '🔥 PROMO SPESIAL BULAN INI: Diskon Rp 50.000 + Gratis Shaker & Handuk Gym untuk Pendaftaran Paket Privat 2 Orang!'),
            'cta_banner_title' => Setting::get('cta_banner_title', 'Siap Memulai Perjalanan Fitness Dalam Waktu Singkat?'),
            'cta_banner_subtitle' => Setting::get('cta_banner_subtitle', 'Jangan tunda lagi! Konsultasikan kebutuhan fitness & personal trainer Anda secara gratis dengan tim admin & pelatih kami sekarang juga.'),
            'cta_popup_enabled' => Setting::get('cta_popup_enabled', '1'),
            'cta_popup_delay' => Setting::get('cta_popup_delay', '20'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        Setting::ensureTable();

        $validated = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:50',
            'whatsapp_message' => 'nullable|string|max:255',
            'site_email' => 'nullable|string|max:100',
            'site_phone' => 'nullable|string|max:50',
            'office_address' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'tiktok_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:100',
            'stat_alumni' => 'nullable|string|max:50',
            'stat_alumni_label' => 'nullable|string|max:100',
            'stat_experience' => 'nullable|string|max:50',
            'stat_experience_label' => 'nullable|string|max:100',
            'stat_trainers' => 'nullable|string|max:50',
            'stat_trainers_label' => 'nullable|string|max:100',
            'stat_rating' => 'nullable|string|max:50',
            'stat_rating_label' => 'nullable|string|max:100',
            'site_logo_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:10240',
            'site_logo_footer_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:10240',
            'hero_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:10240',
            'site_share_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:10240',
        ]);

        // Upload images if provided
        $uploadDir = public_path('uploads');
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }

        if ($request->hasFile('site_logo_file') && $request->file('site_logo_file')->isValid()) {
            $file = $request->file('site_logo_file');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            Setting::set('site_logo', 'uploads/' . $filename);
        }

        if ($request->hasFile('site_logo_footer_file') && $request->file('site_logo_footer_file')->isValid()) {
            $file = $request->file('site_logo_footer_file');
            $filename = 'logo_footer_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            Setting::set('site_logo_footer', 'uploads/' . $filename);
        }

        if ($request->hasFile('hero_image_file') && $request->file('hero_image_file')->isValid()) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            Setting::set('hero_image', 'uploads/' . $filename);
        }

        if ($request->hasFile('site_share_image_file') && $request->file('site_share_image_file')->isValid()) {
            $file = $request->file('site_share_image_file');
            $filename = 'share_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            Setting::set('site_share_image', 'uploads/' . $filename);
        }

        // Save text settings
        $textFields = [
            'hero_title', 'hero_subtitle', 'whatsapp_number', 'whatsapp_message',
            'site_email', 'site_phone', 'office_address', 'instagram_url',
            'tiktok_url', 'youtube_url', 'office_hours',
            'stat_alumni', 'stat_alumni_label', 'stat_experience', 'stat_experience_label',
            'stat_trainers', 'stat_trainers_label', 'stat_rating', 'stat_rating_label',
            'site_seo_title', 'site_seo_description', 'promo_text', 'site_footer_about',
            'cta_banner_title', 'cta_banner_subtitle',
            'cta_popup_enabled', 'cta_popup_delay'
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan logo, hero, media & informasi website berhasil diperbarui!');
    }
}
