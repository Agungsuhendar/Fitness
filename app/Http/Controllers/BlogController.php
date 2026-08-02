<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $posts = $query->orderBy('published_at', 'desc')->paginate(6);
        $categories = Post::select('category')->distinct()->pluck('category');
        $popularPosts = Post::orderBy('views', 'desc')->take(4)->get();

        return view('blog.index', compact('posts', 'categories', 'popularPosts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->increment('views');

        $relatedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
