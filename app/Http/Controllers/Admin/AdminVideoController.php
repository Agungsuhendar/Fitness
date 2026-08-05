<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index()
    {
        // Auto-create table if not exists
        if (!\Illuminate\Support\Facades\Schema::hasTable('videos')) {
            \Illuminate\Support\Facades\Schema::create('videos', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->string('before_badge')->nullable();
                $table->string('after_badge')->nullable();
                $table->text('description')->nullable();
                $table->string('video_url');
                $table->string('thumbnail')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Auto-seed dummy videos if empty
        if (Video::count() === 0) {
            $dummyVideos = [
                [
                    'title' => 'Daffa (7 Tahun)',
                    'subtitle' => 'Hari 1: Takut Air & Menangis ➔ Hari 4: Mahir Gaya Dada 25m',
                    'before_badge' => '🔴 Hari 1: Takut Air',
                    'after_badge' => '🟢 Hari 4: Mahir',
                    'description' => 'Dari tidak mau lepas pegangan hingga berani meluncur & fitness gaya dada 25 meter mandiri!',
                    'video_url' => 'https://www.youtube.com/embed/5ee8sX_1-9c',
                    'thumbnail' => 'images/assets/video_thumb_daffa.png',
                    'order' => 1,
                    'is_active' => true,
                ],
                [
                    'title' => 'Mbak Siti (24 Tahun)',
                    'subtitle' => 'Hari 1: Trauma Kedalaman ➔ Hari 3: Meluncur di Gym Dalam 2m',
                    'before_badge' => '🔴 Hari 1: Trauma',
                    'after_badge' => '🟢 Hari 3: Berani 2m',
                    'description' => 'Bimbingan privat 1-on-1 wanita ramah. Dalam 3 sesi berhasil mengatasi trauma air kedalaman 2 meter!',
                    'video_url' => 'https://www.youtube.com/embed/M5cs8a3Bhfg',
                    'thumbnail' => 'images/assets/video_thumb_siti.png',
                    'order' => 2,
                    'is_active' => true,
                ],
                [
                    'title' => 'Rian (Calon TNI/POLRI)',
                    'subtitle' => 'Hari 1: Fitness 15m Terengah ➔ Hari 6: Lulus Tes 50m Gaya Bebas',
                    'before_badge' => '🔴 Hari 1: 15m',
                    'after_badge' => '🟢 Hari 6: Lulus 50m',
                    'description' => 'Pelatihan stamina fisik & ketahanan napas intensif. Lulus tes fitness 50 meter gaya bebas dengan nilai 100!',
                    'video_url' => 'https://www.youtube.com/embed/xVeXGKPOH58',
                    'thumbnail' => 'images/assets/video_thumb_rian.png',
                    'order' => 3,
                    'is_active' => true,
                ],
            ];

            foreach ($dummyVideos as $data) {
                Video::create($data);
            }
        }

        $videos = Video::orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.form', ['video' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'subtitle' => 'nullable|string|max:255',
            'before_badge' => 'nullable|string|max:100',
            'after_badge' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $video = new Video();
        $video->title = $validated['title'];
        $video->subtitle = $validated['subtitle'] ?? '';
        $video->before_badge = $validated['before_badge'] ?? '';
        $video->after_badge = $validated['after_badge'] ?? '';
        $video->description = $validated['description'] ?? '';
        $video->video_url = $validated['video_url'];
        $video->order = $validated['order'] ?? 0;
        $video->is_active = $request->has('is_active');

        if ($request->hasFile('thumbnail_file')) {
            $uploadDir = public_path('uploads/videos');
            if (!file_exists($uploadDir)) @mkdir($uploadDir, 0777, true);
            $file = $request->file('thumbnail_file');
            $filename = 'video_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $video->thumbnail = 'uploads/videos/' . $filename;
        }

        $video->save();

        return redirect()->route('admin.videos.index')->with('success', 'Video galeri berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'subtitle' => 'nullable|string|max:255',
            'before_badge' => 'nullable|string|max:100',
            'after_badge' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $video->title = $validated['title'];
        $video->subtitle = $validated['subtitle'] ?? '';
        $video->before_badge = $validated['before_badge'] ?? '';
        $video->after_badge = $validated['after_badge'] ?? '';
        $video->description = $validated['description'] ?? '';
        $video->video_url = $validated['video_url'];
        $video->order = $validated['order'] ?? 0;
        $video->is_active = $request->has('is_active');

        if ($request->hasFile('thumbnail_file')) {
            $uploadDir = public_path('uploads/videos');
            if (!file_exists($uploadDir)) @mkdir($uploadDir, 0777, true);
            $file = $request->file('thumbnail_file');
            $filename = 'video_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $video->thumbnail = 'uploads/videos/' . $filename;
        }

        $video->save();

        return redirect()->route('admin.videos.index')->with('success', 'Video galeri berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video galeri berhasil dihapus!');
    }
}
