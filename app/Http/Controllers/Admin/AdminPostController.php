<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form', ['post' => new Post()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'author' => 'required|string',
            'reading_time' => 'integer',
        ]);

        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('images/uploads');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }
            $file->move($uploadPath, $filename);
            $data['image'] = 'images/uploads/' . $filename;
        }

        if (empty($data['image'])) {
            $data['image'] = 'images/hero-bg.webp';
        }

        unset($data['image_file']);
        $data['slug'] = Str::slug($data['title']);
        $data['published_at'] = now();

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'author' => 'required|string',
            'reading_time' => 'integer',
        ]);

        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('images/uploads');
            if (!file_exists($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }
            $file->move($uploadPath, $filename);
            $data['image'] = 'images/uploads/' . $filename;
        }

        if (empty($data['image'])) {
            $data['image'] = $post->image ?? 'images/hero-bg.webp';
        }

        unset($data['image_file']);
        $data['slug'] = Str::slug($data['title']);
        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
