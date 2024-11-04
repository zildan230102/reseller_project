@extends('layouts.main')
@section('title', 'Informasi Buku')
@section('content')
    <style>
        .custom-button-daftar {
            background-color: #ff9800;
            color: white;
            padding: 8px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .custom-button-daftar:hover {
            background-color: #ff7b29;
        }
        .dropdown .btn-no-border {
            border: none;
            outline: none;
            box-shadow: none;
            padding: 0;
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
    </style>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Daftar Buku</h1>

        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Button to Open the Modal for Create -->
                    <button type="button" class="custom-button-daftar mb-3" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="bi bi-plus-lg me-2"></i> Tambah Buku
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
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="custom-dropdown-item no-border-item w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $buku->id }}">
                                                        <i class="bi bi-file-text text-primary me-2"></i> Details
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="custom-dropdown-item no-border-item w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $buku->id }}">
                                                        <i class="bi bi-pencil text-warning me-2"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="custom-dropdown-item no-border-item w-100"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $buku->id }}">
                                                            <i class="bi bi-trash text-danger me-2 fs-6"></i> Hapus
                                                        </button>
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
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                        </option>
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
                                <input type="number" class="form-control" name="berat" step="0.01" min="0"
                                    required>
                                <!-- Memungkinkan input berat desimal -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" step="0.01" min="0"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="custom-button">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal{{ $buku->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="detailModalLabel{{ $buku->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku:
                        {{ $buku->nama_buku }}
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 150px;">Nama Penulis</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->nama_penulis }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Kategori</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->kategori->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">ISBN</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->isbn }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Tahun Terbit</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->tahun_terbit }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Ukuran</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->ukuran }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Halaman</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->halaman }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Jenis Kertas</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->jenis_kertas }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Jenis Sampul</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ $buku->jenis_sampul }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Berat</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ number_format($buku->berat, 2) }} kg</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 150px;">Harga</th>
                                <td style="padding: 0 5px;">:</td>
                                <td>{{ number_format($buku->harga, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $buku->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel{{ $buku->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $buku->id }}">Edit Buku</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('bukus.update', $buku->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label for="nama_buku" class="form-label">Nama Buku</label>
                            <input type="text" class="form-control" name="nama_buku" value="{{ $buku->nama_buku }}"
                                required>
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
                                <input type="text" class="form-control" name="ukuran" value="{{ $buku->ukuran }}"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="halaman" class="form-label">Halaman</label>
                                <input type="number" class="form-control" name="halaman" value="{{ $buku->halaman }}"
                                    required>
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
                                <input type="number" class="form-control" name="berat" value="{{ $buku->berat }}"
                                    step="0.01" min="0" required>
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
    <div class="modal fade" id="deleteModal{{ $buku->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteModalLabel{{ $buku->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $buku->id }}">Hapus Buku</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
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

@endsection
