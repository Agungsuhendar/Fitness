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

        return view('home', compact('programs', 'featuredLocations', 'popularFaqs', 'testimonials', 'latestPosts'));
    }

    public function tentang()
    {
        $testimonials = Testimonial::all();
        return view('tentang', compact('testimonials'));
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
        $testimonials = Testimonial::all();
        return view('testimoni', compact('testimonials'));
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
}
