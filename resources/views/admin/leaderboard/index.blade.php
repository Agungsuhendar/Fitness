@extends('admin.layout')

@section('title', 'Klasemen Leaderboard XP & Reward Member')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-trophy text-warning me-2"></i>Leaderboard XP & Reward Points Member
            </h3>
            <p class="text-secondary small mb-0">Kelola poin XP member, klasemen peringkat gym, lencana kehormatan (Badges), dan pemberian bonus poin tantangan.</p>
        </div>
    </div>

    <!-- Summary Metrics Badges -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(250, 204, 21, 0.15); color: #facc15;">
                        <i class="fa-solid fa-crown fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Peringkat #1 Gym King Saat Ini</span>
                        <h4 class="fw-black text-warning mb-0 mt-1">{{ $topKing ? $topKing->name : 'Daffa Pratama' }}</h4>
                        <span class="badge bg-dark border border-warning text-warning mt-1">{{ $topKing ? number_format($topKing->reward_points) : '4,850' }} XP</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(163, 230, 53, 0.15); color: #a3e635;">
                        <i class="fa-solid fa-star fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Total Poin XP Berjalan</span>
                        <h4 class="fw-black text-lime mb-0 mt-1">{{ number_format($totalXpSum ?: 18950) }} XP</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="admin-card p-3 rounded-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3" style="background: rgba(6, 182, 212, 0.15); color: #06b6d4;">
                        <i class="fa-solid fa-award fa-2x"></i>
                    </div>
                    <div>
                        <span class="text-secondary small fw-semibold">Status Gamifikasi System</span>
                        <h4 class="fw-black text-info mb-0 mt-1">Aktif Auto XP ⚡</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Card -->
    <div class="admin-card p-3 mb-4 rounded-4">
        <form method="GET" action="{{ route('admin.leaderboard.index') }}" class="row g-2">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control bg-dark text-white border-secondary" placeholder="Cari nama member, email, atau ID member..." value="{{ $search }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-lime text-dark fw-bold w-100"><i class="fa-solid fa-filter me-1"></i> Cari Member</button>
                @if($search)
                    <a href="{{ route('admin.leaderboard.index') }}" class="btn btn-outline-secondary text-white"><i class="fa-solid fa-rotate-left"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Rankings Table -->
    <div class="admin-card rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="table-dark text-secondary small text-uppercase" style="border-bottom: 2px solid #1e293b;">
                    <tr>
                        <th class="ps-4">Rank</th>
                        <th>Member</th>
                        <th>ID Member</th>
                        <th>Level Lencana (Badge)</th>
                        <th>Streak Gym</th>
                        <th>Total Poin XP</th>
                        <th class="pe-4 text-end">Beri Bonus XP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $index => $member)
                        <tr>
                            <td class="ps-4">
                                @if(($members->firstItem() + $index) == 1)
                                    <span class="fs-4">🥇</span>
                                @elseif(($members->firstItem() + $index) == 2)
                                    <span class="fs-4">🥈</span>
                                @elseif(($members->firstItem() + $index) == 3)
                                    <span class="fs-4">🥉</span>
                                @else
                                    <span class="badge bg-secondary">#{{ $members->firstItem() + $index }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-white fs-6">{{ $member->name }}</div>
                                <div class="small text-secondary">{{ $member->email }}</div>
                            </td>
                            <td>
                                <code class="text-lime fw-bold">{{ $member->member_card_id ?? 'FL-MBR-' . $member->id }}</code>
                            </td>
                            <td>
                                <span class="badge bg-dark border border-warning text-warning px-2 py-1 fs-6">
                                    {{ $member->level_badge ?? '🔥 VIP Platinum' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-danger fw-bold"><i class="fa-solid fa-fire text-danger me-1"></i> {{ $member->streak_days ?? 14 }} Hari</span>
                            </td>
                            <td>
                                <span class="fw-black text-warning fs-5">{{ number_format($member->reward_points ?? 50) }} XP</span>
                            </td>
                            <td class="pe-4 text-end">
                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalBonusXp{{ $member->id }}">
                                    <i class="fa-solid fa-gift me-1"></i> +Bonus XP
                                </button>

                                <!-- Modal Bonus XP -->
                                <div class="modal fade" id="modalBonusXp{{ $member->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark border border-secondary text-white text-start">
                                            <form action="{{ route('admin.leaderboard.add-xp', $member->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-secondary">
                                                    <h5 class="modal-title fw-bold text-warning"><i class="fa-solid fa-award me-2"></i>Beri Bonus XP ke {{ $member->name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label small text-secondary">Jumlah Bonus XP Points</label>
                                                        <input type="number" name="bonus_xp" class="form-control bg-dark text-white border-secondary" value="100" min="1" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small text-secondary">Alasan / Nama Tantangan Challenge</label>
                                                        <input type="text" name="reason" class="form-control bg-dark text-white border-secondary" placeholder="Misal: Juara 1 Challenge Bench Press 100KG">
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-secondary">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning text-dark fw-bold">Tambah Bonus XP 🏆</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <i class="fa-solid fa-trophy fa-3x mb-3 opacity-50"></i>
                                <p class="mb-0 fs-6">Belum ada data member untuk klasemen leaderboard.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($members->hasPages())
            <div class="p-3 border-top border-secondary">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
