<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-main.css">
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>SiTalang</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="/daftar_siswa" style="font-size: 25px;"><strong>SITALANG</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu <span class="sr-only">(current)</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/daftar_siswa">Daftar Siswa</a>
                        </div>
                    </li>
                </ul>
                <div class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle drop-title" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hallo, {{ @Session::get('nama') }}
                        </a>
                        <div class="dropdown-menu drop" x-placement="bottom-start" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/ubah_password"><i class="fas fa-key" style="margin-right: 10px;"></i>Ubah Password</a>
                            <a class="dropdown-item" href="/kelola_siswa"><i class="fas fa-user-plus" style="margin-right: 10px;"></i>Kelola Siswa</a>
                            <a class="dropdown-item" href="/keluar"><i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>Keluar</a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script type="text/javascript" src="/js/font-awesome.min.js"></script>
    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script type="text/javascript" src="/js/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        var path_home = "{{ route('siswa.home') }}";
        var path_detail = "{{ route('poin.siswa') }}";
    </script>
</body>

</html>