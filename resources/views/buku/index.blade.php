@extends('layouts.main')
@section('title', 'Informasi Buku')
@section('content')

<div class="container-buku mt-4">
    <h1 class="text-title mb-4 ">Daftar Buku</h1>
    <!-- Menampilkan Flash Message -->
    @if(session('success'))
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 3000, 
                showConfirmButton: false,
                customClass: {
                    popup: 'sweetalert',
                    confirmButton: 'buttonallert'
                }
            });
        </script>
    @endif

    <div class="card-container-buku">
        <div class="card">
            <div class="card-header-button">
                <button type="button" class="custom-button-daftar" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Buku
                </button>
            </div>

            <div class="card-body-buku">
                <div class="table-responsive-sm">
                    @if ($bukus->isEmpty())
                    <div class="alert alert-info text-center" role="alert">
                        <strong>Tidak ada data buku.</strong> Silakan tambahkan buku baru.
                    </div>
                    @else
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
                                        <ul class="dropdown-menu text-start-buku p-2" aria-labelledby="dropdownMenuButton">
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
                                                    <button type="button"
                                                        class="custom-dropdown-item no-border-item w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $buku->id }}">
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
                                        <div class="modal-header-buku">
                                            <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku:
                                                {{ $buku->judul_buku }}</h5>
                                            <button type="button" class="btn-close shadow-none btn-modal-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <!-- Nama Penulis -->
                                                <dt class="col-5 col-sm-3 mb-3">Nama Penulis</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->nama_penulis }}</dd>

                                                <!-- Kategori -->
                                                <dt class="col-5 col-sm-3 mb-3">Kategori</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->kategori->nama_kategori }}
                                                </dd>

                                                <!-- ISBN -->
                                                <dt class="col-5 col-sm-3 mb-3">ISBN</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->isbn }}</dd>

                                                <!-- Tahun Terbit -->
                                                <dt class="col-5 col-sm-3 mb-3">Tahun Terbit</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->tahun_terbit }}</dd>

                                                <!-- Ukuran -->
                                                <dt class="col-5 col-sm-3 mb-3">Ukuran</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->ukuran->ukuran }}
                                                    {{ $buku->ukuran->dimensi }}</dd>

                                                <!-- Halaman -->
                                                <dt class="col-5 col-sm-3 mb-3">Halaman</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->halaman }}</dd>

                                                <!-- Jenis Kertas -->
                                                <dt class="col-5 col-sm-3 mb-3">Jenis Kertas</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->jenisKertas->nama_kertas }}
                                                </dd>

                                                <!-- Jenis Sampul -->
                                                <dt class="col-5 col-sm-3 mb-3">Jenis Sampul</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ $buku->jenisSampul->nama_sampul }}
                                                </dd>

                                                <!-- Berat -->
                                                <dt class="col-5 col-sm-3 mb-3">Berat</dt>
                                                <dd class="col-7 col-sm-9 mb-3">: {{ number_format($buku->berat, 2) }}
                                                    kg</dd>

                                                <!-- Harga -->
                                                <dt class="col-5 col-sm-3">Harga</dt>
                                                <dd class="col-7 col-sm-9">: Rp
                                                    {{ number_format($buku->harga, 0, ',', '.') }}</dd>
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

                                        <div class="modal-header-buku">
                                            <h5 class="modal-title" id="editModalLabel{{ $buku->id }}">Edit Buku</h5>
                                            <button type="button" class="btn-close shadow-none btn-modal-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('bukus.update', $buku->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body modal-body-create">
                                                <!-- Input Fields -->
                                                <div class="mb-3">
                                                    <label for="judul_buku" class="form-label"><b>Judul Buku</b></label>
                                                    <input type="text" class="form-control" name="judul_buku"
                                                        value="{{ $buku->judul_buku }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="nama_penulis" class="form-label"><b>Nama
                                                            Penulis</b></label>
                                                    <input type="text" class="form-control" name="nama_penulis"
                                                        value="{{ $buku->nama_penulis }}" required>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                                        <label for="kategori_id"
                                                            class="form-label"><b>Kategori</b></label>
                                                        <select class="form-select" name="kategori_id" required>
                                                            @foreach ($kategoris as $kategori)
                                                            <option value="{{ $kategori->id }}"
                                                                {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>
                                                                {{ $kategori->nama_kategori }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                                        <label for="isbn" class="form-label"><b>ISBN</b></label>
                                                        <input type="text" class="form-control" name="isbn"
                                                            value="{{ $buku->isbn }}" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                                        <label for="tahun_terbit" class="form-label"><b>Tahun
                                                                Terbit</b></label>
                                                        <input type="number" class="form-control" name="tahun_terbit"
                                                            value="{{ $buku->tahun_terbit }}" required>
                                                    </div>
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
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
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                                        <label for="halaman" class="form-label"><b>Halaman</b></label>
                                                        <input type="number" class="form-control" name="halaman"
                                                            value="{{ $buku->halaman }}" required>
                                                    </div>
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                                        <label for="jenis_kertas_id" class="form-label"><b>Jenis
                                                                Kertas</b></label>
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
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                                        <label for="jenis_sampul_id" class="form-label"><b>Jenis
                                                                Sampul</b></label>
                                                        <select class="form-select" name="jenis_sampul_id" required>
                                                            @foreach ($jenisSampuls as $jenisSampul)
                                                            <option value="{{ $jenisSampul->id }}"
                                                                {{ $jenisSampul->id == $buku->jenis_sampul_id ? 'selected' : '' }}>
                                                                {{ $jenisSampul->nama_sampul }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-6 i-col-md-6 mb-3">
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
                                        <div class="modal-header-buku">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $buku->id }}">Hapus Buku
                                            </h5>
                                            <button type="button" class="btn-close shadow-none btn-modal-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-buku">
                    <h5 class="modal-title" id="createModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('bukus.store') }}" method="POST">
                    @csrf
                    <div class="modal-body modal-body-create" style="max-height: 75vh; overflow-y: auto;">
                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label"><b>Judul Buku</b></label>
                            <input type="text" class="form-control" name="judul_buku" placeholder="Masukkan judul buku"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_penulis" class="form-label"><b>Nama Penulis</b></label>
                            <input type="text" class="form-control" name="nama_penulis"
                                placeholder="Masukkan nama penulis" required>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 i-i-col-md-6 mb-3">
                                <label for="kategori_id" class="form-label"><b>Kategori</b></label>
                                <select class="form-select" name="kategori_id" required>
                                    <option value="" disabled selected="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 i-col-md-6  mb-3">
                                <label for="isbn" class="form-label"><b>ISBN</b></label>
                                <input type="text" class="form-control" name="isbn" placeholder="Masukkan nomor ISBN"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 i-col-md-6  mb-3">
                                <label for="tahun_terbit" class="form-label"><b>Tahun Terbit</b></label>
                                <input type="number" class="form-control" name="tahun_terbit"
                                    placeholder="Masukkan tahun terbit buku" required>
                            </div>
                            <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                <label for="ukuran_id" class="form-label"><b>Ukuran</b></label>
                                <select class="form-select" name="ukuran_id" required>
                                    <option value="" disabled selected>Pilih Ukuran</option>
                                    @foreach ($ukurans as $ukuran)
                                    <option value="{{ $ukuran->id }}">{{ $ukuran->ukuran }} {{ $ukuran->dimensi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                <label for="halaman" class="form-label"><b>Halaman</b></label>
                                <input type="number" class="form-control" name="halaman"
                                    placeholder="Masukkan jumlah halaman buku" required>
                            </div>
                            <div class="col-12 col-sm-6 i-col-md-6 mb-3">
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
                            <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                <label for="jenis_sampul_id" class="form-label"><b>Jenis Sampul</b></label>
                                <select class="form-select" name="jenis_sampul_id" required>
                                    <option value="" disabled selected>Pilih Sampul</option>
                                    @foreach ($jenisSampuls as $jenisSampul)
                                    <option value="{{ $jenisSampul->id }}">{{ $jenisSampul->nama_sampul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 i-col-md-6 mb-3">
                                <label for="berat" class="form-label"><b>Berat (kg)</b></label>
                                <input type="number" class="form-control" name="berat" step="0.01" min="0"
                                    placeholder="Masukkan berat buku" required>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newRow = document.querySelector('.new-toko-row');
        if (newRow) {
            setTimeout(() => {
                newRow.classList.remove('new-toko-row');
            }, 10000);
        }
    });
</script>
@endsection