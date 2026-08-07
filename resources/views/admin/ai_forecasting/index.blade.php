@extends('admin.layout')

@section('title', 'AI Revenue & Cashflow Forecaster - Admin FitLife Center')
@section('header_title', 'AI Financial Revenue & Cashflow Predictive Forecaster')

@section('admin_content')
<div style="width: 100%;">

    <!-- Header Banner -->
    <div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
        <!-- Decorative Glow Effects -->
        <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

        <div style="position: relative; z-index: 2;">
            <span style="background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(132, 204, 22, 0.4); color: var(--brand-lime, #84cc16); margin-bottom: 0.75rem; display: inline-block;">
                🤖 AI PREDICTIVE FINANCIAL ANALYTICS
            </span>
            <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif; color: #ffffff;">
                Prediksi Omset &amp; Proyeksi Arus Kas Bulan Depan
            </h2>
            <p style="color: #cbd5e1; margin: 0; font-size: 0.925rem;">
                Analisis prediktif AI untuk proyeksi omset, estimasi jam puncak kedatangan member, dan rekomendasi restok barang POS.
            </p>
        </div>
    </div>

    <!-- AI Analytics Grid -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid var(--brand-lime, #84cc16); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">PROYEKSI OMSET BULAN DEPAN</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($aiInsight['next_month_forecast'], 0, ',', '.') }}
            </div>
            <span style="font-size: 0.75rem; color: var(--brand-lime, #84cc16); font-weight: 800;">+{{ $aiInsight['projected_growth'] }} Growth Rate</span>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid #06b6d4; border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">OMSET POS KASIR CURRENT</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($aiInsight['pos_revenue'], 0, ',', '.') }}
            </div>
            <span style="font-size: 0.75rem; color: #06b6d4; font-weight: 800;">Realtime POS Sales</span>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid #8b5cf6; border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">OMSET MEMBERSHIP &amp; PT</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($aiInsight['membership_revenue'], 0, ',', '.') }}
            </div>
            <span style="font-size: 0.75rem; color: #8b5cf6; font-weight: 800;">Midtrans Gateway</span>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid #eab308; border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">ESTIMASI JAM PUNCAK STUDIO</span>
            <div style="font-size: 0.95rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.35rem;">
                {{ $aiInsight['peak_hours'] }}
            </div>
            <span style="font-size: 0.75rem; color: #eab308; font-weight: 800;">High Density Visit</span>
        </div>
    </div>

    <!-- AI Recommendation Box for Product Restock -->
    <div class="admin-card" style="padding: 1.75rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
        <h4 style="font-size: 1.15rem; color: #ffffff; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-boxes-packing" style="color: var(--brand-lime, #84cc16);"></i> AI Rekomendasi Restok Stok Produk POS (Stok Menipis)
        </h4>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8;">
                        <th style="padding: 0.85rem 1rem;">PRODUK</th>
                        <th style="padding: 0.85rem 1rem;">KATEGORI</th>
                        <th style="padding: 0.85rem 1rem;">STOK SAAT INI</th>
                        <th style="padding: 0.85rem 1rem;">AI SUGGESTED RESTOK</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aiInsight['recommended_restock'] as $prod)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: #ffffff;">📦 {{ $prod->name }}</td>
                        <td style="padding: 0.85rem 1rem; color: #94a3b8;">{{ $prod->category }}</td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: #ef4444;">{{ $prod->stock }} Unit (Stok Menipis)</td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: var(--brand-lime, #84cc16);">+24 Unit (Disarankan)</td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            <a href="{{ route('admin.inventory-log.index') }}" class="btn" style="padding: 0.35rem 0.85rem; font-size: 0.75rem; border-radius: 0.5rem; font-weight: 900; background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border: none;">Input Restok</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 1.5rem; text-align: center; color: var(--brand-lime, #84cc16); font-weight: 800;">🟢 Seluruh stok produk POS aman dan mencukupi untuk 30 hari ke depan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
