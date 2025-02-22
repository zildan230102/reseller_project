@extends('layouts.main')
@section('title', 'Checkout')
@section('content')

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
