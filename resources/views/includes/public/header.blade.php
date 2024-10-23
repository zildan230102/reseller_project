<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">

</head>


<body>
    <header>
        <div class="header" id="header">
            <nav class="navbar navbar-expand navbar-light">
                <img src="{{ ('style/src/img/icons/d2.png') }}" class="img-fluid" alt="Deepublish Logo">
                <div class="b-example-divider"></div>

                <div class="container">
                    <header class="d-flex justify-content-center py-3">
                        <ul class="nav nav-pills">
                        <a class="btn btn-pesanan" href="{{url('/dashboard')}}" role="button" id="dashboard">Dashboard</a>
                            <div class="dropdown">
                                <a class="btn btn-pesanan" href="#" role="button" id="pesanan-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pesanan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Buat Order</a></li>
                                    <li><a class="dropdown-item" href="#">Riwayat Pesanan</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-pesanan" href="#" role="button" id="toko-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    Toko
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('toko') }}">Informasi Toko</a></li>
                                </ul>
                            </div> 
                            <div class="dropdown">
                                <a class="btn btn-pesanan" href="#" role="button" id="pembayaran-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pembayaran
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Riwayat Pembayaran</a></li>
                                    <li><a class="dropdown-item" href="#">Tagihan</a></li>
                                </ul>
                            </div>  
                        </ul>
                    </header>
                </div>
                
                <div class="container"> 
                    <div class="navbar-collapse collapse justify-content-end">
                        <ul class="navbar-nav navbar-align">
                            <!-- Notifikasi -->
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                    <div class="position-relative">
                                        <i class="align-middle" data-feather="bell"></i>
                                        <span class="indicator">4</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                    <div class="dropdown-menu-header">
                                        4 New Notifications
                                    </div>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-2">
                                                    <i class="text-danger" data-feather="alert-circle"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">Update completed</div>
                                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                    <div class="text-muted small mt-1">30m ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-2">
                                                    <i class="text-warning" data-feather="bell"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">Update your product stock information before October 31</div>
                                                    <div class="text-muted small mt-1">Update the stock immediately.</div>
                                                    <div class="text-muted small mt-1">2h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-2">
                                                    <i class="text-primary" data-feather="home"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">Login from 192.186.1.8</div>
                                                    <div class="text-muted small mt-1">5h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-2">
                                                    <i class="text-success" data-feather="user-plus"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">New connection</div>
                                                    <div class="text-muted small mt-1">Christina accepted your request.</div>
                                                    <div class="text-muted small mt-1">14h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu-footer">
                                        <a href="#" class="text-muted">Show all notifications</a>
                                    </div>             
                                </div> 
                            </li>   

                            <!-- Profil Pengguna -->
                            <div class="collapse navbar-collapse justify-content-end">
                                <ul class="navbar-nav">
                                    <div class="dropdown me-3">
                                        <a class="nav-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="style/src/img/avatars/image.png" class="avatar img-fluid rounded" alt="Charles Hall"/> 
                                            <span class="text-dark">Charles Hall</span>
                                        </a>

                                        <ul class="dropdown-menu mt-3">
                                            <li><a class="dropdown-item" href="pages-profile.html"><i class="bi bi-person"></i>Profile</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left"></i>Logout</a></li>
                                        </ul>
                                    </div>
                                </ul>
                            </div> 
                        </ul>
                    </div> 
                </div>
            </nav>
        </div>
    </header>
</body>
</html>