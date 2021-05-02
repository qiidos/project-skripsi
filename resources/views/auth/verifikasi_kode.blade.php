<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-auth.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>SiTalang - Konfirmasi Kode</title>
</head>

<body>
    <div class="container margin-card-login">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 rounded-0 shadow-lg">
                    <div class="card-header bg-card-header text-light rounded-0">
                        <strong>SITALANG</strong>
                    </div>
                    <div class="card-body">

                        <br />
                        <form action="/verifikasi_email/verifikasi_kode/proses_verifikasi_kode" method="post">
                            {{ csrf_field() }}

                            <div class="form-group text-center">
                                <h4 class="font-weight-bold">KONFIRMASI KODE</h4>
                            </div>
                            <hr class="hr-black">
                            <div class="form-row justify-content-center">
                                <div class="col-sm-7 my-1">
                                    @if ($message = Session::get('email_terkirim'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    @if ($message = Session::get('email_terkirim_kembali'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    @if ($message = Session::get('kode_salah'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="kode">Kode</label>
                                        <input class="form-control" type="text" name="kode" placeholder="Enter code" value="{{ old('kode') }}">

                                        @if($errors->has('kode'))
                                        <div class="text-danger">
                                            {{ $errors->first('kode')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group text-center pt-3">
                                        <input class="btn button-main btn-block text-light" id="verifikasi_kode" type="submit" value="Submit">
                                    </div>
                                    <!-- <div class="countdown text-center"></div> -->
                                    <div class="form-group text-center mt-md-2">
                                        <a href="/masuk" class="text-dark">
                                            << Kembali ke Halaman Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <p class="text-white m-1 p-2 text-center">Copyright @ 2021 SMKN 1 PASURUAN All Rights Reserved</p>
        </div>
    </div>
    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
</body>

</html>