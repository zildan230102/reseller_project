@extends('layouts.main')
@section('title', 'Informasi Toko')
@section('content')

<div class="container-toko mt-4">
    <h1 class="text-title mb-4">Daftar Toko</h1>

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

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card-container">
        <div class="card">
            <div class="card-header-button">
                <button type="button" class="custom-button-daftar" data-bs-toggle="modal" data-bs-target="#tokoModal">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Toko
                </button>
            </div>
            <div class="card-body-toko">
                @if ($tokos->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    <strong>Tidak ada data toko.</strong> Silakan tambahkan toko baru.
                </div>
                @else
                <table class="table table-bordered ">
                    <thead class="thead text-center">
                        <tr>
                            <th>Nama Toko</th>
                            <th>Marketplace</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tokos as $toko)
                        <tr class="{{ session('new_toko_id') == $toko->id ? 'new-toko-row' : '' }}">
                            <td>{{ $toko->nama_toko }}</td>
                            <td>{{ $toko->marketplace }}</td>
                            <td class="text-center">
                                <span class="badge {{ $toko->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $toko->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-no-border" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill text-black"></i>
                                    </button>
                                    <ul class="dropdown-menu aksi">
                                        <!-- Toggle Status Button -->
                                        <li>
                                            <form action="{{ route('toko.toggle-status', $toko) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="custom-dropdown-item no-border-item w-100">
                                                    <i
                                                        class="{{ $toko->is_active ? 'bi bi-x-square text-danger small-icon' : 'bi bi-check-square text-success' }}"></i>
                                                    {{ $toko->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        </li>

                                        <!-- Edit Button -->
                                        <li>
                                            <button class="custom-dropdown-item no-border-item w-100" type="button"
                                                data-bs-toggle="modal" data-bs-target="#editTokoModal"
                                                data-id="{{ $toko->id }}" data-nama="{{ $toko->nama_toko }}"
                                                data-marketplace="{{ $toko->marketplace }}"
                                                data-status="{{ $toko->is_active }}">
                                                <i class="bi bi-pencil text-warning me-2 small-icon"></i> Edit
                                            </button>
                                        </li>

                                        <!-- Delete Button -->
                                        <li>
                                            <button class="custom-dropdown-item no-border-item w-100" type="button"
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                data-id="{{ $toko->id }}">
                                                <i class="bi bi-trash text-danger me-2 small-icon"></i> Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk menambah toko -->
    <div class="modal fade" id="tokoModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="tokoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header-toko">
                    <h5 class="modal-title" id="tokoModalLabel">Tambah Toko</h5>
                    <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="tokoForm" action="{{ route('toko.store') }}" method="POST">
                    @csrf
                    <div class="modal-body-toko">
                        <div class="mb-3">
                            <label for="nama_toko" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                placeholder="Masukkan nama toko" required>
                        </div>
                        <div class="mb-3">
                            <label for="marketplace" class="form-label">Marketplace</label>
                            <input type="text" class="form-control" id="marketplace" name="marketplace"
                                placeholder="Masukkan tempat penjualan" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select id="is_active" name="is_active" class="form-select" required>
                                <option value="" disabled selected>Pilih status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="custom-button">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal untuk edit toko -->
    <div class="modal fade" id="editTokoModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="editTokoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header-toko">
                    <h5 class="modal-title" id="editTokoModalLabel">Edit Toko</h5>
                    <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="editTokoForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body-toko">
                        <div class="mb-3">
                            <label for="edit_nama_toko" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" id="edit_nama_toko" name="nama_toko" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_marketplace" class="form-label">Marketplace</label>
                            <input type="text" class="form-control" id="edit_marketplace" name="marketplace" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_is_active" class="form-label">Status</label>
                            <select id="edit_is_active" name="is_active" class="form-select" required>
                                <option value="" disabled selected>Pilih status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="custom-button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header-toko">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Toko
                    </h5>
                    <button type="button" class="btn-close shadow-none btn-modal-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body-toko">
                    <p>Apakah Anda yakin ingin menghapus toko ini?
                    </p>
                </div>
                <div class="modal-footer">
                    @foreach ($tokos as $toko)
                    <form action="{{ route('toko.destroy', $toko->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-custom-danger" data-id="{{ $toko->id }}">Hapus</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editTokoModal = document.getElementById('editTokoModal');
    editTokoModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const marketplace = button.getAttribute('data-marketplace');
        const isActive = button.getAttribute('data-status');

        // Set nilai input dalam form
        const form = document.getElementById('editTokoForm');
        form.action = `/toko/${id}`;
        document.getElementById('edit_nama_toko').value = nama;
        document.getElementById('edit_marketplace').value = marketplace;
        document.getElementById('edit_is_active').value = isActive;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('confirmDeleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Tombol yang memicu modal
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            // Set nama toko dalam modal
            document.getElementById('deleteTokoName').textContent = nama;

            // Update form action
            const form = document.getElementById('deleteForm');
            form.action = `/toko/${id}`;
        });
    });

    // Form Submission for Adding Toko
    const tokoForm = document.getElementById('tokoForm');
    tokoForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default submission for debugging
        this.submit(); // Submit the form
    });

    // Form Submission for Editing Toko
    const editTokoForm = document.getElementById('editTokoForm');
    editTokoForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default submission for debugging
        this.submit(); // Submit the form
    });

    // Toast Notification for Success Message
    if (document.querySelector('.toast-success')) {
        const toast = new bootstrap.Toast(document.querySelector('.toast-success'));
        toast.show();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const newRow = document.querySelector('.new-toko-row');
        if (newRow) {
            setTimeout(() => {
                newRow.classList.remove('new-toko-row');
            }, 10000);
        }
    });
});
</script>


@endsection