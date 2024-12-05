<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Struk Pembayaran</h1>
    <p><strong>Tanggal:</strong> {{ $tanggal }}</p>

    @foreach ($orders as $order)
    <h2>Invoice: {{ $order->no_invoice }}</h2>
    <p><strong>Alamat Pengiriman:</strong><br>
        {{ $order->alamat_kirim }}<br>
        {{ $order->kelurahan }}, {{ $order->kecamatan }}, {{ $order->kota }}, {{ $order->provinsi }}<br>
        <strong>Penerima:</strong> {{ $order->penerima }} ({{ $order->no_hp_penerima }})
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Buku</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->bukus as $buku)
            <tr>
                <td>{{ $buku->judul_buku }}</td>
                <td>{{ $buku->pivot->jumlah }}</td>
                <td>Rp{{ number_format($buku->harga * $buku->pivot->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

    <p class="total">Total Tagihan: Rp{{ number_format($totalTagihan, 0, ',', '.') }}</p>
</body>
</html>
