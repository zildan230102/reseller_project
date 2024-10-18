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
							<button class="month-dropdown">September <span class="arrow">&#9660;</span></button>
							<div class="dropdown-content">
							  <a href="#">January</a>
							  <a href="#">February</a>
							  <a href="#">March</a>
							  <a href="#">April</a>
							  <a href="#">May</a>
							  <a href="#">June</a>
							  <a href="#">July</a>
							  <a href="#">August</a>
							  <a href="#">September</a>
							  <a href="#">October</a>
							  <a href="#">November</a>
							  <a href="#">December</a>
							</div>
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
														<i class="text-orange bi bi-cart icon-large"></i>
													</div>
												</div>
												<h5 class="card-title">Total Penjualan</h5>
											</div>
										</div>
										<h1 class="mt-1 mb-1"><p class="fw-bold fs-4">Rp 15.500.000</p></h1>
										<div class="mb-0">
											<span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i>13.02%</span>
											<span class="text-muted">Dari Bulan Agustus</span>
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
														<i class="text-orange bi bi-wallet2 icon-large"></i>
													</div>
												</div>
												<h5 class="card-title">Total Pendapatan</h5>
											</div>
										</div>
										<h1 class="mt-1 mb-1"><p class="fw-bold fs-4">Rp 5.150.000</p></h1>
										<div class="mb-0">
											<span class="text-success"><i class="fa-solid fa-arrow-trend-up"></i> 13.02%</span>
											<span class="text-muted">Dari Bulan Agustus</span>
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
														<i class="text-orange bi bi-clipboard-data icon-large"></i>
													</div>
												</div>
												<h5 class="card-title">Konversi</h5>
											</div>
										</div>
										<h1 class="mt-1 mb-1"><p class="fw-bold fs-4">86.34%</p></h1>
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
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn active" id="marketplace-btn">Marketplace</button>
									<button type="button" class="btn" id="toko-btn">Toko</button>
									<button type="button" class="btn" id="buku-btn">Buku</button>
								</div>
								<div class="dropdown">
									<button class="month-dropdown">September <span class="arrow">&#9660;</span></button>
									<div class="dropdown-content">
									  <a href="#">January</a>
									  <a href="#">February</a>
									  <a href="#">March</a>
									  <a href="#">April</a>
									  <a href="#">May</a>
									  <a href="#">June</a>
									  <a href="#">July</a>
									  <a href="#">August</a>
									  <a href="#">September</a>
									  <a href="#">October</a>
									  <a href="#">November</a>
									  <a href="#">December</a>
									</div>
								</div>
							</div>
						</div>
						<h5 class="title-chart-bar text-center mb-3">Marketplace Dengan Penjualan Terbanyak Bulan Ini</h5>
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