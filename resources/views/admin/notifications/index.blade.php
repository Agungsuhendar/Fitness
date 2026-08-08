@extends('admin.layout')

@section('title', 'Pusat Notifikasi & Push Broadcast Member')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-bell text-lime me-2"></i>Pusat Notifikasi & Push Broadcast Member
            </h3>
            <p class="text-secondary small mb-0">Kirim pengumuman massal, info promo gym, pengingat latihan, dan kelola riwayat notifikasi ke aplikasi mobile member.</p>
        </div>
        <div>
            <button type="button" class="btn btn-lime text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalSendBroadcast">
                <i class="fa-solid fa-paper-plane me-1"></i> Kirim Broadcast Notifikasi
            </button>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(163, 230, 53, 0.15); color: #a3e635;">
                        <i class="fa-solid fa-paper-plane fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total Broadcast Terkirim</span>
                        <h4 class="fw-black text-white mb-0 mt-1">{{ number_format($totalSent) }} Notifikasi</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(244, 63, 94, 0.15); color: #f43f5e;">
                        <i class="fa-solid fa-envelope-open-text fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Status Notifikasi Belum Dibaca</span>
                        <h4 class="fw-black text-danger mb-0 mt-1">{{ number_format($unreadTotal) }} Unread</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(168, 85, 247, 0.15); color: #a855f7;">
                        <i class="fa-solid fa-mobile-screen-button fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Status Push Engine</span>
                        <h4 class="fw-black text-purple mb-0 mt-1" style="color: #c084fc;">Mobile Sync Active 🚀</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Table -->
    <div class="admin-card rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="table-dark text-secondary small text-uppercase" style="border-bottom: 2px solid #1e293b;">
                    <tr>
                        <th class="ps-4">No / Tanggal</th>
                        <th>Target Member</th>
                        <th>Judul Notifikasi</th>
                        <th>Pesan Notifikasi</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $index => $notif)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-secondary mb-1">#{{ $notifications->firstItem() + $index }}</span>
                                <div class="small text-secondary">{{ $notif->created_at ? $notif->created_at->format('d M Y H:i') : 'Baru saja' }}</div>
                            </td>
                            <td>
                                @if($notif->user)
                                    <div class="fw-bold text-white">{{ $notif->user->name }}</div>
                                    <div class="small text-secondary">{{ $notif->user->email }}</div>
                                @else
                                    <span class="badge bg-lime text-dark fw-bold px-2 py-1"><i class="fa-solid fa-users me-1"></i> Seluruh Member (Broadcast)</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-white fs-6">{{ $notif->title }}</div>
                            </td>
                            <td>
                                <div class="small text-secondary" style="max-width: 300px;">{{ $notif->message }}</div>
                            </td>
                            <td>
                                <span class="badge bg-dark border border-secondary text-secondary px-2 py-1">
                                    {{ ucfirst($notif->category) }}
                                </span>
                            </td>
                            <td>
                                @if($notif->is_read)
                                    <span class="badge bg-success text-dark fw-bold px-2 py-1"><i class="fa-solid fa-check-double me-1"></i> Dibaca</span>
                                @else
                                    <span class="badge bg-warning text-dark fw-bold px-2 py-1"><i class="fa-solid fa-clock me-1"></i> Belum Dibaca</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <form action="{{ route('admin.notifications.destroy', $notif->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus notifikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Notifikasi"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <i class="fa-solid fa-bell-slash fa-3x mb-3 opacity-50"></i>
                                <p class="mb-0 fs-6">Belum ada notifikasi atau pesan broadcast terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($notifications->hasPages())
            <div class="p-3 border-top border-secondary">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Send Broadcast -->
    <div class="modal fade" id="modalSendBroadcast" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border border-secondary text-white">
                <form action="{{ route('admin.notifications.send') }}" method="POST">
                    @csrf
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-paper-plane me-2"></i>Kirim Push Broadcast Notifikasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Judul Notifikasi</label>
                            <input type="text" name="title" class="form-control bg-dark text-white border-secondary" placeholder="Misal: 📢 Pengumuman Gym Libur Idul Fitri" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Kategori Notifikasi</label>
                            <select name="category" class="form-select bg-dark text-white border-secondary" required>
                                <option value="workout">🏋️ Pengingat Latihan (Workout Alert)</option>
                                <option value="hydration">💧 Pengingat Hidrasi Air Putih</option>
                                <option value="reward">🏆 Bonus Poin XP & Reward</option>
                                <option value="announcement">📢 Pengumuman / Event Gym</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Pesan Lengkap Notifikasi</label>
                            <textarea name="message" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Tuliskan pesan notifikasi yang akan diterima seluruh member di aplikasi HP..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-lime text-dark fw-bold">Kirim Broadcast 🚀</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
