@extends('admin.layout')

@section('title', ($video ? 'Edit' : 'Tambah') . ' Video - Admin Panel')
@section('header_title', ($video ? 'Edit' : 'Tambah') . ' Data Video Galeri')

@section('admin_content')
<div style="max-width: 800px;">
    <div class="admin-card" style="padding: 2.25rem 2rem;">
        <form action="{{ $video ? route('admin.videos.update', $video) : route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($video) @method('PUT') @endif

            @if($errors->any())
                <div style="padding: 1rem; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.85rem; margin-bottom: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Judul / Nama Siswa: <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('title', $video->title ?? '') }}" required placeholder="Contoh: Daffa (7 Tahun)">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Subtitle Ringkas:
                    </label>
                    <input type="text" name="subtitle" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('subtitle', $video->subtitle ?? '') }}" placeholder="Contoh: Hari 1: Takut Air ➔ Hari 4: Mahir">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Badge Before (Hari 1):
                    </label>
                    <input type="text" name="before_badge" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('before_badge', $video->before_badge ?? '') }}" placeholder="🔴 Hari 1: Takut Air">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Badge After (Hasil):
                    </label>
                    <input type="text" name="after_badge" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('after_badge', $video->after_badge ?? '') }}" placeholder="🟢 Hari 4: Mahir">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                    URL Embed YouTube / Video: <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="video_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('video_url', $video->video_url ?? '') }}" required placeholder="https://www.youtube.com/embed/5ee8sX_1-9c">
                <small style="color: #94a3b8; font-size: 0.8rem;">Gunakan format embed YouTube: https://www.youtube.com/embed/VIDEO_ID</small>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                    Deskripsi / Cerita Latihan:
                </label>
                <textarea name="description" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 80px;" placeholder="Ceritakan progres latihan siswa...">{{ old('description', $video->description ?? '') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Upload Cover Thumbnail (Shorts 9:16):
                    </label>
                    <input type="file" name="thumbnail_file" accept="image/*" style="font-size: 0.85rem;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Urutan Tampil:
                    </label>
                    <input type="number" name="order" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('order', $video->order ?? 0) }}">
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-weight: 700; font-size: 0.925rem;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $video->is_active ?? true) ? 'checked' : '' }} style="width: 20px; height: 20px;">
                    Tampilkan di Website (Aktif)
                </label>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: space-between;">
                <a href="{{ route('admin.videos.index') }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-floppy-disk"></i> {{ $video ? 'Simpan Perubahan' : 'Tambah Video' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
