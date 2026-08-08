@extends('admin.layout')

@section('title', 'Workout Tracker & Rest Timer Logs')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-dumbbell text-lime me-2"></i>Workout Logs Member
            </h3>
            <p class="text-secondary small mb-0">Pantau riwayat latihan, repetisi set, total beban (kg), dan progres workout member secara real-time dari Mobile App.</p>
        </div>
    </div>

    <!-- Summary Metrics Badges -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(163, 230, 53, 0.15); color: #a3e635;">
                        <i class="fa-solid fa-fire-flame-curved fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total Sesi Workout Selesai</span>
                        <h4 class="fw-black text-white mb-0 mt-1">{{ number_format($totalSessionsAll) }} Sesi</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(250, 204, 21, 0.15); color: #facc15;">
                        <i class="fa-solid fa-weight-hanging fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total Volume Beban Diangkat</span>
                        <h4 class="fw-black text-warning mb-0 mt-1">{{ number_format($totalVolumeAll, 0) }} kg</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(6, 182, 212, 0.15); color: #06b6d4;">
                        <i class="fa-solid fa-mobile-screen-button fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Status Sync Mobile Tracker</span>
                        <h4 class="fw-black text-info mb-0 mt-1">Aktif Sync 🚀</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="admin-card p-3 mb-4 rounded-4">
        <form method="GET" action="{{ route('admin.workout_logs.index') }}" class="row g-2">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control bg-dark text-white border-secondary" placeholder="Cari nama member atau nama latihan (misal: Hypertrophy Day, Bench Press)..." value="{{ $search }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-lime text-dark fw-bold w-100"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                @if($search)
                    <a href="{{ route('admin.workout_logs.index') }}" class="btn btn-outline-secondary text-white"><i class="fa-solid fa-rotate-left"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Logs Table -->
    <div class="admin-card rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="table-dark text-secondary small text-uppercase" style="border-bottom: 2px solid #1e293b;">
                    <tr>
                        <th class="ps-4">No / Tanggal</th>
                        <th>Member</th>
                        <th>Nama Sesi Workout</th>
                        <th>Durasi</th>
                        <th>Volume Beban</th>
                        <th>Set Selesai</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-secondary mb-1">#{{ $logs->firstItem() + $index }}</span>
                                <div class="small text-secondary">{{ $log->workout_date ? $log->workout_date->format('d M Y') : $log->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $log->member_name }}</div>
                                <div class="small text-secondary">{{ $log->user ? $log->user->email : 'Mobile Member' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-dark border border-success text-lime px-2 py-1 fs-6">
                                    <i class="fa-solid fa-bolt me-1"></i> {{ $log->workout_name }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-semibold text-info"><i class="fa-regular fa-clock me-1"></i> {{ $log->formatted_duration }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-warning">{{ number_format($log->total_volume_kg, 0) }} kg</span>
                            </td>
                            <td>
                                <span class="badge bg-success text-dark fw-bold px-2 py-1">
                                    {{ $log->completed_sets_count }} / {{ $log->total_sets_count }} Set
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <form action="{{ route('admin.workout_logs.destroy', $log->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus log workout ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Log"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <i class="fa-solid fa-dumbbell fa-3x mb-3 opacity-50"></i>
                                <p class="mb-0 fs-6">Belum ada riwayat workout log tersimpan di server.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="p-3 border-top border-secondary">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
