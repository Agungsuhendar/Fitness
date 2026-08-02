@extends('admin.layout')

@section('title', 'Kelola Program - Admin Panel')
@section('header_title', 'Kelola Program Les Renang')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <div>
        <h2 style="font-size: 1.35rem;">Daftar Program Aktif</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Kelola judul, deskripsi, harga, dan badge program renang.</p>
    </div>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> Tambah Program Baru
    </a>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul Program</th>
                <th>Sasaran Peserta</th>
                <th>Harga Mulai</th>
                <th>Badge</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $index => $prog)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ Str::startsWith($prog->image, 'http') ? $prog->image : asset($prog->image) }}" alt="{{ $prog->title }}" style="width: 50px; height: 40px; object-fit: cover; border-radius: 8px;">
                </td>
                <td style="font-weight: 800;">{{ $prog->title }}</td>
                <td style="font-size: 0.875rem;">{{ $prog->target_audience }}</td>
                <td style="font-weight: 800; color: var(--primary-dark);">Rp {{ number_format($prog->price_start, 0, ',', '.') }}</td>
                <td><span style="background: #fef3c7; color: #b45309; padding: 0.25rem 0.6rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">{{ $prog->badge ?? '-' }}</span></td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.programs.edit', $prog->id) }}" class="btn btn-outline btn-sm" style="padding: 0.4rem 0.75rem;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.programs.destroy', $prog->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');">
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
