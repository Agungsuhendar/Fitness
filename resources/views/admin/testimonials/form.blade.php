@extends('admin.layout')

@section('title', ($testimonial ? 'Edit' : 'Tambah') . ' Testimoni - Admin Panel')
@section('header_title', ($testimonial ? 'Edit' : 'Tambah') . ' Data Testimoni')

@section('admin_content')
<div style="max-width: 800px;">
    <div class="admin-card" style="padding: 2.25rem 2rem;">
        <form action="{{ $testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($testimonial) @method('PUT') @endif

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
                        Nama Peserta: <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="name" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('name', $testimonial->name ?? '') }}" required placeholder="Ibu Dewi Sari">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Role / Keterangan: <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="role" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('role', $testimonial->role ?? '') }}" required placeholder="Ibu dari Kenzo (7th)">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Program yang Diikuti: <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="program" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('program', $testimonial->program ?? '') }}" required placeholder="FitLife Fitness & PT Anak">
                </div>
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Rating (1-5): <span style="color: #ef4444;">*</span>
                    </label>
                    <select name="rating" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;">
                        @for($r = 5; $r >= 1; $r--)
                            <option value="{{ $r }}" {{ old('rating', $testimonial->rating ?? 5) == $r ? 'selected' : '' }}>
                                {{ $r }} ⭐ {{ $r == 5 ? '(Sangat Puas)' : ($r == 4 ? '(Puas)' : ($r == 3 ? '(Cukup)' : ($r == 2 ? '(Kurang)' : '(Buruk)'))) }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                    Isi Testimoni / Review: <span style="color: #ef4444;">*</span>
                </label>
                <textarea name="review" class="search-input" style="width: 100%; border: 1px solid #cbd5e1; height: 100px;" required placeholder="Ceritakan pengalaman Anda...">{{ old('review', $testimonial->review ?? '') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #cbd5e1; margin-bottom: 0.45rem;">
                        Upload Foto Peserta (opsional):
                    </label>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 2px solid var(--primary-light); flex-shrink: 0;">
                            @if($testimonial && $testimonial->avatar)
                                <img src="{{ Str::startsWith($testimonial->avatar, 'http') ? $testimonial->avatar : asset($testimonial->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 1.5rem;">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="avatar_file" accept="image/*" style="font-size: 0.85rem;">
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; justify-content: center; gap: 0.75rem;">
                    <label style="display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-weight: 700; font-size: 0.9rem;">
                        <input type="checkbox" name="is_approved" value="1" {{ old('is_approved', $testimonial->is_approved ?? true) ? 'checked' : '' }} style="width: 20px; height: 20px;">
                        ✅ Disetujui (tampil di website)
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-weight: 700; font-size: 0.9rem;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured ?? true) ? 'checked' : '' }} style="width: 20px; height: 20px;">
                        ⭐ Featured (tampil di beranda)
                    </label>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: space-between;">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-floppy-disk"></i> {{ $testimonial ? 'Simpan Perubahan' : 'Tambah Testimoni' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
