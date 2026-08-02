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
}
