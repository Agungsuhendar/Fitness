<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran {{ $transaction->invoice_number }}</title>
    <style>
        @page { size: 80mm auto; margin: 0; }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 80mm;
            padding: 10px;
            margin: 0 auto;
            color: #000;
            background: #fff;
            font-size: 12px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .dashed { border-bottom: 1px dashed #000; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 3px 0; font-size: 11px; }
        .btn-print {
            background: #0284c7; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-weight: bold; cursor: pointer; margin-bottom: 15px; width: 100%;
        }
        @media print {
            .no-print { display: none; }
            body { width: 100%; padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">🖨️ CETAK STRUK THERMAL PRINTER</button>
    </div>

    <div class="text-center">
        <h3 style="margin: 0; font-size: 16px; font-weight: bold;">FITLIFE CENTER JOGJA</h3>
        <p style="margin: 2px 0 0; font-size: 10px;">Jl. Kaliurang No. 12, Sleman, Yogyakarta</p>
        <p style="margin: 2px 0 0; font-size: 10px;">WA: {{ site_setting('site_phone', '0812-3456-7890') }}</p>
    </div>

    <div class="dashed"></div>

    <table style="font-size: 10px;">
        <tr>
            <td>No. Invoice</td>
            <td class="text-right"><strong>{{ $transaction->invoice_number }}</strong></td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td class="text-right">{{ $transaction->transacted_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td class="text-right">{{ $transaction->member_name }}</td>
        </tr>
        <tr>
            <td>Metode Bayar</td>
            <td class="text-right">{{ $transaction->payment_method }}</td>
        </tr>
    </table>

    <div class="dashed"></div>

    <table>
        @foreach($transaction->items as $item)
        <tr>
            <td colspan="2" style="font-weight: bold;">{{ $item->product_name }}</td>
        </tr>
        <tr>
            <td style="padding-left: 10px;">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="dashed"></div>

    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-right">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
        </tr>
        @if($transaction->discount > 0)
        <tr>
            <td>Diskon</td>
            <td class="text-right">-Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
        </tr>
        @endif
        <tr style="font-weight: bold; font-size: 13px;">
            <td>TOTAL</td>
            <td class="text-right">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Diterima</td>
            <td class="text-right">Rp {{ number_format($transaction->pay_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-right">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="dashed"></div>

    <div class="text-center" style="font-size: 10px; margin-top: 10px;">
        <p style="margin: 0;">Terima Kasih Atas Kunjungan Anda!</p>
        <p style="margin: 3px 0 0; font-weight: bold;">#FitLifeHealthAndGym</p>
    </div>

</body>
</html>
