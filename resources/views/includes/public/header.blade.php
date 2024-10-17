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


                                    <li><a class="dropdown-item" href="#">Informasi Toko</a></li>
                                </ul> -->
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Toko
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{url('toko')}}">Informasi Toko</a></li>
                                    </ul>
                                </div>


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
                                            <div class="dropdown-menu-footer">
                                                <a href="#" class="text-muted">Show all notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                        data-bs-toggle="dropdown">
                                        <i class="align-middle" data-feather="settings"></i>
                                    </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ url('profile') }}"><i class="align-middle me-1"
                                        data-feather="user"></i>
                                    Profile</a>

                                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                        data-bs-toggle="dropdown">
                                        <img src="{{ ('style/src/img/avatars/avatar.jpg') }}"
                                            class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                                        <span class="text-dark">{{ Auth::user()->name }}</span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ url('profil') }}"><i class="align-middle me-1"
                                                data-feather="user"></i>
                                            Profile
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" style="display: none;"
                                            id="logout-form">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                            </svg> Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>
                </div> 
            </nav>
        </div>
    </header>
</body>

</html>