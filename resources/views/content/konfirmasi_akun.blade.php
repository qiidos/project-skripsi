@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/kelola_siswa" style="color: #6da0d3; text-decoration: none;">Kelola Siswa</a></li>
            <li class="breadcrumb-item"><a href="/tambah_akun_siswa" style="color: #6da0d3; text-decoration: none;">Tambah Akun Siswa</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Konfirmasi Tambah Akun</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>KONFIRMASI TAMBAH AKUN</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>KONFIRMASI TAMBAH AKUN</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/tambah_akun_siswa/proses_konfirmasi_akun" method="post">
                        <div class="form-row mt-md-2 justify-content-center" hidden>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="nis" id="nis" value="{{ $siswa->nis }}">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="email" class="form-control" id="email" value="{{ $mail }}">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="password" id="password" value="{{ $pw }}">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ $siswa->nama }}">
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <div class="table-responsive">
                                    <table class="table table-borderless border shadow rounded">
                                        <tr>
                                            <td class="px-3">
                                                <table class="table table-borderless">
                                                    <colgroup>
                                                        <col span=" 1" style="width: 45%;">
                                                        <col span="1" style="width: 5%;">
                                                        <col span="1" style="width: 50%;">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr>
                                                            <th colspan="3">
                                                                <div class="text-center top-margin-content">
                                                                    <hr class="hr-black-content">
                                                                    <h5><strong>PROFIL SISWA</strong></h5>
                                                                    <hr class="hr-black-content">
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>NIS (Nomor Induk Siswa)</strong></td>
                                                            <td><strong>:</strong></td>
                                                            <td>{{ $siswa->nis }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Nama</strong></td>
                                                            <td><strong>:</strong></td>
                                                            <td>{{ $siswa->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Kelas</strong></td>
                                                            <td><strong>:</strong></td>
                                                            <td>{{ getKelasNameByKelasId($siswa->kelas_id) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3">
                                                                <div class="text-center top-margin-content">
                                                                    <hr class="hr-black-content">
                                                                    <h5><strong>AKUN SISWA</strong></h5>
                                                                    <hr class="hr-black-content">
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Username</strong></td>
                                                            <td><strong>:</strong></td>
                                                            <td><strong>{{ $siswa->nis }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Email</strong></td>
                                                            <td><strong>:</strong></td>
                                                            <td><strong>{{ $mail }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Password</strong></td>
                                                            <td><strong>:</strong></td>
                                                            <td><strong>{{ $pw }}</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <div class="d-flexx d-flex justify-content-end pt-sm-2 pb-sm-1">
                                    <div>
                                        <a href="/tambah_akun_siswa" method="post" class="btn btn-custom btn-secondary text-light button-block" id="kembali" type="button">Kembali</a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn  btn-primary text-light button-block" id="mit" data-toggle="modal" data-target="#myModal">Konfirmasi</button>
                                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>KONFIRMASI BUAT AKUN SISWA!</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan membuat akun siswa dengan nama <strong>{{ $siswa->nama }}</strong> dengan data akun siswa seperti yang telah dibuat?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary text-light ml-3">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@endsection