@extends('admin.layout')

@section('title', ($post->exists ? 'Edit' : 'Tambah') . ' Artikel - Admin Panel')
@section('header_title', ($post->exists ? 'Edit' : 'Tulis') . ' Artikel Blog')

@section('admin_content')
<div class="glass-card" style="padding: 2.25rem; max-width: 850px; background: #ffffff;">
    <form action="{{ $post->exists ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="POST">
        @csrf
        @if($post->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label class="form-label">Judul Artikel <span style="color:red;">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required placeholder="Judul artikel edukasi...">
        </div>

        <div class="grid-3" style="gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Kategori <span style="color:red;">*</span></label>
                <select name="category" class="form-control" required>
                    <option value="Tips Renang" {{ old('category', $post->category) == 'Tips Renang' ? 'selected' : '' }}>Tips Renang</option>
                    <option value="Parenting" {{ old('category', $post->category) == 'Parenting' ? 'selected' : '' }}>Parenting</option>
                    <option value="Persiapan TNI" {{ old('category', $post->category) == 'Persiapan TNI' ? 'selected' : '' }}>Persiapan TNI</option>
                    <option value="Kesehatan" {{ old('category', $post->category) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Penulis / Author <span style="color:red;">*</span></label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $post->author ?? 'Coach Hendra (Senior Instructor)') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Estimasi Menit Baca <span style="color:red;">*</span></label>
                <input type="number" name="reading_time" class="form-control" value="{{ old('reading_time', $post->reading_time ?? 4) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">URL Sampul Gambar <span style="color:red;">*</span></label>
            <input type="text" name="image" class="form-control" value="{{ old('image', $post->image) }}" required placeholder="https://images.unsplash.com/photo-1519315901367-f34ff9154487?auto=format&fit=crop&w=800&q=80">
        </div>

        <div class="form-group">
            <label class="form-label">Ringkasan Excerpt <span style="color:red;">*</span></label>
            <textarea name="excerpt" class="form-control" rows="2" required placeholder="Ringkasan singkat artikel...">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Isi Konten Artikel (Support HTML Tags) <span style="color:red;">*</span></label>
            <textarea name="content" class="form-control" rows="10" required placeholder="Gunakan tag <p>, <h3>, <ul>, <li> untuk format artikel yang menarik...">{{ old('content', $post->content) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Terbitkan Artikel
            </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
