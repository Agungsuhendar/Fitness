@extends('admin.layout')

@section('title', ($post->exists ? 'Edit' : 'Tambah') . ' Artikel - Admin Panel')
@section('header_title', ($post->exists ? 'Edit' : 'Tulis') . ' Artikel Blog')

@section('admin_content')
<div style="background: var(--admin-card-bg, #0d1410); border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: var(--shadow-sm); padding: 2rem 2.5rem; width: 100%;">
    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1.25rem; margin-bottom: 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
        <div>
            <h2 style="font-size: 1.35rem; margin: 0; color: var(--dark);">
                <i class="fa-solid fa-newspaper" style="color: var(--accent-hover); margin-right: 0.5rem;"></i>
                Form {{ $post->exists ? 'Edit' : 'Tulis Baru' }} Artikel Blog
            </h2>
            <p style="color: var(--text-muted); font-size: 0.875rem; margin-top: 0.25rem;">Tulis konten edukasi fitness, tips kesehatan, dan artikel menarik lainnya.</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Artikel
        </a>
    </div>

    <form action="{{ $post->exists ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($post->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label class="form-label">Judul Artikel <span style="color:red;">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required placeholder="Contoh: 7 Tips Mengatasi Rasa Takut Air Pada Anak Pemula">
        </div>

        <div class="grid-3" style="gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Kategori Artikel <span style="color:red;">*</span></label>
                <select name="category" class="form-control" required>
                    <option value="Tips Fitness" {{ old('category', $post->category) == 'Tips Fitness' ? 'selected' : '' }}>Tips Fitness</option>
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
                <label class="form-label">Estimasi Waktu Baca (Menit) <span style="color:red;">*</span></label>
                <input type="number" name="reading_time" class="form-control" value="{{ old('reading_time', $post->reading_time ?? 4) }}" required>
            </div>
        </div>

        <!-- Section Upload Gambar dengan Feature Browse File -->
        <div style="background: rgba(255, 255, 255, 0.04); border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem;">
            <label class="form-label" style="font-size: 1rem; color: #ffffff; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-image" style="color: #f59e0b; margin-right: 0.35rem;"></i> Sampul Gambar Artikel
            </label>
            
            <div class="grid-2" style="gap: 1.5rem; align-items: start;">
                <div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label" style="font-size: 0.85rem; color: #94a3b8;">
                            <i class="fa-solid fa-folder-open"></i> Option A: Browse & Upload File Gambar (Dari Komputer)
                        </label>
                        <input type="file" name="image_file" class="form-control" accept="image/*" onchange="previewSelectedImage(this)" style="background: white; padding: 0.65rem 1rem;">
                        <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Format disarankan: JPG, PNG, WEBP (Max 5MB)</small>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" style="font-size: 0.85rem; color: #94a3b8;">
                            <i class="fa-solid fa-link"></i> Option B: Atau Gunakan URL Gambar Web (Opsional)
                        </label>
                        <input type="text" name="image" id="imageUrlInput" class="form-control" value="{{ old('image', $post->image) }}" placeholder="https://images.unsplash.com/..." style="background: white;">
                    </div>
                </div>

                <div>
                    <label class="form-label" style="font-size: 0.85rem; color: #94a3b8;">Preview Gambar Sampul:</label>
                    <div style="width: 100%; height: 140px; background: #e2e8f0; border-radius: 0.75rem; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px dashed #cbd5e1;">
                        @php
                            $imgSrc = old('image', $post->image);
                            if ($imgSrc && !Str::startsWith($imgSrc, 'http')) {
                                $imgSrc = asset($imgSrc);
                            }
                        @endphp
                        <img id="imagePreview" src="{{ $imgSrc ?: asset('images/hero-bg.webp') }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Ringkasan Artikel (Excerpt) <span style="color:red;">*</span></label>
            <textarea name="excerpt" class="form-control" rows="2" required placeholder="Tuliskan ringkasan singkat artikel 1-2 kalimat...">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Isi Konten Lengkap Artikel (WYSIWYG Visual Editor) <span style="color:red;">*</span></label>
            <textarea name="content" class="form-control rich-editor" rows="12" placeholder="Tulis artikel edukasi fitness yang menarik...">{{ old('content', $post->content) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.25rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
            <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; font-weight: 800;">
                <i class="fa-solid fa-floppy-disk"></i> Terbitkan Artikel Blog
            </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline" style="padding: 0.85rem 1.5rem;">Batal</a>
        </div>
    </form>
</div>

<script>
    function previewSelectedImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
