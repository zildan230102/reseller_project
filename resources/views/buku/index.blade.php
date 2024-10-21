@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Daftar Buku</h1>

    <!-- Button to Open the Modal for Create -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Buku
    </button>

    <!-- Table displaying books -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Buku</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun Terbit</th>
                <th>Berat</th> <!-- Kolom baru -->
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
                <td>{{ number_format($buku->berat / 1000, 2) }} kg</td> <!-- Konversi gram ke kg -->
                <td>{{ $buku->harga }}</td>
                <td>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $buku->id }}">Detail</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $buku->id }}">Edit</button>
                    <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Detail Modal -->
            <div class="modal fade" id="detailModal{{ $buku->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $buku->id }}">Detail Buku: {{ $buku->nama_buku }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <p><strong>Berat:</strong> {{ number_format($buku->berat / 1000, 2) }} kg</p> <!-- Konversi gram ke kg -->
                            <p><strong>Harga:</strong> {{ $buku->harga }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                                <!-- Form fields as before -->
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
                                    <input type="text" class="form-control" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" required>
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
                                    <input type="number" step="0.01" class="form-control" name="berat" value="{{ $buku->berat / 1000 }}" required> <!-- Input baru dalam kg -->
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" name="harga" value="{{ $buku->harga }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
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
                    <!-- Form fields for creating a new book -->
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
                        <input type="text" class="form-control" name="tahun_terbit" required>
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
                        <input type="number" step="0.01" class="form-control" name="berat" required> <!-- Input baru dalam kg -->
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
