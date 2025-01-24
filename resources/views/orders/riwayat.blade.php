@extends('layouts.main')
@section('title', 'Riwayat Pesanan')
@section('content')

<div class="container-riwayat mt-4 container-checkout {{ $orders->isEmpty() ? 'empty-content' : '' }}">
    <div class="card-container">
        @if($orders->isEmpty())
        <h2 class="my-4 text-title text-center">Riwayat Pesanan</h2>
        <div class="alert alert-info">Belum ada riwayat pesanan.</div>
        @else
        <div class="card mt-3">
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
                            <td>
                                @foreach($order->bukus as $buku)
                                    {{ $buku->judul_buku }} ({{ $buku->pivot->jumlah }}){{ !$loop->last ? ',' : '' }}<br>
                                @endforeach
                            </td>
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
                                <div class="dropdown" data-bs-display="static">
                                    <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill text-black"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="custom-dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $order->id }}">
                                                <i class="bi bi-eye text-primary me-2"></i> Detail
                                            </a>
                                        </li>
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
                                        <h5 class="modal-title" id="detailModalLabel{{ $order->id }}">Detail Pesanan:
                                            {{ $order->no_invoice }}</h5>
                                        <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal-pesanan">
                                        <dl class="row">
                                            <dt class="col-5 col-sm-3 mb-3">Tanggal Pemesanan</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $order->tanggal }}</dd>

                                            <dt class="col-5 col-sm-3 mb-3">Nama Penerima</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $order->penerima }}</dd>

                                            <dt class="col-5 col-sm-3 mb-3">Alamat Pengiriman</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $order->alamat_kirim }}</dd>

                                            <dt class="col-5 col-sm-3 mb-3">Buku yang Dipesan</dt>
                                            <dd class="col-7 col-sm-9 mb-3"> 
                                                @if($order->bukus->count() == 1)
                                                    : {{ $order->bukus->first()->judul_buku }} - {{ $order->bukus->first()->pivot->jumlah }} Buku
                                                @else
                                                    <ul>
                                                        @foreach($order->bukus as $buku)
                                                            <li> {{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} Buku</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </dd>
                                            <dt class="col-5 col-sm-3 mb-3">Total Harga</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: Rp{{ number_format($grandTotal, 2) }}</dd>
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
                                    <div class="modal-header modal-header-pesanan">
                                        <h5 class="modal-title" id="cancelModalLabel{{ $order->id }}">Batalkan Pesanan
                                            {{ $order->no_invoice }}</h5>
                                        <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal-pesanan">
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