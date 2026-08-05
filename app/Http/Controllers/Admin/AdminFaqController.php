<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.form', ['faq' => new Faq()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
            'is_popular' => 'boolean',
            'order' => 'integer',
        ]);

        $data['is_popular'] = $request->has('is_popular');
        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
            'is_popular' => 'boolean',
            'order' => 'integer',
        ]);

        $data['is_popular'] = $request->has('is_popular');
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
