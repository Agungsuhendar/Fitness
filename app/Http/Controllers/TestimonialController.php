<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Store a testimonial submitted by a participant (public form).
     * Testimoni akan masuk dengan status is_approved = false (menunggu moderasi admin).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'program' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $validated['name'];
        $testimonial->role = $validated['role'];
        $testimonial->program = $validated['program'];
        $testimonial->rating = $validated['rating'];
        $testimonial->review = $validated['review'];
        $testimonial->is_featured = false;
        $testimonial->is_approved = false; // Menunggu moderasi admin

        if ($request->hasFile('avatar_file')) {
            $uploadDir = public_path('uploads/testimonials');
            if (!file_exists($uploadDir)) @mkdir($uploadDir, 0777, true);
            $file = $request->file('avatar_file');
            $filename = 'testi_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $testimonial->avatar = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();

        return redirect()->route('testimoni')->with('success', 'Terima kasih! Testimoni Anda telah dikirim dan menunggu persetujuan admin.');
    }
}
