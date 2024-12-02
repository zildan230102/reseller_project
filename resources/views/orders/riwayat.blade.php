@extends('layouts.main')

@section('title', 'Riwayat Pesanan')

@section('content')

<style>
.card-body {
    padding: 0 auto;
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
.order-title {
    font-size: 1.5rem;
}
@media (max-width: 576px) {
    .order-title {
        font-size: 1rem;
    }
    
    
}
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
          <h3 class="order-title mb-0">Riwayat Pesanan</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead class="text-center table-light">
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
                    <td class="text-center">{{ $loop->iteration }}</td>
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
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4"><strong>Tanggal</strong></div>
                                    <div class="col-1">:</div>
                                    <div class="col-6">{{ $order->tanggal }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Penerima</strong></div>
                                    <div class="col-1">:</div>
                                    <div class="col-6">{{ $order->penerima }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Alamat Kirim</strong></div>
                                    <div class="col-1">:</div>
                                    <div class="col-6">{{ $order->alamat_kirim }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Buku yang Dipesan</strong></div>
                                    <div class="col-1">:</div>
                                    <div class="col-6">
                                        <ul>
                                            @foreach($order->bukus as $buku)
                                            <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} Buku</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Total Harga</strong></div>
                                    <div class="col-1">:</div>
                                    <div class="col-6">{{ number_format($grandTotal, 2) }}</div>
                                </div>
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
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                            </div>
                            @if ($order->status !== 'canceled')
                            <div class="modal-footer">
                                <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-custom-danger">Batalkan Pesanan</button>
                                </form>
                            </div>    
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>
      @endsection