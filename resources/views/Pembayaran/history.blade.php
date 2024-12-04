@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Riwayat Pembayaran</h2>

    @if(empty($orders))
        <div class="alert alert-info">Belum ada riwayat pembayaran.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Invoice</th>
                    <th>Total</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $payment)
                <tr>
                    <td>{{ $payment['date'] }}</td>
                    <td>{{ $payment['no_invoice'] }}</td>
                    <td>Rp{{ number_format($payment['amount'], 0, ',', '.') }}</td>
                    <td>{{ ucfirst($payment['method']) }}</td>
                    <td>{{ $payment['status'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
