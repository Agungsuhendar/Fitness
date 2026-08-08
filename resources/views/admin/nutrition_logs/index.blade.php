@extends('admin.layout')

@section('title', 'Nutrition & AI Meal Scanner Logs')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-utensils text-lime me-2"></i>Nutrition & AI Meal Scanner Logs
            </h3>
            <p class="text-secondary small mb-0">Pantau catatan kalori harian, makronutrisi (Protein, Karbo, Lemak), dan hasil foto AI Meal Scan milik member.</p>
        </div>
    </div>

    <!-- Summary Metrics Badges -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(163, 230, 53, 0.15); color: #a3e635;">
                        <i class="fa-solid fa-fire fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total Kalori Tercatat</span>
                        <h4 class="fw-black text-white mb-0 mt-1">{{ number_format($totalCaloriesAll) }} kcal</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(6, 182, 212, 0.15); color: #06b6d4;">
                        <i class="fa-solid fa-drumstick-bite fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total Asupan Protein</span>
                        <h4 class="fw-black text-info mb-0 mt-1">{{ number_format($totalProteinAll) }} gram</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(168, 85, 247, 0.15); color: #a855f7;">
                        <i class="fa-solid fa-wand-magic-sparkles fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total AI Vision Scans</span>
                        <h4 class="fw-black text-purple mb-0 mt-1" style="color: #c084fc;">{{ number_format($totalAiScansAll) }} Makanan 🤖</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="admin-card p-3 mb-4 rounded-4">
        <form method="GET" action="{{ route('admin.nutrition_logs.index') }}" class="row g-2">
            <div class="col-md-7">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control bg-dark text-white border-secondary" placeholder="Cari nama member atau menu makanan (misal: Dada Ayam, Steak, Salmon)..." value="{{ $search }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select bg-dark text-white border-secondary">
                    <option value="">-- Semua Sumber --</option>
                    <option value="ai" {{ $filterType === 'ai' ? 'selected' : '' }}>🤖 AI Vision Scan Only</option>
                    <option value="manual" {{ $filterType === 'manual' ? 'selected' : '' }}>✏️ Manual Entry Only</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-lime text-dark fw-bold w-100"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                @if($search || $filterType)
                    <a href="{{ route('admin.nutrition_logs.index') }}" class="btn btn-outline-secondary text-white"><i class="fa-solid fa-rotate-left"></i></a>
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
                        <th>Menu Makanan</th>
                        <th>Kategori</th>
                        <th>Kalori (kcal)</th>
                        <th>Makronutrisi (P / C / F)</th>
                        <th>Sumber</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-secondary mb-1">#{{ $logs->firstItem() + $index }}</span>
                                <div class="small text-secondary">{{ $log->log_date ? $log->log_date->format('d M Y') : $log->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $log->member_name }}</div>
                                <div class="small text-secondary">{{ $log->user ? $log->user->email : 'Mobile Member' }}</div>
                            </td>
                            <td>
                                <div class="fw-bold text-white fs-6">{{ $log->meal_name }}</div>
                            </td>
                            <td>
                                <span class="badge bg-dark border border-secondary text-secondary px-2 py-1">
                                    {{ $log->meal_type }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-warning fs-6"><i class="fa-solid fa-fire text-warning me-1"></i> {{ number_format($log->calories) }} kcal</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <span class="badge bg-success text-dark fw-bold">P: {{ $log->protein }}g</span>
                                    <span class="badge bg-info text-dark fw-bold">C: {{ $log->carbs }}g</span>
                                    <span class="badge bg-warning text-dark fw-bold">F: {{ $log->fat }}g</span>
                                </div>
                            </td>
                            <td>
                                @if($log->is_ai_scanned)
                                    <span class="badge bg-purple-subtle text-purple border border-purple px-2 py-1" style="background: rgba(168, 85, 247, 0.2); color: #c084fc; border-color: #c084fc;">
                                        <i class="fa-solid fa-robot me-1"></i> AI Vision {{ $log->ai_confidence ? '(' . $log->ai_confidence . ')' : '' }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-2 py-1">
                                        <i class="fa-solid fa-keyboard me-1"></i> Manual
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <form action="{{ route('admin.nutrition_logs.destroy', $log->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus catatan makanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Log"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-secondary">
                                <i class="fa-solid fa-utensils fa-3x mb-3 opacity-50"></i>
                                <p class="mb-0 fs-6">Belum ada catatan nutrisi / AI meal scan tersimpan di server.</p>
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
