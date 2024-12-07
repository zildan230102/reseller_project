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
                    <a class="navbar-brand" href="#">
                        <!-- Logo besar (untuk desktop) -->
                        <img src="{{ ('style/src/img/icons/d2.png') }}" class="img logo-desktop" alt="Deepublish Logo Digital">
                        <!-- Logo kecil (untuk mobile) -->
                        <img src="{{ ('style/src/img/icons/d2.png') }}" class="img logo-mobile" alt="Deepublish Logo Mobile">
                        <div class="navbar-toggler-container">
                            <button class="navbar-toggler" type="button" id="hamburgerButton" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon custom-toggler-icon"></span>
                            </button>
                        </div>
                    </a>

                    <!-- Baris kedua: Text -->
                    <!-- Baris Kedua: Menu yang bisa di-collapse -->
                
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="btn btn-pesanan" href="{{url('/dashboard')}}" role="button"
                                    id="dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="btn btn-pesanan" href="#" role="button" id="pesanan-btn" aria-expanded="false">
                                    Pesanan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('orders') }}">Buat Order</a></li>
                                    <li><a class="dropdown-item" href="{{ route('riwayat.pesanan') }}">Riwayat Pesanan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-pesanan" href="#" role="button" id="toko-btn" aria-expanded="false">
                                    Toko
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('toko') }}">Daftar Toko</a></li>
                                    <li><a class="dropdown-item" href="{{ url('bukus') }}">Daftar Buku</a></li>
                                </ul>
                            </li>    
                            <li class="nav-item dropdown">
                                <a class="btn btn-pesanan" href="#" role="button" id="pembayaran-btn" aria-expanded="false">
                                    Pembayaran
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('payment.history') }}">Riwayat Pembayaran</a></li>
                                    <li><a class="dropdown-item" href="{{ route('payment.bills') }}">Tagihan</a></li>
                                </ul>
                                
                            </li>    
                        </ul>
                        <!-- Baris Ketiga -->
                        <!-- Profil Pengguna -->
                        <li class="nav-item dropdown user-profile">
                            <a class="nav-dropdown d-flex align-items-center" href="#" role="button" aria-expanded="false">
                                <img src="style/src/img/avatars/image.png" class="avatar img-fluid rounded" alt="Charles Hall" />
                                <span class="text-dark ms-2">Charles Hall</span>
                            </a>
                            <ul class="dropdown-menu mt-1">
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="bi bi-person"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="{{ url('logout') }}"><i class="bi bi-box-arrow-left"></i>Logout</a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <script>
        document.getElementById('hamburgerButton').addEventListener('click', function() {
            const menu = document.getElementById('navbarNav');
        
            // Toggle kelas 'show' untuk buka/tutup menu
            menu.classList.toggle('show');
            
            // Toggle 'aria-expanded' untuk aksesibilitas
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
        });
    </script>
</body>

</html>