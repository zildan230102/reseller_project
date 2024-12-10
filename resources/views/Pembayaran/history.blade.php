@extends('layouts.main')

@section('title', 'Riwayat Pembayaran')

@section('content')
<style>
.container-riwayat {
    width: 100%;
    padding: 20px;
    padding-top: 80px;
    max-width: 1200px;
    margin: 0 auto;
    height: 400px;
}
.dropdown .btn-no-border {
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0;
}
.no-border-dropdown {
    border: none;
    box-shadow: none;
}
.no-border-item {
    border: none;
    background-color: transparent;
}
.no-border-item:hover {
    background-color: #f8f9fa;
    border: none;
}
.card-body-toko {
    padding: 15px;
}
@media (max-width: 576px) {
    .container {
        padding: 5px;
        padding-top: 60px;
    }
    .text-title{
        font-size: 20px;
        text-align: center;
        margin-bottom: 16px !important;
    }
    .table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        font-size: 14px;
        overflow: visible;
    }
    .modal-dialog {
        max-width: 85%;
        margin: 0 auto;
    }
    .modal-content {
        padding: 10px;
        overflow: hidden;
    }
    .modal-header {
        padding: 5px 10px 10px 10px;
    }
    .modal-body {
        font-size: 12px;
        padding: 15px 10px 15px 10px;
        overflow-y: auto; 
    }

    .modal-title {
        font-size: 16px;
    }
    .modal-footer {
        padding: 5px 5px 0px 5px;
    }
}
</style>

<div class="container-riwayat mt-4">
    <div class="card-container">
        @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada riwayat pembayaran.</div>
        @else
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-title mb-0">Riwayat Pembayaran</h3>
            </div>
            <div class="card-body-toko">
                <div class="table-responsive-sm">
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
                            <td>{{ ucfirst($payment->metode_pembayaran ?? 'Tidak Diketahui') }}</td>
                            <td>{{ ucfirst($payment->status ?? 'Belum Dibayar') }}</td>
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
                                                <p><strong>Tanggal Pembayaran:</strong> {{ $payment->tanggal_pembayaran ? $payment->tanggal_pembayaran->format('d-m-Y') : 'Belum Dibayar' }}</p>
                                                <p><strong>Invoice:</strong> {{ $payment->no_invoice }}</p>
                                                <p><strong>Total:</strong> Rp{{ number_format($payment->grand_total, 0, ',', '.') }}</p>
                                                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($payment->metode_pembayaran ?? 'Tidak Diketahui') }}</p>
                                                <p><strong>Status:</strong> {{ ucfirst($payment->status ?? 'Belum Dibayar') }}</p>
                                                <p><strong>Alamat Kirim:</strong></p>
                                                <p class="alamat-kirim">
                                                    {{ $payment->alamat_kirim }}<br>
                                                    {{ $payment->kelurahan }}, {{ $payment->kecamatan }}, {{ $payment->kota }}<br> 
                                                    {{ $payment->provinsi }}
                                                </p>
                                                <p><strong>Buku yang Dipesan:</strong></p>
                                                <ul>
                                                    @foreach ($payment->bukus as $buku)
                                                        <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} pcs</li>
                                                    @endforeach
                                                </ul>
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
