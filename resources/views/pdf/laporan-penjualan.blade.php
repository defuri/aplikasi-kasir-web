<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
        }

        .header {
            margin-bottom: 20px;
        }

        h1 {
            font-size: 18px;
            margin: 0 0 5px 0;
        }

        .subtitle {
            font-size: 14px;
            margin: 0 0 15px 0;
            color: #666;
        }

        .meta-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #FCD34D;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .info-box {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .info-table th {
            background-color: #F3F4F6;
            text-align: left;
            padding: 5px;
            border: 1px solid #ddd;
        }

        .trJumlah {
            border-top: 2px solid black;
        }

    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Penjualan Perbulan</h1>
        <div class="subtitle">
            Periode: {{ Carbon\Carbon::parse($tanggal_mulai)->format('d F Y') }} -
            {{ Carbon\Carbon::parse($tanggal_selesai)->format('d F Y') }}
        </div>
    </div>

    <table class="info-table">
        <tr>
            <th>Pembuat Laporan</th>
            <td>{{ $pembuat_laporan }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembuatan</th>
            <td>{{ $tanggal_pembuatan }}</td>
        </tr>
        <tr>
            <th>Total Pendapatan:</th>
            <td>Rp {{ number_format($totalPendapatan, 0, ',', '.') }} </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>No Meja</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->id_transaksi }}</td>
                    <td>{{ $transaction->tmeja->nomor_meja }}</td>
                    <td>{{ $transaction->tuser->nama_user }}</td>
                    <td>{{ Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="trJumlah">
                <th colspan="5">Total</th>
                <td>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
