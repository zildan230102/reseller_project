@extends('layouts.main')
@section('title', 'Riwayat Pesanan')
@section('content')

<style>
.container-riwayat {
    width: 100%;
    padding: 0 20px 0 20px;
    padding-top: 80px;
    max-width: 1200px;
    margin: 0 auto;
    height: 400px;
}
.header-title {
    padding: 20px;
}
.btn-no-border {
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0;
}
.btn-no-border:focus,
.btn-no-border:focus-visible {
    outline: none;
    box-shadow: none;
}
.card-body-toko {
    padding: 0px 10px;
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

@media (min-width: 320px) and (max-width: 599px) {
    .container-riwayat {
        padding-top: 80px;
        height: auto;
    }
    .text-title {
        font-size: 18px;
        text-align: center;
    }
    .header-title {
        padding: 15px;
    }
    .text-title{
        font-size: 18px;
        text-align: center;
    }
    .table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        font-size: 14px;
        overflow: visible;
    }
    .table th,
    .table td {
        font-size: 10px; 
        padding: 5px; 
    }
    .judul-buku {
        display: block;
    }
    .modal-title {
        font-size: 18px;
        max-width: 240px;
    }
    .modal-content {
        max-height: 90vh;
    }
    .modal-header {
        font-size: 16px;
        padding: 10px;
    }
    .modal-body {
        font-size: 12px;
        padding: 10px 20px;
        overflow-y: auto; 
    }
    .alert-info {
        padding: 16px;
        font-size: 12px;
    }
    .modal-dialog {
        max-width: 320px;
        margin: 0 auto;
    }
    .modal-header-pesanan {
        padding: 1rem 1rem 1rem 1.5rem;
    }
    .modal-pesanan {
        padding: 1rem 1rem 0 1.5rem;
    }
    .modal-body dl dt {
        flex: 0 0 40%; 
        max-width: 40%; 
        text-align: left;
    }
    .modal-body dl dd {
        flex: 0 0 60%; 
        max-width: 60%; 
    }
    .modal-body dl dd ul {
        padding-left: 0; 
        margin: 0; 
        list-style-position: inside; 
        display: block;
    }
    .aksi {
        font-size: 12px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
    .custom-dropdown-item {
        font-size: 12px;
    }
    .btn-modal-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1; 
    }
}
@media (min-width: 600px) and (max-width: 1024px){
    .container-riwayat {
        padding: 80px 30px 0 30px;
        height: auto;
        max-width: 1200px;
    }
    .header-title {
        padding: 20px;
    }
    .text-title {
        font-size: 25px;
        text-align: center;
    }
    .modal-dialog {
        max-width: 500px;
        margin: 0 auto;
    }
    .modal-header-pesanan {
        padding: 1.5rem 1rem 1rem 2rem;
    }
    .modal-pesanan {
        padding: 1rem 2rem 0.5rem 2rem;
    }
    .modal-body dl dt {
        flex: 0 0 25%; 
        max-width: 30%; 
        text-align: left;
    }
    .modal-body dl dd {
        flex: 0 0 75%; 
        max-width: 70%; 
    }
    .modal-body dl dd ul {
        padding-left: 0; 
        margin: 0; 
        list-style-position: inside; 
    }
    .aksi {
        font-size: 14px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
    .btn-modal-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1; 
    }
}
@media (min-width: 1025px) and (max-width: 1280px) {
    .container-riwayat {
        padding: 80px 30px 0 30px;
        height: auto;
        max-width: 1200px;
    }
    .header-title {
        padding: 20px;
    }
    .text-title {
        font-size: 25px;
        text-align: center;
    }
    .modal-dialog {
        max-width: 600px;
        margin: 0 auto;
    }
    .modal-header-pesanan {
        padding: 1.5rem 1rem 1rem 2rem;
    }
    .modal-pesanan {
        padding: 1rem 2rem 0.5rem 2rem;
    }
    .modal-body dl dt {
        flex: 0 0 35%; 
        max-width: 40%; 
        text-align: left;
    }
    .modal-body dl dd {
        flex: 0 0 65%; 
        max-width: 60%; 
    }
    .modal-body dl dd ul {
        padding-left: 0; 
        margin: 0; 
        list-style-position: inside; 
    }
    .aksi {
        font-size: 14px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
    .btn-modal-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1; 
    }
}
</style>

<div class="container-riwayat mt-4">
    <div class="card-container">
        @if($orders->isEmpty())
        <h2 class="my-4 text-title">Riwayat Pesanan</h2>
        <div class="alert alert-info">Belum ada riwayat pesanan.</div>
        @else
        <div class="card">
            <div class="header-title">
                <h3 class="text-title mb-0 text-start">Riwayat Pesanan</h3>
            </div>
            <div class="card-body-toko">
                <div class="table-responsive">
                <table class="table table-bordered table-striped">
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
                                    {{ $buku->judul_buku }} ({{ $buku->pivot->jumlah }}){{ !$loop->last ? ',' : '' }}<br>
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
                                    <ul class="dropdown-menu aksi">
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
                            aria-labelledby="detailModalLabel{{ $order->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header modal-header-pesanan">
                                        <h5 class="modal-title" id="detailModalLabel{{ $order->id }}">Detail Pesanan
                                            {{ $order->no_invoice }}</h5>
                                        <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal-pesanan">
                                        <dl class="row">
                                            <dt class="col-5 col-sm-3 mb-3">Tanggal</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $order->tanggal }}</dd>

                                            <dt class="col-5 col-sm-3 mb-3">Penerima</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $order->penerima }}</dd>

                                            <dt class="col-5 col-sm-3 mb-3">Alamat Kirim</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $order->alamat_kirim }}</dd>

                                            <dt class="col-5 col-sm-3 mb-3">Buku yang Dipesan</dt>
                                            <dd> 
                                                <ul>
                                                    @foreach($order->bukus as $buku)
                                                    <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} Buku</li>
                                                    @endforeach
                                                </ul>
                                            </dd>

                                            <dt class="col-5 col-sm-3 mb-3">Total Harga</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ number_format($grandTotal, 2) }}</dd>
                                        </dl>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
        
                        <!-- Modal Batalkan Pesanan -->
                        <div class="modal fade" id="cancelModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="cancelModalLabel{{ $order->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
        @endif
    </div>
</div>
@endsection