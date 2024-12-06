@extends('layouts.main')

@section('content')
<style>
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
</style>
<div class="container mt-4">
    <div class="card">
        <!-- Card Header -->
        <div class="card-header">
            <h2 class="mb-0">Riwayat Pembayaran</h2>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            @if($orders->isEmpty())
                <div class="alert alert-info">Belum ada riwayat pembayaran.</div>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
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
                                <button class="btn btn-sm btn-no-border" data-bs-toggle="modal" data-bs-target="#detailModal_{{ $payment->id }}" title="Lihat Detail">
                                    <i class="bi bi-info-circle text-black"></i>
                                </button>

                                <!-- Modal untuk Detail -->
                                <div class="modal fade" id="detailModal_{{ $payment->id }}" tabindex="-1" aria-labelledby="detailModalLabel_{{ $payment->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
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
                                                <p>
                                                    {{ $payment->alamat_kirim }}, {{ $payment->kelurahan }},
                                                    {{ $payment->kecamatan }}, {{ $payment->kota }},
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
            @endif
        </div>
    </div>
</div>

@endsection
