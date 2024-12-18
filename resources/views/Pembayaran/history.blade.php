@extends('layouts.main')
@section('title', 'Riwayat Pembayaran')
@section('content')

<style>
.container-riwayat {
    width: 100%;
    padding: 0 20px 0 20px;
    padding-top: 40px;
    max-width: 1200px;
    margin: 0 auto;
    height: auto;
}
.header-title {
    padding: 20px;
}
.card-container {
    padding-top: 40px;
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

@media (min-width: 320px) and (max-width: 599px){
    .container-riwayat {
        padding: 0 20px 0 20px;
        padding-top: 40px;
        height: auto;
        margin: 0 auto;
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
    .modal-dialog {
        max-width: 85%;
        margin: 0 auto;
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
}
@media (min-width: 600px) and (max-width: 1280px) {
    .container-riwayat {
        padding: 40px 20px 0 20px;
        height: auto;
        max-width: 1200px;
    }
    .text-title {
        font-size: 25px;
        text-align: center;
    }
    .header-title {
        padding: 20px;
    }
    .modal-dialog {
        max-width: 90%;;
    }
}

</style>

<div class="container-riwayat mt-4">
    <div class="card-container">
        @if($orders->isEmpty())
        <h2 class="my-4 text-title">Riwayat Pembayaran</h2>
        <div class="alert alert-info">Belum ada riwayat pembayaran.</div>
        @else
        <div class="card history">
            <div class="header-title">
                <h3 class="text-title mb-0 text-start">Riwayat Pembayaran</h3>
            </div>
            <div class="card-body-toko">
                <div class="table-responsive">
                <table class="table table-striped table-bordered ">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal</th>
                            <th>Invoice</th>
                            <th>Total</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $payment)
                        <tr>
                            <td>{{ $payment->tanggal_pembayaran ? $payment->tanggal_pembayaran->format('d-m-Y') : 'Belum Dibayar' }}</td>
                            <td>{{ $payment->no_invoice }}</td>
                            <td>Rp{{ number_format($payment->grand_total, 0, ',', '.') }}</td>
                            <td class="text-center">{{ ucfirst($payment->metode_pembayaran ?? 'Tidak Diketahui') }}</td>
                            <td class="text-center">{{ ucfirst($payment->status ?? 'Belum Dibayar') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-no-border" data-bs-toggle="modal" data-bs-target="#detailModal_{{ $payment->id }}" title="Lihat Detail">
                                    <i class="bi bi-info-circle text-black"></i>
                                </button>

                                <!-- Modal untuk Detail -->
                                <div class="modal fade" id="detailModal_{{ $payment->id }}" tabindex="-1" aria-labelledby="detailModalLabel_{{ $payment->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel_{{ $payment->id }}">Detail Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="row">
                                                    <dt class="col-5 col-sm-3 mb-3">Tanggal Pembayaran</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ $payment->tanggal_pembayaran ? $payment->tanggal_pembayaran->format('d-m-Y') : 'Belum Dibayar' }}</dd>
                                                    
                                                    <dt class="col-5 col-sm-3 mb-3">Invoice</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ $payment->no_invoice }}</dd>
                                                    
                                                    <dt class="col-5 col-sm-3 mb-3">Total</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: Rp{{ number_format($payment->grand_total, 0, ',', '.') }}</dd>

                                                    <dt class="col-5 col-sm-3 mb-3">Metode Pembayaran</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ ucfirst($payment->metode_pembayaran ?? 'Tidak Diketahui') }}</dd>

                                                    <dt class="col-5 col-sm-3 mb-3">Status</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ ucfirst($payment->status ?? 'Belum Dibayar') }}</dd>

                                                    <dt class="col-5 col-sm-3 mb-3">Alamat Kirim</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ $payment->alamat_kirim }}<br>
                                                        {{ $payment->kelurahan }}, {{ $payment->kecamatan }}, {{ $payment->kota }}<br> 
                                                        {{ $payment->provinsi }}</dd>
                                                    
                                                    <dt class="col-5 col-sm-3">Buku yang Dipesan</dt>
                                                    <dd>
                                                        <ul>
                                                            @foreach ($payment->bukus as $buku)
                                                                <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} pcs</li>
                                                            @endforeach
                                                        </ul>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
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
