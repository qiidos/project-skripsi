@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/kelola_siswa" style="color: #6da0d3; text-decoration: none;">Kelola Siswa</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Tambah Akun Siswa</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>TAMBAH AKUN SISWA</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>TAMBAH AKUN SISWA</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row mt-md-2 justify-content-center">
                        <div class="form-group col-md-12">
                            <form action="/tambah_akun_siswa/proses_tambah_akun" method="post">
                                {{ csrf_field() }}
                                @if ($message = Session::get('nis_salah'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @if ($message = Session::get('email_ada'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @if ($message = Session::get('akun_ada'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @if ($message = Session::get('user_terdaftar'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-3">
                                        <label for="username"><strong>Username (NIS)</strong></label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username siswa" value="{{ old('username') }}">
                                        <small><strong>Catatan!</strong> Username merupakan NIS siswa yang telah terdaftar di daftar siswa.</small>

                                        @if($errors->has('nis'))
                                        <div class=" text-danger">
                                            {{ $errors->first('nis')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email"><strong>Email Siswa</strong></label>
                                        <input type="text" name="email" placeholder="Masukkan email siswa" class="form-control" id="email" value="{{ old('email') }}">

                                        @if($errors->has('email'))
                                        <div class="text-danger">
                                            {{ $errors->first('email')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row mt-md-2 justify-content-center">
                                    <div class="form-group col-md-7">
                                        <label for="password_baru"><strong>Set Password</strong></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Atur password akun" value="{{ old('password_baru') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-btn"><button class="btn pw-baru border" type="button"><i class="fa fa-eye" id="mata-baru"></i></button></span>
                                            </div>
                                        </div>
                                        <small><strong>Catatan!</strong> Password baru harus terdiri dari huruf dan diakhiri dengan angka dengan minimal 6 karakter serta tidak boleh menggunakan spesial karakter (spasi,titik,dsb). (contoh: xxxxx123)</small>

                                        @if($errors->has('password_baru'))
                                        <div class=" text-danger">
                                            {{ $errors->first('password_baru')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row mt-md-2 justify-content-center">
                                    <div class="form-group col-md-7">
                                        <label for="konfirmasi_password"><strong>Konfirmasi Password</strong></label>
                                        <div class="input-group">
                                            <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi password akun" value="{{ old('konfirmasi_password') }}">
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
                                </div>
                                <div class="form-row mt-md-2 justify-content-center">
                                    <div class="form-group col-md-7">
                                        <div class="d-flexx d-flex justify-content-end pt-sm-2 pb-sm-1">
                                            <div>
                                                <a href="/kelola_siswa" method="post" class="btn btn-custom btn-secondary text-light button-block" id="kembali" type="button">Kembali</a>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-custom btn-primary text-light button-block" id="mit">Cek Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection