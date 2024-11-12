@extends('layouts.main')
@section('title', 'Informasi Buku')
@section('content')
<style>
.container {
    width: 100%;
    padding: 20px;
}

.card-header-button {
    padding: 15px 0px 0px 15px;
    display: flex;
    background-color: transparent;
    border-bottom: none;
}

.custom-button-daftar {
    background-color: #ff9800;
    color: white;
    padding: 8px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: auto;
}

.custom-button-daftar:hover {
    background-color: #ff7b29;
}

.dropdown-menu {
    min-width: auto;
    width: max-content;
    padding: 0.5rem;
    z-index: 1050;
}

.custom-dropdown-item {
    display: flex;
    align-items: center;
    justify-content: start;
    padding: 4px;
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

.dropdown .btn-no-border {
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .header-title {
        font-size: 20px;
        text-align: center;
    }

    .custom-button-daftar {
        width: auto;
        font-size: 14px;
    }

    table {
        overflow-x: auto;
        font-size: 16px;
    }

    .modal-dialog {
        max-width: 80%;
    }

    .modal-header {
        padding: 10px 15px;
    }

    .modal-title {
        font-size: 18px !important;
    }

    .modal-body {
        padding: 20px
    }

    .form-group label {
        font-size: 16px;
    }

    .form-group input,
    .form-group select {
        font-size: 14px;
        padding: 8px;
    }

    .custom-button {
        font-size: 14px;
        padding: 10px 15px;
    }

    .d-flex.justify-content-end {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 5px;
    }

    .header-title {
        font-size: 18px;
        text-align: center;
    }

    .custom-button-daftar {
        width: auto;
        font-size: 12px;
        padding: 8px;
    }

    .table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        font-size: 12px;
    }

    .modal-dialog {
        max-width: 80%;
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
        font-size: 16px;
    }

    .modal-footer {
        padding: 5px 5px 0px 5px;
    }

    .form-control,
    .form-select {
        font-size: 12px;
    }

    .custom-button {
        font-size: 12px;
        padding: 8px 16px;
    }

    .btn-custom-danger {
        font-size: 12px;
        padding: 6px 10px;
    }
}
</style>

<div class="container mt-4">

    <h1 class="text-center mb-4">Daftar Buku</h1>
        <!-- Menampilkan Flash Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header-button">
                <button type="button" class="custom-button-daftar" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i> <span> Tambah Buku </span>
                </button>
            </div>

            <div class="card-body">
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
                        @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $buku->nama_buku }}</td>
                            <td>{{ $buku->nama_penulis }}</td>
                            <td>{{ $buku->kategori->nama_kategori }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->isbn }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill text-black"></i>
                                    </button>
                                    <ul class="dropdown-menu text-start p-2" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button class="custom-dropdown-item no-border-item w-100"
                                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $buku->id }}">
                                                <i class="bi bi-file-text text-primary me-2"></i> Details
                                            </button>
                                        </li>
                                        <li>
                                            <button class="custom-dropdown-item no-border-item w-100"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $buku->id }}">
                                                <i class="bi bi-pencil text-warning me-2"></i> Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="custom-dropdown-item no-border-item w-100"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $buku->id }}">
                                                    <i class="bi bi-trash text-danger me-2 fs-6"></i> Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>


                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailModal{{ $buku->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel{{ $buku->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku:
                                            {{ $buku->nama_buku }}</h5>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <!-- Nama Penulis -->
                                            <dt class="col-sm-3 mb-3">Nama Penulis</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->nama_penulis }}</dd>

                                            <!-- Kategori -->
                                            <dt class="col-sm-3 mb-3">Kategori</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->kategori->nama_kategori }}</dd>

                                            <!-- ISBN -->
                                            <dt class="col-sm-3 mb-3">ISBN</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->isbn }}</dd>

                                            <!-- Tahun Terbit -->
                                            <dt class="col-sm-3 mb-3">Tahun Terbit</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->tahun_terbit }}</dd>

                                            <!-- Ukuran -->
                                            <dt class="col-sm-3 mb-3">Ukuran</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->ukuran->ukuran }}
                                                {{ $buku->ukuran->dimensi }}</dd>

                                            <!-- Halaman -->
                                            <dt class="col-sm-3 mb-3">Halaman</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->halaman }}</dd>

                                            <!-- Jenis Kertas -->
                                            <dt class="col-sm-3 mb-3">Jenis Kertas</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->jenisKertas->nama_kertas }}</dd>

                                            <!-- Jenis Sampul -->
                                            <dt class="col-sm-3 mb-3">Jenis Sampul</dt>
                                            <dd class="col-sm-9 mb-3">{{ $buku->jenisSampul->nama_sampul }}</dd>

                                            <!-- Berat -->
                                            <dt class="col-sm-3 mb-3">Berat</dt>
                                            <dd class="col-sm-9 mb-3">{{ number_format($buku->berat, 2) }} kg</dd>

                                            <!-- Harga -->
                                            <dt class="col-sm-3 mb-3">Harga</dt>
                                            <dd class="col-sm-9">Rp {{ number_format($buku->harga, 0, ',', '.') }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $buku->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $buku->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $buku->id }}">Edit Buku</h5>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
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
                                                        @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}"
                                                            {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>
                                                            {{ $kategori->nama_kategori }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="isbn" class="form-label">ISBN</label>
                                                    <input type="text" class="form-control" name="isbn"
                                                        value="{{ $buku->isbn }}" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                                    <input type="number" class="form-control" name="tahun_terbit"
                                                        value="{{ $buku->tahun_terbit }}" required>
                                                </div>
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="ukuran_id" class="form-label">Ukuran</label>
                                                    <select class="form-select" name="ukuran_id" required>
                                                        @foreach ($ukurans as $ukuran)
                                                        <option value="{{ $ukuran->id }}"
                                                            {{ $ukuran->id == $buku->ukuran_id ? 'selected' : '' }}>
                                                            {{ $ukuran->ukuran }} {{ $ukuran->dimensi }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="halaman" class="form-label">Halaman</label>
                                                    <input type="number" class="form-control" name="halaman"
                                                        value="{{ $buku->halaman }}" required>
                                                </div>
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="jenis_kertas_id" class="form-label">Jenis Kertas</label>
                                                    <select class="form-select" name="jenis_kertas_id" required>
                                                        @foreach ($jenisKertas as $kertas)
                                                        <option value="{{ $kertas->id }}"
                                                            {{ $kertas->id == $buku->jenis_kertas_id ? 'selected' : '' }}>
                                                            {{ $kertas->nama_kertas }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="jenis_sampul_id" class="form-label">Jenis Sampul</label>
                                                    <select class="form-select" name="jenis_sampul_id" required>
                                                        @foreach ($jenisSampuls as $jenisSampul)
                                                        <option value="{{ $jenisSampul->id }}"
                                                            {{ $jenisSampul->id == $buku->jenis_sampul_id ? 'selected' : '' }}>
                                                            {{ $jenisSampul->nama_sampul }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-6 mb-3">
                                                    <label for="berat" class="form-label">Berat (kg)</label>
                                                    <input type="number" class="form-control" name="berat"
                                                        value="{{ $buku->berat }}" step="0.01" min="0" required>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga"
                                                    value="{{ $buku->harga }}" step="0.01" min="0" required>
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
                        <div class="modal fade" id="deleteModal{{ $buku->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel{{ $buku->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $buku->id }}">Hapus Buku
                                        </h5>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus buku
                                            <strong>{{ $buku->nama_buku }}</strong>?
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
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Buku</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <option class="text-body-secondary" value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
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
                            <label for="ukuran_id" class="form-label">Ukuran</label>
                            <select class="form-select" name="ukuran_id" required>
                            <option class="text-body-secondary" value="">Pilih Ukuran</option>
                                @foreach ($ukurans as $ukuran)
                                <option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }} {{ $ukuran->dimensi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="halaman" class="form-label">Halaman</label>
                            <input type="number" class="form-control" name="halaman" required>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="jenis_kertas_id" class="form-label">Jenis Kertas</label>
                            <select class="form-select" name="jenis_kertas_id" required>
                            <option class="text-body-secondary" value="">Pilih Kertas</option>
                                @foreach ($jenisKertas as $kertas)
                                <option value="{{ $kertas->id }}">{{ $kertas->nama_kertas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="jenis_sampul_id" class="form-label">Jenis Sampul</label>
                            <select class="form-select" name="jenis_sampul_id" required>
                            <option class="text-body-secondary" value="">Pilih Sampul</option>
                                @foreach ($jenisSampuls as $jenisSampul)
                                <option value="{{ $jenisSampul->id }}">{{ $jenisSampul->nama_sampul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="berat" class="form-label">Berat (kg)</label>
                            <input type="number" class="form-control" name="berat" step="0.01" min="0" required>
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