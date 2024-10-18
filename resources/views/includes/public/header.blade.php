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
            <nav class="navbar navbar-expand navbar-light px-5">
                <img src="{{ ('style/src/img/icons/d2.png') }}" class="img-fluid" alt="Deepublish Logo">
                <div class="b-example-divider"></div>

                <div class="container">
                    <header class="d-flex justify-content-center py-3">
                        {{-- <div class="row text-center"></div> --}}
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a href="{{url('/dashboard')}}" class="nav-link">Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown" id="pesananDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Pesanan
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="pesananDropdown">
                                    <li><a class="dropdown-item" href="#">Buat Order</a></li>
                                    <li><a class="dropdown-item" href="#">Riwayat Pesanan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown" id="tokoDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Toko
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="tokoDropdown">

                                    <li><a class="dropdown-item" href="{{ url('toko') }}">Informasi Toko</a></li>
                                </ul>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{url('toko')}}">Informasi Toko</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown" id="pembayaranDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Pembayaran
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="pembayaranDropdown">
                                    <li><a class="dropdown-item" href="#">Riwayat Pembayaran</a></li>
                                    <li><a class="dropdown-item" href="#">Tagihan</a></li>
                                </ul>
                            </li>
                        </ul>
                </div>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
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
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
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
                                                <div class="text-dark">Update your product stock information before
                                                    October 31</div>
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
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                        </li>
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <img src="style/src/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
                                alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                    data-feather="user"></i> Profile</a>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>

                </div>
    </header>
    </div>
    </nav>
    </div>
    </header>
</body>

</html>