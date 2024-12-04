@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Checkout Pembayaran</h2>

    @if($orders->isEmpty())
    <div class="alert alert-info">Tidak ada pesanan yang perlu dibayar.</div>
    @else
    <form action="{{ route('payment.process') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Kolom Kiri: Informasi Pesanan -->
            <div class="col-md-8">
                @foreach ($orders as $order)
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="order_ids[]" value="{{ $order->id }}"
                                id="order_{{ $order->id }}">
                            <label class="form-check-label" for="order_{{ $order->id }}">
                                <strong>Invoice:</strong> {{ $order->no_invoice }}
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5>Detail Produk</h5>
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

                        <h5>Alamat Pengiriman</h5>
                        <p>
                            {{ $order->alamat_kirim }}<br>
                            {{ $order->kelurahan }}, {{ $order->kecamatan }}, {{ $order->kota }},
                            {{ $order->provinsi }}<br>
                            <strong>Penerima:</strong> {{ $order->penerima }} ({{ $order->no_hp_penerima }})
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Kolom Kanan: Ringkasan dan Pembayaran -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Ringkasan Pembayaran</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Total Tagihan:</strong>
                            Rp{{ number_format($orders->sum('grand_total'), 0, ',', '.') }}</p>

                        <div class="form-group">
                            <label for="metode_pembayaran">Metode Pembayaran:</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3" id="payButton" disabled>Konfirmasi
                            Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

<script>
// Script untuk mengaktifkan tombol bayar jika ada checkbox yang dipilih
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="order_ids[]"]');
    const payButton = document.getElementById('payButton');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            payButton.disabled = !anyChecked;
        });
    });
});
</script>
@endsection