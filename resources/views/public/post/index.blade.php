@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <h2 class="h3 mb-3">Selamat Datang, <strong>Jenny Wilson!</strong></h2>

        <!-- Row Pertama -->
        <div class="row">
            <div class="col-xl-7 col-xxl-8">
                <div class="card flex-fill w-100">
                    <div class="header-sale d-flex justify-content-between align-items-center">
                        <h5 class="penjualan-keseluruhan mt-1">Penjualan Keseluruhan</h5>
                        <div class="dropdown">
                            <button class="month-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                September<i class="bi bi-chevron-down ml-2"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-bs-offset="0,10">
                                <li><a class="dropdown-item" href="#">Januari</a></li>
                                <li><a class="dropdown-item" href="#">Februari</a></li>
                                <li><a class="dropdown-item" href="#">Maret</a></li>
                                <li><a class="dropdown-item" href="#">April</a></li>
                                <li><a class="dropdown-item" href="#">Mei</a></li>
                                <li><a class="dropdown-item" href="#">Juni</a></li>
                                <li><a class="dropdown-item" href="#">Juli</a></li>
                                <li><a class="dropdown-item" href="#">Agustus</a></li>
                                <li><a class="dropdown-item" href="#">September</a></li>
                                <li><a class="dropdown-item" href="#">Oktober</a></li>
                                <li><a class="dropdown-item" href="#">November</a></li>
                                <li><a class="dropdown-item" href="#">Desember</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="title-sale d-flex  align-items-center">
                        <h3 class="">Rp6.680.000</h3>
                        <div class="ms-3">
                            <span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i>13.02%</span>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row Kanan --}}
            <div class="col-xl-5 col-xxl-4 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-sm-12">
                            <div class="card-total">
                                <div class="card-right">
                                    <div class="row">
                                        <div class="col d-flex flex-column align-item-center mt-0">
                                            <div class="col-auto">
                                                <div class="stat">
                                                    <i class="text-orange bi bi-cart icon-large"></i>
                                                </div>
                                            </div>
                                            <h5 class="title-total">Total Penjualan</h5>
                                        </div>
                                    </div>
                                    <h1 class="">
                                        <p class="fw-bold fs-4">Rp15.500.000</p>
                                    </h1>
                                    <div class="mb-0">
                                        <span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i>13.02%</span>
                                        <span class="text-muted">Dari Bulan Agustus</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="card-total">
                                <div class="card-right">
                                    <div class="row">
                                        <div class="col d-flex flex-column align-item-center mt-0">
                                            <div class="col-auto">
                                                <div class="stat">
                                                    <i class="text-orange bi bi-wallet2 icon-large"></i>
                                                </div>
                                            </div>
                                            <h5 class="title-total">Total Pendapatan</h5>
                                        </div>
                                    </div>
                                    <h1 class="">
                                        <p class="fw-bold fs-4">Rp5.150.000</p>
                                    </h1>
                                    <div class="mb-0">
                                        <span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i>13.02%</span>
                                        <span class="text-muted">Dari Bulan Agustus</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="card-total">
                                <div class="card-right">
                                    <div class="row">
                                        <div class="col d-flex  flex-column align-item-center mt-0">
                                            <div class="col-auto">
                                                <div class="stat">
                                                    <i class="text-orange bi bi-clipboard-data icon-large"></i>
                                                </div>
                                            </div>
                                            <h5 class="title-total">Konversi</h5>
                                        </div>
                                    </div>
                                    <h1 class="">
                                        <p class="fw-bold fs-4">86.34%</p>
                                    </h1>
                                    <div class="mb-0">
                                        <span class="text-danger"><i class="fa-solid fa-arrow-trend-down"></i> 0.32%</span>
                                        <span class="text-muted">Dari Bulan Agustus</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Row kedua-->
        <div class="row"> 
            <!-- Kolom kiri -->
            <div class="col-xl-7 col-xxl-8">
                <div class="card flex-fill w-100">
                    <div class="bar-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group-desktop" role="group" aria-label="Tombol Desktop">
                                <button type="button" class="btn active" id="marketplace-btn">Marketplace</button>
                                <button type="button" class="btn" id="toko-btn">Toko</button>
                                <button type="button" class="btn" id="buku-btn">Buku</button>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Kategori<i class="bi bi-chevron-down ml-2"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-bs-offset="0,10">
                                    <li><a class="dropdown-item" href="#">Marketplace</a></li>
                                    <li><a class="dropdown-item" href="#">Toko</a></li>
                                    <li><a class="dropdown-item" href="#">Buku</a></li>
                                </ul>
                            </div>

                            <div class="dropdown">
                                <button class="month-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    September<i class="bi bi-chevron-down ml-2"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-bs-offset="0,10">
                                    <li><a class="dropdown-item" href="#">Januari</a></li>
                                    <li><a class="dropdown-item" href="#">Februari</a></li>
                                    <li><a class="dropdown-item" href="#">Maret</a></li>
                                    <li><a class="dropdown-item" href="#">April</a></li>
                                    <li><a class="dropdown-item" href="#">Mei</a></li>
                                    <li><a class="dropdown-item" href="#">Juni</a></li>
                                    <li><a class="dropdown-item" href="#">Juli</a></li>
                                    <li><a class="dropdown-item" href="#">Agustus</a></li>
                                    <li><a class="dropdown-item" href="#">September</a></li>
                                    <li><a class="dropdown-item" href="#">Oktober</a></li>
                                    <li><a class="dropdown-item" href="#">November</a></li>
                                    <li><a class="dropdown-item" href="#">Desember</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h5 class="title-chart-bar text-center mb-3">Marketplace dengan Penjualan Terbanyak Bulan Ini</h5>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                    <div class="chart-legend d-flex justify-content-center mt-3">
                        <div class="legend-item" style="background-color: #0F0890;" data-label="Lazada"></div>
                        <div class="legend-item" style="background-color: #F1582E;" data-label="Shopee"></div>
                        <div class="legend-item" style="background-color: #469546;" data-label="Tokopedia"></div>
                        <div class="legend-item" style="background-color: #3A77FF;" data-label="OLX"></div>
                        <div class="legend-item" style="background-color: #BCBCBC;" data-label="Web Deepublish"></div>
                        <div class="legend-item" style="background-color: #E37F51;" data-label="Bukalapak"></div>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan -->
            <div class="col-xl-5 col-xxl-4 d-flex flex-column">
                <div class="card mb-3 w-100">
                    <div class="card-header">
                        <h5 class="data-marketplace">Data Marketplace</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Tabel Data -->
                            <div class="col-kiri mb-3 mb-sm-0">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 custom-table">
                                        <tbody>
                                            <tr>
                                                <td class="name">Shopee</td>
                                                <td class="text-end">48%</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Web Deepublish</td>
                                                <td class="text-end">20%</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Tokopedia</td>
                                                <td class="text-end">12%</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Lazada</td>
                                                <td class="text-end">9%</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Bukalapak</td>
                                                <td class="text-end">6%</td>
                                            </tr>
                                            <tr>
                                                <td class="name">OLX</td>
                                                <td class="text-end">5%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Chart Pie dan Legend Data dalam satu kolom -->
                            <div class="col-kanan">
                                <div class="row">
                                    <div class="performa-header">
                                        <h4 class="performa-marketplace">Performa Marketplace</h4>
                                    </div>
                                    <!-- Chart Pie -->
                                    <div class="col-6">
                                        <div class="chart-container">
                                            <canvas id="chartjs-dashboard-pie"></canvas>
                                        </div>
                                    </div>
                                    <!-- Legend Data -->
                                    <div class="col-6">
                                        <ul class="legend-list">
                                            <li class="legend-shopee"><span>Shopee</span> <strong>$30</strong></li>
                                            <li class="legend-tokopedia"><span>Tokopedia</span> <strong>$30</strong>
                                            </li>
                                            <li class="legend-lazada"><span>Lazada</span> <strong>$30</strong></li>
                                            <li class="legend-bukalapak"><span>Bukalapak</span> <strong>$30</strong>
                                            </li>
                                            <li class="legend-olx"><span>OLX </span><strong>$30</strong></li>
                                            <li class="legend-deepublish"><span>Deepublish</span> <strong>$30</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Penjualan Buku -->
                <div class="card w-100">
                    <div class="card-header">
                        <h5 class="data-penjualan">Data Penjualan Buku</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="judul-th">
                                    <tr>
                                        <th class="judul-th">Name</th>
                                        <th class="judul-th">Price</th>
                                        <th class="judul-th">Sold</th>
                                        <th class="judul-th">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="name-column">Judul Buku</td>
                                        <td>Rp 150.000</td>
                                        <td>32 pcs</td>
                                        <td><span class="status-dot in-stock"></span>In Stock</td>
                                    </tr>
                                    <tr>
                                        <td class="name-column">Judul Buku</td>
                                        <td>Rp 150.000</td>
                                        <td>24 pcs</td>
                                        <td><span class="status-dot out-of-stock"></span>Out of Stock</td>
                                    </tr>
                                    <tr>
                                        <td class="name-column">Judul Buku</td>
                                        <td>Rp 150.000</td>
                                        <td>12 pcs</td>
                                        <td><span class="status-dot in-stock"></span>In Stock</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row ketiga -->
        <div class="row">
            <!-- Kolom Kiri (dikosongkan) -->
            <div class="col-xl-7 col-xxl-8 d-flex">
                <!-- Kolom ini dikosongkan, tapi tetap ada untuk mempertahankan struktur grid -->
            </div>

            <!-- Kolom Kanan untuk tabel Data Toko Reseller -->
            <div class="col-xl-5 col-xxl-4 d-flex">
                <div class="card w-100">
                    <div class="card-header">
                        <h5 class="data-reseller">Data Toko Reseller</h5>
                    </div>
                    <div class="card-body">
                        <table class="table my-0 table-borderless">
                            <thead class="judul-th">
                                <tr>
                                    <th class="judul-th">Name</th>
                                    <th class="judul-th">Marketplace</th>
                                    <th class="judul-th">Sold</th>
                                    <th class="judul-th">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="name-column">Buku kita</td>
                                    <td>Shopee</td>
                                    <td>32 pcs</td>
                                    <td><span class="status-dot in-stock"></span>Active</td>
                                </tr>
                                <tr>
                                    <td class="name-column">Kutu Buku</td>
                                    <td>Lazada</td>
                                    <td>10 pcs</td>
                                    <td><span class="status-dot in-stock"></span>Active</td>
                                </tr>
                                <tr>
                                    <td class="name-column">Buka Buku</td>
                                    <td>Bukalapak</td>
                                    <td>8 pcs</td>
                                    <td><span class="status-dot in-stock"></span>Active</td>
                                </tr>
                                <tr>
                                    <td class="name-column">Buku Ku</td>
                                    <td>OLX</td>
                                    <td>7 pcs</td>
                                    <td><span class="status-dot in-stock"></span>Active</td>
                                </tr>
                                <tr>
                                    <td class="name-column">Dunia Buku</td>
                                    <td>Web Deepublish</td>
                                    <td>16 pcs</td>
                                    <td><span class="status-dot in-stock"></span>Active</td>
                                </tr>
                                <tr>
                                    <td class="name-column">Bukupedia</td>
                                    <td>Tokopedia</td>
                                    <td>12 pcs</td>
                                    <td><span class="status-dot in-stock"></span>Active</td>
                                </tr>
                                <tr class="deactive">
                                    <td class="name-column">Buku Mu</td>
                                    <td>Tiktok Shop</td>
                                    <td>2 pcs</td>
                                    <td><span class="status-dot out-of-stock"></span>Deactive</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('categoryDropdown');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            // Toggle dropdown visibility when button is clicked
            categoryDropdown.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent the click from bubbling up
                dropdownMenu.classList.toggle('show'); // Toggle visibility
            });

            // Prevent dropdown from closing when clicking inside the menu
            dropdownMenu.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent dropdown from closing
            });

            // Close dropdown if clicking outside both button and menu
            document.addEventListener('click', function(event) {
                if (!dropdownMenu.contains(event.target) && !categoryDropdown.contains(event.target)) {
                    dropdownMenu.classList.remove('show'); // Hide dropdown
                }
            });
        });
    </script>    
</main>

@endsection