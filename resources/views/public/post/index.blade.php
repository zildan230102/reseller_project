@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Selamat Datang, <strong>Jenny Wilson!</strong></h1>

			<!-- Row Pertama -->
			<div class="row">
				<div class="col-xl-6 col-xxl-7">
					<div class="card flex-fill w-100">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="card-title">Penjualan Keseluruhan</h5>
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
						<div class="card-body py-3">
							<div class="chart chart-sm">
								<canvas id="chartjs-dashboard-line"></canvas>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-6 col-xxl-5 d-flex">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Total Penjualan</h5>
											</div>
											<div class="col-auto">
												<div class="stat text-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
														<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
													</svg>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3">Rp 8.500.000</h1>
										<div class="mb-0">
											<span class="text-success"><i class="mdi mdi-arrow-bottom-right"></i> +13.02%</span>
											<span class="text-muted">Dari bulan lalu</span>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Total Pendapatan</h5>
											</div>
											<div class="col-auto">
												<div class="stat text-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
														<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
													</svg>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3">Rp 5.150.000</h1>
										<div class="mb-0">
											<span class="text-success"><i class="mdi mdi-arrow-bottom-right"></i> 13.02%</span>
											<span class="text-muted">Dari bulan lalu</span>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Tagihan</h5>
											</div>
											<div class="col-auto">
												<div class="stat text-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
														<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
														<path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
													</svg>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3 text-danger">Rp 1.480.000</h1>
										<div class="mb-0">
											<span class="text-danger"><i class="mdi mdi-arrow-bottom-right"></i> 0.32%</span>
											<span class="text-muted">Dari bulan lalu</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			<!--Row kedua-->
			<div class="row">
				<div class="col-xl-6 col-xxl-5 d-flex order-2 order-xxl-3">
					<div class="card flex-fill w-100">
						<div class="card-header">
							<h5 class="card-title mb-0">Data Marketplace</h5>
						</div>
						<div class="card-body d-flex">
							<div class="d-flex w-100">
								<!-- Tabel Data --> 
								<div class="w-50 me-3">
								<table class="table mb-0 table-borderless">
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

								<!-- Chart Pie --> 
								<div class="align-self-center w-50">
									<div class="py-3">
									  <div class="chart chart-xs">
										<canvas id="chartjs-dashboard-pie"></canvas>
									  </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 col-xxl-7">
					<div class="card flex-fill w-100">
						<div class="card-header">
							<!-- <h5 class="card-title mb-0">Monthly Sales</h5> -->
							<div class="button-container">
								<div class="button-group">
									<button class="btn">Marketplace</button>
									<button class="btn">Toko</button>
									<button class="btn">Buku</button>
								</div>	
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
						</div>
						<div class="card-body d-flex w-100">
							<div class="align-self-center chart chart-lg">
								<canvas id="chartjs-dashboard-bar"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>

<!-- Row 3 --> 
<div class="row">
    <!-- Kolom Kiri (dikosongkan) -->
    <div class="col-xl-6 col-xxl-7 d-flex">
      <!-- Kolom ini dikosongkan, tapi tetap ada untuk mempertahankan struktur grid -->
    </div>

	<!-- Kolom Kanan untuk tabel Data Toko Reseller -->
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="card w-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Data Penjualan Buku</h5>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0 table-borderless">
            <thead>
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Sold</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Buku kita</td>
                <td>Rp150.000</td>
                <td>32 pcs</td>
                <td><span class="badge in-stock">In Stock</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Rp150.000</td>
                <td>24 pcs</td>
                <td><span class="badge out-of-stock">Out of Stock</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Rp150.000</td>
                <td>12 pcs</td>
                <td><span class="badge in-stock">In Stock</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

	<!-- Row 3 --> 
<div class="row">
    <!-- Kolom Kiri (dikosongkan) -->
    <div class="col-xl-6 col-xxl-7 d-flex">
      <!-- Kolom ini dikosongkan, tapi tetap ada untuk mempertahankan struktur grid -->
    </div>

    <!-- Kolom Kanan untuk tabel Data Toko Reseller -->
    <div class="col-xl-6 col-xxl-5 d-flex">
      <div class="card w-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Data Toko Reseller</h5>
        </div>
        <div class="card-body">
          <table class="table table-hover my-0 table-borderless">
            <thead>
              <tr>
                <th>Name</th>
                <th>Marketplace</th>
                <th>Sold</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
			  <tr>
                <td>Buku kita</td>
                <td>Shopee</td>
                <td>32 pcs</td>
                <td><span class="badge bg-success">Done</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
		</div>
	</main>

@endsection