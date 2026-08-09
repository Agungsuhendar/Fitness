<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran {{ $transaction->invoice_number }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        @page {
            size: 58mm auto;
            margin: 0mm;
        }
        * { box-sizing: border-box; }
        html, body {
            width: 58mm;
            max-width: 58mm;
            margin: 0 auto;
            padding: 6px 4px;
            color: #000000;
            background: #ffffff;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, Arial, sans-serif;
            font-size: 9.5px;
            line-height: 1.3;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .divider { border-top: 1px dashed #000000; margin: 6px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; font-size: 9px; vertical-align: top; }
        .bold { font-weight: 700; }
        .extrabold { font-weight: 900; }
        
        .brand-badge {
            display: inline-block;
            background: #000000;
            color: #ffffff;
            font-weight: 900;
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 99px;
            letter-spacing: 0.03em;
            margin-bottom: 3px;
        }
        
        .item-row { margin-bottom: 4px; }
        .item-name { font-weight: 700; color: #000000; font-size: 9.5px; margin-bottom: 1px; }
        .item-meta { display: flex; justify-content: space-between; font-size: 8.5px; color: #333333; }
        
        .total-box {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 5px;
            margin: 6px 0;
        }
        
        @media print {
            .no-print { display: none !important; }
            html, body {
                width: 58mm !important;
                max-width: 58mm !important;
                margin: 0 auto !important;
                padding: 2px !important;
                font-size: 8.5px !important;
                background: #ffffff !important;
                color: #000000 !important;
            }
            img { max-width: 125px !important; height: auto !important; }
            .brand-badge { background: #000000 !important; color: #ffffff !important; }
        }
    </style>
</head>
<body @if($transaction->payment_status !== 'pending') onload="window.print()" @endif>

    <!-- Header Struk Thermal 58mm -->
    <div class="text-center">
        <div class="brand-badge">⚡ FITLIFE CENTER</div>
        <div style="font-size: 11px; font-weight: 900; color: #000000;">FITLIFE HEALTH & GYM</div>
        <div style="font-size: 8.5px; color: #444444; margin-top: 1px;">Jl. Kaliurang No. 12, Sleman</div>
        <div style="font-size: 8.5px; color: #444444;">WA: {{ site_setting('site_phone', '0812-3456-7890') }}</div>
    </div>

    <div class="divider"></div>

    <!-- Metadata Invoice -->
    <table style="font-size: 8.5px; color: #111111;">
        <tr>
            <td>No. Inv</td>
            <td class="text-right extrabold" style="color: #000000;">{{ $transaction->invoice_number }}</td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td class="text-right bold">{{ $transaction->transacted_at ? $transaction->transacted_at->format('d/m/y H:i') : date('d/m/y H:i') }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td class="text-right bold">{{ $transaction->member_name }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-right bold">{{ $transaction->created_by ?? 'Kasir Studio' }}</td>
        </tr>
        <tr>
            <td>Metode</td>
            <td class="text-right bold">{{ $transaction->payment_method }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Itemized List -->
    <div style="margin: 4px 0;">
        @foreach($transaction->items as $item)
        <div class="item-row">
            <div class="item-name">{{ $item->product_name }}</div>
            <div class="item-meta">
                <span>{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                <span class="bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Summary Box -->
    <div class="total-box">
        <table>
            <tr>
                <td style="color: #444444;">Subtotal</td>
                <td class="text-right bold">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
            </tr>
            @if($transaction->discount > 0)
            <tr>
                <td style="color: #000000;">Diskon</td>
                <td class="text-right bold">-Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="font-size: 11px;">
                <td class="extrabold" style="color: #000000; padding-top: 2px;">TOTAL</td>
                <td class="text-right extrabold" style="color: #000000; padding-top: 2px;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="color: #444444;">Diterima</td>
                <td class="text-right bold">Rp {{ number_format($transaction->pay_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="color: #444444;">Kembali</td>
                <td class="text-right bold">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    @php
        $isQris = str_contains(strtolower($transaction->payment_method), 'qris') || str_contains(strtolower($transaction->payment_method), 'ipaymu');
        $qrisImg = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' . urlencode(url('/invoice/' . $transaction->invoice_number));
    @endphp

    <!-- QRIS Barcode Seamless 58mm Thermal -->
    @if($isQris)
    <div class="text-center" style="margin: 8px 0;">
        <div style="font-size: 9px; font-weight: 900; color: #000000; text-transform: uppercase;">
            📱 SCAN QRIS IPAYMU
        </div>
        <div style="font-size: 7.5px; color: #555555; margin: 1px 0 4px;">
            GoPay • OVO • ShopeePay • Dana • BCA
        </div>
        <img src="{{ $qrisImg }}" alt="QRIS Barcode" style="width: 125px; height: 125px; display: block; margin: 0 auto;">
        <div style="margin-top: 4px; font-size: 8.5px; font-weight: 900; color: #000000;">
            STATUS: {{ ($transaction->payment_status === 'paid' || $transaction->payment_status === 'settlement') ? '✅ LUNAS' : '⏳ PENDING' }}
        </div>
    </div>
    @endif

    <div class="divider"></div>

    <!-- Thermal Print Footer -->
    <div class="text-center" style="font-size: 8.5px; color: #444444; line-height: 1.3;">
        <div class="bold" style="color: #000000;">Terima Kasih Telah Berolahraga!</div>
        <div>Bukti Transaksi Resmi FitLife Studio</div>
        <div style="font-size: 7.5px; font-family: monospace; color: #777777; margin-top: 3px;">#{{ substr(md5($transaction->invoice_number), 0, 10) }}</div>
    </div>

</body>
</html>
