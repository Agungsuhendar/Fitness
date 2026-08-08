<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class TutorialApiController extends Controller
{
    /**
     * Get Video Tutorials & Form Guides
     * GET /api/v1/tutorials
     */
    public function index(Request $request)
    {
        $dbVideos = Video::where('is_active', true)->orderBy('order')->get();

        if ($dbVideos->isEmpty()) {
            $tutorials = [
                [
                    'id' => 1,
                    'title' => 'Barbell Bench Press Masterclass',
                    'category' => 'Dada',
                    'instructor' => 'Coach Bima Sakti',
                    'duration' => '4:15 min',
                    'level' => 'Menengah',
                    'thumbnail' => 'assets/images/video_thumb_daffa.png',
                    'video_url' => 'https://www.youtube.com/embed/5ee8sX_1-9c',
                    'color' => 'limePrimary',
                    'dos' => [
                        'Tarik bahu ke belakang (Scapular Retraction).',
                        'Gunakan leg drive dari tumit kaki.',
                        'Turunkan bar perlahan ke dada tengah (2 detik).',
                    ],
                    'donts' => [
                        'Jangan memantulkan bar di dada.',
                        'Jangan mengepakkan siku terlalu lebar (90 derajat).',
                    ],
                ],
                [
                    'id' => 2,
                    'title' => 'Barbell Back Squat Technique',
                    'category' => 'Kaki',
                    'instructor' => 'Coach Hendra Gunawan',
                    'duration' => '5:30 min',
                    'level' => 'Pemula - Lanjutan',
                    'thumbnail' => 'assets/images/video_thumb_rian.png',
                    'video_url' => 'https://www.youtube.com/embed/xVeXGKPOH58',
                    'color' => 'cyanAccent',
                    'dos' => [
                        'Mulai dengan memajukan pinggul (Hip Hinge).',
                        'Jaga lutut sejajar dengan arah jempol kaki.',
                        'Turun hingga paha sejajar dengan lantai (90 derajat).',
                    ],
                    'donts' => [
                        'Jangan membiarkan lutut menekuk ke dalam (Valgus).',
                        'Jangan melengkungkan punggung bawah.',
                    ],
                ],
                [
                    'id' => 3,
                    'title' => 'Lat Pulldown Perfect Form',
                    'category' => 'Punggung',
                    'instructor' => 'Coach Danu Prasetya',
                    'duration' => '3:45 min',
                    'level' => 'Semua Tingkat',
                    'thumbnail' => 'assets/images/video_thumb_siti.png',
                    'video_url' => 'https://www.youtube.com/embed/M5cs8a3Bhfg',
                    'color' => 'purpleAccent',
                    'dos' => [
                        'Tarik bar menggunakan otot paha punggung (Lat).',
                        'Busungkan dada saat bar mendekati bagian atas dada.',
                    ],
                    'donts' => [
                        'Jangan mengayunkan badan terlalu jauh ke belakang.',
                        'Jangan menarik bar ke belakang leher.',
                    ],
                ],
                [
                    'id' => 4,
                    'title' => 'Dumbbell Shoulder Press Guide',
                    'category' => 'Bahu',
                    'instructor' => 'Coach Rina Wulandari',
                    'duration' => '4:00 min',
                    'level' => 'Menengah',
                    'thumbnail' => 'assets/images/member_anisa_avatar.png',
                    'video_url' => 'https://www.youtube.com/embed/5ee8sX_1-9c',
                    'color' => 'goldAccent',
                    'dos' => [
                        'Kunci otot inti (Core) dan bokong.',
                        'Dorong dumbbell lurus ke atas tanpa menyentuhkan antar dumbbell.',
                    ],
                    'donts' => [
                        'Jangan melengkungkan punggung bawah secara berlebihan.',
                    ],
                ],
            ];
        } else {
            $tutorials = $dbVideos->map(function ($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'category' => $video->subtitle ?: 'Umum',
                    'instructor' => 'Coach FitLife Specialist',
                    'duration' => '4:00 min',
                    'level' => 'Semua Tingkat',
                    'thumbnail' => $video->thumbnail ?: 'assets/images/video_thumb_daffa.png',
                    'video_url' => $video->video_url,
                    'color' => 'limePrimary',
                    'dos' => [
                        'Jaga postur tulang belakang netral dan stabil.',
                        'Kontrol pernapasan (buang napas saat beban diangkat).',
                    ],
                    'donts' => [
                        'Jangan gunakan beban yang melebihi batas kemampuan teknik.',
                    ],
                ];
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar Video Tutorial & Form Guide.',
            'categories' => ['Semua', 'Dada', 'Punggung', 'Kaki', 'Bahu', 'Lengan'],
            'data' => $tutorials,
        ]);
    }
}
