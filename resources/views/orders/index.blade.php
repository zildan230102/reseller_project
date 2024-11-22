@extends('layouts.main')
@section('title', 'Buat Order')
@section('content')

<style>
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
<div class="container-order mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Order</h3>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body-order">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs nav-fill mb-4" id="orderTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="order-info-tab" data-bs-toggle="tab"
                        data-bs-target="#order-info" type="button" role="tab" aria-controls="order-info"
                        aria-selected="true">Informasi Order</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="shipping-info-tab" data-bs-toggle="tab" data-bs-target="#shipping-info"
                        type="button" role="tab" aria-controls="shipping-info" aria-selected="false">Informasi
                        Customer</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-notes-tab" data-bs-toggle="tab" data-bs-target="#payment-notes"
                        type="button" role="tab" aria-controls="payment-notes" aria-selected="false">Informasi
                        Pembayaran</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <form action="{{ route('orders.store') }}" method="POST" class="">
                @csrf
                <div class="tab-content" id="orderTabContent">
                    <!-- Tab 1: Order Info -->
                    <div class="tab-pane fade show active" id="order-info" role="tabpanel"
                        aria-labelledby="order-info-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" readonly
                                    value={{now()}}>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No HP Pengirim</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="toko_id" class="form-label">Toko</label>
                                <select id="toko_id" name="toko_id" class="form-control" required>
                                    <option value="">Pilih Toko</option>
                                    @foreach ($tokos as $toko)
                                    <option value="{{ $toko->id }}" data-marketplace="{{ $toko->marketplace }}">
                                        {{ $toko->nama_toko }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="asal_penjualan" class="form-label">Marketplace</label>
                                <input type="text" class="form-control" id="asal_penjualan" name="asal_penjualan"
                                    readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="ekspedisi_id" class="form-label">Ekspedisi</label>
                                <select class="form-select" name="ekspedisi_id" required>
                                    <option value="" disabled selected>Pilih Ekspedisi</option>
                                    @foreach ($ekspedisis as $ekspedisi)
                                    <option value="{{ $ekspedisi->id }}">{{ $ekspedisi->nama_ekspedisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="kode_booking" class="form-label">Kode Booking</label>
                                <input type="text" class="form-control" id="kode_booking" name="kode_booking" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="custom-button"
                                onclick="tabSelanjutnya('shipping-info-tab')">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Tab 2: Shipping Info -->
                    <div class="tab-pane fade" id="shipping-info" role="tabpanel" aria-labelledby="shipping-info-tab">
                        <div class="mb-3">
                            <label for="penerima" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" id="penerima" name="penerima" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp_penerima" class="form-label">No HP Penerima</label>
                            <input type="text" class="form-control" id="no_hp_penerima" name="no_hp_penerima" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat_kirim" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="alamat_kirim" name="alamat_kirim" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" required>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="custom-button"
                                onclick="tabSebelumnya('order-info-tab')">Sebelumnya</button>
                            <button type="button" class="custom-button"
                                onclick="tabSelanjutnya('payment-notes-tab')">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Tab 3: Payment and Notes -->
                    <div class="tab-pane fade" id="payment-notes" role="tabpanel" aria-labelledby="payment-notes-tab">
                        <div class="mb-3">
                            <label for="bukus" class="form-label">Pilih Buku</label>
                            <div id="buku-container">
                                <div class="row align-items-center mb-2">
                                    <div class="col-md-6">
                                        <select name="bukus[0][id]" class="form-select" required>
                                            <option value="">Pilih Buku</option>
                                            @foreach($bukus as $buku)
                                            <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="bukus[0][jumlah]" class="form-control"
                                            placeholder="Jumlah" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-buku">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="add-buku">Tambah Buku</button>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="total_berat" class="form-label">Total Berat (KG)</label>
                            <input type="number" class="form-control" id="total_berat" name="total_berat" required
                                step="0.01" min="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="grand_total" class="form-label">Grand Total</label>
                            <input type="number" step="0.01" class="form-control" id="grand_total" name="grand_total"
                                required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="custom-button"
                                onclick="tabSebelumnya('shipping-info-tab')">Sebelumnya</button>
                            <button type="submit" class="custom-button">Tambah Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Tabel Daftar Order Responsif -->
<div class="container-card">
    <div class="card">
        <div class="card-header">
            <h3 class="order-title mb-0">Daftar Order</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead class="table-light">
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
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill text-black"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="custom-dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#editOrderModal{{ $order->id }}">
                                                <i class="bi bi-pencil text-warning me-2"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form id="deleteForm" action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a type="button" class="custom-dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-order-id="{{ $order->id }}">
                                                    <i class="bi bi-trash text-danger me-2 fs-6"></i> Hapus
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus order ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-custom-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
@foreach ($orders as $order)
<div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
    aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Edit Order</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nav Tabs dalam Modal -->
                <ul class="nav nav-tabs" id="editOrderTab{{ $order->id }}" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="order-info-tab{{ $order->id }}" data-bs-toggle="tab"
                            data-bs-target="#order-info{{ $order->id }}" type="button" role="tab"
                            aria-controls="order-info" aria-selected="true">Informasi
                            Order</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-info-tab{{ $order->id }}" data-bs-toggle="tab"
                            data-bs-target="#shipping-info{{ $order->id }}" type="button" role="tab"
                            aria-controls="shipping-info" aria-selected="false">Informasi Customer</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payment-notes-tab{{ $order->id }}" data-bs-toggle="tab"
                            data-bs-target="#payment-notes{{ $order->id }}" type="button" role="tab"
                            aria-controls="payment-notes" aria-selected="false">Informasi Pembayaran</button>
                    </li>
                </ul>

                <!-- Tab Content dalam Modal -->
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="tab-content" id="editOrderTabContent{{ $order->id }}">
                        <!-- Informasi Order -->
                        <div class="tab-pane fade show active" id="order-info{{ $order->id }}" role="tabpanel"
                            aria-labelledby="order-info-tab{{ $order->id }}">
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal{{ $order->id }}" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal{{ $order->id }}" name="tanggal"
                                        value="{{ $order->tanggal }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp{{ $order->id }}" class="form-label">No HP
                                        Pengirim</label>
                                    <input type="text" class="form-control" id="no_hp{{ $order->id }}" name="no_hp"
                                        value="{{ $order->no_hp }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="toko_id{{ $order->id }}" class="form-label">Toko</label>
                                    <select id="toko_id{{ $order->id }}" name="toko_id" class="form-control" required
                                        onchange="updateMarketplace({{ $order->id }})">
                                        @foreach ($tokos as $toko)
                                        <option value="{{ $toko->id }}" data-marketplace="{{ $toko->marketplace }}"
                                            {{ $order->toko_id == $toko->id ? 'selected' : '' }}>
                                            {{ $toko->nama_toko }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="asal_penjualan{{ $order->id }}" class="form-label">Marketplace</label>
                                    <input type="text" class="form-control" id="asal_penjualan{{ $order->id }}"
                                        name="asal_penjualan" value="{{ $order->asal_penjualan }}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="ekspedisi_id" class="form-label">Ekspedisi</label>
                                    <select class="form-select" name="ekspedisi_id" required>
                                        @foreach ($ekspedisis as $ekspedisi)
                                        <option value="{{ $ekspedisi->id }}"
                                            {{ $ekspedisi->id == $order->ekspedisi_id ? 'selected' : '' }}>
                                            {{ $ekspedisi->nama_ekspedisi }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="kode_booking" class="form-label">Kode Booking</label>
                                    <input type="text" class="form-control" id="kode_booking" name="kode_booking"
                                        value="{{ old('kode_booking', $order->kode_booking) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Customer -->
                        <div class="tab-pane fade" id="shipping-info{{ $order->id }}" role="tabpanel"
                            aria-labelledby="shipping-info-tab{{ $order->id }}">
                            <div class="mt-3 mb-3">
                                <label for="penerima{{ $order->id }}" class="form-label">Nama Penerima</label>
                                <input type="text" class="form-control" id="penerima{{ $order->id }}" name="penerima"
                                    value="{{ $order->penerima }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="no_hp_penerima{{ $order->id }}" class="form-label">No HP
                                    Penerima</label>
                                <input type="text" class="form-control" id="no_hp_penerima{{ $order->id }}"
                                    name="no_hp_penerima" value="{{ $order->no_hp_penerima }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_kirim{{ $order->id }}" class="form-label">Alamat
                                    Kirim</label>
                                <textarea class="form-control" id="alamat_kirim{{ $order->id }}" name="alamat_kirim"
                                    required>{{ $order->alamat_kirim }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kelurahan{{ $order->id }}" class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan{{ $order->id }}"
                                        name="kelurahan" value="{{ $order->kelurahan }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kecamatan{{ $order->id }}" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan{{ $order->id }}"
                                        name="kecamatan" value="{{ $order->kecamatan }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kota{{ $order->id }}" class="form-label">Kota</label>
                                    <input type="text" class="form-control" id="kota{{ $order->id }}" name="kota"
                                        value="{{ $order->kota }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi{{ $order->id }}" class="form-label">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi{{ $order->id }}"
                                        name="provinsi" value="{{ $order->provinsi }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Pembayaran -->
                        <div class="tab-pane fade" id="payment-notes{{ $order->id }}" role="tabpanel"
                            aria-labelledby="payment-notes-tab{{ $order->id }}">

                            <div class="mb-3">
                                <label for="bukus" class="form-label">Buku</label>
                                <select class="form-control" id="bukus" name="bukus[]" multiple required>
                                    @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" @foreach($selectedBukus ?? [] as $selectedBuku)
                                        @if($selectedBuku['id']==$buku->id)
                                        selected
                                        @endif
                                        @endforeach
                                        data-jumlah="{{ $selectedBuku['jumlah'] ?? 1 }}">
                                        {{ $buku->judul_buku }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="catatan{{ $order->id }}" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan{{ $order->id }}"
                                    name="catatan">{{ $order->catatan }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="total_berat{{ $order->id }}" class="form-label">Total Berat
                                    (KG)</label>
                                <input type="number" class="form-control" id="total_berat{{ $order->id }}"
                                    name="total_berat" value="{{ $order->total_berat }}" required step="0.01"
                                    min="0.01">
                            </div>

                            <div class="mb-3">
                                <label for="grand_total{{ $order->id }}" class="form-label">Grand
                                    Total</label>
                                <input type="number" step="0.01" class="form-control" id="grand_total{{ $order->id }}"
                                    name="grand_total" value="{{ $order->grand_total }}" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="custom-button">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
document.getElementById('add-buku').addEventListener('click', function() {
    const container = document.getElementById('buku-container');
    const index = container.children.length;

    const template = `
        <div class="row align-items-center mb-2">
            <div class="col-md-6">
                <select name="bukus[${index}][id]" class="form-select" required>
                    <option value="">Pilih Buku</option>
                    @foreach($bukus as $buku)
                        <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="bukus[${index}][jumlah]" class="form-control" placeholder="Jumlah" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-buku">Hapus</button>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', template);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-buku')) {
        e.target.closest('.row').remove();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const bukuSelect = document.getElementById('bukus');
    const bukuDetails = document.getElementById('bukuDetails');

    bukuSelect.addEventListener('change', function() {
        const selectedOptions = Array.from(this.selectedOptions);
        bukuDetails.innerHTML = ''; // Clear existing buku details

        selectedOptions.forEach(function(option) {
            const bukuId = option.value;
            const bukuNama = option.textContent;
            const jumlah = option.getAttribute('data-jumlah') || 1; // Default jumlah is 1

            const div = document.createElement('div');
            div.classList.add('mb-3');
            div.innerHTML = `
                    <label for="buku_${bukuId}" class="form-label">Jumlah Buku: ${bukuNama}</label>
                    <input type="number" class="form-control" id="buku_${bukuId}" name="bukus[${bukuId}][jumlah]" value="${jumlah}" min="1" required>
                `;
            bukuDetails.appendChild(div);
        });
    });

    bukuSelect.dispatchEvent(new Event('change'));
});

console.log("TEST");

document.addEventListener("DOMContentLoaded", function() {
    // Mengambil tanggal hari ini dalam format YYYY-MM-DD
    var today = new Date().toISOString().split('T')[0];
    // Set nilai input dengan tanggal hari ini
    document.getElementById('tanggal').value = today;
});
document.addEventListener('DOMContentLoaded', function() {
    const tokoSelect = document.getElementById('toko_id');
    const marketplaceInput = document.getElementById('asal_penjualan');
    const tanggalInput = document.getElementById('tanggal');

    tokoSelect.addEventListener('change', function() {
        const selectedOption = tokoSelect.options[tokoSelect.selectedIndex];
        const marketplaceValue = selectedOption.getAttribute('data-marketplace');
        console.log({
            selectedOption,
            marketplaceInput
        })
        marketplaceInput.value = marketplaceValue || '';
    });

    const today = new Date().toISOString().split('T')[0];
    tanggalInput.value = today;

    // Handler untuk konfirmasi penghapusan
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var orderId = button.data('order-id'); // Ambil ID order dari data atribut tombol
        var actionUrl = "{{ url(' orders ') }}/" +
            orderId; // Ganti dengan URL yang sesuai untuk penghapusan order

        // Update action form dengan URL yang benar
        $('#deleteForm').attr('action', actionUrl);
    });

    // Handler untuk mengkonfirmasi penghapusan
    $('#confirmDelete').on('click', function() {
        $('#deleteForm').submit(); // Kirim form penghapusan
    });
});

// Modal Toko dan Marketplace
function updateMarketplace(orderId) {
    // Ambil elemen select dan input marketplace
    var tokoSelect = document.getElementById("toko_id" + orderId);
    var marketplaceInput = document.getElementById("asal_penjualan" + orderId);

    // Ambil data-marketplace dari option yang dipilih
    var selectedOption = tokoSelect.options[tokoSelect.selectedIndex];
    var marketplace = selectedOption.getAttribute("data-marketplace");

    // Update nilai input marketplace
    marketplaceInput.value = marketplace;
}

function tabSelanjutnya(tabId) {
    document.getElementById(tabId).click();
}

function tabSebelumnya(tabId) {
    document.getElementById(tabId).click();
}
</script>


@endsection