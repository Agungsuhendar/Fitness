@extends('admin.layout')

@section('title', 'Kelola Data Member & Top-Up Kuota | Admin FitLife Center')
@section('header_title', 'Manajemen Member & Top-Up Kuota Sesi')

@section('admin_content')
<div style="width: 100%;">
    
    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                Manajemen Member &amp; Top-Up Kuota Sesi
            </h1>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0.25rem 0 0;">
                Kelola akun member, status keanggotaan, penugasan Coach PT, dan penambahan kuota sesi latihan.
            </p>
        </div>

        <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <div style="background: rgba(132,204,22,0.12); border: 1.5px solid #84cc16; padding: 0.5rem 1.15rem; border-radius: 0.85rem; text-align: right;">
                <span style="font-size: 0.7rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">TOTAL MEMBER</span>
                <div style="font-size: 1.25rem; font-weight: 900; color: white;">{{ $totalMembers }} Member</div>
            </div>
            <div style="background: rgba(56,189,248,0.12); border: 1.5px solid #38bdf8; padding: 0.5rem 1.15rem; border-radius: 0.85rem; text-align: right;">
                <span style="font-size: 0.7rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">KUOTA SESI AKTIF</span>
                <div style="font-size: 1.25rem; font-weight: 900; color: white;">{{ $totalActiveSessions }} Sesi</div>
            </div>
            <a href="{{ route('admin.members.create') }}" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907; border-radius: 0.85rem; font-weight: 900; padding: 0.75rem 1.25rem; font-size: 0.875rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.3);">
                <i class="fa-solid fa-user-plus"></i> + Member Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(132, 204, 22, 0.15); border: 1px solid rgba(132, 204, 22, 0.4); border-radius: 0.85rem; padding: 0.85rem 1.25rem; margin-bottom: 1.5rem; color: #bef264; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filter & Search Bar -->
    <div style="background: #0d1310; border: 1px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem; margin-bottom: 1.5rem;">
        <form method="GET" action="{{ route('admin.members.index') }}" style="display: flex; gap: 1rem; align-items: center;">
            <div style="position: relative; flex: 1;">
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama member, email, nomor WA, atau ID Member (e.g. FL-MBR-7782)..."
                    style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.85rem; padding: 0.75rem 1rem 0.75rem 2.6rem; color: white; font-size: 0.9rem; outline: none;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;"></i>
            </div>
            <button type="submit" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.75rem 1.5rem; border-radius: 0.85rem; font-weight: 900; cursor: pointer;">
                Cari Member
            </button>
            @if($q)
                <a href="{{ route('admin.members.index') }}" style="color: #ef4444; font-size: 0.85rem; font-weight: 800; text-decoration: none;">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Members Table Card -->
    <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.04); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                        <th style="padding: 0.85rem 1rem;">ID &amp; NAMA MEMBER</th>
                        <th style="padding: 0.85rem 1rem;">KONTAK</th>
                        <th style="padding: 0.85rem 1rem;">PAKET &amp; STATUS</th>
                        <th style="padding: 0.85rem 1rem;">MASA BERLAKU</th>
                        <th style="padding: 0.85rem 1rem;">SISA SESI PT</th>
                        <th style="padding: 0.85rem 1rem;">PERSONAL TRAINER</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody style="color: #cbd5e1;">
                    @forelse($members as $m)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                        <td style="padding: 1rem;">
                            <div style="font-weight: 900; color: white; font-size: 0.95rem;">{{ $m->name }}</div>
                            <div style="font-size: 0.75rem; font-family: monospace; color: #84cc16; font-weight: 800;">
                                {{ $m->member_card_id ?: ('FL-MBR-' . str_pad($m->id, 4, '0', STR_PAD_LEFT)) }}
                            </div>
                        </td>
                        <td style="padding: 1rem;">
                            <div>{{ $m->email }}</div>
                            <div style="font-size: 0.775rem; color: #94a3b8;">{{ $m->phone ?: '-' }}</div>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 700; color: white;">{{ $m->membership_type ?: 'Regular Gym Pass' }}</div>
                            <div style="font-size: 0.775rem; color: #84cc16; font-weight: 800;">
                                Rp {{ number_format($m->membership_price ?: 300000, 0, ',', '.') }} ({{ $m->payment_method ?: 'Cash' }})
                            </div>
                            <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-size: 0.725rem; font-weight: 800; padding: 0.2rem 0.55rem; border-radius: 99px; display: inline-block; margin-top: 0.2rem;">
                                {{ $m->status ?: 'Active' }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            @php
                                $expDate = $m->membership_expires_at ? \Carbon\Carbon::parse($m->membership_expires_at) : null;
                                $isExpired = $expDate && $expDate->isPast();
                            @endphp
                            @if($expDate)
                                <div style="font-weight: 800; color: {{ $isExpired ? '#f43f5e' : '#fbbf24' }};">
                                    {{ $expDate->format('d M Y') }}
                                </div>
                                <div style="font-size: 0.725rem; color: {{ $isExpired ? '#f43f5e' : '#94a3b8' }};">
                                    {{ $isExpired ? '⚠️ Kadaluarsa' : ($expDate->diffInDays(now()) . ' Hari Lagi') }}
                                </div>
                            @else
                                <div style="font-weight: 700; color: #fbbf24;">30 Hari (Default)</div>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-size: 1.1rem; font-weight: 900; color: {{ ($m->remaining_sessions ?? 0) > 0 ? '#84cc16' : '#ef4444' }};">
                                {{ $m->remaining_sessions ?? 0 }} Sesi
                            </div>
                            <div style="font-size: 0.725rem; color: #94a3b8;">
                                Selesai: {{ $m->completed_sessions ?? 0 }} / Total: {{ $m->total_sessions ?? 0 }}
                            </div>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 700; color: #cbd5e1;">{{ $m->assigned_coach ?: 'Coach Hendra Wijaya' }}</div>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <a href="{{ route('admin.members.edit', $m->id) }}" style="background: rgba(132,204,22,0.15); color: #84cc16; border: 1px solid #84cc16; padding: 0.4rem 0.85rem; border-radius: 99px; text-decoration: none; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.35rem;">
                                <i class="fa-solid fa-pen-to-square"></i> Top-Up / Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 2.5rem; text-align: center; color: #94a3b8;">
                            Belum ada data member yang sesuai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Sleek Pagination Bar -->
        <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.08); padding: 1rem 1.35rem; border-radius: 1.25rem; box-shadow: 0 10px 25px rgba(0,0,0,0.4);">
            <div style="color: #94a3b8; font-size: 0.85rem; font-weight: 700;">
                Menampilkan Data Member Halaman <strong style="color: #84cc16;">{{ $members->currentPage() }}</strong> dari <strong style="color: white;">{{ $members->lastPage() }}</strong> (Total <strong style="color: white;">{{ $members->total() }}</strong> Member)
            </div>
            <div>
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
@endsection
