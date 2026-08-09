<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label Barcode - {{ $product->name }}</title>
    <style>
        @page {
            size: auto;
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace, sans-serif;
            background: #ffffff;
            color: #000000;
            margin: 0;
            padding: 10px;
            text-align: center;
        }
        .label-card {
            width: 58mm;
            margin: 0 auto 15px;
            padding: 8px;
            border: 1px dashed #000000;
            box-sizing: border-box;
        }
        .store-name {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .product-name {
            font-size: 11px;
            font-weight: bold;
            margin: 3px 0;
            line-height: 1.2;
        }
        .barcode-img {
            max-width: 100%;
            height: 45px;
            margin: 4px 0;
        }
        .code-num {
            font-size: 9px;
            letter-spacing: 1px;
        }
        .price {
            font-size: 12px;
            font-weight: bold;
            margin-top: 3px;
        }
        .no-print {
            margin-bottom: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
            .label-card {
                border: none;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <h3>🖨️ Cetak Stiker Label Barcode Thermal (58mm/80mm)</h3>
        <p>Tempelkan stiker ini pada suplemen, shaker, atau gelang tiket harian studio.</p>
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; font-weight: bold; background: #84cc16; border: none; cursor: pointer; border-radius: 5px;">
            🖨️ CETAK SEKARANG (PRINT)
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 14px; font-weight: bold; background: #e2e8f0; border: none; cursor: pointer; border-radius: 5px; margin-left: 10px;">
            Tutup
        </button>
    </div>

    @for($i = 1; $i <= 4; $i++)
    <div class="label-card">
        <div class="store-name">FITLIFE CENTER JOGJA</div>
        <div class="product-name">{{ $product->name }}</div>
        <img class="barcode-img" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($product->barcode ?: $product->code) }}" alt="Barcode">
        <div class="code-num">{{ $product->barcode ?: $product->code }}</div>
        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
    </div>
    @endfor

    <script>
        // Auto print after page load
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 600);
        };
    </script>
</body>
</html>
