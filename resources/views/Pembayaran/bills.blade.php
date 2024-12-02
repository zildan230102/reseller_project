@extends('layouts.main')

@section('title', 'Tagihan')

@section('content')

<div class="container">
    <h2>Tagihan</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <!-- Form memilih metode pembayaran -->
    <form action="{{ route('payment.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="order_id">Pilih Pesanan:</label>
            <select name="order_id" id="order_id" class="form-control">
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" 
                        @if($order->metode_pembayaran) disabled @endif>
                        {{ $order->no_invoice }} ({{ $order->penerima }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran">Pilih Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
                <!-- Tambahkan metode pembayaran lainnya jika perlu -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Metode Pembayaran</button>
    </form>

    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>Tanggal</th>
                <th>Penerima</th>
                <th>Alamat Kirim</th>
                <th>Buku yang Dipesan</th>
                <th>Grand Total</th>
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
                <td>{{ $order->metode_pembayaran ?? 'Belum Dibayar' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
