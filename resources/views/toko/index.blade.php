@extends('layouts.main')
@section('title', 'Informasi Toko')
@section('content')

<style>
.container-toko {
    width: 100%;
    padding-top: 60px;
    max-width: 1200px;
    margin: 0 auto;
    height: auto;
}

.text-title {
    text-align: center;
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

.card-body-toko {
    padding: 0 15px;
}

.buttonallert {
    background-color: #ff9800;
    box-shadow: none;
    outline: none;
}

.buttonallert:focus {
    box-shadow: none;
}

.modal-dialog {
    max-width: 480px;
    margin: 0 auto;
    margin-top: 1rem;
}

.modal-header-toko {
    padding: 1.25rem 1rem 1.25rem 2rem;
    font-size: 14px;
    border-bottom: 2px solid #ddd;
}

.modal-body-toko {
    padding: 1rem 2rem 0.25rem 2rem;
}

.btn-modal-close {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    z-index: 1;
}

.button-add {
    border-top: 2px solid #ddd;
    padding: 1rem 1.5rem 1rem 1.5rem;
}
.new-toko-row {
    background-color: #d1e7dd; 
    animation: fadeOut 30s forwards; 
}

@keyframes fadeOut {
    0% {
        background-color: #ffe1b4f6;
    }
    100% {
        background-color: transparent;
    }
}

@media (min-width: 320px) and (max-width: 599px) {
    .container-toko {
        padding: 60px 20px 0 20px;
        height: auto;
    }

    .text-title {
        font-size: 20px;
        text-align: center;
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
        max-width: 320px;
        margin: 0 auto;
        padding-top: 1rem;
    }

    .modal-header-toko {
        padding: 1.25rem 1.5rem 1rem 1.5rem;
        font-size: 14px;
    }

    .modal-body-toko {
        font-size: 14px;
        padding: 0.75rem 1.5rem 0.25rem 1.5rem;
    }

    .modal-title {
        font-size: 16px;
    }

    .modal-footer {
        font-size: 12px;
        padding: 0.75rem 1rem 0.75rem 1rem;
    }

    .btn-modal-close {
        position: absolute;
        top: 1.25rem;
        right: 1.5rem;
        z-index: 1;
    }

    .button-add {
        padding: 1rem 1.25rem 1rem 0;
    }

    .form-group label {
        font-size: 12px;
    }

    .form-control,
    .form-select {
        font-size: 12px;
    }

    .form-control option {
        font-size: 11px;
    }

    .custom-button {
        font-size: 14px;
        padding: 8px 16px;
    }

    .btn-custom-danger {
        font-size: 14px;
        padding: 6px 10px;
    }

    .table .dropdown-menu {
        font-size: 12px;
        left: auto;
        right: 0;
        transform: translateX(-40%) !important;
    }

    .small-icon {
        font-size: 10px;
    }

    .custom-dropdown option {
        font-size: 11px;
    }

    .alert-success {
        font-size: 14px;
    }

    .sweetalert {
        max-width: 300px;
        font-size: 12px;
    }
}

@media (min-width: 600px) and (max-width: 1280px) {
    .container-toko {
        padding: 10px;
        padding-top: 80px;
        height: auto;
    }
    .card-container {
        padding: 0 20px 0 20px;
    }
    .text-title {
        text-align: center;
        font-size: 25px;
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
        max-width: 480px;
        margin: 0 auto;
        margin-top: 1rem;
    }
    .modal-header-toko {
        padding: 1.25rem 2rem 1rem 2rem;
    }
    .modal-title {
        font-size: 18px;
    }
    .modal-footer {
        font-size: 12px;
        padding: 0.75rem 1rem 0.75rem 1rem;
    }
    .modal-body-toko {
        font-size: 14px;
        padding: 0.75rem 2rem 0.5rem 2rem;
    }
    .btn-modal-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1;
    }
    .button-add {
        padding: 1.2rem 1.5rem 1.2rem 0;
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
    .form-select option {
        font-size: 11px;
    }
    .aksi {
        font-size: 14px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
}

@media (min-width: 1025px) and (max-width: 1280px) {
    .container-toko {
        padding: 10px;
        padding-top: 60px;
        height: auto;
    }
    .card-container {
        padding: 0 40px 0 40px;
    }
    .text-title {
        text-align: center;
        font-size: 25px;
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
        max-width: 480px;
        margin: 0 auto;
        margin-top: 1rem;
    }
    .modal-header-toko {
        padding: 1.25rem 2rem 1rem 2rem;
    }
    .modal-title {
        font-size: 18px !important;
    }
    .modal-footer {
        font-size: 12px;
        padding: 0.75rem 1rem 0.75rem 1rem;
    }
    .modal-body-toko {
        font-size: 14px;
        padding: 0.75rem 2rem 0.5rem 2rem;
    }
    .btn-modal-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1;
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
    .form-select option {
        font-size: 11px;
    }
    .aksi {
        font-size: 14px;
        left: auto;
        right: 0;
        transform: translateX(-50%) !important;
    }
}
</style>

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