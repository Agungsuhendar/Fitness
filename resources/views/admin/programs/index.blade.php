@extends('admin.layout')

@section('title', 'Kelola Program - Admin Panel')
@section('header_title', 'Kelola Program Les Renang')

@section('admin_content')
<div style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
        <div>
            <h2 style="font-size: 1.35rem; color: #0f172a; margin: 0;">
                <i class="fa-solid fa-swatchbook" style="color: #0284c7; margin-right: 0.5rem;"></i>
                Daftar Program Aktif
            </h2>
            <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Kelola judul, deskripsi, harga, dan badge program les renang.</p>
        </div>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm" style="border-radius: 0.75rem; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); padding: 0.65rem 1.35rem; font-weight: 700;">
            <i class="fa-solid fa-plus"></i> Tambah Program Baru
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th style="width: 90px;">Gambar</th>
                <th>Judul Program</th>
                <th>Sasaran Peserta</th>
                <th>Harga Mulai</th>
                <th>Badge Label</th>
                <th style="text-align: right; padding-right: 1.5rem;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($programs as $index => $prog)
            <tr>
                <td style="font-weight: 700; color: #64748b;">{{ $index + 1 }}</td>
                <td>
                    <img src="{{ Str::startsWith($prog->image, 'http') ? $prog->image : asset($prog->image) }}" alt="{{ $prog->title }}" style="width: 56px; height: 44px; object-fit: cover; border-radius: 0.65rem; border: 1px solid #e2e8f0;">
                </td>
                <td style="font-weight: 800; color: #0f172a;">{{ $prog->title }}</td>
                <td style="font-size: 0.875rem; color: #475569;">{{ $prog->target_audience }}</td>
                <td style="font-weight: 900; color: #0369a1;">Rp {{ number_format($prog->price_start, 0, ',', '.') }}</td>
                <td>
                    @if($prog->badge)
                        <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">
                            <i class="fa-solid fa-star" style="font-size: 0.7rem;"></i> {{ $prog->badge }}
                        </span>
                    @else
                        <span style="color: #94a3b8;">-</span>
                    @endif
                </td>
                <td style="text-align: right; padding-right: 1.5rem;">
                    <div style="display: inline-flex; gap: 0.5rem; justify-content: flex-end;">
                        <a href="{{ route('admin.programs.edit', $prog->id) }}" class="btn btn-outline btn-sm" style="padding: 0.45rem 0.85rem; border-radius: 0.65rem; border-color: #0284c7; color: #0284c7; font-weight: 700;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.programs.destroy', $prog->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');" style="display: inline;">
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
                <td colspan="7" style="text-align: center; color: #64748b; padding: 3rem;">Belum ada program renang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
