@extends('admin.layout')

@section('title', ($program->exists ? 'Edit' : 'Tambah') . ' Program - Admin Panel')
@section('header_title', ($program->exists ? 'Edit' : 'Tambah') . ' Program Renang')

@section('admin_content')
<div style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: var(--shadow-sm); padding: 2rem 2.5rem; width: 100%;">
    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1.25rem; margin-bottom: 2rem; border-bottom: 1px solid #f1f5f9;">
        <div>
            <h2 style="font-size: 1.35rem; margin: 0; color: var(--dark);">
                <i class="fa-solid fa-swatchbook" style="color: var(--primary); margin-right: 0.5rem;"></i>
                Form {{ $program->exists ? 'Edit' : 'Tambah' }} Program Renang
            </h2>
            <p style="color: var(--text-muted); font-size: 0.875rem; margin-top: 0.25rem;">Lengkapi informasi detail paket program pelatihan di bawah ini.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Program
        </a>
    </div>

    <form action="{{ $program->exists ? route('admin.programs.update', $program->id) : route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($program->exists)
            @method('PUT')
        @endif

        <div class="grid-2" style="gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Judul Program <span style="color:red;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $program->title) }}" required placeholder="Contoh: Les Renang Anak (Usia 3–15 Tahun)">
            </div>

            <div class="form-group">
                <label class="form-label">Sub Judul (Ringkas)</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $program->subtitle) }}" placeholder="Contoh: Metode ramah anak, cepat bisa, & berstandar keselamatan tinggi.">
            </div>
        </div>

        <div class="grid-3" style="gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Target Audience / Sasaran <span style="color:red;">*</span></label>
                <input type="text" name="target_audience" class="form-control" value="{{ old('target_audience', $program->target_audience) }}" required placeholder="Contoh: Orang tua anak 3-15 tahun">
            </div>
            <div class="form-group">
                <label class="form-label">Harga Mulai (Rp) <span style="color:red;">*</span></label>
                <input type="number" name="price_start" class="form-control" value="{{ old('price_start', $program->price_start) }}" required placeholder="350000">
            </div>
            <div class="form-group">
                <label class="form-label">Badge Label (Opsional)</label>
                <input type="text" name="badge" class="form-control" value="{{ old('badge', $program->badge) }}" placeholder="Contoh: Paling Populer / Recommended">
            </div>
        </div>

        <!-- Section Upload Gambar dengan Feature Browse File -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem;">
            <label class="form-label" style="font-size: 1rem; color: #0f172a; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-image" style="color: #0284c7; margin-right: 0.35rem;"></i> Gambar Program
            </label>
            
            <div class="grid-2" style="gap: 1.5rem; align-items: start;">
                <div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label" style="font-size: 0.85rem; color: #475569;">
                            <i class="fa-solid fa-folder-open"></i> Option A: Browse & Upload File Gambar (Dari Komputer)
                        </label>
                        <input type="file" name="image_file" class="form-control" accept="image/*" onchange="previewSelectedImage(this)" style="background: white; padding: 0.65rem 1rem;">
                        <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 0.35rem;">Format disarankan: JPG, PNG, WEBP (Max 5MB)</small>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" style="font-size: 0.85rem; color: #475569;">
                            <i class="fa-solid fa-link"></i> Option B: Atau Gunakan URL Gambar Web (Opsional)
                        </label>
                        <input type="text" name="image" id="imageUrlInput" class="form-control" value="{{ old('image', $program->image) }}" placeholder="https://images.unsplash.com/..." style="background: white;">
                    </div>
                </div>

                <div>
                    <label class="form-label" style="font-size: 0.85rem; color: #475569;">Preview Gambar Saat Ini:</label>
                    <div style="width: 100%; height: 140px; background: #e2e8f0; border-radius: 0.75rem; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px dashed #cbd5e1;">
                        @php
                            $imgSrc = old('image', $program->image);
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
            <label class="form-label">Urutan Tampil (Order)</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $program->order ?? 1) }}" required style="max-width: 250px;">
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Lengkap Program (WYSIWYG Visual Editor) <span style="color:red;">*</span></label>
            <textarea name="description" class="form-control rich-editor" rows="6" placeholder="Jelaskan detail keunggulan, materi pelatihan, dan jadwal program...">{{ old('description', $program->description) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.25rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
            <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); font-weight: 800;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data Program
            </button>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-outline" style="padding: 0.85rem 1.5rem;">Batal</a>
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
