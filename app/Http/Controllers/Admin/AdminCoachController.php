<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;

class AdminCoachController extends Controller
{
    public function index()
    {
        // Auto-create table if not exists
        if (!\Illuminate\Support\Facades\Schema::hasTable('coaches')) {
            \Illuminate\Support\Facades\Schema::create('coaches', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('title')->nullable();
                $table->string('specialty');
                $table->text('description')->nullable();
                $table->string('photo')->nullable();
                $table->string('color')->default('#0077b6');
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Auto-seed dummy data if table is empty
        if (Coach::count() === 0) {
            $dummyCoaches = [
                [
                    'name' => 'Coach Hendra',
                    'title' => 'S.Pd.',
                    'specialty' => 'Head Coach & Spesialis Anak',
                    'description' => 'Lulusan FIK UNY, Pemegang Sertifikat Pelatih PRSI Tingkat Nasional. Pengalaman 12 tahun mengajar renang anak & mengatasi trauma air.',
                    'photo' => 'uploads/coaches/coach_hendra.png',
                    'color' => '#0077b6',
                    'order' => 1,
                    'is_active' => true,
                ],
                [
                    'name' => 'Coach Rina',
                    'title' => 'S.Or.',
                    'specialty' => 'Spesialis Wanita & Muslimah',
                    'description' => 'Ahli hydrotherapy & instruktur khusus wanita berhijab. Ramah, sabar, dan menguasai teknik adaptasi kolam privat.',
                    'photo' => 'uploads/coaches/coach_rina.png',
                    'color' => '#d946ef',
                    'order' => 2,
                    'is_active' => true,
                ],
                [
                    'name' => 'Coach Danu',
                    'title' => 'Purn.',
                    'specialty' => 'Head Trainer TNI & POLRI',
                    'description' => 'Mantan instruktur jasmani militer. Berpengalaman melatih fisik 500+ calon taruna Akpol, Bintara, dan Sekolah Kedinasan.',
                    'photo' => 'uploads/coaches/coach_danu.png',
                    'color' => '#d97706',
                    'order' => 3,
                    'is_active' => true,
                ],
            ];

            foreach ($dummyCoaches as $data) {
                Coach::create($data);
            }
        }

        $coaches = Coach::orderBy('order')->get();
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        return view('admin.coaches.form', ['coach' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'nullable|string|max:100',
            'specialty' => 'required|string|max:150',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $coach = new Coach();
        $coach->name = $validated['name'];
        $coach->title = $validated['title'] ?? '';
        $coach->specialty = $validated['specialty'];
        $coach->description = $validated['description'] ?? '';
        $coach->color = $validated['color'] ?? '#0077b6';
        $coach->order = $validated['order'] ?? 0;
        $coach->is_active = $request->has('is_active') ? true : false;

        if ($request->hasFile('photo_file')) {
            $uploadDir = public_path('uploads/coaches');
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $file = $request->file('photo_file');
            $filename = 'coach_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $coach->photo = 'uploads/coaches/' . $filename;
        }

        $coach->save();

        return redirect()->route('admin.coaches.index')->with('success', 'Data pelatih berhasil ditambahkan!');
    }

    public function edit(Coach $coach)
    {
        return view('admin.coaches.form', compact('coach'));
    }

    public function update(Request $request, Coach $coach)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'nullable|string|max:100',
            'specialty' => 'required|string|max:150',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $coach->name = $validated['name'];
        $coach->title = $validated['title'] ?? '';
        $coach->specialty = $validated['specialty'];
        $coach->description = $validated['description'] ?? '';
        $coach->color = $validated['color'] ?? '#0077b6';
        $coach->order = $validated['order'] ?? 0;
        $coach->is_active = $request->has('is_active') ? true : false;

        if ($request->hasFile('photo_file')) {
            $uploadDir = public_path('uploads/coaches');
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $file = $request->file('photo_file');
            $filename = 'coach_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $coach->photo = 'uploads/coaches/' . $filename;
        }

        $coach->save();

        return redirect()->route('admin.coaches.index')->with('success', 'Data pelatih berhasil diperbarui!');
    }

    public function destroy(Coach $coach)
    {
        $coach->delete();
        return redirect()->route('admin.coaches.index')->with('success', 'Data pelatih berhasil dihapus!');
    }
}
