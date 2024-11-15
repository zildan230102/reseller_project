@extends('layouts.main')
@section('title', 'Informasi Toko')
@section('content')

    <style>
        .container {
            width: 100%;
            padding: 20px;
            padding-top: 80px;
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

        /* Responsif untuk layar 768px ke bawah */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
                padding-top: 80px;
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
            .form-group input, .form-group select {
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
                padding-top: 60px;
            }
            .text-title{
                font-size: 20px;
                text-align: center;
                margin-bottom: 16px !important;
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
            .bi-plus-lg {
                margin-right: 5px !important;
            }
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                font-size: 14px;
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
                font-size: 14px;
                padding: 15px 10px 15px 10px;
            }
            .modal-title {
                font-size: 16px;
            }
            .modal-footer {
                padding: 5px 5px 0px 5px;
            }
            .form-group label {
                font-size: 14px;
            }
            .form-control, .form-select {
                font-size: 12px;
            }
            .custom-button {
                font-size: 14px;
                padding: 8px 16px;
            }
            .btn-custom-danger {
                font-size: 14px;
                padding: 6px 10px;
            }
        }
    </style>
    <div class="container mt-4">
        <h1 class="text-title mb-4">Daftar Toko</h1>

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

        <div class="card-container">
            <div class="card mb-4">
                <div class="card-header-button">
                    <button type="button" class="custom-button-daftar" data-bs-toggle="modal" data-bs-target="#tokoModal">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Toko
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead text-center">
                            <tr>
                                <th>Nama Toko</th>
                                <th>Marketplace</th>
                                <th>Ekspedisi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tokos as $toko)
                                <tr>
                                    <td>{{ $toko->nama_toko }}</td>
                                    <td>{{ $toko->marketplace }}</td>
                                    <td>{{ $toko->ekspedisi->nama_ekspedisi ?? 'Tidak Ada' }}</td>
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
                                            <ul class="dropdown-menu">
                                                <!-- Toggle Status Button -->
                                                <li>
                                                    <form action="{{ route('toko.toggle-status', $toko) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        <button type="submit"
                                                            class="custom-dropdown-item no-border-item w-100">
                                                            <i
                                                                class="{{ $toko->is_active ? 'bi bi-x-square text-danger' : 'bi bi-check-square text-success' }}"></i>
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
                                                        <i class="bi bi-pencil text-warning me-2"></i> Edit
                                                    </button>
                                                </li>

                                                <!-- Delete Button -->
                                                <li>
                                                    <button class="custom-dropdown-item no-border-item w-100" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                        data-id="{{ $toko->id }}">
                                                        <i class="bi bi-trash text-danger me-2 fs-6"></i> Hapus
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
        </div>



        <!-- Modal untuk menambah toko -->
        <div class="modal fade" id="tokoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="tokoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tokoModalLabel">Tambah Toko</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tokoForm" action="{{ route('toko.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_toko">Nama Toko</label>
                                <input type="text" class="form-control" name="nama_toko" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="marketplace">Marketplace</label>
                                <input type="text" class="form-control" name="marketplace"
                                    placeholder="Masukkan nama marketplace" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="ekspedisi_id">Ekspedisi</label>
                                <select name="ekspedisi_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Ekspedisi</option>
                                    @foreach ($ekspedisis as $ekspedisi)
                                        <option value="{{ $ekspedisi->id }}">{{ $ekspedisi->nama_ekspedisi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
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
        <div class="modal fade" id="editTokoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="editTokoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTokoModalLabel">Edit Toko</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editTokoForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_nama_toko">Nama Toko</label>
                                <input type="text" class="form-control" id="edit_nama_toko" name="nama_toko"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_marketplace">Marketplace</label>
                                <input type="text" class="form-control" id="edit_marketplace" name="marketplace"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_ekspedisi_id">Ekspedisi</label>
                                <select id="edit_ekspedisi_id" name="ekspedisi_id" class="form-control" required>
                                    @foreach ($ekspedisis as $ekspedisi)
                                        <option value="{{ $ekspedisi->id }}">{{ $ekspedisi->nama_ekspedisi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_is_active">Status</label>
                                <select id="edit_is_active" name="is_active" class="form-select">
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
        <div class="modal fade" id="confirmDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus toko ini?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-custom-danger">Hapus</button>
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
    @endsection
