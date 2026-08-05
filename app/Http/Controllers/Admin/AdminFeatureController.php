<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class AdminFeatureController extends Controller
{
    public function index()
    {
        // Auto-create table if not exists
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

        // Auto-seed dummy features if empty
        if (Feature::count() === 0) {
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
                Feature::create($data);
            }
        }

        $features = Feature::orderBy('order')->get();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.form', ['feature' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'color' => 'nullable|string|max:30',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $feature = new Feature();
        $feature->icon = $validated['icon'];
        $feature->title = $validated['title'];
        $feature->description = $validated['description'];
        $feature->color = $validated['color'] ?? '#0077b6';
        $feature->order = $validated['order'] ?? 0;
        $feature->is_active = $request->has('is_active');

        $feature->save();

        return redirect()->route('admin.features.index')->with('success', 'Keunggulan berhasil ditambahkan!');
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.form', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'color' => 'nullable|string|max:30',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $feature->icon = $validated['icon'];
        $feature->title = $validated['title'];
        $feature->description = $validated['description'];
        $feature->color = $validated['color'] ?? '#0077b6';
        $feature->order = $validated['order'] ?? 0;
        $feature->is_active = $request->has('is_active');

        $feature->save();

        return redirect()->route('admin.features.index')->with('success', 'Keunggulan berhasil diperbarui!');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.features.index')->with('success', 'Keunggulan berhasil dihapus!');
    }
}
