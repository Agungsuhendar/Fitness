<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('order')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.form', ['program' => new Program()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'target_audience' => 'required|string',
            'description' => 'required|string',
            'price_start' => 'required|numeric',
            'badge' => 'nullable|string',
            'image' => 'required|string',
            'order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title']);
        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan!');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.form', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'target_audience' => 'required|string',
            'description' => 'required|string',
            'price_start' => 'required|numeric',
            'badge' => 'nullable|string',
            'image' => 'required|string',
            'order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus.');
    }
}
