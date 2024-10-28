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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- Baris Pertama : Logo -->
                    <div class="row w-auto">
                        <a class="navbar-brand" href="#">
                            <img src="{{ ('style/src/img/icons/d2.png') }}" class="img" alt="Deepublish Logo">
                        </a>
                    </div>

                    <!-- Tombol Hamburger untuk layar kecil -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Baris kedua: Text -->
                    <!-- Baris Kedua: Menu yang bisa di-collapse -->
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="btn btn-pesanan" href="{{url('/dashboard')}}" role="button"
                                    id="dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-pesanan" href="#" id="pesanan-btn" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Pesanan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('orders') }}">Buat Order</a></li>
                                    <li><a class="dropdown-item" href="#">Riwayat Pesanan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-pesanan" href="#" id="toko-btn" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Toko
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('toko') }}">Daftar Toko</a></li>
                                    <li><a class="dropdown-item" href="{{ url('bukus') }}">Daftar Buku</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-pesanan" href="#" id="pembayaran-btn" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Pembayaran
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Riwayat Pembayaran</a></li>
                                    <li><a class="dropdown-item" href="{{ url('logout') }}">Tagihan</a></li>
                                </ul>
                            </li>
                            <!-- Baris Ketiga: Profil Pengguna -->
                        </ul>
                        <li class="nav-item dropdown user-profile">
                            <a class="nav-link d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="style/src/img/avatars/image.png" class="avatar img-fluid rounded"
                                    alt="Charles Hall" />
                                <span class="text-dark ms-2">Charles Hall</span>
                            </a>
                            <ul class="dropdown-menu mt-1">
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i
                                            class="bi bi-person"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class="bi bi-box-arrow-left"></i>Logout</a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>