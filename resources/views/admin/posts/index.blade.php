@extends('admin.layout')

@section('title', 'Kelola Artikel Blog - Admin Panel')
@section('header_title', 'Kelola Artikel & Edukasi Blog')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 1.35rem;">Daftar Artikel Blog</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola artikel edukasi tips renang, parenting, dan persiapan TNI POLRI.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> Tulis Artikel Baru
    </a>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul Artikel</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Waktu Baca</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index => $post)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 50px; height: 40px; object-fit: cover; border-radius: 8px;">
                </td>
                <td style="font-weight: 800; max-width: 280px;">{{ $post->title }}</td>
                <td><span style="background: #e0f2fe; color: var(--primary-dark); padding: 0.25rem 0.65rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">{{ $post->category }}</span></td>
                <td>{{ $post->author }}</td>
                <td>{{ $post->reading_time }} Menit</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline btn-sm" style="padding: 0.4rem 0.75rem;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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
