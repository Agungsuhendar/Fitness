@extends('admin.layout')

@section('title', 'Kelola Tim Pelatih - Admin Panel')
@section('header_title', 'Kelola Tim Pelatih / Instruktur')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: #64748b;">Total Pelatih: <strong>{{ count($coaches) }}</strong></p>
    <a href="{{ route('admin.coaches.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Pelatih Baru
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
                <th>Foto</th>
                <th>Nama Pelatih</th>
                <th>Spesialisasi</th>
                <th>Status</th>
                <th>Urutan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coaches as $i => $coach)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <div style="width: 55px; height: 55px; border-radius: 50%; overflow: hidden; border: 3px solid {{ $coach->color ?? '#0077b6' }};">
                        @if($coach->photo)
                            <img src="{{ Str::startsWith($coach->photo, 'http') ? $coach->photo : asset($coach->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $coach->color ?? '#0077b6' }}; color: white; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.3rem;">
                                {{ strtoupper(substr($coach->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div style="font-weight: 800;">{{ $coach->name }}{{ $coach->title ? ', ' . $coach->title : '' }}</div>
                </td>
                <td><span style="color: {{ $coach->color ?? '#0077b6' }}; font-weight: 700; font-size: 0.85rem;">{{ $coach->specialty }}</span></td>
                <td>
                    @if($coach->is_active)
                        <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">Aktif</span>
                    @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">Nonaktif</span>
                    @endif
                </td>
                <td>{{ $coach->order }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.coaches.edit', $coach) }}" class="btn btn-outline btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.coaches.destroy', $coach) }}" method="POST" onsubmit="return confirm('Yakin hapus data pelatih ini?')">
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
                    <i class="fa-solid fa-user-slash" style="font-size: 2rem; margin-bottom: 0.75rem; display: block;"></i>
                    Belum ada data pelatih. Klik "Tambah Pelatih Baru" untuk menambahkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
