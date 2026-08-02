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
            'image' => 'required|string',
            'author' => 'required|string',
            'reading_time' => 'integer',
        ]);

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
            'image' => 'required|string',
            'author' => 'required|string',
            'reading_time' => 'integer',
        ]);

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
