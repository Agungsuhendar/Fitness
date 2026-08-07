<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FitnessClass;
use Illuminate\Http\Request;

class AdminClassController extends Controller
{
    public function index()
    {
        $classes = FitnessClass::orderByDesc('class_date')->orderBy('start_time')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'coach_name' => 'required|string|max:255',
            'class_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'max_capacity' => 'required|integer|min:1',
            'branch' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        FitnessClass::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Jadwal Kelas Kelompok Studio "' . $validated['name'] . '" BERHASIL DITAMBAHKAN!');
    }

    public function destroy($id)
    {
        $class = FitnessClass::findOrFail($id);
        $name = $class->name;
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Jadwal kelas "' . $name . '" telah dihapus.');
    }
}
