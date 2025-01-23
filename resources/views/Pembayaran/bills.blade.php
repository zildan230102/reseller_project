@extends('layouts.main')
@section('title', 'Checkout')
@section('content')

<style>
.container-checkout {
    width: 100%;
    padding: 0 20px 0 20px;
    padding-top: 70px;
    max-width: 1200px;
    margin: 0 auto;
}
.card-header-tagihan {
    padding: 15px 0 0 15px;
}
.card-body-tagihan {
    padding: 16px;
}
.title {
    padding: 20px 0px 0px 30px;
    font-size: 18px;
    font-weight: bold;
}
.text-title {
    text-align: center;
}

#payButton:hover {
    background-color: #c66300;
}

.btn-secondary {
    background-color: #f57c00;
    color: white;
}
.container-checkout.empty-content {
    height: 400px;
}
.container-checkout:not(.empty-content) {
    height: auto; 
}

@media (min-width: 320px) and (max-width: 599px) {
    .container-checkout {
        height: auto;
    }
    .container-checkout.empty-content {
        height: 250px;
    }
    .container-checkout:not(.empty-content) {
        height: auto; 
    }
    .text-title {
        font-size: 18px;
        text-align: center;
    }
    h2 {
        font-size: 18px;
    }
    .card-header-tagihan h4 {
        font-size: 16px;
    }
    .card-body p {
        font-size: 10px;
    }
    .form-check-label {
        font-size: 14px;
    }
    .table th,
    .table td {
        font-size: 12px;
    }
    .btn {
        font-size: 12px;
    }
    h5 {
        font-size: 14px; 
    }
    .row div {
        font-size: 12px; 
    }
    strong {
        font-size: 13px;
    }
    select.form-control {
        font-size: 12px;
        padding: 4px;
        height: auto;
    }
    option {
        font-size: 10px;
    }
    .title {
        padding: 15px 0px 5px 15px;
        font-size: 16px;
    }
    .grand-total {
        text-align: right !important;
        display: block; 
        width: 100%;
        margin: 0; 
        padding-right: 5px; 
        font-size: 14px;
    }
    .grand-total strong {
    margin-right: 0 !important;
    }
    .alert-info {
        padding: 16px;
        font-size: 12px;
    }
    .custom-dropdown {
        font-size: 12px;
    }
    .form-select option {
        font-size: 12px;
    }
    .form-select {
        font-size: 12px;
    }
}
@media (min-width: 600px) and (max-width: 1024px) {
    .container-checkout {
        padding: 60px 40px 0 40px;
        height: auto;
        max-width: 1200px;
    }
    .container-checkout.empty-content {
        height: 650px;
    }
    .container-checkout:not(.empty-content) {
        height: auto; 
    }
    .card-header-tagihan h4{
        font-size: 16px;
        padding-bottom: 0;
    }
    .card-body-tagihan {
        padding-top: 10px;
        font-size: 14px;
    }
    .title {
        font-size: 18px;
    }
    .btn {
        white-space: nowrap; 
        display: inline-block;
        padding: 10px 20px; 
        font-size: 14px; 
    }
    select.form-control {
        font-size: 14px;
        padding: 4px;
        height: auto;
    }
    option {
        font-size: 12px;
        padding: 4px;
    }
    .cform-select {
        font-size: 14px;
    }
    .form-select option {
        font-size: 12px;
    }
    .custom-dropdown {
        font-size: 14px;
    }
    .form-select.custom-dropdown option {
        font-size: 12px; 
    }
}

@media (min-width: 1025px) and (max-width: 1280px) {
    .container-checkout {
        padding: 70px 40px 0 40px;
        height: auto;
        max-width: 1200px;
    }
    .container-checkout.empty-content {
        height: 400px;
    }
    .container-checkout:not(.empty-content) {
        height: auto; 
    }
    .card-header-tagihan h4{
        font-size: 16px;
        padding-bottom: 0;
    }
    .card-body-tagihan {
        padding-top: 10px;
        font-size: 14px;
    }
    .title {
        font-size: 18px;
        padding-left: 20px;
    }
    .btn {
        white-space: nowrap; 
        display: inline-block;
        padding: 10px 20px; 
        font-size: 14px; 
    }
    select.form-control {
        font-size: 14px;
        padding: 4px;
        height: auto;
    }
    option {
        font-size: 12px;
        padding: 4px;
    }
    .cform-select {
        font-size: 14px;
    }
    .form-select option {
        font-size: 12px;
    }
}
</style>
<div class="container-checkout {{ $orders->isEmpty() ? 'empty-content' : '' }}">
    <h2 class="my-4 text-title">Checkout Pembayaran</h2>

    @if($orders->isEmpty())
    <div class="alert alert-info">Tidak ada pesanan yang perlu dibayar.</div>
    @else
    <form action="{{ route('payment.process') }}" method="POST" id="paymentForm">
        @csrf

        <div class="row">
            <!-- Kolom Kiri: Informasi Pesanan -->
            <div class="col-md-8">
                @foreach ($orders as $order)
                <div class="card mb-4">
                    <div class="card-header-tagihan">
                        <div class="form-check">
                            <input class="form-check-input order-checkbox" type="checkbox" name="order_ids[]" 
                                value="{{ $order->id }}" id="order_{{ $order->id }}" data-total="{{ $order->grand_total }}">
                            <label class="form-check-label" for="order_{{ $order->id }}">
                                <strong>Invoice:</strong> {{ $order->no_invoice }}
                            </label>
                        </div>
                    </div>

                    <div class="title">Detail Produk</div>

                    <div class="card-body-tagihan">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 500px">Nama Buku</th>
                                    <th style="width: 150px">Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $grandTotal = 0;
                                @endphp
                                @foreach ($order->bukus as $buku)
                                @php
                                $subtotal = $buku->harga * $buku->pivot->jumlah;
                                $grandTotal += $subtotal; // Tambahkan subtotal ke grand total
                                @endphp
                                <tr>
                                    <td>{{ $buku->judul_buku }}</td>
                                    <td>{{ $buku->pivot->jumlah }}</td>
                                    <td class="text-end">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="grand-total text-end">
                            <strong style="margin-right: 30px;">Grand Total</strong>
                            <strong style="margin-right: 8px;">Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong>
                        </div>

                        
                        
                        <div class="row">
                            <h6 class="text-start mt-2">Alamat Pengiriman</h6>
                        
                            <div class="col-8">
                                {{ $order->alamat_kirim }}<br>
                                {{ $order->kelurahan }}, {{ $order->kecamatan }}, {{ $order->kota }},
                                {{ $order->provinsi }}<br>
                            </div>
                            <div class="col-4">
                                <strong>Penerima:</strong> {{ $order->penerima }} ({{ $order->no_hp_penerima }})
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Kolom Kanan: Ringkasan dan Pembayaran -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header-tagihan">
                        <h4>Ringkasan Pembayaran</h4>
                    </div>
                    <div class="card-body-tagihan">
                        <p><strong>Total Tagihan:</strong> 
                        Rp<span id="totalTagihan">0</span></p>

                        <div class="form-group">
                            <label for="metode_pembayaran">Metode Pembayaran:</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-select custom-dropdown" required>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-secondary btn-block" id="payButton" disabled>Konfirmasi Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

@endsection
