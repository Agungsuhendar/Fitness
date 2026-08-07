@extends('admin.layout')

@section('title', 'Kelola Keunggulan - Admin Panel')
@section('header_title', 'Kelola "Mengapa Memilih Kami" (Keunggulan)')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: #64748b;">Total Poin Keunggulan: <strong>{{ count($features) }}</strong></p>
    <a href="{{ route('admin.features.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Keunggulan Baru
    </a>
</div>

@if(session('success'))
    <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.5rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<div class="admin-card" style="padding: 0; overflow: hidden;">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Icon</th>
                <th>Judul Keunggulan</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Urutan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($features as $i => $feat)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <div style="width: 46px; height: 46px; background: {{ $feat->color }}18; color: {{ $feat->color }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                        <i class="{{ $feat->icon }}"></i>
                    </div>
                </td>
                <td>
                    <div style="font-weight: 800; color: #ffffff;">{{ $feat->title }}</div>
                </td>
                <td style="max-width: 300px;">
                    <div style="font-size: 0.85rem; color: #64748b;">{{ $feat->description }}</div>
                </td>
                <td>
                    @if($feat->is_active)
                        <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">Aktif</span>
                    @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">Nonaktif</span>
                    @endif
                </td>
                <td>{{ $feat->order }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.features.edit', $feat) }}" class="btn btn-outline btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.features.destroy', $feat) }}" method="POST" onsubmit="return confirm('Yakin hapus keunggulan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 3rem; color: #94a3b8;">
                    <i class="fa-solid fa-star-half-stroke" style="font-size: 2rem; margin-bottom: 0.75rem; display: block;"></i>
                    Belum ada data keunggulan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
