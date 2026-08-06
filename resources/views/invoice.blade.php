@extends('layouts.app')

@section('title', 'E-Kuitansi & Invoice Pembayaran Resmi | FitLife Center Yogyakarta')
@section('meta_description', 'Bukti pembayaran resmi e-Receipt FitLife Center Yogyakarta. Rincian tagihan paket gym, diskon voucher promo, dan konfirmasi lunas.')

@section('content')
<style>
    @media print {
        header, footer, nav, .no-print, .live-toast, #pwaInstallBanner {
            display: none !important;
        }
        body, main {
            background: white !important;
            color: black !important;
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        .invoice-card-container {
            border: 1px solid #000 !important;
            box-shadow: none !important;
            color: #000 !important;
            background: #fff !important;
        }
    }
</style>

<section style="background: #060907; padding: 3.5rem 0 6rem; color: white; min-height: 85vh;">
    <div class="container" style="max-width: 780px;">
        
        <!-- Action Header Bar (Hidden on print) -->
        <div class="no-print" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <a href="{{ route('member.dashboard') }}" style="color: #94a3b8; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Portal Member
            </a>

            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <button type="button" onclick="window.print()" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
                </button>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $invoice->member_phone) }}?text={{ urlencode('Halo Kak ' . $invoice->member_name . ', berikut E-Kuitansi Bukti Pembayaran Resmi ' . $invoice->number . ' Anda di FitLife Center: ' . url('/invoice?id=' . $invoice->member_id)) }}" target="_blank" class="btn glow-btn" style="background: #25d366; color: white; border: none; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 15px rgba(37,211,102,0.4);">
                    <i class="fa-brands fa-whatsapp"></i> Kirim ke WA Member
                </a>
            </div>
        </div>

        <!-- Printable Invoice Box Container -->
        <div class="invoice-card-container" style="background: #0d1310; border: 2px solid rgba(132,204,22,0.4); border-radius: 1.75rem; padding: 2.75rem; box-shadow: 0 25px 60px rgba(0,0,0,0.8), 0 0 35px rgba(132, 204, 22, 0.15);">
            
            <!-- Invoice Top Header -->
            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px dashed rgba(255,255,255,0.12); padding-bottom: 1.75rem; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="FitLife Center" style="height: 42px; width: auto; margin-bottom: 0.5rem;">
                    <div style="font-size: 0.85rem; color: #94a3b8;">FitLife Center Yogyakarta HQ</div>
                    <div style="font-size: 0.775rem; color: #64748b;">Jl. Kaliurang Km 12, Sleman • CS WA: 0812-3456-7890</div>
                </div>

                <div style="text-align: right;">
                    <span style="background: rgba(34, 197, 94, 0.18); color: #4ade80; border: 1.5px solid #4ade80; font-weight: 900; font-size: 0.85rem; padding: 0.4rem 1.15rem; border-radius: 99px; letter-spacing: 1px; display: inline-block; margin-bottom: 0.65rem;">
                        ✔ {{ $invoice->status }}
                    </span>
                    <div style="font-family: monospace; font-size: 1.1rem; font-weight: 900; color: #84cc16;">
                        {{ $invoice->number }}
                    </div>
                    <div style="font-size: 0.8rem; color: #94a3b8;">
                        Tanggal: {{ $invoice->date }}
                    </div>
                </div>
            </div>

            <!-- Customer & Branch Metadata Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;" class="grid-2">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                    <span style="font-size: 0.725rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">DITERBITKAN UNTUK (MEMBER)</span>
                    <div style="font-size: 1.15rem; font-weight: 900; color: white; margin: 0.25rem 0 0.15rem;">
                        {{ $invoice->member_name }}
                    </div>
                    <div style="font-size: 0.8rem; color: #94a3b8; font-family: monospace;">
                        ID: {{ $invoice->member_id }} • WA: {{ $invoice->member_phone }}
                    </div>
                </div>

                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.15rem; padding: 1.25rem;">
                    <span style="font-size: 0.725rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">METODE &amp; LOKASI</span>
                    <div style="font-size: 0.95rem; font-weight: 800; color: white; margin: 0.25rem 0 0.15rem;">
                        {{ $invoice->branch }}
                    </div>
                    <div style="font-size: 0.8rem; color: #94a3b8;">
                        Metode: <strong style="color: #38bdf8;">{{ $invoice->payment_method }}</strong>
                    </div>
                </div>
            </div>

            <!-- Itemized Table -->
            <div style="margin-bottom: 2rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.05); color: #84cc16; border-bottom: 1.5px solid rgba(132,204,22,0.3);">
                            <th style="padding: 0.85rem 1rem;">RINCIAN PAKET / LAYANAN</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">HARGA ASLI</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">POTONGAN PROMO</th>
                            <th style="padding: 0.85rem 1rem; text-align: right;">TOTAL NETTO</th>
                        </tr>
                    </thead>
                    <tbody style="color: #cbd5e1;">
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                            <td style="padding: 1rem; font-weight: 800; color: white;">
                                {{ $invoice->package_name }}
                                <div style="font-size: 0.775rem; color: #84cc16; font-weight: 700;">Termasuk Akses VIP Pass &amp; InBody Scan</div>
                            </td>
                            <td style="padding: 1rem; text-align: right; font-family: monospace;">
                                Rp {{ number_format($invoice->original_price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 1rem; text-align: right; font-family: monospace; color: #ef4444; font-weight: 800;">
                                -Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}
                                <div style="font-size: 0.725rem; color: #84cc16;">({{ $invoice->promo_code }})</div>
                            </td>
                            <td style="padding: 1rem; text-align: right; font-family: monospace; font-weight: 900; color: #84cc16; font-size: 1.05rem;">
                                Rp {{ number_format($invoice->total_paid, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Grand Total Bar -->
            <div style="background: rgba(132,204,22,0.1); border: 1.5px solid #84cc16; border-radius: 1.25rem; padding: 1.25rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">TOTAL PEMBAYARAN DITERIMA</span>
                    <div style="font-size: 0.8rem; color: #94a3b8;">Sudah termasuk PPN &amp; Biaya Administrasi</div>
                </div>
                <div style="font-size: 2.2rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;">
                    Rp {{ number_format($invoice->total_paid, 0, ',', '.') }}
                </div>
            </div>

            <!-- Footer Sign -->
            <div style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.25rem; display: flex; justify-content: space-between; align-items: flex-end; font-size: 0.775rem; color: #94a3b8;">
                <div>
                    Terima kasih telah mempercayai <strong>FitLife Center Yogyakarta</strong>. <br>
                    E-Kuitansi ini diterbitkan secara otomatis dan sah sebagai bukti pembayaran resmi.
                </div>
                <div style="text-align: right; font-family: monospace; color: #84cc16; font-weight: 800;">
                    [CONFIRMED &amp; SIGNED BY FINANCE DEPT]
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
