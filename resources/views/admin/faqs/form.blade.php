@extends('admin.layout')

@section('title', ($faq->exists ? 'Edit' : 'Tambah') . ' FAQ - Admin Panel')
@section('header_title', ($faq->exists ? 'Edit' : 'Tambah') . ' Pertanyaan FAQ')

@section('admin_content')
<div class="glass-card" style="padding: 2.25rem; max-width: 750px; background: #ffffff;">
    <form action="{{ $faq->exists ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST">
        @csrf
        @if($faq->exists)
            @method('PUT')
        @endif

        <div class="grid-2" style="gap: 1rem;">
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
            <label class="form-label">Jawaban Lengkap <span style="color:red;">*</span></label>
            <textarea name="answer" class="form-control" rows="5" required placeholder="Tuliskan jawaban yang rinci dan ramah...">{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 1.75rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 800; cursor: pointer;">
                <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $faq->is_popular) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                Tampilkan di Halaman Beranda (Populer FAQ)
            </label>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan FAQ
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
