@extends('admin.layout')

@section('title', 'Kelola Artikel Blog - Admin Panel')
@section('header_title', 'Kelola Artikel & Edukasi Blog')

@section('admin_content')
<div style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
        <div>
            <h2 style="font-size: 1.35rem; color: #0f172a; margin: 0;">
                <i class="fa-solid fa-newspaper" style="color: #f59e0b; margin-right: 0.5rem;"></i>
                Daftar Artikel Blog
            </h2>
            <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Kelola artikel edukasi tips fitness, parenting, dan persiapan tes TNI POLRI.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm" style="border-radius: 0.75rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 0.65rem 1.35rem; font-weight: 700; border: none;">
            <i class="fa-solid fa-plus"></i> Tulis Artikel Baru
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th style="width: 90px;">Sampul</th>
                <th>Judul Artikel</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Waktu Baca</th>
                <th style="text-align: right; padding-right: 1.5rem;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $index => $post)
            <tr>
                <td style="font-weight: 700; color: #64748b;">{{ $index + 1 }}</td>
                <td>
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 56px; height: 44px; object-fit: cover; border-radius: 0.65rem; border: 1px solid #e2e8f0;">
                </td>
                <td style="font-weight: 800; color: #0f172a; max-width: 280px;">{{ $post->title }}</td>
                <td>
                    <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">
                        {{ $post->category }}
                    </span>
                </td>
                <td style="font-size: 0.875rem; color: #475569; font-weight: 700;">{{ $post->author }}</td>
                <td style="font-size: 0.85rem; color: #64748b;">{{ $post->reading_time }} Menit</td>
                <td style="text-align: right; padding-right: 1.5rem;">
                    <div style="display: inline-flex; gap: 0.5rem; justify-content: flex-end;">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline btn-sm" style="padding: 0.45rem 0.85rem; border-radius: 0.65rem; border-color: #0284c7; color: #0284c7; font-weight: 700;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm" style="padding: 0.45rem 0.85rem; border-radius: 0.65rem; border-color: #ef4444; color: #ef4444; background: #fff5f5; font-weight: 700;">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; color: #64748b; padding: 3rem;">Belum ada artikel blog.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
