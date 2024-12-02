@extends('layouts.main')

@section('title', 'Riwayat Pesanan')
@section('content')

<style>
.container-order {
    max-width: 1200px;
    margin: 70px auto auto auto;
    padding-top: 50px;
}

.container-card {
    max-width: 1200px;
    margin: 0 auto;
}

.card-header {
    position: relative;
    z-index: 1;
}

.card-body-order {
    padding: 1.5rem;
}

.dropdown-menu {
    min-width: auto;
    width: max-content;
    padding: 0.5rem;
    z-index: 1050;
}

.custom-dropdown-item {
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: start;
    padding: 0.4rem 0.8rem;
    color: #333;
    text-decoration: none;
    box-sizing: border-box;
    transition: background-color 0.2s ease;
}

.custom-dropdown-item:hover {
    background-color: #f0f0f0;
    color: #000;
    text-decoration: none;
}

.custom-dropdown-item i {
    margin-right: 8px;
    margin-left: 0;
}

.dropdown .btn-no-border {
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0;
}

.nav-tabs .nav-link {
    color: #000000;
    border: 1px solid transparent;
}

.nav-tabs .nav-link.active {
    color: #FFA500;
}

.nav-tabs .nav-link:hover {
    color: #FFA500;
}

.order-title {
    font-size: 1.5rem;
}

@media (max-width: 768px) {
    .order-title {
        font-size: 1.25rem;
    }

    .table th,
    .table td {
        font-size: 0.9rem;
        padding: 0.5rem;
    }

    .custom-dropdown-item {
        font-size: 0.9rem;
        padding: 0.3rem 0.6rem;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 0.5rem;
    }

    .card h3 {
        font-size: 1.2rem;
    }

    .card-body-order,
    .form-label,
    .form-control {
        font-size: 1rem;
    }

    .nav-tabs .nav-item .nav-link {
        font-size: 0.8rem;
        padding: 0.4rem;
    }

    .custom-button {
        font-size: 0.7rem;
        padding: 0.4rem 0.8rem;
    }

    .btn-custom-danger {
        font-size: 0.7rem;
        padding: 0.3rem 0.6rem;
    }

    .card-header {
        padding: 15px 15px 0px 15px;
    }

    .order-title {
        font-size: 1rem;
    }

    .form-label {
        font-size: 14px;
    }

    table {
        overflow-x: auto;
        font-size: 14px;
    }

    .custom-dropdown-item {
        font-size: 0.8rem;
        padding: 0.2rem 0.5rem;
    }

    .dropdown-menu {
        width: auto;
        min-width: 120px;
        max-width: 90px;
    }

    .modal-dialog {
        max-width: 85%;
        margin: 0 auto;
    }

    .modal-content {
        padding: 10px;
    }

    .modal-header {
        padding: 5px 10px 10px 10px;
    }

    .modal-body {
        font-size: 12px;
        padding: 15px 10px 15px 10px;
    }

    .modal-title {
        font-size: 1.1rem !important;
    }

    .modal-footer {
        padding: 5px 5px 0px 5px;
    }
}
</style>

<!-- Halaman Riwayat Order -->
<div class="container-order">
    <div class="card">
        <div class="card-header">
            <h3 class="order-title mb-0">Riwayat Order</h3>
        </div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Invoice</th>
                            <th>Buku</th>
                            <th>Grand Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td>{{ $order->no_invoice }}</td>

                            <!-- Menampilkan daftar buku yang ada di dalam order -->
                            <td>
                                @foreach($order->bukus as $buku)
                                {{ $buku->judul_buku }} ({{ $buku->pivot->jumlah }}),
                                @endforeach
                            </td>

                            <!-- Menampilkan Grand Total -->
                            <td>
                                @php
                                $grandTotal = 0;
                                foreach ($order->bukus as $buku) {
                                $grandTotal += $buku->harga * $buku->pivot->jumlah;
                                }
                                @endphp
                                {{ number_format($grandTotal, 2) }}
                            </td>
                            <td class="text-center">
                                <!-- Aksi Detail & Batalkan -->
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill text-black"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- Modal Detail Pesanan -->
                                        <li>
                                            <a class="custom-dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $order->id }}">
                                                <i class="bi bi-eye text-primary me-2"></i> Detail
                                            </a>
                                        </li>
                                        <!-- Modal Batalkan Pesanan -->
                                        @if($order->status != 'canceled')
                                        <li>
                                            <a class="custom-dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#cancelModal{{ $order->id }}">
                                                <i class="bi bi-x-circle text-danger me-2"></i> Batalkan
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail Pesanan -->
                        <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="detailModalLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $order->id }}">Detail Pesanan
                                            {{ $order->no_invoice }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Tanggal:</strong> {{ $order->tanggal }}</p>
                                        <p><strong>Penerima:</strong> {{ $order->penerima }}</p>
                                        <p><strong>Alamat Kirim:</strong> {{ $order->alamat_kirim }}</p>
                                        <h6>Buku yang Dipesan:</h6>
                                        <ul>
                                            @foreach($order->bukus as $buku)
                                            <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} Buku</li>
                                            @endforeach
                                        </ul>
                                        <p><strong>Total Harga:</strong> {{ number_format($grandTotal, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Batalkan Pesanan -->
                        <div class="modal fade" id="cancelModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="cancelModalLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel{{ $order->id }}">Batalkan Pesanan
                                            {{ $order->no_invoice }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-custom-danger">Batalkan Pesanan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
<!-- Tambahkan jQuery terlebih dahulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Tambahkan file JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

</script>

@endsection