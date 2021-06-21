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
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>SiTalang</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar fixed-top shadow">
        <div class="container-fluid">
            <div class="navbar-brand">
                <button type="button" id="sidebarCollapse" class="button-trans">
                    <i class="fas fa-bars" style="color: white;"></i>
                </button>
                <a href="/info_poin/{{ $siswa->id }}" class="text-light navbar-brand"><strong>SITALANG</strong></a>
            </div>
            <div class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle drop-title" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hallo, {{ strtok(@Session::get('nama'), " ") }}
                    </a>
                    <div class="dropdown-menu" style="position: absolute; transform: translate3d(-90px, 37px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/ubah_password"><i class="fas fa-key" style="margin-right: 10px;"></i>Ubah Password</a>
                        <hr style="margin: 7px 0px;">
                        <a class="dropdown-item" href="/keluar"><i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>Keluar</a>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="container-fluid">
                <ul class="components pl-4 pt-3" style="list-style-type: none;">
                    <li class="active">
                        <strong>MENU</strong>
                    <li style="list-style-type: none;">
                        <a href="/info_poin/{{ $siswa->id }}" style="text-decoration: none;" class="list"><i class="fas fa-user-friends" style="margin-right: 10px;"></i>Pelanggaran</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="content">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script type="text/javascript" src="/js/font-awesome.min.js"></script>
    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script type="text/javascript" src="/js/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/js/main-siswa.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        var path_info_poin = "{{ route('poin.siswa') }}";
    </script>
</body>

</html>