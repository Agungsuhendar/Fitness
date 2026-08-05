@extends('admin.layout')

@section('title', ($coach ? 'Edit' : 'Tambah') . ' Pelatih - Admin Panel')
@section('header_title', ($coach ? 'Edit' : 'Tambah') . ' Data Pelatih')

@section('admin_content')
<div style="max-width: 800px;">
    <div class="admin-card" style="padding: 2.25rem 2rem;">
        <form action="{{ $coach ? route('admin.coaches.update', $coach) : route('admin.coaches.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($coach) @method('PUT') @endif

            @if($errors->any())
                <div style="padding: 1rem; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.85rem; margin-bottom: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Nama Lengkap Pelatih: <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="name" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('name', $coach->name ?? '') }}" required placeholder="Contoh: Coach Hendra">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Gelar / Jabatan (opsional):
                    </label>
                    <input type="text" name="title" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('title', $coach->title ?? '') }}" placeholder="Contoh: S.Pd., S.Or.">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                    Spesialisasi / Role: <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="specialty" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('specialty', $coach->specialty ?? '') }}" required placeholder="Contoh: Head Coach & Spesialis Anak">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                    Deskripsi / Bio Singkat:
                </label>
                <textarea name="description" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 85px;" placeholder="Lulusan FIK UNY, Pemegang Sertifikat Pelatih PRSI...">{{ old('description', $coach->description ?? '') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Upload Foto Pelatih:
                    </label>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid {{ $coach->color ?? '#0077b6' }}; flex-shrink: 0;">
                            @if($coach && $coach->photo)
                                <img id="photoPreview" src="{{ Str::startsWith($coach->photo, 'http') ? $coach->photo : asset($coach->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div id="photoPreview" style="width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 2rem;">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="photo_file" accept="image/*" style="font-size: 0.85rem;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Warna Border Ring Foto (Hex):
                    </label>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <input type="color" name="color" value="{{ old('color', $coach->color ?? '#0077b6') }}" style="width: 50px; height: 42px; border: none; cursor: pointer; border-radius: 0.5rem;">
                        <input type="text" value="{{ old('color', $coach->color ?? '#0077b6') }}" style="width: 120px; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-family: monospace;" readonly>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Urutan Tampil (0 = paling atas):
                    </label>
                    <input type="number" name="order" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('order', $coach->order ?? 0) }}">
                </div>
                <div style="display: flex; align-items: flex-end; padding-bottom: 0.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-weight: 700; font-size: 0.925rem;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coach->is_active ?? true) ? 'checked' : '' }} style="width: 20px; height: 20px;">
                        Tampilkan di Website (Aktif)
                    </label>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: space-between;">
                <a href="{{ route('admin.coaches.index') }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-floppy-disk"></i> {{ $coach ? 'Simpan Perubahan' : 'Tambah Pelatih' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
