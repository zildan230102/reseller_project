@extends('layouts.main')

@section('title', 'Riwayat Pesanan')

@section('content')

<div class="container">
    <h2>Riwayat Pesanan</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>Tanggal</th>
                <th>Penerima</th>
                <th>Alamat Kirim</th>
                <th>Buku yang Dipesan</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->no_invoice }}</td>
                <td>{{ $order->tanggal }}</td>
                <td>{{ $order->penerima }}</td>
                <td>{{ $order->alamat_kirim }}</td>
                <td>
                    <ul>
                        @foreach($order->bukus as $buku)
                        <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} Buku</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ number_format($order->grand_total, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->metode_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
