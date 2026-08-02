@extends('admin.layout')

@section('title', 'Kelola FAQ - Admin Panel')
@section('header_title', 'Kelola 20+ Pertanyaan & Jawaban FAQ')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 1.35rem;">Daftar FAQ Aktif (Total {{ $faqs->count() }} Pertanyaan)</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola pertanyaan dan jawaban yang tampil pada halaman FAQ dan Beranda.</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> Tambah FAQ Baru
    </a>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Pertanyaan</th>
                <th>Jawaban (Preview)</th>
                <th>Populer?</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $index => $faq)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><span style="background: #e0f2fe; color: var(--primary-dark); padding: 0.25rem 0.65rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">{{ $faq->category }}</span></td>
                <td style="font-weight: 800; max-width: 250px;">{{ $faq->question }}</td>
                <td style="font-size: 0.875rem; color: var(--text-muted); max-width: 320px;">{{ Str::limit($faq->answer, 90) }}</td>
                <td>
                    @if($faq->is_popular)
                        <span style="color: var(--emerald); font-weight: 800;"><i class="fa-solid fa-circle-check"></i> Ya</span>
                    @else
                        <span style="color: var(--text-muted);">-</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-outline btn-sm" style="padding: 0.4rem 0.75rem;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm" style="padding: 0.4rem 0.75rem; border-color: #ef4444; color: #ef4444;">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
