@extends('admin.layout')

@section('title', ($faq->exists ? 'Edit' : 'Tambah') . ' FAQ - Admin Panel')
@section('header_title', ($faq->exists ? 'Edit' : 'Tambah') . ' Pertanyaan FAQ')

@section('admin_content')
<div style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: var(--shadow-sm); padding: 2rem 2.5rem; width: 100%;">
    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1.25rem; margin-bottom: 2rem; border-bottom: 1px solid #f1f5f9;">
        <div>
            <h2 style="font-size: 1.35rem; margin: 0; color: var(--dark);">
                <i class="fa-solid fa-circle-question" style="color: var(--emerald); margin-right: 0.5rem;"></i>
                Form {{ $faq->exists ? 'Edit' : 'Tambah' }} Pertanyaan FAQ
            </h2>
            <p style="color: var(--text-muted); font-size: 0.875rem; margin-top: 0.25rem;">Lengkapi kategori, pertanyaan, dan jawaban rinci di bawah ini.</p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar FAQ
        </a>
    </div>

    <form action="{{ $faq->exists ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST">
        @csrf
        @if($faq->exists)
            @method('PUT')
        @endif

        <div class="grid-2" style="gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Kategori FAQ <span style="color:red;">*</span></label>
                <select name="category" class="form-control" required>
                    <option value="Umum" {{ old('category', $faq->category) == 'Umum' ? 'selected' : '' }}>Umum</option>
                    <option value="Pendaftaran" {{ old('category', $faq->category) == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                    <option value="Pelatih" {{ old('category', $faq->category) == 'Pelatih' ? 'selected' : '' }}>Pelatih</option>
                    <option value="Kolam & Safety" {{ old('category', $faq->category) == 'Kolam & Safety' ? 'selected' : '' }}>Kolam & Safety</option>
                    <option value="TNI/POLRI & Terapi" {{ old('category', $faq->category) == 'TNI/POLRI & Terapi' ? 'selected' : '' }}>TNI/POLRI & Terapi</option>
                    <option value="Pembayaran" {{ old('category', $faq->category) == 'Pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Urutan Tampil (Order)</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $faq->order ?? 1) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Pertanyaan <span style="color:red;">*</span></label>
            <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required placeholder="Contoh: Apakah ada garansi sampai bisa renang?">
        </div>

        <div class="form-group">
            <label class="form-label">Jawaban Lengkap (WYSIWYG Visual Editor) <span style="color:red;">*</span></label>
            <textarea name="answer" class="form-control rich-editor" rows="6" placeholder="Tuliskan jawaban yang rinci, solutif, dan ramah untuk calon pendaftar...">{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 1.75rem;">
            <label style="display: inline-flex; align-items: center; gap: 0.75rem; font-weight: 800; cursor: pointer; background: #f8fafc; padding: 0.85rem 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $faq->is_popular) ? 'checked' : '' }} style="width: 20px; height: 20px; accent-color: var(--primary);">
                Tampilkan di Halaman Beranda (Populer FAQ)
            </label>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.25rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
            <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data FAQ
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline" style="padding: 0.85rem 1.5rem;">Batal</a>
        </div>
    </form>
</div>
@endsection
