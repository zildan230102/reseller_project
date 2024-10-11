@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Selamat Datang, <strong>Jenny Wilson!</strong></h1>


{{-- Row Pertama --}}

		{{-- Row Kiri --}}

			<!-- Row Pertama -->

			<div class="row">
				<div class="col-xl-7 col-xxl-8">
					<div class="card flex-fill w-100">
					<div class="header-sale d-flex justify-content-between align-items-center">
						<h5 class="penjualan-keseluruhan">Penjualan Keseluruhan</h5>
						<div class="dropdown">
							<select class="month-dropdown" name="month" id="month">
								<option value="Agustus">Agustus</option>
								<option value="September" selected>September</option>
								<option value="Oktober">Oktober</option>
								<option value="November">November</option>
								<option value="Desember">Desember</option>
							</select>
						</div>
					</div>
					<div class="title-sale d-flex  align-items-center">
						<h3 class="mt-1 mb-3">Rp. 6.680.000</h3>
						<div class="mt-1 mb-3 ms-3">
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
							<div class="col-sm-6">
								<div class="card-total">
									<div class="card-body">
										<div class="row">
											<div class="col d-flex flex-column align-item-center mt-0">
												<div class="col-auto">
													<div class="stat">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
															<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
														</svg>
													</div>
												</div>
												<h5 class="card-title">Total Penjualan</h5>
											</div>
											
										</div>
										<h1 class="mt-1 mb-3">Rp 15.500.000</h1>
										<div class="mb-0">
											<span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i>13.02%</span>
											<span class="text-muted">Dari bulan Agustus</span>
										</div>
									</div>
								</div>
							</div>

							

							<div class="col-sm-6">
								<div class="card-total">
									<div class="card-body">
										<div class="row">
											<div class="col d-flex flex-column align-item-center mt-0">
												<div class="col-auto">
													<div class="stat">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
															<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
														</svg>
													</div>
												</div>
												<h5 class="card-title">Total Pendapatan</h5>
											</div>
										</div>
										<h1 class="mt-1 mb-3">Rp 5.150.000</h1>
										<div class="mb-0">
											<span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i> 13.02%</span>
											<span class="text-muted">Dari bulan Agustus</span>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="card-total">
									<div class="card-body">
										<div class="row">
											<div class="col d-flex  flex-column align-item-center mt-0">
												<div class="col-auto">
													<div class="stat">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
															<path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z"/>
															<path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
															<path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
														</svg>
													</div>
												</div>
												<h5 class="card-title">Konversi</h5>
											</div>
										</div>
										<h1 class="mt-1 mb-3">Rp 86.34%</h1>
										<div class="mb-0">
											<span class="text-danger"><i class="fa-solid fa-arrow-trend-down"></i> 0.32%</span>
											<span class="text-muted">Dari bulan Agustus</span>
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
						<div class="card-header">
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-secondary active" id="marketplace-btn">Marketplace</button>
									<button type="button" class="btn btn-secondary" id="toko-btn">Toko</button>
									<button type="button" class="btn btn-secondary" id="buku-btn">Buku</button>
								</div>
							
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bulan</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Januari</a>
										<a class="dropdown-item" href="#">Februari</a>
										<a class="dropdown-item" href="#">Maret</a>
									</div>
								</div>
							</div>	
							<h5 class="card-title d-flex justify-content-between align-item-center">Marketplace Dengan Penjualan Terbanyak Bulan Ini</h5>
						</div>
						<div class="card-body d-flex w-100">
							<div class="align-self-center chart chart-lg">
								<canvas id="chartjs-dashboard-bar"></canvas>
							</div>
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
										<table class="table table-borderless mb-0">
											<tbody>
												<tr>
													<td>Shopee</td>
													<td class="text-end">48%</td>
												</tr>
												<tr>
													<td>Web Deepublish</td>
													<td class="text-end">20%</td>
												</tr>
												<tr>
													<td>Tokopedia</td>
													<td class="text-end">12%</td>
												</tr>
												<tr>
													<td>Lazada</td>
													<td class="text-end">9%</td>
												</tr>
												<tr>
													<td>Bukalapak</td>
													<td class="text-end">6%</td>
												</tr>
												<tr>
													<td>OLX</td>
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
												<li class="legend-tokopedia"><span>Tokopedia</span> <strong>$30</strong></li>
												<li class="legend-lazada"><span>Lazada</span> <strong>$30</strong></li>
												<li class="legend-bukalapak"><span>Bukalapak</span> <strong>$30</strong></li>
												<li class="legend-olx"><span>OLX </span><strong>$30</strong></li>
												<li class="legend-deepublish"><span>Deepublish</span> <strong>$30</strong></li>
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
	</main>

@endsection