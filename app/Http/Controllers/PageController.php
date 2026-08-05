<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Location;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function home()
    {
        $programs = Program::orderBy('order')->get();
        $featuredLocations = Location::where('is_featured', true)->get();
        $popularFaqs = Faq::orderBy('order')->take(10)->get();
        $testimonials = Testimonial::where('is_featured', true)->get();
        $latestPosts = Post::orderBy('published_at', 'desc')->take(3)->get();
        
        $this->ensureVideosSeeded();
        $this->ensureFeaturesSeeded();

        try {
            $videos = \App\Models\Video::active()->ordered()->get();
        } catch (\Exception $e) {
            $videos = collect();
        }

        try {
            $features = \App\Models\Feature::active()->ordered()->get();
        } catch (\Exception $e) {
            $features = collect();
        }

        return view('home', compact('programs', 'featuredLocations', 'popularFaqs', 'testimonials', 'latestPosts', 'videos', 'features'));
    }

    public function tentang()
    {
        $testimonials = Testimonial::all();
        try {
            $coaches = \App\Models\Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }
        return view('tentang', compact('testimonials', 'coaches'));
    }

    public function lokasi(Request $request)
    {
        $city = $request->input('city');
        if ($city) {
            $locations = Location::where('city', 'like', '%' . $city . '%')->get();
        } else {
            $locations = Location::all();
        }
        return view('lokasi', compact('locations'));
    }

    public function harga()
    {
        $programs = Program::orderBy('order')->get();
        return view('harga', compact('programs'));
    }

    public function testimoni()
    {
        try {
            $testimonials = Testimonial::where('is_approved', true)->orderByDesc('created_at')->get();
        } catch (\Exception $e) {
            $testimonials = Testimonial::all();
        }

        $this->ensureVideosSeeded();
        try {
            $videos = \App\Models\Video::active()->ordered()->get();
        } catch (\Exception $e) {
            $videos = collect();
        }
        return view('testimoni', compact('testimonials', 'videos'));
    }

    private function ensureVideosSeeded()
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('videos')) {
                \Illuminate\Support\Facades\Schema::create('videos', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->string('title');
                    $table->string('subtitle')->nullable();
                    $table->string('before_badge')->nullable();
                    $table->string('after_badge')->nullable();
                    $table->text('description')->nullable();
                    $table->string('video_url');
                    $table->string('thumbnail')->nullable();
                    $table->integer('order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            }

            if (\App\Models\Video::count() === 0) {
                $dummyVideos = [
                    [
                        'title' => 'Daffa (7 Tahun)',
                        'subtitle' => 'Hari 1: Takut Air & Menangis ➔ Hari 4: Mahir Gaya Dada 25m',
                        'before_badge' => '🔴 Hari 1: Takut Air',
                        'after_badge' => '🟢 Hari 4: Mahir',
                        'description' => 'Dari tidak mau lepas pegangan hingga berani meluncur & renang gaya dada 25 meter mandiri!',
                        'video_url' => 'https://www.youtube.com/embed/5ee8sX_1-9c',
                        'thumbnail' => 'images/assets/video_thumb_daffa.png',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'title' => 'Mbak Siti (24 Tahun)',
                        'subtitle' => 'Hari 1: Trauma Kedalaman ➔ Hari 3: Meluncur di Kolam Dalam 2m',
                        'before_badge' => '🔴 Hari 1: Trauma',
                        'after_badge' => '🟢 Hari 3: Berani 2m',
                        'description' => 'Bimbingan privat 1-on-1 wanita ramah. Dalam 3 sesi berhasil mengatasi trauma air kedalaman 2 meter!',
                        'video_url' => 'https://www.youtube.com/embed/M5cs8a3Bhfg',
                        'thumbnail' => 'images/assets/video_thumb_siti.png',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'title' => 'Rian (Calon TNI/POLRI)',
                        'subtitle' => 'Hari 1: Renang 15m Terengah ➔ Hari 6: Lulus Tes 50m Gaya Bebas',
                        'before_badge' => '🔴 Hari 1: 15m',
                        'after_badge' => '🟢 Hari 6: Lulus 50m',
                        'description' => 'Pelatihan stamina fisik & ketahanan napas intensif. Lulus tes renang 50 meter gaya bebas dengan nilai 100!',
                        'video_url' => 'https://www.youtube.com/embed/xVeXGKPOH58',
                        'thumbnail' => 'images/assets/video_thumb_rian.png',
                        'order' => 3,
                        'is_active' => true,
                    ],
                ];

                foreach ($dummyVideos as $data) {
                    \App\Models\Video::create($data);
                }
            }
        } catch (\Exception $e) {
            // Silence exception
        }
    }

    public function faq(Request $request)
    {
        $q = $request->input('q');
        $category = $request->input('category');

        $query = Faq::query();
        if ($q) {
            $query->where(function($qBuilder) use ($q) {
                $qBuilder->where('question', 'like', "%{$q}%")
                         ->orWhere('answer', 'like', "%{$q}%");
            });
        }
        if ($category) {
            $query->where('category', $category);
        }
        $faqs = $query->orderBy('order')->get();
        $categories = Faq::select('category')->distinct()->pluck('category');

        return view('faq', compact('faqs', 'categories'));
    }

    public function kontak()
    {
        $locations = Location::all();
        $programs = Program::all();
        return view('kontak', compact('locations', 'programs'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $programs = Program::where('title', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->get();
        $posts = Post::where('title', 'like', "%{$q}%")
            ->orWhere('content', 'like', "%{$q}%")
            ->get();
        $faqs = Faq::where('question', 'like', "%{$q}%")
            ->orWhere('answer', 'like', "%{$q}%")
            ->get();

        return view('search', compact('q', 'programs', 'posts', 'faqs'));
    }

    public function areaLanding($slug)
    {
        $areasData = [
            'sleman' => [
                'area_name' => 'Sleman & Depok',
                'title' => 'Les Renang Sleman - Kursus Privat Renang Anak & Dewasa Terdekat',
                'meta_description' => 'Les renang privat di Sleman Yogyakarta. Bimbingan 1-on-1 pelatih berlisensi di Depok Sport Center, UNY, UGM. Privat anak, wanita & persiapan TNI POLRI. Garansi cepat bisa!',
                'pools' => 'Depok Sport Center (DSC), Kolam Renang UNY Karangmalang, Kolam Renang Kampus UGM, FIK UNY',
                'description' => 'Layanan les renang privat terbaik untuk wilayah Kabupaten Sleman, meliputi kecamatan Depok, Ngaglik, Mlati, Kalasan, hingga area kampus UGM & UNY.',
                'subdistricts' => ['Depok', 'Ngaglik', 'Mlati', 'Kalasan', 'Sleman Kota', 'Godean', 'Ngemplak'],
                'icon' => 'fa-mountain-sun'
            ],
            'bantul' => [
                'area_name' => 'Bantul & Sewon',
                'title' => 'Les Renang Bantul - Kursus Privat Renang Anak, Wanita & Dewasa',
                'meta_description' => 'Kursus les renang privat terpercaya di Bantul & Sewon Yogyakarta. Bimbingan privat ramah anak, wanita, & dewasa pemula. Garansi 100% cepat bisa berenang!',
                'pools' => 'Kolam Renang Tirta Tamansari Bantul, Grand Puri Waterpark, Tirto Asri, Sewon',
                'description' => 'Program privat renang terpercaya di wilayah Kabupaten Bantul, melayani area Sewon, Kasihan, Banguntapan, Piyungan, hingga Bantul Kota.',
                'subdistricts' => ['Sewon', 'Kasihan', 'Banguntapan', 'Piyungan', 'Bantul Kota', 'Pundong', 'Jetis'],
                'icon' => 'fa-water'
            ],
            'ugm' => [
                'area_name' => 'UGM & Area Kampus Depok',
                'title' => 'Les Renang UGM & UNY Depok - Privat Renang Mahasiswa & Umum',
                'meta_description' => 'Les privat renang terdekat dari UGM & UNY Yogyakarta. Spesialis mahasiswa, anak-anak, & dewasa pemula. Jadwal fleksibel & pelatih berpengalaman!',
                'pools' => 'Kolam Renang UGM, Kolam Renang FIK UNY Karangmalang, Depok Sport Center Seturan',
                'description' => 'Les privat renang terdekat untuk mahasiswa UGM, UNY, UPN, Sanata Dharma, Atma Jaya, serta warga di kawasan Gejayan, Seturan, dan Kaliurang.',
                'subdistricts' => ['UGM', 'UNY', 'Gejayan', 'Seturan', 'Babarsari', 'Kaliurang Km 5-8', 'Condongcatur'],
                'icon' => 'fa-graduation-cap'
            ],
            'kota-jogja' => [
                'area_name' => 'Kota Yogyakarta',
                'title' => 'Les Renang Kota Jogja - Kursus Privat Renang Terpercaya',
                'meta_description' => 'Les renang privat di Kota Yogyakarta. Melayani privat renang anak, wanita/muslimah, dewasa, & persiapan TNI/POLRI. Garansi cepat mahir berenang!',
                'pools' => 'Kolam Renang Umbulharjo, Muja Muju, UNY, Tirto Guwo Yogyakarta',
                'description' => 'Melayani les privat renang di seluruh wilayah Kota Yogyakarta, meliputi Umbulharjo, Gondokusuman, Mergangsan, Mantrijeron, dan sekitar Malioboro.',
                'subdistricts' => ['Umbulharjo', 'Gondokusuman', 'Mergangsan', 'Mantrijeron', 'Tegalrejo', 'Danurejan', 'Kotabaru'],
                'icon' => 'fa-city'
            ],
            'kulon-progo' => [
                'area_name' => 'Kulon Progo & Wates',
                'title' => 'Les Renang Kulon Progo & Wates - Privat Renang Terpercaya',
                'meta_description' => 'Les renang privat profesional di Kulon Progo & Wates. Melayani privat anak, dewasa, & wanita. Garansi bisa berenang bersama pelatih lisensi resmi!',
                'pools' => 'Kolam Renang UNY Wates, Kolam Renang Pengasih Kulon Progo',
                'description' => 'Layanan privat renang profesional untuk masyarakat Kulon Progo dan sekitarnya, melayani area Wates, Pengasih, Sentolo, hingga Temon.',
                'subdistricts' => ['Wates', 'Pengasih', 'Sentolo', 'Temon', 'Lendah', 'Galur'],
                'icon' => 'fa-compass'
            ]
        ];

        if (!array_key_exists($slug, $areasData)) {
            abort(404);
        }

        $area = $areasData[$slug];
        $slugKey = $slug;
        $programs = Program::orderBy('order')->get();
        $testimonials = Testimonial::where('is_featured', true)->get();
        $popularFaqs = Faq::orderBy('order')->take(8)->get();
        $locations = Location::all();

        return view('area_landing', compact('area', 'slugKey', 'programs', 'testimonials', 'popularFaqs', 'locations'));
    }

    private function ensureFeaturesSeeded()
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('features')) {
                \Illuminate\Support\Facades\Schema::create('features', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->string('icon')->default('fa-solid fa-star');
                    $table->string('title');
                    $table->text('description')->nullable();
                    $table->string('color')->default('#0077b6');
                    $table->integer('order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            }

            if (\App\Models\Feature::count() === 0) {
                $dummyFeatures = [
                    [
                        'icon' => 'fa-solid fa-user-graduate',
                        'title' => 'Pelatih Sabar & Pro',
                        'description' => 'Lulusan FIK Keolahragaan UNY, pemegang lisensi PRSI/POSSI, dan tersertifikasi First Aid.',
                        'color' => '#0077b6',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'icon' => 'fa-solid fa-calendar-days',
                        'title' => 'Jadwal Super Fleksibel',
                        'description' => 'Bebas pilih jam latihan sesuai kesibukan Anda (Pagi 06.00 WIB s/d Malam 20.00 WIB).',
                        'color' => '#00b4d8',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'icon' => 'fa-solid fa-person-dress',
                        'title' => 'Instruktur Wanita Privat',
                        'description' => 'Khusus siswa perempuan / muslimah dengan pelatih wanita sabar & lokasi kolam privat aman.',
                        'color' => '#d946ef',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'icon' => 'fa-solid fa-trophy',
                        'title' => 'Garansi Cepat Bisa',
                        'description' => 'Dibimbing intensif 1-on-1 hingga berani air, mengapung, meluncur, dan mahir berenang gaya dada & bebas.',
                        'color' => '#10b981',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ];

                foreach ($dummyFeatures as $data) {
                    \App\Models\Feature::create($data);
                }
            }
        } catch (\Exception $e) {
            // Silence exception
        }
    }
}
