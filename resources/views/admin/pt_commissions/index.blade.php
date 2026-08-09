@extends('admin.layout')

@section('title', 'Kalkulator Komisi Personal Trainer - Admin FitLife Center')
@section('header_title', 'Sistem Rekapitulasi Komisi Personal Trainer (PT Payout)')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(34, 197, 94, 0.15); border: 1.5px solid #4ade80; color: #4ade80; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                💰 Rekapitulasi &amp; Komisi Personal Trainer
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Audit jumlah sesi PT selesai, kalkulasi bagi hasil komisi Coach, &amp; pencetakan slip insentif resmi.
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <form action="{{ route('admin.pt-commissions.generate') }}" method="POST" style="display: inline-block;">
                @csrf
                <input type="hidden" name="month" value="{{ $month }}">
                <button type="submit" class="btn glow-btn" style="background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #060907 !important; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4);">
                    <i class="fa-solid fa-calculator"></i> ⚡ Hitung Komisi Trainer Bulan Ini
                </button>
            </form>

            <form action="{{ route('admin.pt-commissions.index') }}" method="GET" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                <input type="month" name="month" value="{{ $month }}" class="form-control bg-dark text-white border-secondary fw-bold" onchange="this.form.submit()" style="width: 170px;">
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">TOTAL SESI PT SELESAI</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($totalSessionsConducted) }} Sesi
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">TOTAL NOMINAL KOMISI</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($totalPayoutAmount, 0, ',', '.') }}
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #eab308; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #eab308; font-weight: 800; text-transform: uppercase;">BELUM DIBAYAR (PENDING)</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: #eab308; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($pendingAmount, 0, ',', '.') }}
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #38bdf8; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">SUDAH DICAIRKAN (LUNAS)</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: #38bdf8; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($paidAmount, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <!-- Payouts Table -->
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h4 style="font-size: 1.15rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📋 Rekap Insentif Komisi Trainer Periode {{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }}
            </h4>
            <span style="font-size: 0.8rem; color: #94a3b8;">* Komisi Otomatis Terkalkulasi Berdasarkan Log Presensi Check-In &amp; Booking PT</span>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.775rem; text-transform: uppercase;">
                        <th style="padding: 1rem;">Nama Trainer / Coach</th>
                        <th style="padding: 1rem; text-align: center;">Sesi PT Selesai</th>
                        <th style="padding: 1rem; text-align: right;">Tarif Komisi / Sesi</th>
                        <th style="padding: 1rem; text-align: right;">Total Komisi (Rp)</th>
                        <th style="padding: 1rem;">Status Payout</th>
                        <th style="padding: 1rem; text-align: right;">Aksi &amp; Slip Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $p)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem;">
                            <div style="font-weight: 900; color: white; font-size: 0.95rem;">{{ $p->coach_name }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">Personal Trainer Specialist</div>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <span style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; font-weight: 900; font-size: 0.85rem; padding: 0.3rem 0.85rem; border-radius: 99px; border: 1px solid rgba(56, 189, 248, 0.3);">
                                {{ $p->total_sessions_conducted }} Sesi
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: right; color: #cbd5e1;">
                            Rp {{ number_format($p->rate_per_session, 0, ',', '.') }}
                        </td>
                        <td style="padding: 1rem; text-align: right; font-weight: 900; color: #84cc16; font-size: 1.05rem;">
                            Rp {{ number_format($p->total_payout_amount, 0, ',', '.') }}
                        </td>
                        <td style="padding: 1rem;">
                            @if($p->status === 'paid')
                                <span style="background: rgba(34, 197, 94, 0.15); color: #4ade80; font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid #4ade80;">
                                    🟢 LUNAS ({{ $p->paid_at ? $p->paid_at->format('d/m/Y') : '-' }})
                                </span>
                            @else
                                <span style="background: rgba(234, 179, 8, 0.15); color: #eab308; font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid #eab308;">
                                    ⏳ PENDING (Belum Dibayar)
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: right;">
                            <div style="display: flex; gap: 0.4rem; justify-content: flex-end; align-items: center;">
                                @if($p->status !== 'paid')
                                <form action="{{ route('admin.pt-commissions.mark-paid', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Konfirmasi pencairan gaji komisi untuk {{ $p->coach_name }}?')" style="background: #84cc16; color: #060907; border: none; padding: 0.4rem 0.75rem; border-radius: 8px; font-weight: 900; font-size: 0.775rem; cursor: pointer;">
                                        ✅ Tandai Lunas
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('admin.pt-commissions.slip', $p->id) }}" target="_blank" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.4rem 0.75rem; border-radius: 8px; font-weight: 800; font-size: 0.775rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;">
                                    📄 Slip Gaji
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 2.5rem; text-align: center; color: #94a3b8;">
                            Belum ada rekapitulasi komisi untuk bulan ini. Klik <strong>⚡ Hitung Komisi Trainer Bulan Ini</strong> di atas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
