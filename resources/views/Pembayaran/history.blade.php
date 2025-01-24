@extends('layouts.main')
@section('title', 'Riwayat Pembayaran')
@section('content')


<div class="container-riwayat mt-4 {{ $orders->isEmpty() ? 'empty-content' : '' }}">
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
                                <button type="button" class="btn btn-sm btn-aksi btn-no-border" data-bs-toggle="modal" data-bs-target="#detailModal_{{ $payment->id }}" title="Lihat Detail">
                                    <i class="bi bi-info-circle text-black"></i>
                                </button>

                                <!-- Modal untuk Detail -->
                                <div class="modal fade" id="detailModal_{{ $payment->id }}" tabindex="-1" aria-labelledby="detailModalLabel_{{ $payment->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header modal-pembayaran-header">
                                                <h5 class="modal-title" id="detailModalLabel_{{ $payment->id }}">Detail Pembayaran</h5>
                                                <button type="button" class="btn-close btn-modal-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body modal-pembayaran">
                                                <dl class="row">
                                                    <dt class="col-5 col-sm-3 mb-3">Tanggal Pembayaran</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ $payment->tanggal_pembayaran ? $payment->tanggal_pembayaran->format('d-m-Y') : 'Belum Dibayar' }}</dd>
                                                    
                                                    <dt class="col-5 col-sm-3 mb-3"> Nomor Invoice</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ $payment->no_invoice }}</dd>
                                                    
                                                    <dt class="col-5 col-sm-3 mb-3">Total Pembayaran</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: Rp{{ number_format($payment->grand_total, 0, ',', '.') }}</dd>

                                                    <dt class="col-5 col-sm-3 mb-3">Metode Pembayaran</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ ucfirst($payment->metode_pembayaran ?? 'Tidak Diketahui') }}</dd>

                                                    <dt class="col-5 col-sm-3 mb-3">Status Pembayaran</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">: {{ ucfirst($payment->status ?? 'Belum Dibayar') }}</dd>

                                                    <dt class="col-5 col-sm-3 mb-3">Alamat Pengiriman</dt>
                                                    <dd class="col-7 col-sm-9 mb-3">
                                                        <div class="alamat-kirim">: {{ $payment->alamat_kirim }}</div>
                                                        <div>  {{ $payment->kelurahan }}</div>
                                                        <div>  {{ $payment->kecamatan }}</div> 
                                                        <div>  {{ $payment->kota }}</div> 
                                                        <div>  {{ $payment->provinsi }}</div>
                                                    </dd>
                                                    
                                                    <dt class="col-5 col-sm-3">Buku yang Dipesan</dt>
                                                    <dd class="col-7 col-sm-9 mb-3 buku-pesan ">
                                                        @if ($payment->bukus->count() == 1)
                                                            : {{ $payment->bukus->first()->judul_buku }} - {{ $payment->bukus->first()->pivot->jumlah }} Buku
                                                        @else
                                                            <ul>
                                                                @foreach ($payment->bukus as $buku)
                                                                    <li>{{ $buku->judul_buku }} - {{ $buku->pivot->jumlah }} Buku</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
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
