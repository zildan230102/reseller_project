@extends('layouts.main')
@section('title', 'Informasi Buku')
@section('content')
<style>
    .dropdown .btn-no-border {
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0;
}

    .btn-custom-info {
        background-color: #17a2b8;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn-custom-info:hover {
        background-color: #138496;
    }
    .btn-custom-warning {
        background-color: #ffc107;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn-custom-warning:hover {
        background-color: #e0a800;
    }
    .btn-custom-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn-custom-danger:hover {
        background-color: #c82333;
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4 text-center ">Daftar Buku</h1>

    <!-- Button to Open the Modal for Create -->
    <button type="button" class="custom-button mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="bi bi-plus-lg"></i> <span> Tambah Buku </span>
    </button>

    <!-- Table displaying books -->
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>Nama Buku</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun Terbit</th>
                <th>Berat</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukus as $buku)
            <tr>
                <td>{{ $buku->nama_buku }}</td>
                <td>{{ $buku->nama_penulis }}</td>
                <td>{{ $buku->kategori->nama_kategori }}</td>
                <td>{{ $buku->tahun_terbit }}</td>
                <td>{{ number_format($buku->berat, 2) }} kg</td> <!-- Menggunakan kg langsung -->
                <td>{{ number_format($buku->harga, 2, ',', '.') }}</td>
                <td class="text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-eye-fill text-black"></i>
                        </button>
                        <button class="btn-custom-warning mx-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $buku->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-custom-danger mx-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $buku->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

            <!-- Detail Modal -->
            <div class="modal fade" id="detailModal{{ $buku->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku: {{ $buku->nama_buku }}</h5>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nama Penulis:</strong> {{ $buku->nama_penulis }}</p>
                            <p><strong>Kategori:</strong> {{ $buku->kategori->nama_kategori }}</p>
                            <p><strong>ISBN:</strong> {{ $buku->isbn }}</p>
                            <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                            <p><strong>Ukuran:</strong> {{ $buku->ukuran }}</p>
                            <p><strong>Halaman:</strong> {{ $buku->halaman }}</p>
                            <p><strong>Jenis Kertas:</strong> {{ $buku->jenis_kertas }}</p>
                            <p><strong>Jenis Sampul:</strong> {{ $buku->jenis_sampul }}</p>
                            <p><strong>Berat:</strong> {{ number_format($buku->berat, 2) }} kg</p> <!-- Menggunakan kg langsung -->
                            <p><strong>Harga:</strong> {{ number_format($buku->harga, 2, ',', '.') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="custom-button" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $buku->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $buku->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $buku->id }}">Edit Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bukus.update', $buku->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Input Fields -->
                    <div class="mb-3">
                        <label for="nama_buku" class="form-label">Nama Buku</label>
                        <input type="text" class="form-control" name="nama_buku" value="{{ $buku->nama_buku }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_penulis" class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control" name="nama_penulis" value="{{ $buku->nama_penulis }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn" value="{{ $buku->isbn }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" value="{{ $buku->ukuran }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="halaman" class="form-label">Halaman</label>
                        <input type="number" class="form-control" name="halaman" value="{{ $buku->halaman }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kertas" class="form-label">Jenis Kertas</label>
                        <input type="text" class="form-control" name="jenis_kertas" value="{{ $buku->jenis_kertas }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_sampul" class="form-label">Jenis Sampul</label>
                        <input type="text" class="form-control" name="jenis_sampul" value="{{ $buku->jenis_sampul }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control" name="berat" value="{{ $buku->berat }}" step="0.01" min="0" required> <!-- Memungkinkan input berat desimal -->
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" value="{{ $buku->harga }}" step="0.01" min="0" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="custom-button">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $buku->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $buku->id }}">Hapus Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus buku <strong>{{ $buku->nama_buku }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-custom-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bukus.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Input Fields -->
                    <div class="mb-3">
                        <label for="nama_buku" class="form-label">Nama Buku</label>
                        <input type="text" class="form-control" name="nama_buku" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_penulis" class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control" name="nama_penulis" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" required>
                    </div>
                    <div class="mb-3">
                        <label for="halaman" class="form-label">Halaman</label>
                        <input type="number" class="form-control" name="halaman" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kertas" class="form-label">Jenis Kertas</label>
                        <input type="text" class="form-control" name="jenis_kertas" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_sampul" class="form-label">Jenis Sampul</label>
                        <input type="text" class="form-control" name="jenis_sampul" required>
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control" name="berat" step="0.01" min="0" required> <!-- Memungkinkan input berat desimal -->
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="custom-button">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
