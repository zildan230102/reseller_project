@extends('layouts.main')
@section('title', 'Informasi Toko')
@section('content')

<style>
.btn-tambah-toko {
    background-color: #ff9800;
    color: white;
    font-weight: bold;
    transition: none;
}
.btn-tambah-toko:hover, .btn-modal:hover{
    background-color: #ff9800;
    color: white;
}
.btn-tambah-toko .bi {
    font-weight: bold !important;
    margin-right: 8px;
}
.btn-modal {
    background-color: #ff9800;
    color: white;
}
.btn-danger {
    background-color: red;
    color: white;
}
.badge-active {
    background-color: green; /* Warna hijau untuk status aktif */
    color: white;           /* Warna teks putih untuk kontras */
    padding: 5px 10px;     /* Sedikit padding untuk tampilan yang lebih baik */
    border-radius: 5px;    /* Membuat sudut badge menjadi melengkung */
}
.badge-inactive {
    background-color: red;  /* Warna merah untuk status non-aktif */
    color: white;           /* Warna teks putih untuk kontras */
    padding: 5px 10px;     /* Sedikit padding untuk tampilan yang lebih baik */
    border-radius: 5px;    /* Membuat sudut badge menjadi melengkung */
}
</style>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Toko</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <button type="button" class="btn btn-tambah-toko mb-3" data-bs-toggle="modal" data-bs-target="#tokoModal">
        <i class="bi bi-plus-lg"></i> <span> Tambah Toko </span>
    </button>

    <table class="table table-bordered">
        <thead class="thead text-center">
            <tr>
                <th>Nama Toko</th>
                <th>Marketplace</th>
                <th>Tanggal Dibuat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tokos as $toko)
            <tr>
                <td>{{ $toko->nama_toko }}</td>
                <td>{{ $toko->marketplace }}</td>
                <!-- Menggunakan kolom created_at -->
                <td>{{ \Carbon\Carbon::parse($toko->created_at)->format('d-m-Y') }}</td>
                <td>
                    <span class="badge {{ $toko->is_active ? 'badge-active' : 'badge-inactive' }}">
                        {{ $toko->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-eye-fill text-black"></i>
                        </button>
                        <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                            <li class="m-2">
                                <form action="{{ route('toko.toggle-status', $toko) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item bg-warning text-white">
                                        <i class="{{ $toko->is_active ? 'bi bi-x-square fs-5' : 'bi bi-check-square fs-5' }}"></i>
                                    </button>
                                </form>
                            </li>
                            <li class="m-2">
                                <button class="dropdown-item bg-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#editTokoModal" data-id="{{ $toko->id }}" data-nama="{{ $toko->nama_toko }}" data-marketplace="{{ $toko->marketplace }}" data-status="{{ $toko->is_active }}">
                                    <i class="bi bi-pencil fs-5"></i>
                                </button>
                            </li>
                            <li class="m-2">
                                <button class="dropdown-item bg-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $toko->id }}">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data toko.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal untuk menambah toko -->
<div class="modal fade" id="tokoModal" tabindex="-1" role="dialog" aria-labelledby="tokoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tokoModalLabel">Tambah Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tokoForm" action="{{ route('toko.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" name="nama_toko" required>
                    </div>

                    <div class="form-group">
                        <label for="marketplace">Marketplace</label>
                        <input type="text" class="form-control" name="marketplace" placeholder="Masukkan nama marketplace" required>
                    </div>

                    <div class="form-group">
                        <label for="is_active">Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end ">
                        <button type="submit" class="btn btn-modal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk edit toko -->
<div class="modal fade" id="editTokoModal" tabindex="-1" role="dialog" aria-labelledby="editTokoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTokoModalLabel">Edit Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTokoForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" id="edit_nama_toko" name="nama_toko" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_marketplace">Marketplace</label>
                        <input type="text" class="form-control" id="edit_marketplace" name="marketplace" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_is_active">Status</label>
                        <select id="edit_is_active" name="is_active" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-modal">Update</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus toko ini?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan JavaScript untuk AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Konfirmasi penghapusan toko
    $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var tokoId = button.data('id'); // Ambil ID toko dari tombol yang diklik
        var actionUrl = '{{ url("toko") }}/' + tokoId; // Buat URL action untuk form hapus

        // Set URL action untuk form hapus
        $('#deleteForm').attr('action', actionUrl);
    });

    // Handle pengiriman form dengan AJAX untuk menambah toko
    $('#tokoForm').on('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form secara default

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                $('#tokoModal').modal('hide'); // Tutup modal
                location.reload(); // Reload halaman untuk melihat data terbaru
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat menyimpan data');
            }
        });
    });

    // Handle pengisian data untuk modal edit
    $('#editTokoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var tokoId = button.data('id');
        var namaToko = button.data('nama');
        var marketplace = button.data('marketplace');
        var status = button.data('status');
        
        // Set data ke dalam form edit
        $('#edit_nama_toko').val(namaToko);
        $('#edit_marketplace').val(marketplace);
        $('#edit_is_active').val(status);
        
        // Set URL action untuk form edit
        $('#editTokoForm').attr('action', '{{ url("toko") }}/' + tokoId);
    });
});
</script>
@endsection