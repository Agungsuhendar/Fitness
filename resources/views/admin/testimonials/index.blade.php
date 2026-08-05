@extends('admin.layout')

@section('title', 'Kelola Testimoni - Admin Panel')
@section('header_title', 'Kelola Testimoni Peserta')

@section('admin_content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: #64748b;">Total Testimoni: <strong>{{ count($testimonials) }}</strong> ({{ $testimonials->where('is_approved', true)->count() }} disetujui, {{ $testimonials->where('is_approved', false)->count() }} menunggu)</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Testimoni
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
                <th>Avatar</th>
                <th>Nama</th>
                <th>Program</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $i => $testi)
            <tr style="{{ !$testi->is_approved ? 'background: #fffbeb;' : '' }}">
                <td>{{ $i + 1 }}</td>
                <td>
                    <div style="width: 45px; height: 45px; border-radius: 50%; overflow: hidden; border: 2px solid {{ $testi->is_approved ? '#22c55e' : '#f59e0b' }};">
                        @if($testi->avatar)
                            <img src="{{ Str::startsWith($testi->avatar, 'http') ? $testi->avatar : asset($testi->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.1rem;">
                                {{ strtoupper(substr($testi->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div style="font-weight: 800;">{{ $testi->name }}</div>
                    <div style="font-size: 0.8rem; color: #64748b;">{{ Str::limit($testi->review, 50) }}</div>
                </td>
                <td><span style="font-size: 0.85rem;">{{ $testi->program }}</span></td>
                <td>
                    @for($s = 0; $s < $testi->rating; $s++)
                        <i class="fa-solid fa-star" style="color: #f59e0b; font-size: 0.75rem;"></i>
                    @endfor
                </td>
                <td>
                    @if($testi->is_approved)
                        <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">✅ Disetujui</span>
                    @else
                        <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800;">⏳ Menunggu</span>
                    @endif
                </td>
                <td style="font-size: 0.8rem; color: #64748b;">{{ $testi->created_at ? $testi->created_at->format('d M Y') : '-' }}</td>
                <td>
                    <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                        <form action="{{ route('admin.testimonials.toggle-approve', $testi) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm" style="background: {{ $testi->is_approved ? '#fef3c7' : '#dcfce7' }}; color: {{ $testi->is_approved ? '#92400e' : '#166534' }}; border: 1px solid {{ $testi->is_approved ? '#fbbf24' : '#86efac' }}; font-size: 0.7rem;">
                                {{ $testi->is_approved ? '⏸ Reject' : '✅ Approve' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.testimonials.edit', $testi) }}" class="btn btn-outline btn-sm" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testi) }}" method="POST" onsubmit="return confirm('Yakin hapus testimoni ini?')" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; font-size: 0.7rem;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 3rem; color: #94a3b8;">
                    <i class="fa-solid fa-comment-slash" style="font-size: 2rem; margin-bottom: 0.75rem; display: block;"></i>
                    Belum ada data testimoni.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
