<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Location;
use App\Models\Faq;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('order')->get();
        return view('program.index', compact('programs'));
    }

    public function show($slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();
        $relatedPrograms = Program::where('id', '!=', $program->id)->take(3)->get();
        $locations = Location::all();
        $faqs = Faq::where('question', 'like', "%{$program->title}%")
                    ->orWhere('answer', 'like', "%{$program->title}%")
                    ->take(5)
                    ->get();
        if ($faqs->count() < 3) {
            $faqs = Faq::take(5)->get();
        }

        return view('program.show', compact('program', 'relatedPrograms', 'locations', 'faqs'));
    }
}
