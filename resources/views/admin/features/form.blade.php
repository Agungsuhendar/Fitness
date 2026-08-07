@extends('admin.layout')

@section('title', ($feature ? 'Edit' : 'Tambah') . ' Keunggulan - Admin Panel')
@section('header_title', ($feature ? 'Edit' : 'Tambah') . ' Poin Keunggulan')

@section('admin_content')
<div style="max-width: 800px;">
    <div class="admin-card" style="padding: 2.25rem 2rem;">
        <form action="{{ $feature ? route('admin.features.update', $feature) : route('admin.features.store') }}" method="POST">
            @csrf
            @if($feature) @method('PUT') @endif

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
                        Judul Keunggulan: <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('title', $feature->title ?? '') }}" required placeholder="Pelatih Sabar & Pro">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Icon (FontAwesome Class): <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="icon" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('icon', $feature->icon ?? 'fa-solid fa-star') }}" required placeholder="fa-solid fa-user-graduate">
                    <small style="color: #94a3b8; font-size: 0.8rem;">Contoh: fa-solid fa-user-graduate, fa-solid fa-trophy</small>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                    Deskripsi / Penjelasan Singkat: <span style="color: #ef4444;">*</span>
                </label>
                <textarea name="description" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 90px;" required placeholder="Jelaskan detail keunggulan ini...">{{ old('description', $feature->description ?? '') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Warna Akses Icon (HEX Code):
                    </label>
                    <input type="color" name="color" value="{{ old('color', $feature->color ?? '#0077b6') }}" style="height: 42px; width: 100%; border: 1px solid #cbd5e1; border-radius: 0.5rem; cursor: pointer;">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Urutan Tampil:
                    </label>
                    <input type="number" name="order" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('order', $feature->order ?? 0) }}">
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-weight: 700; font-size: 0.925rem;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $feature->is_active ?? true) ? 'checked' : '' }} style="width: 20px; height: 20px;">
                    Tampilkan di Website (Aktif)
                </label>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: space-between;">
                <a href="{{ route('admin.features.index') }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-floppy-disk"></i> {{ $feature ? 'Simpan Perubahan' : 'Tambah Keunggulan' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
