@extends('admin.layout')

@section('title', 'Kelola Galeri Video - Admin Panel')
@section('header_title', 'Kelola Galeri Video Before-After Alumni')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: #64748b;">Total Video: <strong>{{ count($videos) }}</strong></p>
    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Video Baru
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
                <th>Thumbnail</th>
                <th>Judul Siswa</th>
                <th>Embed Video URL</th>
                <th>Badge Status</th>
                <th>Status</th>
                <th>Urutan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videos as $i => $vid)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <div style="width: 70px; height: 95px; border-radius: 0.75rem; overflow: hidden; border: 2px solid #0077b6;">
                        @if($vid->thumbnail)
                            <img src="{{ Str::startsWith($vid->thumbnail, 'http') ? $vid->thumbnail : asset($vid->thumbnail) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: #0077b6; color: white; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-play"></i>
                            </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div style="font-weight: 800; color: #0f172a;">{{ $vid->title }}</div>
                    <div style="font-size: 0.8rem; color: #64748b;">{{ $vid->subtitle }}</div>
                </td>
                <td>
                    <span style="font-size: 0.75rem; font-family: monospace; background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; color: #0284c7;">
                        {{ Str::limit($vid->video_url, 35) }}
                    </span>
                </td>
                <td>
                    <div style="font-size: 0.75rem;">
                        <span style="color: #ef4444; font-weight: 700;">{{ $vid->before_badge }}</span> ➔ 
                        <span style="color: #10b981; font-weight: 700;">{{ $vid->after_badge }}</span>
                    </div>
                </td>
                <td>
                    @if($vid->is_active)
                        <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">Aktif</span>
                    @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">Nonaktif</span>
                    @endif
                </td>
                <td>{{ $vid->order }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.videos.edit', $vid) }}" class="btn btn-outline btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.videos.destroy', $vid) }}" method="POST" onsubmit="return confirm('Yakin hapus video ini?')">
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
                <td colspan="8" style="text-align: center; padding: 3rem; color: #94a3b8;">
                    <i class="fa-solid fa-video-slash" style="font-size: 2rem; margin-bottom: 0.75rem; display: block;"></i>
                    Belum ada video galeri. Klik "Tambah Video Baru".
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
