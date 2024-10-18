@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Buat Order</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form untuk menambah order -->
    <form action="{{ route('orders.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="no_invc" class="form-label">No Invoice</label>
                <input type="text" class="form-control" id="no_invc" name="no_invc" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="toko_id" class="form-label">Toko</label>
            <select id="toko_id" name="toko_id" class="form-control" required>
                <option value="">-- Pilih Toko --</option>
                @foreach($tokos as $toko)
                    <option value="{{ $toko->id }}">{{ $toko->nama_toko }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="asal_penjualan" class="form-label">Asal Penjualan</label>
                <input type="text" class="form-control" id="asal_penjualan" name="asal_penjualan" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="kode_booking" class="form-label">Kode Booking</label>
            <input type="text" class="form-control" id="kode_booking" name="kode_booking" required>
        </div>

        <div class="mb-3">
            <label for="ekspedisi" class="form-label">Ekspedisi</label>
            <input type="text" class="form-control" id="ekspedisi" name="ekspedisi" required>
        </div>

        <div class="mb-3">
            <label for="penerima" class="form-label">Penerima</label>
            <input type="text" class="form-control" id="penerima" name="penerima" required>
        </div>

        <div class="mb-3">
            <label for="no_hp_penerima" class="form-label">No HP Penerima</label>
            <input type="text" class="form-control" id="no_hp_penerima" name="no_hp_penerima" required>
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

        <div class="mb-3">
            <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
            <textarea class="form-control" id="alamat_kirim" name="alamat_kirim" required></textarea>
        </div>

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

        <button type="submit" class="btn btn-primary">Tambah Order</button>
    </form>

    <!-- Tabel Daftar Order -->
    <h3>Daftar Order</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
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
                    <td>{{ $order->no_invc }}</td>
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

                <!-- Modal Edit Order -->
                <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $order->tanggal }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_invc" class="form-label">No Invoice</label>
                                        <input type="text" class="form-control" id="no_invc" name="no_invc" value="{{ $order->no_invc }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="toko_id" class="form-label">Toko</label>
                                        <select id="toko_id" name="toko_id" class="form-control" required>
                                            @foreach($tokos as $toko)
                                                <option value="{{ $toko->id }}" {{ $toko->id == $order->toko_id ? 'selected' : '' }}>{{ $toko->nama_toko }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $order->no_hp }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="asal_penjualan" class="form-label">Asal Penjualan</label>
                                        <input type="text" class="form-control" id="asal_penjualan" name="asal_penjualan" value="{{ $order->asal_penjualan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kode_booking" class="form-label">Kode Booking</label>
                                        <input type="text" class="form-control" id="kode_booking" name="kode_booking" value="{{ $order->kode_booking }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ekspedisi" class="form-label">Ekspedisi</label>
                                        <input type="text" class="form-control" id="ekspedisi" name="ekspedisi" value="{{ $order->ekspedisi }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="penerima" class="form-label">Penerima</label>
                                        <input type="text" class="form-control" id="penerima" name="penerima" value="{{ $order->penerima }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp_penerima" class="form-label">No HP Penerima</label>
                                        <input type="text" class="form-control" id="no_hp_penerima" name="no_hp_penerima" value="{{ $order->no_hp_penerima }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kelurahan" class="form-label">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ $order->kelurahan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $order->kecamatan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota" name="kota" value="{{ $order->kota }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ $order->provinsi }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                                        <textarea class="form-control" id="alamat_kirim" name="alamat_kirim" required>{{ $order->alamat_kirim }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan</label>
                                        <textarea class="form-control" id="catatan" name="catatan">{{ $order->catatan }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_berat" class="form-label">Total Berat (KG)</label>
                                        <input type="number" class="form-control" id="total_berat" name="total_berat" value="{{ $order->total_berat }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="grand_total" class="form-label">Grand Total</label>
                                        <input type="number" step="0.01" class="form-control" id="grand_total" name="grand_total" value="{{ $order->grand_total }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
