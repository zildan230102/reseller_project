@extends('layouts.main')
@section('title', 'Informasi Buku')
@section('content')

<style>
.container-buku {
    width: 100%;
    padding-top: 60px;
} 
.text-title {
    padding-left: 150px;
    text-align: left;
}
.card-container {
    max-width: 1200px;
    margin: 0 auto;
}
.card-header-button {
    padding: 15px;
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
.dropdown .btn-no-border {
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0;
}
.table .dropdown-menu {
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
.small-icon {
    font-size: 12px;
}
.card-body-buku {
    padding: 0px 15px;
}
select.form-select, select.form-select option {
    font-size: 16px;
}
.buttonallert {
    background-color: #ff9800;
    box-shadow: none;
    outline: none;
}
.buttonallert:focus{
    box-shadow: none;
}

@media (min-width: 320px) and (max-width: 599px) {
    .container-buku{
        height: auto;
    }
    .card-container {
        padding: 0 20px;
    }
    .text-title {
        font-size: 20px;
        margin-bottom: 16px !important;
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
        overflow: visible;
    }
    .modal-dialog {
        max-width: 80%;
        margin: 0 auto;
    }
    .modal-content {
        max-height: 90vh !important;
    }
    .modal-header {
        padding: 10px;
        font-size: 16px; 
    }
    .modal-body {
        font-size: 12px;
        padding: 10px 20px;
    }
    .modal-footer {
        padding: 5px;
    }
    select.form-select {
        font-size: 12px;
        max-height: 150px;
        overflow-y: auto;
    }
    select.form-select option {
        font-size: 10px;
    }
    .form-control, .form-select {
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
    .table .dropdown-menu {
        font-size: 12px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
    .small-icon {
        font-size: 10px;
    }
    .alert-success {
        font-size: 12px;
    }
    .sweetalert {
        max-width: 300px;
        font-size: 12px;
    }
}

@media (min-width: 600px) and (max-width: 1280px) {
    .container-buku {
        height: auto;
        /* padding-top: 70px; */
    }
    .card-container {
        padding: 0 20px 0 20px;
    }
    .text-title {
        font-size: 25px;
        text-align: center;
        padding-left: 0;
    }
    .modal-dialog {
        max-width: 80%;
    }
    .modal-header {
        font-size: 14px;
    }
    .modal-body {
        font-size: 16px;
        padding: 10px 20px 10px 20px;
        max-height: 70vh !important;
    }
    .modal-footer {
        padding: 10px 20px 10px 10px;
    }
    select.form-select {
        max-height: 150px;
        overflow-y: auto;
    }
    .text-start {
        font-size: 14px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
    .form-select option {
        font-size: 10px !important;
    }
    /* .container-buku {
        padding-bottom: 0 !important;
    } */
    /* .card-container {
        max-width: 1000px;
        margin: 0 auto;
    } */
    select.form-select option {
        font-size: 10px;
    }
}

</style>

<div class="container-buku mt-4">
    <h1 class="text-title mb-4 ">Daftar Buku</h1>
    <!-- Menampilkan Flash Message -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'sweetalert',
                    confirmButton: 'buttonallert'
                }
            });
        </script>
    @endif

    <div class="card-container">
        <div class="card">
            <div class="card-header-button">
                <button type="button" class="custom-button-daftar" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Buku
                </button>
            </div>

            <div class="card-body-buku">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <!-- <th>Kategori</th> -->
                            <!-- <th>Tahun Terbit</th> -->
                            <th>ISBN</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $buku->judul_buku }}</td>
                            <td>{{ $buku->nama_penulis }}</td>
                            <!-- <td>{{ $buku->kategori->nama_kategori }}</td> -->
                            <!-- <td class="text-center">{{ $buku->tahun_terbit }}</td> -->
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
                                                <i class="bi bi-file-text text-primary me-2 small-icon"></i> Details
                                            </button>
                                        </li>
                                        <li>
                                            <button class="custom-dropdown-item no-border-item w-100"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $buku->id }}">
                                                <i class="bi bi-pencil text-warning me-2 small-icon"></i> Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="custom-dropdown-item no-border-item w-100"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $buku->id }}">
                                                    <i class="bi bi-trash text-danger me-2 small-icon"></i> Hapus
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
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku:
                                            {{ $buku->judul_buku }}</h5>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <!-- Nama Penulis -->
                                            <dt class="col-5 col-sm-3 mb-3">Nama Penulis</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->nama_penulis }}</dd>
                                    
                                            <!-- Kategori -->
                                            <dt class="col-5 col-sm-3 mb-3">Kategori</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->kategori->nama_kategori }}</dd>
                                    
                                            <!-- ISBN -->
                                            <dt class="col-5 col-sm-3 mb-3">ISBN</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->isbn }}</dd>
                                    
                                            <!-- Tahun Terbit -->
                                            <dt class="col-5 col-sm-3 mb-3">Tahun Terbit</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->tahun_terbit }}</dd>
                                    
                                            <!-- Ukuran -->
                                            <dt class="col-5 col-sm-3 mb-3">Ukuran</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->ukuran->ukuran }} {{ $buku->ukuran->dimensi }}</dd>
                                    
                                            <!-- Halaman -->
                                            <dt class="col-5 col-sm-3 mb-3">Halaman</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->halaman }}</dd>
                                    
                                            <!-- Jenis Kertas -->
                                            <dt class="col-5 col-sm-3 mb-3">Jenis Kertas</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->jenisKertas->nama_kertas }}</dd>
                                    
                                            <!-- Jenis Sampul -->
                                            <dt class="col-5 col-sm-3 mb-3">Jenis Sampul</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ $buku->jenisSampul->nama_sampul }}</dd>
                                    
                                            <!-- Berat -->
                                            <dt class="col-5 col-sm-3 mb-3">Berat</dt>
                                            <dd class="col-7 col-sm-9 mb-3">: {{ number_format($buku->berat, 2) }} kg</dd>
                                    
                                            <!-- Harga -->
                                            <dt class="col-5 col-sm-3">Harga</dt>
                                            <dd class="col-7 col-sm-9">: Rp {{ number_format($buku->harga, 0, ',', '.') }}</dd>
                                        </dl>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $buku->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $buku->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                                                <label for="judul_buku" class="form-label"><b>Judul Buku</b></label>
                                                <input type="text" class="form-control" name="judul_buku"
                                                    value="{{ $buku->judul_buku }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_penulis" class="form-label"><b>Nama Penulis</b></label>
                                                <input type="text" class="form-control" name="nama_penulis"
                                                    value="{{ $buku->nama_penulis }}" required>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="kategori_id" class="form-label"><b>Kategori</b></label>
                                                    <select class="form-select" name="kategori_id" required>
                                                        @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}"
                                                            {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>
                                                            {{ $kategori->nama_kategori }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="isbn" class="form-label"><b>ISBN</b></label>
                                                    <input type="text" class="form-control" name="isbn"
                                                        value="{{ $buku->isbn }}" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="tahun_terbit" class="form-label"><b>Tahun Terbit</b></label>
                                                    <input type="number" class="form-control" name="tahun_terbit"
                                                        value="{{ $buku->tahun_terbit }}" required>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="ukuran_id" class="form-label"><b>Ukuran</b></label>
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
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="halaman" class="form-label"><b>Halaman</b></label>
                                                    <input type="number" class="form-control" name="halaman"
                                                        value="{{ $buku->halaman }}" required>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="jenis_kertas_id" class="form-label"><b>Jenis Kertas</b></label>
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
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="jenis_sampul_id" class="form-label"><b>Jenis Sampul</b></label>
                                                    <select class="form-select" name="jenis_sampul_id" required>
                                                        @foreach ($jenisSampuls as $jenisSampul)
                                                        <option value="{{ $jenisSampul->id }}"
                                                            {{ $jenisSampul->id == $buku->jenis_sampul_id ? 'selected' : '' }}>
                                                            {{ $jenisSampul->nama_sampul }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                                    <label for="berat" class="form-label"><b>Berat (Kg)</b></label>
                                                    <input type="number" class="form-control" name="berat"
                                                        value="{{ $buku->berat }}" step="0.01" min="0" required>
                                                </div>
                                            </div>

                                            <div class="">
                                                <label for="harga" class="form-label"><b>Harga</b></label>
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
                                            <strong>{{ $buku->judul_buku }}</strong> ini?
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Buku</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bukus.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                    <!-- Input Fields -->
                    <div class="mb-3">
                        <label for="judul_buku" class="form-label"><b>Judul Buku</b></label>
                        <input type="text" class="form-control" name="judul_buku" placeholder="Masukkan judul buku" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_penulis" class="form-label"><b>Nama Penulis</b></label>
                        <input type="text" class="form-control" name="nama_penulis" placeholder="Masukkan nama penulis" required>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                            <label for="kategori_id" class="form-label"><b>Kategori</b></label>
                            <select class="form-select" name="kategori_id" required>
                            <option value="" disabled selected="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6  mb-3">
                            <label for="isbn" class="form-label"><b>ISBN</b></label>
                            <input type="text" class="form-control" name="isbn" placeholder="Masukkan nomor ISBN" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6  mb-3">
                            <label for="tahun_terbit" class="form-label"><b>Tahun Terbit</b></label>
                            <input type="number" class="form-control" name="tahun_terbit" placeholder="Masukkan tahun terbit buku" required>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                            <label for="ukuran_id" class="form-label"><b>Ukuran</b></label>
                            <select class="form-select" name="ukuran_id" required>
                            <option value="" disabled selected>Pilih Ukuran</option>
                                @foreach ($ukurans as $ukuran)
                                <option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }} {{ $ukuran->dimensi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                            <label for="halaman" class="form-label"><b>Halaman</b></label>
                            <input type="number" class="form-control" name="halaman" placeholder="Masukkan jumlah halaman buku" required>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                            <label for="jenis_kertas_id" class="form-label"><b>Jenis Kertas</b></label>
                            <select class="form-select" name="jenis_kertas_id" required>
                            <option value="" disabled selected><b>Pilih Kertas</b></option>
                                @foreach ($jenisKertas as $kertas)
                                <option value="{{ $kertas->id }}">{{ $kertas->nama_kertas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                            <label for="jenis_sampul_id" class="form-label"><b>Jenis Sampul</b></label>
                            <select class="form-select" name="jenis_sampul_id" required>
                            <option value="" disabled selected>Pilih Sampul</option>
                                @foreach ($jenisSampuls as $jenisSampul)
                                <option value="{{ $jenisSampul->id }}">{{ $jenisSampul->nama_sampul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                            <label for="berat" class="form-label"><b>Berat (kg)</b></label>
                            <input type="number" class="form-control" name="berat" step="0.01" min="0" placeholder="Masukkan berat buku" required>
                        </div>
                    </div>

                    <div class="">
                        <label for="harga" class="form-label"><b>Harga</b></label>
                        <input type="number" class="form-control" name="harga" step="0.01" min="0" placeholder="Masukkan harga buku" required>
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