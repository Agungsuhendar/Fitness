@extends('admin.layout')

@section('title', 'Dashboard Ringkasan Leads & Pendaftaran Admin | FitLife Center Yogyakarta')
@section('header_title', 'Dashboard Leads & Pendaftaran Member')

@section('admin_content')
<div style="width: 100%;">
    
    <!-- Top Action Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                Dashboard Leads &amp; Pendaftaran Member
            </h1>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0.25rem 0 0;">
                Kelola calon member baru, reservasi free trial, klaim voucher promo, dan ekspor data rekap ke CSV.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.leads.export') }}" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.75rem 1.4rem; border-radius: 99px; font-weight: 900; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                <i class="fa-solid fa-file-csv" style="font-size: 1.1rem;"></i>
                <span>Ekspor Data Leads (CSV)</span>
            </a>
        </div>
    </div>

        <!-- Summary Metric Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2.5rem;" class="grid-2">
            <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.35rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">TOTAL LEADS MASUK</span>
                    <i class="fa-solid fa-users" style="color: #84cc16;"></i>
                </div>
                <div style="font-size: 2rem; font-weight: 900; color: #ffffff;">{{ $stats->total_leads }}</div>
                <span style="font-size: 0.75rem; color: #84cc16; font-weight: 700;">● Terbaca Real-Time</span>
            </div>

            <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.35rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">FREE TRIAL BOOKINGS</span>
                    <i class="fa-solid fa-calendar-check" style="color: #38bdf8;"></i>
                </div>
                <div style="font-size: 2rem; font-weight: 900; color: #38bdf8;">{{ $stats->total_trials }}</div>
                <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 700;">● Sesi VIP Pass</span>
            </div>

            <div style="background: #0d1310; border: 1.5px solid rgba(132,204,22,0.4); border-radius: 1.25rem; padding: 1.35rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800;">MEMBER AKTIF CONVERTED</span>
                    <i class="fa-solid fa-crown" style="color: #84cc16;"></i>
                </div>
                <div style="font-size: 2rem; font-weight: 900; color: #84cc16;">{{ $stats->converted_members }}</div>
                <span style="font-size: 0.75rem; color: #84cc16; font-weight: 700;">● Tingkat Konversi 85%</span>
            </div>

            <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.35rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800;">VOUCHER PROMO KLAIM</span>
                    <i class="fa-solid fa-ticket" style="color: #fbbf24;"></i>
                </div>
                <div style="font-size: 2rem; font-weight: 900; color: #fbbf24;">{{ $stats->total_vouchers }}</div>
                <span style="font-size: 0.75rem; color: #fbbf24; font-weight: 700;">● Kode Aktif</span>
            </div>
        </div>

        <!-- Search & Table Box -->
        <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap;">
                <h3 style="font-size: 1.35rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0;">
                    <i class="fa-solid fa-list-check" style="color: #84cc16;"></i> Daftar Lead Pendaftar Terbaru
                </h3>

                <!-- Quick Filter Search -->
                <div style="max-width: 320px; width: 100%; position: relative;">
                    <input type="text" id="adminSearchInput" placeholder="Cari nama, WA, atau cabang..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.65rem 1rem 0.65rem 2.4rem; border-radius: 99px; color: white; font-size: 0.85rem; outline: none;" onkeyup="filterAdminLeadsLive()">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.85rem;"></i>
                </div>
            </div>

            <!-- Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.04); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                            <th style="padding: 0.85rem 1rem;">ID LEAD</th>
                            <th style="padding: 0.85rem 1rem;">NAMA PENDAFTAR</th>
                            <th style="padding: 0.85rem 1rem;">WHATSAPP</th>
                            <th style="padding: 0.85rem 1rem;">CABANG GYM</th>
                            <th style="padding: 0.85rem 1rem;">PROGRAM</th>
                            <th style="padding: 0.85rem 1rem;">PROMO VOUCHER</th>
                            <th style="padding: 0.85rem 1rem;">STATUS</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">AKSI OPERASIONAL</th>
                        </tr>
                    </thead>
                    <tbody id="adminLeadsTbody" style="color: #cbd5e1;">
                        @foreach($leads as $lead)
                        <tr class="admin-lead-row" data-search="{{ strtolower($lead->name . ' ' . $lead->phone . ' ' . $lead->location . ' ' . $lead->promo) }}" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                            <td style="padding: 0.9rem 1rem; font-family: monospace; font-weight: 800; color: #84cc16;">
                                {{ $lead->id }}
                            </td>
                            <td style="padding: 0.9rem 1rem; font-weight: 800; color: white;">
                                {{ $lead->name }}
                                <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 400;">{{ $lead->type }}</div>
                            </td>
                            <td style="padding: 0.9rem 1rem; font-family: monospace;">
                                {{ $lead->phone }}
                            </td>
                            <td style="padding: 0.9rem 1rem;">
                                {{ $lead->location }}
                            </td>
                            <td style="padding: 0.9rem 1rem; font-weight: 700; color: #cbd5e1;">
                                {{ $lead->program }}
                            </td>
                            <td style="padding: 0.9rem 1rem;">
                                <span style="background: rgba(132,204,22,0.12); color: #84cc16; border: 1px solid rgba(132,204,22,0.3); font-weight: 900; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px;">
                                    {{ $lead->promo }}
                                </span>
                            </td>
                            <td style="padding: 0.9rem 1rem;">
                                @if($lead->status === 'Member Aktif')
                                    <span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px;">● Member Aktif</span>
                                @elseif($lead->status === 'Trial Selesai')
                                    <span style="background: rgba(56, 189, 248, 0.2); color: #38bdf8; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px;">● Trial Selesai</span>
                                @else
                                    <span style="background: rgba(251, 191, 36, 0.2); color: #fbbf24; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px;">● {{ $lead->status }}</span>
                                @endif
                            </td>
                            <td style="padding: 0.9rem 1rem; text-align: right;">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}?text={{ urlencode('Halo Kak ' . $lead->name . ', saya Admin FitLife Center Jogja mau menindaklanjuti pendaftaran ' . $lead->program . '.') }}" target="_blank" class="btn" style="background: #25d366; color: white; border: none; padding: 0.4rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
                                    <i class="fa-brands fa-whatsapp"></i> Chat WA
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<script>
    function filterAdminLeadsLive() {
        const query = document.getElementById('adminSearchInput').value.toLowerCase().trim();
        const rows = document.querySelectorAll('.admin-lead-row');

        rows.forEach(row => {
            const data = row.getAttribute('data-search') || '';
            row.style.display = data.includes(query) ? '' : 'none';
        });
    }
</script>
@endsection
