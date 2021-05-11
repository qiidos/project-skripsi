@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item active text-light" aria-current="page">Siswa</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row">
        <div class="col-md-12 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>DAFTAR SISWA</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row justify-content-center mt-md-3">
                        <div class="form-group col-md-4">
                            <label for="tingkat"><strong>Tingkat</strong></label>
                            <select id="tingkat" name="tingkat" class="form-control">
                                <option value="0">Pilih Tingkat</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kelas"><strong>Kelas</strong></label>
                            <select id="kelas" name="kelas" class="form-control filter-select" disabled>
                                <option value="0">Pilih tingkat terlebih dahulu</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('data_siswa_sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mt-md-2 thead-margin shadow" style="width:100%" id="datatabel">
                            <colgroup>
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 50%;">
                                <col span="1" style="width: 25%;">
                                <col span="1" style="width: 10%;">
                                <col span="1" style="width: 10%;">
                            </colgroup>
                            <thead class="text-center thead-bg">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Poin</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection