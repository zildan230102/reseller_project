@extends('layouts.main')
@section('title', 'Informasi Toko')
@section('content')

<div class="container mt-4">
    <h1 class="mb-4 text-center">Daftar Toko</h1>

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

    <button type="button" class="custom-button mb-3" data-bs-toggle="modal" data-bs-target="#tokoModal">
        <i class="bi bi-plus-lg"></i> <span> Tambah Toko </span>
    </button>
    <div class="table-responsive">
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
                                <li class="d-flex justify-content-around">
                                    <form action="{{ route('toko.toggle-status', $toko) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn bg-warning text-white p-1 ml-1">
                                            <i class="{{ $toko->is_active ? 'bi bi-x-square fs-6' : 'bi bi-check-square fs-6' }}"></i>
                                        </button>
                                    </form>
                                    <button class="btn bg-primary text-white p-1" type="button" data-bs-toggle="modal" data-bs-target="#editTokoModal" data-id="{{ $toko->id }}" data-nama="{{ $toko->nama_toko }}" data-marketplace="{{ $toko->marketplace }}" data-status="{{ $toko->is_active }}">
                                        <i class="bi bi-pencil fs-6"></i>
                                    </button>
                                    <button class="btn bg-danger text-white p-1 mr-1" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $toko->id }}">
                                        <i class="bi bi-trash fs-6"></i>
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
                            <button type="submit" class="custom-button">Simpan</button>
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
                        <button type="submit" class="custom-button">Update</button>
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
    // Handler untuk konfirmasi penghapusan
    $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var tokoId = button.data('id'); 
        var actionUrl = '{{ url("toko") }}/' + tokoId; 

        $('#deleteForm').attr('action', actionUrl);
    });

    // Tambah toko menggunakan AJAX
    $('#tokoForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                $('#tokoModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat menyimpan data');
            }
        });
    });

    // Mengisi data ke dalam form edit
    $('#editTokoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var tokoId = button.data('id');
        var namaToko = button.data('nama');
        var marketplace = button.data('marketplace');
        var status = button.data('status');

        $('#edit_nama_toko').val(namaToko);
        $('#edit_marketplace').val(marketplace);
        $('#edit_is_active').val(status);
        
        // Set URL action untuk form edit
        $('#editTokoForm').attr('action', '{{ url("toko") }}/' + tokoId);
    });
});

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection