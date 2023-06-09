<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/img/favicon.png') }}">
    <title>
        SI Manajemen Finansial Colony | Register
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/css/nucleo-icons.css" rel="stylesheet') }} " />
    <link href="{{ url('assets/css/nucleo-svg.css" rel="stylesheet') }} " />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
</head>

<body class="">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang</h3>
                                    <p class="mb-0">Silakan isi form untuk mendapatkan akun anda</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="{{ url('register') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <?php if (Session::has("message")): ?>
                                        <div class="alert text-white alert-danger alert-dismissible fade show"
                                            role="alert">
                                            {{ Session::get('message') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php elseif (Session::has('info')) : ?>
                                        <div class="alert text-white alert-info alert-dismissible fade show"
                                            role="alert">
                                            {{ Session::get('info') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php endif ?>
                                        <label>Nama</label>
                                        <div class="mb-3">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama"
                                                aria-label="nama" aria-describedby="nama-addon">
                                        </div>
                                        <label>Alamat</label>
                                        <div class="mb-3">
                                            <input type="text" name="alamat" class="form-control"
                                                placeholder="Alamat" aria-label="alamat"
                                                aria-describedby="alamat-addon">
                                        </div>
                                        <label>Nomor HP</label>
                                        <div class="mb-3">
                                            <input type="text" name="no_hp" class="form-control"
                                                placeholder="Nomor HP" aria-label="no_hp"
                                                aria-describedby="nomor-hp-addon">
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email" aria-label="email" aria-describedby="email-addon">
                                        </div>
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" name="username" class="form-control"
                                                placeholder="Username" aria-label="username"
                                                aria-describedby="username-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                        <label>Foto</label>
                                        <div class="mb-3">
                                            <input type="file" name="image" id="image" class="form-control"
                                                accept="image/*" />
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Sudah Ada Akun?
                                        <a href="{{ url('login-konsumen') }}"
                                            class="text-info text-gradient font-weight-bold">Sign
                                            in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('{{ url('assets/img/curved-images/curved6.jpg') }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright © 2023 Me
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>

</html>
