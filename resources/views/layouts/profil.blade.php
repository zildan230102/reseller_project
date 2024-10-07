<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    @include('includes.public.style')
</head>

<body>

    @include('includes.public.header')

    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Profile</h1>

            </div>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Foto Profil</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('style/src/img/avatars/avatar-4.jpg')}}" alt="Christina Mason"
                                class="img-fluid rounded-circle mb-2" width="128" height="128" />
                            <h5 class="card-title mb-0">Christina Mason</h5>
                            <div class="text-muted mb-2">Reseller Deepublish</div>

                            <div>
                                <a class="btn btn-primary btn-sm" href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></span>
                                    Edit Profil</a>
                            </div>
                        </div>
                        <hr class="my-0" />

                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Data Diri</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1">Id :
                                </li>
                                <li class="mb-1">Alamat :</li>

                                <li class="mb-1">Tanggal
                                    Bergabung :</li>
                                <li class="mb-1">Nomor Hp :
                                </li>
                                <li class="mb-1">Email :
                                </li>
                            </ul>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Sosial Media</h5>
                            <ul class="list-unstyled mb-0">

                                <li class="mb-1"><a href="#">Twitter</a></li>
                                <li class="mb-1"><a href="#">Facebook</a></li>
                                <li class="mb-1"><a href="#">Instagram</a></li>
                                <li class="mb-1"><a href="#">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Riwayat Aktivitas</h5>

                        </div>

                        <div class="card-body h-100">

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('includes.public.footer')

    @include('includes.public.script')

</body>

</html>