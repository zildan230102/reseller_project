@extends('layouts.main')

@section('title', 'Buat Order')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Buat Order</h2>

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

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="orderTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="order-info-tab" data-bs-toggle="tab" data-bs-target="#order-info" type="button" role="tab" aria-controls="order-info" aria-selected="true">Informasi Order</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="shipping-info-tab" data-bs-toggle="tab" data-bs-target="#shipping-info" type="button" role="tab" aria-controls="shipping-info" aria-selected="false">Informasi Customer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="payment-notes-tab" data-bs-toggle="tab" data-bs-target="#payment-notes" type="button" role="tab" aria-controls="payment-notes" aria-selected="false">Informasi Pembayaran</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <form action="{{ route('orders.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="tab-content" id="orderTabContent">
            <!-- Tab 1: Order Info -->
            <div class="tab-pane fade show active" id="order-info" role="tabpanel" aria-labelledby="order-info-tab">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        @error('no_hp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="toko_id" class="form-label">Toko</label>
                        <select id="toko_id" name="toko_id" class="form-control" required>
                            <option value="">-- Pilih Toko --</option>
                            @foreach($tokos as $toko)
                                <option value="{{ $toko->id }}" data-marketplace="{{ $toko->marketplace }}">{{ $toko->nama_toko }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asal_penjualan" class="form-label">Marketplace</label>
                        <input type="text" class="form-control" id="asal_penjualan" name="asal_penjualan" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="custom-button" onclick="tabSelanjutnya('shipping-info-tab')">Selanjutnya</button>
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
                    <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                    <textarea class="form-control" id="alamat_kirim" name="alamat_kirim" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="custom-button" onclick="tabSebelumnya('order-info-tab')">Sebelumnya</button>
                    <button type="button" class="custom-button" onclick="tabSelanjutnya('payment-notes-tab')">Selanjutnya</button>
                </div>
            </div>

            <!-- Tab 3: Payment and Notes -->
            <div class="tab-pane fade" id="payment-notes" role="tabpanel" aria-labelledby="payment-notes-tab">
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan"></textarea>
                </div>

                <div class="mb-3">
                    <label for="total_berat" class="form-label">Total Berat (KG)</label>
                    <input type="number" class="form-control" id="total_berat" name="total_berat" required>
                </div>

                <div class="mb-3">
                    <label for="grand_total" class="form-label">Grand Total</label>
                    <input type="number" step="0.01" class="form-control" id="grand_total" name="grand_total" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="custom-button" onclick="tabSebelumnya('shipping-info-tab')">Sebelumnya</button>
                    <button type="submit" class="custom-button">Tambah Order</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Tabel Daftar Order -->
    <h3>Daftar Order</h3>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Invoice</th>
                <th>Toko</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->tanggal }}</td>
                <td>{{ $order->no_invoice }}</td>
                <td>{{ $order->toko->nama_toko }}</td>
                <td>{{ $order->no_hp }}</td>
                <td>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">Edit</button>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus order ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script untuk mengisi Asal Penjualan otomatis dan Tanggal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tokoSelect = document.getElementById('toko_id');
    const marketplaceInput = document.getElementById('asal_penjualan');
    const tanggalInput = document.getElementById('tanggal');
    
    tokoSelect.addEventListener('change', function () {
        const selectedOption = tokoSelect.options[tokoSelect.selectedIndex];
        const marketplaceValue = selectedOption.getAttribute('data-marketplace');
        marketplaceInput.value = marketplaceValue || '';
    });

    const today = new Date().toISOString().split('T')[0];
    tanggalInput.value = today;
});

function tabSelanjutnya(tabId) {
    document.getElementById(tabId).click();
}

function tabSebelumnya(tabId) {
    document.getElementById(tabId).click();
}
</script>
@endsection
