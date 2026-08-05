<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        // Auto-add is_approved column if not exists
        if (\Illuminate\Support\Facades\Schema::hasTable('testimonials') && !\Illuminate\Support\Facades\Schema::hasColumn('testimonials', 'is_approved')) {
            \Illuminate\Support\Facades\Schema::table('testimonials', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->boolean('is_approved')->default(true)->after('is_featured');
            });
        }

        // Auto-seed dummy data if table is empty
        if (Testimonial::count() === 0) {
            $dummyTestimonials = [
                [
                    'name' => 'Ibu Dewi Sari',
                    'role' => 'Ibu dari Kenzo (7th)',
                    'program' => 'FitLife Fitness & PT Anak',
                    'rating' => 5,
                    'review' => 'Anak saya awalnya sangat takut air, bahkan menangis kalau dekat studio gym. Setelah 6x pertemuan dengan Coach Hendra, sekarang Kenzo sudah bisa fitness gaya bebas sendiri! Coach-nya sangat sabar dan profesional. Terima kasih FitLife Gym Jogja!',
                    'avatar' => 'uploads/testimonials/testi_ibu_dewi.png',
                    'is_featured' => true,
                    'is_approved' => true,
                ],
                [
                    'name' => 'Andi Pratama',
                    'role' => 'Calon Taruna Akpol 2026',
                    'program' => 'Persiapan TNI & POLRI',
                    'rating' => 5,
                    'review' => 'Alhamdulillah lulus tes fitness Akpol berkat bimbingan Coach Danu! Latihan intensif 4 minggu, dari yang hanya bisa fitness 25 meter sekarang bisa 100 meter tanpa berhenti. Metode latihan militer tapi tetap aman dan terstruktur.',
                    'avatar' => 'uploads/testimonials/testi_bapak_andi.png',
                    'is_featured' => true,
                    'is_approved' => true,
                ],
                [
                    'name' => 'Ratna Kusuma',
                    'role' => 'Peserta Dewasa Pemula',
                    'program' => 'FitLife Fitness & PT Dewasa',
                    'rating' => 5,
                    'review' => 'Umur 32 tahun baru belajar fitness, sempat malu dan takut. Tapi Coach Rina benar-benar membuat saya nyaman, apalagi karena sesi khusus wanita. Sekarang fitness sudah jadi hobi mingguan saya. Sangat recommended untuk ibu-ibu yang ingin belajar!',
                    'avatar' => 'uploads/testimonials/testi_mbak_ratna.png',
                    'is_featured' => true,
                    'is_approved' => true,
                ],
            ];

            foreach ($dummyTestimonials as $data) {
                Testimonial::create($data);
            }
        }

        $testimonials = Testimonial::orderByDesc('created_at')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'program' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_approved' => 'nullable|boolean',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $validated['name'];
        $testimonial->role = $validated['role'];
        $testimonial->program = $validated['program'];
        $testimonial->rating = $validated['rating'];
        $testimonial->review = $validated['review'];
        $testimonial->is_featured = $request->has('is_featured');
        $testimonial->is_approved = $request->has('is_approved');

        if ($request->hasFile('avatar_file')) {
            $uploadDir = public_path('uploads/testimonials');
            if (!file_exists($uploadDir)) @mkdir($uploadDir, 0777, true);
            $file = $request->file('avatar_file');
            $filename = 'testi_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $testimonial->avatar = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'program' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_approved' => 'nullable|boolean',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $testimonial->name = $validated['name'];
        $testimonial->role = $validated['role'];
        $testimonial->program = $validated['program'];
        $testimonial->rating = $validated['rating'];
        $testimonial->review = $validated['review'];
        $testimonial->is_featured = $request->has('is_featured');
        $testimonial->is_approved = $request->has('is_approved');

        if ($request->hasFile('avatar_file')) {
            $uploadDir = public_path('uploads/testimonials');
            if (!file_exists($uploadDir)) @mkdir($uploadDir, 0777, true);
            $file = $request->file('avatar_file');
            $filename = 'testi_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $testimonial->avatar = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus!');
    }

    // Toggle approve/reject
    public function toggleApprove(Testimonial $testimonial)
    {
        $testimonial->is_approved = !$testimonial->is_approved;
        $testimonial->save();
        return redirect()->route('admin.testimonials.index')->with('success', 'Status testimoni diubah!');
    }
}
