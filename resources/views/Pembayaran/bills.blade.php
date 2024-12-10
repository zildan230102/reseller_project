@extends('layouts.main')

@section('content')
<style>
.card-header-tagihan {
    padding: 15px 0 0 15px;
}
.card-body-tagihan {
    padding: 1rem 1rem 1.2rem 1rem;
}
@media (max-width: 576px) {
    h2.my-4 {
        font-size: 18px; /* Sesuaikan ukuran font untuk h2 */
    }

    .card-header-tagihan h4 {
        font-size: 16px; /* Sesuaikan ukuran font untuk Ringkasan Pembayaran */
    }

    .card-body p {
        font-size: 10px; /* Sesuaikan ukuran font untuk paragraf di dalam card body */
    }

    .form-check-label {
        font-size: 14px; /* Ukuran font untuk label checkbox */
    }

    .table th,
    .table td {
        font-size: 12px; /* Ukuran font untuk tabel */
    }

    .btn {
        font-size: 0.9rem; /* Ukuran font untuk tombol */
    }
        /* Untuk h5 */
        h5 {
        font-size: 14px; /* Sesuaikan ukuran font */
    }

    /* Untuk teks dalam div */
    .row div {
        font-size: 12px; /* Sesuaikan ukuran font */
    }

    /* Untuk strong */
    strong {
        font-size: 13px; /* Sesuaikan ukuran font */
    }
}

</style>
<div class="container">
    <h2 class="my-4">Checkout Pembayaran</h2>

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
                            <input class="form-check-input order-checkbox" type="checkbox" name="order_ids[]" 
                                value="{{ $order->id }}" id="order_{{ $order->id }}" data-total="{{ $order->grand_total }}">
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
                                    <th style="width: 500px">Nama Buku</th>
                                    <th style="width: 150px">Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->bukus as $buku)
                                @php
                                $subtotal = $buku->harga * $buku->pivot->jumlah;
                                @endphp
                                <tr>
                                    <td>{{ $buku->judul_buku }}</td>
                                    <td>{{ $buku->pivot->jumlah }}</td>
                                    <td class="text-end">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p class="text-end"><strong style="margin-right: 30px;">Grand Total</strong><strong style="margin-right: 8px;">Rp{{ number_format($order->grand_total, 0, ',', '.') }}</strong></p>
                        
                        <div class="row">
                        <h5 class="text-start">Alamat Pengiriman</h5>
                        
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
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3" id="payButton" disabled>Konfirmasi Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.order-checkbox');
    const payButton = document.getElementById('payButton');
    const totalTagihanElement = document.getElementById('totalTagihan');

    const updateTotalTagihan = () => {
        let totalTagihan = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalTagihan += parseFloat(checkbox.dataset.total);
            }
        });
        totalTagihanElement.textContent = totalTagihan.toLocaleString('id-ID');
        payButton.disabled = totalTagihan === 0;
    };

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalTagihan);
    });
});
</script>
@endsection
