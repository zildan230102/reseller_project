@extends('layouts.main')
@section('title', 'Informasi Buku')
@section('content')
<style>
    .custom-dropdown-item {
        color: #333;
        padding: 8px 8px 8px 0px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
    }

    .custom-dropdown-item i {
        vertical-align: middle;
        margin-right: 8px;
    }

    .custom-dropdown-item:hover {
        background-color: #f1f1f1;
        text-decoration: none;
    }

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

<div class="container mt-5">
    <h1 class="text-center">Daftar Buku</h1>

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
                <th>ISBN</th>
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
                <td>{{ $buku->isbn }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-eye-fill text-black"></i>
                        </button>
                        <ul class="dropdown-menu text-start p-2" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="custom-dropdown-item text-info" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $buku->id }}">
                                    <i class="bi bi-file-text"></i> Details
                                </a>
                            </li>
                            <li>
                                <a class="custom-dropdown-item text-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $buku->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a type="button" class="custom-dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $buku->id }}">
                                        <i class="bi bi-trash fs-6"></i> Hapus
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <!-- Detail Modal -->
            <div class="modal fade" id="detailModal{{ $buku->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="detailModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku:
                                {{ $buku->nama_buku }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <dl class="row">
                                <dt class="col-sm-3 mb-3">Nama Penulis</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->nama_penulis }}</dd>

                                <dt class="col-sm-3 mb-3">Kategori</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->kategori->nama_kategori }}</dd>

                                <dt class="col-sm-3 mb-3">ISBN</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->isbn }}</dd>

                                <dt class="col-sm-3 mb-3">Tahun Terbit</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->tahun_terbit }}</dd>

                                <dt class="col-sm-3 mb-3">Ukuran</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->ukuran }}</dd>

                                <dt class="col-sm-3 mb-3">Halaman</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->halaman }}</dd>

                                <dt class="col-sm-3 mb-3">Jenis Kertas</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->jenis_kertas }}</dd>

                                <dt class="col-sm-3 mb-3">Jenis Sampul</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ $buku->jenis_sampul }}</dd>

                                <dt class="col-sm-3 mb-3">Berat</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8 mb-3">{{ number_format($buku->berat, 2) }} kg</dd>

                                <dt class="col-sm-3">Harga</dt>
                                <dd class="col-sm-1">:</dd>
                                <dd class="col-sm-8">{{ number_format($buku->harga, 2, ',', '.') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $buku->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="editModalLabel{{ $buku->id }}" aria-hidden="true">
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
                                    <input type="text" class="form-control" name="nama_buku"
                                        value="{{ $buku->nama_buku }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_penulis" class="form-label">Nama Penulis</label>
                                    <input type="text" class="form-control" name="nama_penulis"
                                        value="{{ $buku->nama_penulis }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select class="form-select" name="kategori_id" required>
                                            @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" name="isbn" value="{{ $buku->isbn }}"
                                            required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                        <input type="number" class="form-control" name="tahun_terbit"
                                            value="{{ $buku->tahun_terbit }}" required>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="ukuran" class="form-label">Ukuran</label>
                                        <input type="text" class="form-control" name="ukuran"
                                            value="{{ $buku->ukuran }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="halaman" class="form-label">Halaman</label>
                                        <input type="number" class="form-control" name="halaman"
                                            value="{{ $buku->halaman }}" required>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="jenis_kertas" class="form-label">Jenis Kertas</label>
                                        <input type="text" class="form-control" name="jenis_kertas"
                                            value="{{ $buku->jenis_kertas }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="jenis_sampul" class="form-label">Jenis Sampul</label>
                                        <input type="text" class="form-control" name="jenis_sampul"
                                            value="{{ $buku->jenis_sampul }}" required>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="berat" class="form-label">Berat (kg)</label>
                                        <input type="number" class="form-control" name="berat"
                                            value="{{ $buku->berat }}" step="0.01" min="0" required>
                                        <!-- Memungkinkan input berat desimal -->
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" value="{{ $buku->harga }}"
                                        step="0.01" min="0" required>
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
            <div class="modal fade" id="deleteModal{{ $buku->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="deleteModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $buku->id }}">Hapus Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus buku <strong>{{ $buku->nama_buku }}</strong>?
                            </p>
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

<div class="row">
    <div class="col-sm-12 col-md-6 mb-3">
        <!-- Modal Create -->
        <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
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

                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select class="form-select" name="kategori_id" required>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" class="form-control" name="isbn" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" name="tahun_terbit" required>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="ukuran" class="form-label">Ukuran</label>
                                    <input type="text" class="form-control" name="ukuran" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="halaman" class="form-label">Halaman</label>
                                    <input type="number" class="form-control" name="halaman" required>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="jenis_kertas" class="form-label">Jenis Kertas</label>
                                    <input type="text" class="form-control" name="jenis_kertas" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="jenis_sampul" class="form-label">Jenis Sampul</label>
                                    <input type="text" class="form-control" name="jenis_sampul" required>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="berat" class="form-label">Berat (kg)</label>
                                    <input type="number" class="form-control" name="berat" step="0.01" min="0" required>
                                    <!-- Memungkinkan input berat desimal -->
                                </div>
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