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
        $faqs = $popularFaqs;
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

        try {
            $coaches = \App\Models\Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }

        return view('home', compact('programs', 'featuredLocations', 'popularFaqs', 'faqs', 'testimonials', 'latestPosts', 'videos', 'features', 'coaches'));
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

    public function kalkulator()
    {
        $programs = Program::orderBy('order')->get();
        return view('kalkulator', compact('programs'));
    }

    public function quiz()
    {
        $programs = Program::orderBy('order')->get();
        try {
            $coaches = \App\Models\Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }
        return view('quiz', compact('programs', 'coaches'));
    }

    public function memberDashboard()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user) {
            $member = (object)[
                'name' => $user->name,
                'id' => $user->member_card_id ?? ('FL-MBR-' . str_pad($user->id, 4, '0', STR_PAD_LEFT)),
                'email' => $user->email,
                'phone' => $user->phone ?? '-',
                'membership_type' => $user->membership_type ?? 'VIP Personal Trainer Pass 1-on-1',
                'status' => $user->status ?? 'Aktif (Berlaku s/d 30 Des 2026)',
                'branch' => $user->branch ?? 'FitLife Center HQ (Sleman, Jogja)',
                'total_sessions' => $user->total_sessions ?? 12,
                'completed_sessions' => $user->completed_sessions ?? 4,
                'remaining_sessions' => $user->remaining_sessions ?? 8,
                'assigned_coach' => $user->assigned_coach ?? 'Coach Hendra Wijaya (APKI Certified)',
                'next_session' => $user->next_session ?? 'Jumat, 8 Agustus 2026 • 17:00 WIB',
                'initial_weight' => $user->initial_weight ?? 82.5,
                'current_weight' => $user->current_weight ?? 74.0,
                'target_weight' => $user->target_weight ?? 70.0,
                'initial_bodyfat' => $user->initial_bodyfat ?? 26.5,
                'current_bodyfat' => $user->current_bodyfat ?? 19.2,
                'muscle_mass' => $user->muscle_mass ?? '32.4 kg (+1.8 kg)',
            ];
        } else {
            $member = (object)[
                'name' => 'Bima Perkasa (Demo Member)',
                'id' => 'FL-MBR-7782',
                'email' => 'bima@example.com',
                'phone' => '081234567890',
                'membership_type' => 'VIP Personal Trainer Pass 1-on-1',
                'status' => 'Aktif (Berlaku s/d 15 Sep 2026)',
                'branch' => 'FitLife HQ Kaliurang (Sleman)',
                'total_sessions' => 12,
                'completed_sessions' => 4,
                'remaining_sessions' => 8,
                'assigned_coach' => 'Coach Hendra Wijaya (APKI Certified)',
                'next_session' => 'Jumat, 8 Agustus 2026 • 17.00 WIB',
                'initial_weight' => 82.5,
                'current_weight' => 74.0,
                'target_weight' => 70.0,
                'initial_bodyfat' => 26.5,
                'current_bodyfat' => 19.2,
                'muscle_mass' => '32.4 kg (+1.8 kg)',
            ];
        }

        $programs = Program::orderBy('order')->get();
        return view('member', compact('member', 'programs'));
    }

    public function updateMemberProgress(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Anda harus login terlebih dahulu.'], 401);
        }

        $validated = $request->validate([
            'current_weight' => 'nullable|numeric|min:20|max:300',
            'target_weight' => 'nullable|numeric|min:20|max:300',
            'current_bodyfat' => 'nullable|numeric|min:3|max:60',
        ]);

        if (isset($validated['current_weight'])) {
            if (!$user->initial_weight) {
                $user->initial_weight = $validated['current_weight'];
            }
            $user->current_weight = $validated['current_weight'];
        }

        if (isset($validated['target_weight'])) {
            $user->target_weight = $validated['target_weight'];
        }

        if (isset($validated['current_bodyfat'])) {
            if (!$user->initial_bodyfat) {
                $user->initial_bodyfat = $validated['current_bodyfat'];
            }
            $user->current_bodyfat = $validated['current_bodyfat'];
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Statistik kebugaran & berat badan berhasil diperbarui!',
            'user' => [
                'current_weight' => $user->current_weight,
                'target_weight' => $user->target_weight,
                'current_bodyfat' => $user->current_bodyfat,
            ]
        ]);
    }

    public function pelatih()
    {
        try {
            $coaches = \App\Models\Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }
        return view('pelatih', compact('coaches'));
    }

    public function tulisTestimoni()
    {
        $programs = Program::orderBy('order')->get();
        return view('tulis-testimoni', compact('programs'));
    }

    public function storeTestimonial(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'program_name' => 'nullable|string|max:255',
            'before_weight' => 'nullable|string|max:50',
            'after_weight' => 'nullable|string|max:50',
            'review' => 'required|string|max:2000',
        ]);

        try {
            \App\Models\Testimonial::create([
                'name' => $validated['name'],
                'rating' => $validated['rating'],
                'program_name' => $validated['program_name'] ?? 'FitLife Personal Training',
                'review' => $validated['review'],
                'before_weight' => $validated['before_weight'] ?? null,
                'after_weight' => $validated['after_weight'] ?? null,
                'is_approved' => false,
                'is_featured' => false,
            ]);
        } catch (\Exception $e) {}

        return back()->with('success', 'Terima kasih! Ulasan & testimoni Anda telah berhasil terkirim dan akan ditampilkan setelah diproses admin.');
    }

    public function areaLanding($slug)
    {
        // Strip prefixes if user comes from les-fitness- or fitness-
        $cleanSlug = str_replace(['les-fitness-', 'fitness-'], '', $slug);

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

    public function kelas()
    {
        $classes = collect([
            (object)[
                'id' => 1,
                'title' => 'Zumba Fitness Party',
                'category' => 'Cardio Dance',
                'instructor' => 'Instruktur Maya Indah',
                'day' => 'Senin',
                'time' => '17:00 - 18:00 WIB',
                'branch' => 'Sleman HQ (Jl. Kaliurang)',
                'total_slots' => 15,
                'remaining_slots' => 4,
                'badge' => 'POPULER',
                'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=600'
            ],
            (object)[
                'id' => 2,
                'title' => 'Body Combat & Boxing HIIT',
                'category' => 'Martial HIIT',
                'instructor' => 'Coach Hendra Wijaya',
                'day' => 'Rabu',
                'time' => '18:30 - 19:30 WIB',
                'branch' => 'Seturan Branch (UGM)',
                'total_slots' => 12,
                'remaining_slots' => 3,
                'badge' => 'HIGH INTENSITY',
                'image' => 'https://images.unsplash.com/photo-1549060279-7e168fcee0c2?q=80&w=600'
            ],
            (object)[
                'id' => 3,
                'title' => 'Pilates Core Shaping',
                'category' => 'Posture & Core',
                'instructor' => 'Coach Maya Indah',
                'day' => 'Kamis',
                'time' => '16:30 - 17:30 WIB',
                'branch' => 'Sewon Branch (Bantul)',
                'total_slots' => 10,
                'remaining_slots' => 2,
                'badge' => 'KHUSUS WANITA',
                'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=600'
            ],
            (object)[
                'id' => 4,
                'title' => 'Spinning Class RPM Speed',
                'category' => 'Indoor Cycling',
                'instructor' => 'Coach Budi Santoso',
                'day' => 'Jumat',
                'time' => '19:00 - 20:00 WIB',
                'branch' => 'Sleman HQ (Jl. Kaliurang)',
                'total_slots' => 10,
                'remaining_slots' => 5,
                'badge' => 'CARDIO INTENSE',
                'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600'
            ],
            (object)[
                'id' => 5,
                'title' => 'Crossfit & Functional Strength',
                'category' => 'Strength & Power',
                'instructor' => 'Coach Hendra Wijaya',
                'day' => 'Sabtu',
                'time' => '09:00 - 10:30 WIB',
                'branch' => 'Sleman HQ (Jl. Kaliurang)',
                'total_slots' => 15,
                'remaining_slots' => 6,
                'badge' => 'STRENGTH',
                'image' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600'
            ]
        ]);

        return view('kelas', compact('classes'));
    }

    public function toko()
    {
        $products = collect([
            (object)[
                'id' => 1,
                'name' => 'FitLife Whey Isolate Protein 2 Lbs (900g)',
                'category' => 'Whey & Protein',
                'original_price' => 450000,
                'promo_price' => 385000,
                'rating' => '4.9 ★★★★★',
                'reviews_count' => 84,
                'stock' => 'TERSEDIA',
                'badge' => 'BEST SELLER',
                'description' => '25g Whey Isolate Murni per serving, 0g Gula, & rendah kalori. Ideal untuk pembentukan otot tanpa lemak.',
                'image' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?q=80&w=600'
            ],
            (object)[
                'id' => 2,
                'name' => 'FitLife Pure Micronized Creatine 300g (60 Servings)',
                'category' => 'Creatine & Energy',
                'original_price' => 250000,
                'promo_price' => 195000,
                'rating' => '5.0 ★★★★★',
                'reviews_count' => 112,
                'stock' => 'TERSEDIA',
                'badge' => 'POWER BOOST',
                'description' => '100% Creatine Monohydrate murni mencerahkan tenaga angkatan & ledakan tenaga otot saat latihan beban.',
                'image' => 'https://images.unsplash.com/photo-1579722821273-0f6c7d44362f?q=80&w=600'
            ],
            (object)[
                'id' => 3,
                'name' => 'FitLife Pre-Workout Energy Matrix (30 Servings)',
                'category' => 'Creatine & Energy',
                'original_price' => 320000,
                'promo_price' => 265000,
                'rating' => '4.8 ★★★★★',
                'reviews_count' => 45,
                'stock' => 'TERSEDIA',
                'badge' => 'HIGH STAMINA',
                'description' => 'Formula Citrulline Malate, Beta-Alanine, & Caffeine untuk fokus tajam & stamina latihan melimpah.',
                'image' => 'https://images.unsplash.com/photo-1546483875-ad9014c88eba?q=80&w=600'
            ],
            (object)[
                'id' => 4,
                'name' => 'FitLife Heavy Duty Padded Lifting Straps',
                'category' => 'Aksesori & Gear',
                'original_price' => 120000,
                'promo_price' => 85000,
                'rating' => '4.9 ★★★★★',
                'reviews_count' => 67,
                'stock' => 'TERSEDIA',
                'badge' => 'GEAR FAVOURITE',
                'description' => 'Strap genggaman Neoprene tebal untuk angkatan Deadlift & Row maksimal tanpa pergelangan tangan sakit.',
                'image' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600'
            ],
            (object)[
                'id' => 5,
                'name' => 'FitLife Shaker Bottle Stainless Leak-Proof 750ml',
                'category' => 'Aksesori & Gear',
                'original_price' => 150000,
                'promo_price' => 110000,
                'rating' => '4.9 ★★★★★',
                'reviews_count' => 93,
                'stock' => 'TERSEDIA',
                'badge' => 'PREMIUM SHAKER',
                'description' => 'Botol shaker stainless anti-bocor dengan bola pengocok stainless & penjaga suhu dingin hingga 12 jam.',
                'image' => 'https://images.unsplash.com/photo-1526401485004-46910ecc8e51?q=80&w=600'
            ],
            (object)[
                'id' => 6,
                'name' => 'FitLife Official Performance Jersey (Dry-Fit)',
                'category' => 'Apparel / Jersey',
                'original_price' => 220000,
                'promo_price' => 165000,
                'rating' => '5.0 ★★★★★',
                'reviews_count' => 38,
                'stock' => 'TERSEDIA',
                'badge' => 'OFFICIAL MERCH',
                'description' => 'Jersey olahraga berbahan breathable Dry-Fit elastis nyaman untuk latihan gym & aktivitas outdoor.',
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=600'
            ]
        ]);

        return view('toko', compact('products'));
    }

    public function virtualTour()
    {
        $zones = collect([
            (object)[
                'id' => 'freeweight',
                'name' => 'Free Weight & Power Rack Zone',
                'badge' => 'HEAVY LIFTING',
                'subtitle' => 'Area angkatan beban lengkap dengan Hammer Strength Power Rack, Dumbbell Eleiko s/d 50KG, & Rubber Flooring 25mm',
                'bg_image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1200',
                'hotspots' => [
                    (object)[
                        'top' => '45%',
                        'left' => '32%',
                        'title' => 'Hammer Strength Power Rack & Olympic Barbell',
                        'desc' => 'Dua set Power Rack komersial Eleiko dengan safety bar kokoh & plat beban besi murni berstandar kompetisi.'
                    ],
                    (object)[
                        'top' => '60%',
                        'left' => '68%',
                        'title' => 'Dumbbell Set Pro 2.5KG - 50KG',
                        'desc' => 'Dumbbell Karet Ergononomis anti-slip dengan rak susun 3 tingkat yang rapi & higienis.'
                    ]
                ]
            ],
            (object)[
                'id' => 'cardio',
                'name' => 'Cardio & Running Zone',
                'badge' => 'FAT BURNING',
                'subtitle' => 'Area treadmill canggih dengan layar HD interaktif, Assault Air Bike, & Rowing Machine',
                'bg_image' => 'https://images.unsplash.com/photo-1540497077202-7c8a3999166f?q=80&w=1200',
                'hotspots' => [
                    (object)[
                        'top' => '50%',
                        'left' => '40%',
                        'title' => 'Commercial Treadmill Touchscreen HD',
                        'desc' => 'Treadmill komersial berperedam kejut dengan fitur Bluetooth audio & sensor denyut jantung real-time.'
                    ],
                    (object)[
                        'top' => '55%',
                        'left' => '75%',
                        'title' => 'Assault Air Bike HIIT Edition',
                        'desc' => 'Sepeda statis resistensi udara untuk pembakaran kalori ekstrem dalam waktu singkat.'
                    ]
                ]
            ],
            (object)[
                'id' => 'vipstudio',
                'name' => 'VIP Studio Privat PT 1-on-1',
                'badge' => 'PRIVAT 100%',
                'subtitle' => 'Studio privat khusus member Personal Trainer 1-on-1 tanpa antri alat & bebas privasi',
                'bg_image' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?q=80&w=1200',
                'hotspots' => [
                    (object)[
                        'top' => '42%',
                        'left' => '50%',
                        'title' => 'InBody 570 Composition Analyzer',
                        'desc' => 'Alat pemindai analisis komposisi tubuh medis untuk mengukur % lemak, massa otot, & lemak viseral akurat.'
                    ]
                ]
            ],
            (object)[
                'id' => 'sauna',
                'name' => 'Area Sauna Kayu Cedar & Locker Digital',
                'badge' => 'RECOVERY & RELAX',
                'subtitle' => 'Ruang sauna relaksasi otot suhu 75°C & locker digital RFID pintar yang terenkripsi',
                'bg_image' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?q=80&w=1200',
                'hotspots' => [
                    (object)[
                        'top' => '48%',
                        'left' => '35%',
                        'title' => 'Ruang Sauna Kayu Cedar Alami',
                        'desc' => 'Sauna bersuhu 75°C untuk melancarkan sirkulasi darah & mempercepat pemulihan asam laktat setelah latihan.'
                    ],
                    (object)[
                        'top' => '55%',
                        'left' => '65%',
                        'title' => 'Locker Digital RFID Smart Lock',
                        'desc' => '24 unit locker digital yang dapat dikunci aman menggunakan gelang RFID member.'
                    ]
                ]
            ]
        ]);

        return view('virtual-tour', compact('zones'));
    }
}
