@extends('admin.layout')

@section('title', ($program->exists ? 'Edit' : 'Tambah') . ' Program - Admin Panel')
@section('header_title', ($program->exists ? 'Edit' : 'Tambah') . ' Program Renang')

@section('admin_content')
<div class="glass-card" style="padding: 2.25rem; max-width: 800px; background: #ffffff;">
    <form action="{{ $program->exists ? route('admin.programs.update', $program->id) : route('admin.programs.store') }}" method="POST">
        @csrf
        @if($program->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label class="form-label">Judul Program <span style="color:red;">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $program->title) }}" required placeholder="Contoh: Les Renang Anak (Usia 3–15 Tahun)">
        </div>

        <div class="form-group">
            <label class="form-label">Sub Judul (Ringkas)</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $program->subtitle) }}" placeholder="Contoh: Metode ramah anak, cepat bisa, & berstandar keselamatan tinggi.">
        </div>

        <div class="grid-2" style="gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Target Audience / Sasaran <span style="color:red;">*</span></label>
                <input type="text" name="target_audience" class="form-control" value="{{ old('target_audience', $program->target_audience) }}" required placeholder="Contoh: Orang tua anak 3-15 tahun">
            </div>
            <div class="form-group">
                <label class="form-label">Harga Mulai (Rp) <span style="color:red;">*</span></label>
                <input type="number" name="price_start" class="form-control" value="{{ old('price_start', $program->price_start) }}" required placeholder="350000">
            </div>
        </div>

        <div class="grid-2" style="gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Badge Label (Opsional)</label>
                <input type="text" name="badge" class="form-control" value="{{ old('badge', $program->badge) }}" placeholder="Contoh: Paling Populer / Recommended">
            </div>
            <div class="form-group">
                <label class="form-label">Urutan Tampil (Order)</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $program->order ?? 1) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">URL Gambar (Unsplash / Local Asset) <span style="color:red;">*</span></label>
            <input type="text" name="image" class="form-control" value="{{ old('image', $program->image) }}" required placeholder="https://images.unsplash.com/photo-1519315901367-f34ff9154487?auto=format&fit=crop&w=800&q=80">
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Lengkap <span style="color:red;">*</span></label>
            <textarea name="description" class="form-control" rows="5" required placeholder="Jelaskan detail program...">{{ old('description', $program->description) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Program
            </button>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
