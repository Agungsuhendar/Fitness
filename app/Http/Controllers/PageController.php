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

            // Always ensure video contents match fitness transformations
            if (\App\Models\Video::count() === 0 || \App\Models\Video::where('title', 'like', '%Daffa%')->exists()) {
                \App\Models\Video::truncate();
                $dummyVideos = [
                    [
                        'title' => 'Bima (28 Tahun)',
                        'subtitle' => 'Hari 1: 88 kg & Lemak Perut ➔ Hari 90: 72 kg Sixpack & Lean Muscle',
                        'before_badge' => '🔴 Hari 1: 88 kg Fat',
                        'after_badge' => '🟢 Hari 90: 72 kg Lean',
                        'description' => 'Transformasi total 16 kg lemak terpangkas dalam 90 hari bimbingan privat Personal Trainer ApexFitness & custom diet plan!',
                        'video_url' => 'https://www.youtube.com/embed/5ee8sX_1-9c',
                        'thumbnail' => 'images/assets/video_thumb_daffa.png',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'title' => 'Anisa (25 Tahun)',
                        'subtitle' => 'Bulan 1: Posture Bungkuk ➔ Bulan 3: Hourglass Shape & Toned Body',
                        'before_badge' => '🔴 Bulan 1: Gelambir & Bungkuk',
                        'after_badge' => '🟢 Bulan 3: Hourglass',
                        'description' => 'Bimbingan Personal Trainer wanita 1-on-1. Membentuk lekuk pinggul, mengencangkan paha & memperbaiki postur tegap!',
                        'video_url' => 'https://www.youtube.com/embed/M5cs8a3Bhfg',
                        'thumbnail' => 'images/assets/video_thumb_siti.png',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'title' => 'Rian (Calon TNI/POLRI)',
                        'subtitle' => 'Hari 1: Pull-up 3x & Lari 1800m ➔ Hari 60: Pull-up 18x & Lari 3100m',
                        'before_badge' => '🔴 Hari 1: Skor 40',
                        'after_badge' => '🟢 Hari 60: Lulus 100',
                        'description' => 'Pelatihan stamina fisik & kekuatan kalistenik intensif. Lulus tes kesamaptaan jasmani dengan nilai sempurna 100!',
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
        // Strip prefixes if user comes from les-renang- or fitness-
        $cleanSlug = str_replace(['les-renang-', 'fitness-'], '', $slug);

        $areasData = [
            'sleman' => [
                'area_name' => 'Sleman & Depok',
                'title' => 'Gym & Personal Trainer Sleman - ApexFitness Center Terdekat',
                'meta_description' => 'Pusat fitness & personal trainer privat di Sleman Yogyakarta. Bimbingan 1-on-1 pelatih berlisensi APKI di Kaliurang, Depok, Seturan, UGM. Penurunan BB & pembentukan otot!',
                'pools' => 'ApexFitness Headquarters Kaliurang, Apex Studio Seturan, Depok Gym Center',
                'description' => 'Layanan fitness & Personal Trainer privat terbaik di wilayah Sleman, meliputi Depok, Seturan, Kaliurang, Monjali, hingga kawasan kampus UGM & UNY.',
                'subdistricts' => ['Depok', 'Seturan', 'Kaliurang', 'Mlati', 'Sleman Kota', 'Godean', 'Ngaglik'],
                'icon' => 'fa-dumbbell'
            ],
            'bantul' => [
                'area_name' => 'Bantul & Sewon',
                'title' => 'Gym & Personal Trainer Bantul - ApexFitness Studio',
                'meta_description' => 'Pusat gym privat & Personal Trainer profesional di Bantul & Sewon Jogja. Bimbingan ramah pemula, wanita, & weight loss. Garansi hasil terukur!',
                'pools' => 'Apex Studio Sewon, Tirto Gym Fitness, Apex Bantul Branch',
                'description' => 'Program privat fitness terpercaya di wilayah Kabupaten Bantul, melayani area Sewon, Kasihan, Banguntapan, Piyungan, hingga Bantul Kota.',
                'subdistricts' => ['Sewon', 'Kasihan', 'Banguntapan', 'Piyungan', 'Bantul Kota', 'Jetis'],
                'icon' => 'fa-fire'
            ],
            'ugm' => [
                'area_name' => 'UGM & Area Kampus Depok',
                'title' => 'Gym Mahasiswa UGM & UNY Depok - Personal Trainer Terdekat',
                'meta_description' => 'Gym & Personal Trainer terdekat UGM & UNY Yogyakarta. Spesialis mahasiswa, pemula, & body transformation. Promo membership mahasiswa & jadwal fleksibel!',
                'pools' => 'Apex Studio Seturan, Apex Headquarters Kaliurang, UNY Sport Fitness',
                'description' => 'Latihan fitness privat terdekat untuk mahasiswa UGM, UNY, UPN, Sanata Dharma, Atma Jaya, serta warga di kawasan Gejayan, Seturan, dan Kaliurang.',
                'subdistricts' => ['UGM', 'UNY', 'Gejayan', 'Seturan', 'Babarsari', 'Kaliurang Km 5-8', 'Condongcatur'],
                'icon' => 'fa-graduation-cap'
            ],
            'kota-jogja' => [
                'area_name' => 'Kota Yogyakarta',
                'title' => 'Gym & Personal Trainer Kota Jogja - ApexFitness Center',
                'meta_description' => 'Pusat gym & Personal Trainer di Kota Yogyakarta. Melayani privat weight loss, muscle building, privat wanita, & tes fisik TNI/POLRI. Garansi hasil terukur!',
                'pools' => 'Apex Performance Gym Umbulharjo, Apex City Center Malioboro',
                'description' => 'Melayani privat fitness & gym di seluruh wilayah Kota Yogyakarta, meliputi Umbulharjo, Gondokusuman, Mergangsan, Mantrijeron, dan sekitar Malioboro.',
                'subdistricts' => ['Umbulharjo', 'Gondokusuman', 'Mergangsan', 'Mantrijeron', 'Tegalrejo', 'Danurejan', 'Kotabaru'],
                'icon' => 'fa-city'
            ],
            'kulon-progo' => [
                'area_name' => 'Kulon Progo & Wates',
                'title' => 'Gym & Personal Trainer Kulon Progo - ApexFitness Studio',
                'meta_description' => 'Personal Trainer privat profesional di Kulon Progo & Wates. Melayani privat fat burn, pembentukan otot, & privat wanita. Trainer tersertifikasi resmi!',
                'pools' => 'Apex Branch Wates, Wates Fitness Center',
                'description' => 'Layanan privat fitness profesional untuk masyarakat Kulon Progo dan sekitarnya, melayani area Wates, Pengasih, Sentolo, hingga Temon.',
                'subdistricts' => ['Wates', 'Pengasih', 'Sentolo', 'Temon', 'Lendah', 'Galur'],
                'icon' => 'fa-compass'
            ]
        ];

        if (!array_key_exists($cleanSlug, $areasData)) {
            abort(404);
        }

        $area = $areasData[$cleanSlug];
        $slugKey = $cleanSlug;
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
                    $table->string('color')->default('#10b981');
                    $table->integer('order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            }

            if (\App\Models\Feature::count() === 0 || \App\Models\Feature::where('title', 'like', '%PRSI%')->exists()) {
                \App\Models\Feature::truncate();
                $dummyFeatures = [
                    [
                        'icon' => 'fa-solid fa-certificate',
                        'title' => 'Trainer Berlisensi APKI / IFBB',
                        'description' => 'Didampingi Personal Trainer profesional tersertifikasi nasional & internasional yang berpengalaman melatih 1000+ member.',
                        'color' => '#10b981',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'icon' => 'fa-solid fa-chart-line',
                        'title' => 'InBody 3D Scan & Body Assessment',
                        'description' => 'Evaluasi massa otot, % lemak tubuh, dan kadar metabolisme tubuh secara akurat setiap 2 minggu sekali.',
                        'color' => '#f97316',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'icon' => 'fa-solid fa-person-dress',
                        'title' => 'Trainer Wanita & Studio Privat',
                        'description' => 'Khusus member wanita / muslimah dengan Personal Trainer wanita sabar & area studio gym privat aman 100%.',
                        'color' => '#ec4899',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'icon' => 'fa-solid fa-trophy',
                        'title' => 'Garansi Hasil Terukur',
                        'description' => 'Program latihan terstruktur, custom meal plan harian, & garansi pemangkasan lemak/pembentukan otot progresif.',
                        'color' => '#3b82f6',
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
