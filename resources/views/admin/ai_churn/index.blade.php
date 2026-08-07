@extends('admin.layout')

@section('title', 'AI Member Retention & Churn Predictor - Admin FitLife Center')
@section('header_title', 'AI Member Retention & Churn Risk Predictor')

@section('admin_content')
<div style="width: 100%;">

    <!-- Header Banner -->
    <div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
        <!-- Decorative Glow Effects -->
        <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(244, 63, 94, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

        <div style="position: relative; z-index: 2;">
            <span style="background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(132, 204, 22, 0.4); color: var(--brand-lime, #84cc16); margin-bottom: 0.75rem; display: inline-block;">
                🤖 AI BEHAVIORAL RETENTION PREDICTOR
            </span>
            <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif; color: #ffffff;">
                Prediksi Resiko Member Berhenti (Churn Risk)
            </h2>
            <p style="color: #cbd5e1; margin: 0; font-size: 0.925rem;">
                Sistem AI secara otomatis mendeteksi member yang sudah lama tidak latihan dan memberikan rekomendasi pesan WA ramah untuk ajakan kembali.
            </p>
        </div>
    </div>

    <!-- Churn Table Card -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8;">
                        <th style="padding: 0.85rem 1rem;">NAMA MEMBER</th>
                        <th style="padding: 0.85rem 1rem;">TIDAK PRESENSI</th>
                        <th style="padding: 0.85rem 1rem;">AI CHURN RISK SCORE</th>
                        <th style="padding: 0.85rem 1rem;">PRESENSI TERAKHIR</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI CEGAH CHURN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($churnAnalysis as $item)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                        <td style="padding: 0.85rem 1rem;">
                            <div style="font-weight: 900; color: #ffffff;">{{ $item->user->name }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">ID: {{ $item->user->member_card_id ?: 'MEMBER' }} • Sisa: {{ $item->user->remaining_sessions }} Sesi</div>
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 800; color: #94a3b8;">
                            {{ $item->days_inactive }} Hari Tidak Latihan
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="background: {{ $item->color }}20; color: {{ $item->color }}; font-weight: 900; font-size: 0.775rem; padding: 0.3rem 0.75rem; border-radius: 99px; border: 1px solid {{ $item->color }};">
                                ⚠️ {{ $item->risk_score }}% {{ $item->risk_label }}
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; font-size: 0.8rem; color: #cbd5e1;">
                            {{ $item->last_checkin }}
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            @if($item->user->phone)
                            <a href="https://wa.me/{{ $item->user->phone }}?text={{ urlencode($item->recommended_message) }}" target="_blank" class="btn" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #10b981; padding: 0.4rem 0.85rem; border-radius: 0.65rem; font-weight: 800; font-size: 0.775rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                                <i class="fa-brands fa-whatsapp"></i> Kirim WA Ajakan Latihan
                            </a>
                            @else
                                <span style="font-size: 0.75rem; color: #94a3b8;">No WA Kosong</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
