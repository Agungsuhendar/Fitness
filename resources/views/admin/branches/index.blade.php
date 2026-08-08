@extends('admin.layout')

@section('title', 'Branch Locator & Crowd Meter Cabang Gym')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-location-dot text-lime me-2"></i>Branch Locator & Live Crowd Meter
            </h3>
            <p class="text-secondary small mb-0">Kelola lokasi cabang FitLife Gym, kapasitas maksimum area gym, dan update indikator keramaian (Live Crowd Gauge) real-time.</p>
        </div>
        <div>
            <button type="button" class="btn btn-lime text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalAddBranch">
                <i class="fa-solid fa-plus me-1"></i> Tambah Cabang Baru
            </button>
        </div>
    </div>

    <!-- Branches Cards Grid -->
    <div class="row g-4 mb-4">
        @forelse($branches as $branch)
            @php
                $pct = $branch->max_capacity > 0 ? round(($branch->current_capacity / $branch->max_capacity) * 100) : 35;
                $statusColor = $pct >= 80 ? 'danger' : ($pct >= 50 ? 'warning' : 'lime');
                $statusHex = $pct >= 80 ? '#f43f5e' : ($pct >= 50 ? '#facc15' : '#a3e635');
            @endphp
            <div class="col-12 col-md-6 col-xl-4">
                <div class="admin-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-dark border border-secondary text-secondary mb-1"><i class="fa-solid fa-city me-1"></i> {{ $branch->city }}</span>
                                <h4 class="fw-bold text-white mb-0">{{ $branch->name }}</h4>
                            </div>
                            <span class="badge bg-{{ $statusColor }} text-dark fw-bold px-2 py-1 fs-6" style="background-color: {{ $statusHex }} !important;">
                                {{ $pct }}% Crowd
                            </span>
                        </div>

                        <p class="text-secondary small mb-3"><i class="fa-solid fa-map-pin me-1 text-danger"></i> {{ $branch->address }}</p>

                        <!-- Live Crowd Gauge Bar -->
                        <div class="p-3 bg-dark rounded-3 border border-secondary mb-3">
                            <div class="d-flex justify-content-between align-items-center small mb-2">
                                <span class="text-secondary fw-semibold">Live Member Saat Ini:</span>
                                <span class="fw-bold text-white fs-6">{{ $branch->current_capacity }} / {{ $branch->max_capacity }} Orang</span>
                            </div>
                            <div class="progress bg-secondary" style="height: 10px;">
                                <div class="progress-bar bg-{{ $statusColor }}" role="progressbar" style="width: {{ $pct }}%; background-color: {{ $statusHex }} !important;" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-2 text-end">
                                <span class="small fw-bold" style="color: {{ $statusHex }};">{{ $branch->crowd_status }}</span>
                            </div>
                        </div>

                        <!-- Info Pills -->
                        <div class="small text-secondary mb-2">
                            <i class="fa-solid fa-clock me-1 text-lime"></i> Jam Operasional: <strong class="text-white">{{ $branch->hours }}</strong>
                        </div>
                        <div class="small text-secondary mb-3">
                            <i class="fa-solid fa-phone me-1 text-info"></i> Telepon: <strong class="text-white">{{ $branch->phone }}</strong>
                        </div>
                    </div>

                    <!-- Action Update Crowd Button -->
                    <div class="pt-3 border-top border-secondary">
                        <button type="button" class="btn btn-outline-lime w-100 btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalUpdateCrowd{{ $branch->id }}">
                            <i class="fa-solid fa-gauge-high me-1"></i> Update Capacity Realtime
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Update Crowd -->
            <div class="modal fade" id="modalUpdateCrowd{{ $branch->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark border border-secondary text-white">
                        <form action="{{ route('admin.branches.update-crowd', $branch->id) }}" method="POST">
                            @csrf
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-sliders me-2"></i>Update Crowd Gauge {{ $branch->name }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label small text-secondary">Jumlah Member di Dalam Gym Saat Ini</label>
                                    <input type="number" name="current_capacity" class="form-control bg-dark text-white border-secondary" value="{{ $branch->current_capacity }}" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small text-secondary">Kapasitas Maksimum Cabang (Orang)</label>
                                    <input type="number" name="max_capacity" class="form-control bg-dark text-white border-secondary" value="{{ $branch->max_capacity }}" min="10" required>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-lime text-dark fw-bold">Simpan Real-time 🚀</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-secondary">
                <i class="fa-solid fa-building-circle-xmark fa-3x mb-3 opacity-50"></i>
                <p class="mb-0 fs-6">Belum ada lokasi cabang gym terdaftar.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal Add Branch -->
    <div class="modal fade" id="modalAddBranch" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border border-secondary text-white">
                <form action="{{ route('admin.branches.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-plus me-2"></i>Tambah Cabang Gym Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Nama Cabang</label>
                            <input type="text" name="name" class="form-control bg-dark text-white border-secondary" placeholder="Misal: FitLife Gym Malioboro HQ" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Kota / Wilayah</label>
                            <input type="text" name="city" class="form-control bg-dark text-white border-secondary" placeholder="Misal: Yogyakarta" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Alamat Lengkap</label>
                            <textarea name="address" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Jl. Malioboro No. 12..." required></textarea>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Jam Operasional</label>
                                <input type="text" name="hours" class="form-control bg-dark text-white border-secondary" value="24 Jam Nonstop">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Kapasitas Maksimum</label>
                                <input type="number" name="max_capacity" class="form-control bg-dark text-white border-secondary" value="80" min="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-lime text-dark fw-bold">Tambah Cabang 🏢</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
