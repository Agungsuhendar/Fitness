@extends('admin.layout')

@section('title', 'Kelola Paket Keanggotaan Gym Fleksibel')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-id-card text-lime me-2"></i>Kelola Paket Keanggotaan Gym (Membership Plans)
            </h3>
            <p class="text-secondary small mb-0">Atur paket keanggotaan fleksibel (Daily Pass, Regular, VIP All-Access, Sesi PT, Student Pass, & Corporate) secara real-time.</p>
        </div>
        <div>
            <button type="button" class="btn btn-lime text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalAddPlan">
                <i class="fa-solid fa-plus me-1"></i> Tambah Paket Keanggotaan
            </button>
        </div>
    </div>

    <!-- Plans Cards Grid -->
    <div class="row g-4 mb-4">
        @forelse($plans as $plan)
            @php
                $categoryBadgeColor = match($plan->category) {
                    'daily' => 'info',
                    'monthly' => 'success',
                    'vip' => 'warning',
                    'pt_private' => 'danger',
                    'student' => 'primary',
                    'corporate' => 'secondary',
                    default => 'lime'
                };
            @endphp
            <div class="col-12 col-md-6 col-xl-4">
                <div class="admin-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between border border-secondary" style="background: #111827;">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-{{ $categoryBadgeColor }} text-dark fw-bold px-2 py-1 small">
                                {{ strtoupper($plan->category) }} PASS
                            </span>
                            @if($plan->badge)
                                <span class="badge bg-dark border border-warning text-warning fw-bold px-2 py-1 small">
                                    {{ $plan->badge }}
                                </span>
                            @endif
                        </div>

                        <h4 class="fw-bold text-white mb-1 mt-2">{{ $plan->name }}</h4>
                        <p class="text-secondary small mb-3">{{ $plan->description ?: 'Paket latihan fleksibel FitLife Gym.' }}</p>

                        <!-- Price Tag Box -->
                        <div class="p-3 bg-dark rounded-3 border border-secondary mb-3">
                            <div class="small text-secondary fw-semibold">Harga Keanggotaan:</div>
                            <div class="d-flex align-items-baseline gap-2 mt-1">
                                @if($plan->promo_price)
                                    <h4 class="fw-black text-lime mb-0">Rp {{ number_format($plan->promo_price) }}</h4>
                                    <span class="text-secondary text-decoration-line-through small">Rp {{ number_format($plan->price) }}</span>
                                @else
                                    <h4 class="fw-black text-white mb-0">Rp {{ number_format($plan->price) }}</h4>
                                @endif
                            </div>
                            <div class="mt-1 small text-info">
                                <i class="fa-solid fa-clock me-1"></i> Masa Aktif: {{ $plan->duration_days }} Hari
                                @if($plan->session_count)
                                    • ({{ $plan->session_count }} Sesi PT)
                                @endif
                            </div>
                        </div>

                        <!-- Features List -->
                        <div class="mb-3">
                            <span class="text-secondary small fw-bold text-uppercase">Manfaat & Fasilitas:</span>
                            <ul class="list-unstyled mt-2 mb-0 small">
                                @if(is_array($plan->features))
                                    @foreach($plan->features as $feature)
                                        <li class="text-white mb-1"><i class="fa-solid fa-check text-lime me-2"></i> {{ $feature }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-3 border-top border-secondary d-flex gap-2 justify-content-between align-items-center">
                        <form action="{{ route('admin.membership_plans.toggle-active', $plan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @if($plan->is_active)
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Nonaktifkan Paket"><i class="fa-solid fa-toggle-on me-1"></i> Aktif</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-outline-secondary" title="Aktifkan Paket"><i class="fa-solid fa-toggle-off me-1"></i> Nonaktif</button>
                            @endif
                        </form>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditPlan{{ $plan->id }}">
                                <i class="fa-solid fa-pen me-1"></i> Edit
                            </button>
                            <form action="{{ route('admin.membership_plans.destroy', $plan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus paket keanggotaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Plan -->
            <div class="modal fade" id="modalEditPlan{{ $plan->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-dark border border-secondary text-white">
                        <form action="{{ route('admin.membership_plans.update', $plan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Paket Keanggotaan</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-start">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label small text-secondary">Nama Paket Keanggotaan</label>
                                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ $plan->name }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small text-secondary">Kategori Paket</label>
                                        <select name="category" class="form-select bg-dark text-white border-secondary" required>
                                            <option value="daily" {{ $plan->category === 'daily' ? 'selected' : '' }}>Daily Pass Harian</option>
                                            <option value="monthly" {{ $plan->category === 'monthly' ? 'selected' : '' }}>Regular Bulanan</option>
                                            <option value="vip" {{ $plan->category === 'vip' ? 'selected' : '' }}>VIP All-Access</option>
                                            <option value="pt_private" {{ $plan->category === 'pt_private' ? 'selected' : '' }}>Personal Trainer Sesi</option>
                                            <option value="student" {{ $plan->category === 'student' ? 'selected' : '' }}>Student Pass Mahasiswa</option>
                                            <option value="corporate" {{ $plan->category === 'corporate' ? 'selected' : '' }}>Corporate Company Pass</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-secondary">Harga Normal (Rp)</label>
                                        <input type="number" name="price" class="form-control bg-dark text-white border-secondary" value="{{ $plan->price }}" min="0" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small text-secondary">Harga Promo / Diskon (Rp, Kosongkan jika tidak ada)</label>
                                        <input type="number" name="promo_price" class="form-control bg-dark text-white border-secondary" value="{{ $plan->promo_price }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small text-secondary">Masa Aktif (Hari)</label>
                                        <input type="number" name="duration_days" class="form-control bg-dark text-white border-secondary" value="{{ $plan->duration_days }}" min="1" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small text-secondary">Jumlah Sesi PT (Khusus Paket PT)</label>
                                        <input type="number" name="session_count" class="form-control bg-dark text-white border-secondary" value="{{ $plan->session_count }}" placeholder="Misal: 10">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small text-secondary">Lencana Promo Badge</label>
                                        <input type="text" name="badge" class="form-control bg-dark text-white border-secondary" value="{{ $plan->badge }}" placeholder="Misal: ⚡ Paling Laris">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small text-secondary">Deskripsi Singkat Paket</label>
                                        <input type="text" name="description" class="form-control bg-dark text-white border-secondary" value="{{ $plan->description }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small text-secondary">Daftar Manfaat & Fasilitas (Satu fasilitas per baris)</label>
                                        <textarea name="features_text" class="form-control bg-dark text-white border-secondary" rows="4">{{ is_array($plan->features) ? implode("\n", $plan->features) : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-lime text-dark fw-bold">Simpan Perubahan 🚀</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-secondary">
                <i class="fa-solid fa-id-card fa-3x mb-3 opacity-50"></i>
                <p class="mb-0 fs-6">Belum ada paket keanggotaan terdaftar.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal Add Plan -->
    <div class="modal fade" id="modalAddPlan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border border-secondary text-white">
                <form action="{{ route('admin.membership_plans.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-plus me-2"></i>Tambah Paket Keanggotaan Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small text-secondary">Nama Paket Keanggotaan</label>
                                <input type="text" name="name" class="form-control bg-dark text-white border-secondary" placeholder="Misal: Paket Platinum Unlimited 6 Bulan" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Kategori Paket</label>
                                <select name="category" class="form-select bg-dark text-white border-secondary" required>
                                    <option value="daily">Daily Pass Harian</option>
                                    <option value="monthly" selected>Regular Bulanan</option>
                                    <option value="vip">VIP All-Access</option>
                                    <option value="pt_private">Personal Trainer Sesi</option>
                                    <option value="student">Student Pass Mahasiswa</option>
                                    <option value="corporate">Corporate Company Pass</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Harga Normal (Rp)</label>
                                <input type="number" name="price" class="form-control bg-dark text-white border-secondary" placeholder="350000" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Harga Promo / Diskon (Rp, Kosongkan jika tidak ada)</label>
                                <input type="number" name="promo_price" class="form-control bg-dark text-white border-secondary" placeholder="299000">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Masa Aktif (Hari)</label>
                                <input type="number" name="duration_days" class="form-control bg-dark text-white border-secondary" value="30" min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Jumlah Sesi PT (Khusus Paket PT)</label>
                                <input type="number" name="session_count" class="form-control bg-dark text-white border-secondary" placeholder="Misal: 10">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Lencana Promo Badge</label>
                                <input type="text" name="badge" class="form-control bg-dark text-white border-secondary" placeholder="Misal: 🔥 Diskon 20%">
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-secondary">Deskripsi Singkat Paket</label>
                                <input type="text" name="description" class="form-control bg-dark text-white border-secondary" placeholder="Akses unlimited ke seluruh fasilitas gym...">
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-secondary">Daftar Manfaat & Fasilitas (Satu fasilitas per baris)</label>
                                <textarea name="features_text" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Akses Seluruh Alat Gym&#10;Free Locker Room&#10;Akses Semua Cabang"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-lime text-dark fw-bold">Tambah Paket 💳</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
