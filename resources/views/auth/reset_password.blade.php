<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-auth.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>SiTalang - Ubah Password</title>
</head>

<body>
    <div class="container margin-card-reset_password">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 rounded-0 shadow-lg">
                    <div class="card-header bg-card-header text-light rounded-0">
                        <strong>SITALANG</strong>
                    </div>
                    <div class="card-body">

                        <br />
                        <form action="/reset_password/proses_reset_password" method="post">
                            {{ csrf_field() }}

                            <div class="form-group text-center">
                                <h4 class="font-weight-bold">RESET PASSWORD</h4>
                            </div>
                            <hr class="hr-black">
                            <div class="form-row justify-content-center">
                                <div class="col-sm-7 my-1">
                                    @if ($message = Session::get('kode_sesuai'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="password_baru">Password Baru</label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" id="password-field-pwbaru" name="password_baru" placeholder="Masukkan password baru" value="{{ old('password_baru') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-btn"><button class="btn pw-baru border" type="button"><i class="fa fa-eye" id="mata-baru"></i></button></span>
                                            </div>
                                        </div>
                                        <small><strong>Catatan!</strong> Password baru harus terdiri dari huruf dan diakhiri dengan angka dengan minimal 6 karakter serta tidak boleh menggunakan spesial karakter (spasi,titik,dsb). (contoh: xxxxx123)</small>

                                        @if($errors->has('password_baru'))
                                        <div class="text-danger">
                                            {{ $errors->first('password_baru')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" id="password-field-pwkonfir" name="konfirmasi_password" placeholder="Konfirmasi password baru" value="{{ old('konfirmasi_password') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-btn"><button class="btn pw-konfir border" type="button"><i class="fa fa-eye" id="mata-konfir"></i></button></span>
                                            </div>
                                        </div>
                                        @if($errors->has('konfirmasi_password'))
                                        <div class="text-danger">
                                            {{ $errors->first('konfirmasi_password')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group text-center pt-3">
                                        <input class="btn button-main btn-block text-light" id="ubah_password" type="submit" value="Submit">
                                    </div>
                                    <div class="form-group text-center">
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
    <script type="text/javascript" src="/js/font-awesome.min.js"></script>
    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/auth.js"></script>
</body>

</html>