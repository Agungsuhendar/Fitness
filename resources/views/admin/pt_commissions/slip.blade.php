<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji Komisi PT - {{ $payout->coach_name }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace, sans-serif;
            background: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 20px;
        }
        .slip-card {
            max-width: 580px;
            margin: 0 auto;
            background: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #0f172a;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0 0 5px;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 12px;
            color: #475569;
        }
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 15px;
        }
        .meta-table td {
            padding: 5px 0;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin: 15px 0;
        }
        .details-table th, .details-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
        }
        .details-table th {
            background: #f1f5f9;
        }
        .total-box {
            background: #f8fafc;
            border: 1.5px solid #16a34a;
            padding: 12px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #16a34a;
            border-radius: 8px;
            margin-top: 15px;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
        }
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                background: white;
                padding: 0;
            }
            .slip-card {
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" style="padding: 10px 25px; font-size: 14px; font-weight: bold; background: #84cc16; color: #000; border: none; cursor: pointer; border-radius: 99px;">
            🖨️ CETAK SLIP GAJI KOMISI
        </button>
        <button onclick="window.close()" style="padding: 10px 25px; font-size: 14px; font-weight: bold; background: #e2e8f0; color: #000; border: none; cursor: pointer; border-radius: 99px; margin-left: 10px;">
            Tutup
        </button>
    </div>

    <div class="slip-card">
        <div class="header">
            <h2>FITLIFE CENTER YOGYAKARTA</h2>
            <p>SLIP GAJI KOMISI PERSONAL TRAINER (PT)</p>
            <p style="font-weight: bold; margin-top: 5px;">Periode: {{ \Carbon\Carbon::parse($payout->period_month . '-01')->format('F Y') }}</p>
        </div>

        <table class="meta-table">
            <tr>
                <td><strong>NAMA TRAINER:</strong> {{ $payout->coach_name }}</td>
                <td style="text-align: right;"><strong>STATUS:</strong> {{ strtoupper($payout->status) }}</td>
            </tr>
            <tr>
                <td><strong>TANGGAL CAIR:</strong> {{ $payout->paid_at ? $payout->paid_at->format('d M Y, H:i') : '-' }}</td>
                <td style="text-align: right;"><strong>DIBUAT OLEH:</strong> {{ $payout->created_by ?: 'Admin Studio' }}</td>
            </tr>
        </table>

        <table class="details-table">
            <thead>
                <tr>
                    <th>KOMPONEN PENERIMAAN</th>
                    <th style="text-align: center;">KETERANGAN</th>
                    <th style="text-align: right;">SUBTOTAL (RP)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Komisi Sesi Personal Trainer</td>
                    <td style="text-align: center;">{{ $payout->total_sessions_conducted }} Sesi x Rp {{ number_format($payout->rate_per_session, 0, ',', '.') }}</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($payout->total_payout_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-box">
            TOTAL DITERIMA (NET PAYOUT): Rp {{ number_format($payout->total_payout_amount, 0, ',', '.') }}
        </div>

        <div class="signatures">
            <div>
                <p>Penerima (Trainer):</p>
                <br><br>
                <p><strong>( {{ $payout->coach_name }} )</strong></p>
            </div>
            <div>
                <p>Finance / Manajer Studio:</p>
                <br><br>
                <p><strong>( {{ $payout->created_by ?: 'Admin FitLife' }} )</strong></p>
            </div>
        </div>
    </div>

</body>
</html>
