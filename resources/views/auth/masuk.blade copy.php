<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-auth.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <title>Masuk - SiTalang</title>
</head>

<body>
    <div class="container margin-card-login">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-group shadow">
                    <div class="card border-0 mb-0 rounded-0 bg_card_login">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group text-center">
                                    <img src="/asset/logo-smk.png" width="50%">
                                </div>
                                <hr class="hr-white">
                                <div class="form-group text-center text-light">
                                    <h4 class="font-weight-bold">SITALANG</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 rounded-0">
                        <div class="card-body card-body-login">

                            <br>

                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a href="#guru" class="nav-link active" role="tab" data-toggle="tab">Guru</a>
                                </li>

                                <li class="nav-item">
                                    <a href="#siswa" class="nav-link" role="tab" data-toggle="tab">Siswa</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="guru">
                                    @if ($message = Session::get('username_salah'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif

                                    @if ($message = Session::get('password_salah'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif

                                    @if ($message = Session::get('reset_password_berhasil'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif

                                    @if ($message = Session::get('ubah_password_berhasil'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    <form action="/proses_masuk" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-group text-center">
                                            <h5 class="font-weight-bold">Masuk ke Akun Guru</h5>
                                        </div>
                                        <div class="form-group">
                                            <label for="username"><i class="fas fa-user" style="margin-right: 10px;"></i>Username</label>
                                            <input class="form-control" type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}">

                                            @if($errors->has('username'))
                                            <div class="text-danger">
                                                {{ $errors->first('username')}}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="password"><i class="fas fa-lock" style="margin-right: 10px;"></i>Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="password-field" name="password" placeholder="Masukkan password">
                                                <div class="input-group-append">
                                                    <span class="input-group-btn"><button class="btn reveal border" type="button"><i class="fa fa-eye" id="mata"></i></button></span>
                                                </div>
                                            </div>
                                            @if($errors->has('password'))
                                            <div class="text-danger">
                                                {{ $errors->first('password')}}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="form-group text-center pt-2">
                                            <input class="btn button-main btn-block text-light" id="login" type="submit" value="Masuk">
                                        </div>
                                        <div class="form-group text-center">
                                            Lupa Password? <a href="/verifikasi_email" class="text-primary">Reset Password!</a>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="siswa">
                                    <div role="tabpanel" class="tab-pane active" id="guru">
                                        @if ($message = Session::get('username_salah'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif

                                        @if ($message = Session::get('password_salah'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif

                                        @if ($message = Session::get('reset_password_berhasil'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif

                                        @if ($message = Session::get('ubah_password_berhasil'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        <form action="/proses_masuk" method="post">
                                            {{ csrf_field() }}

                                            <div class="form-group text-center">
                                                <h5 class="font-weight-bold">Masuk ke Akun Siswa</h5>
                                            </div>
                                            <div class="form-group">
                                                <label for="username"><i class="fas fa-user" style="margin-right: 10px;"></i>Username</label>
                                                <input class="form-control" type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}">

                                                @if($errors->has('username'))
                                                <div class="text-danger">
                                                    {{ $errors->first('username')}}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="password"><i class="fas fa-lock" style="margin-right: 10px;"></i>Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="password" id="password-field" name="password" placeholder="Masukkan password">
                                                    <div class="input-group-append">
                                                        <span class="input-group-btn"><button class="btn reveal border" type="button"><i class="fa fa-eye" id="mata"></i></button></span>
                                                    </div>
                                                </div>
                                                @if($errors->has('password'))
                                                <div class="text-danger">
                                                    {{ $errors->first('password')}}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="form-group text-center pt-2">
                                                <input class="btn button-main btn-block text-light" id="login" type="submit" value="Masuk">
                                            </div>
                                            <div class="form-group text-center">
                                                Lupa Password? <a href="/verifikasi_email" class="text-primary">Reset Password!</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- <form action="/proses_masuk" method="post">
                                {{ csrf_field() }}

                                <div class="form-group text-center">
                                    <h5 class="font-weight-bold">Masuk ke Akun Admin</h5>
                                </div>
                                <div class="form-group">
                                    <label for="username"><i class="fas fa-user" style="margin-right: 10px;"></i>Username</label>
                                    <input class="form-control" type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}">

                                    @if($errors->has('username'))
                                    <div class="text-danger">
                                        {{ $errors->first('username')}}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password"><i class="fas fa-lock" style="margin-right: 10px;"></i>Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password-field" name="password" placeholder="Masukkan password">
                                        <div class="input-group-append">
                                            <span class="input-group-btn"><button class="btn reveal border" type="button"><i class="fa fa-eye" id="mata"></i></button></span>
                                        </div>
                                    </div>
                                    @if($errors->has('password'))
                                    <div class="text-danger">
                                        {{ $errors->first('password')}}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group text-center pt-3">
                                    <input class="btn button-main btn-block text-light" id="login" type="submit" value="Masuk">
                                </div>
                                <div class="form-group text-center">
                                    Lupa Password? <a href="/verifikasi_email" class="text-primary">Reset Password!</a>
                                </div>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-1">
            <p class="text-white m-1 text-center">Copyright @ 2021 SMKN 1 PASURUAN All Rights Reserved</p>
        </div>
    </div>
    <script type="text/javascript" src="/js/font-awesome.min.js"></script>
    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/auth.js"></script>
</body>

</html>