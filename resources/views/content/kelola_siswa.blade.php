@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item active text-light" aria-current="page">Kelola Siswa</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-4 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>TAMBAH AKUN SISWA</strong></div>
                </div>
                <div class="card-header">
                    <div class="row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>TAMBAH AKUN SISWA</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless border rounded">
                            <tbody>
                                <td>
                                    Menu ini berfungsi untuk menambahkan akun siswa agar siswa dapat melihat poin pelanggaran yang telah didapatkan.
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-center">
                        <form action="/import_siswa/proses_import" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-md-12 justify-content-center">
                                <a class="btn btn-primary text-light" href="/tambah_akun_siswa"><i class="fas fa-user-plus" style="margin-right: 10px;"></i>Tambah Akun Siswa</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 top-margin-2">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>IMPORT DATA SISWA</strong></div>
                </div>
                <div class="card-header">
                    <div class="row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>IMPORT DATA SISWA</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless border rounded">
                            <tbody>
                                <td>
                                    Menu ini berfungsi untuk menambahkan data siswa pada database melalui file berformat csv.
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-center">
                        <form action="/import_siswa/proses_import" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-md-12 justify-content-center">
                                <a class="btn btn-primary text-light" href="/import_siswa"><i class="fas fa-file-import" style="margin-right: 10px;"></i>Import Data Siswa</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4 top-margin-2">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>UPDATE KELAS SISWA</strong></div>
                </div>
                <div class="card-header">
                    <div class="row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>UPDATE KELAS SISWA</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless border rounded">
                            <tbody>
                                <td>
                                    Menu ini berfungsi untuk mengatur ulang kelas yang terdapat pada data siswa ketika naik kelas.
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-center">
                        <form action="/import_siswa/proses_import" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-md-12 justify-content-center">
                                <a class="btn btn-primary text-light" href="/update_kelas"><i class="fas fa-lock" style="margin-right: 10px;"></i>Update Kelas Siswa</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection