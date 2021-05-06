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
                            <label for="kelas"><strong>Kelas</strong></label>
                            <select id="kelas" name="kelas" class="form-control filter-select">
                                <option value="0">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jurusan"><strong>Jurusan</strong></label>
                            <select id="jurusan" name="jurusan" class="form-control filter-select">
                                <option value="0">Pilih Jurusan</option>
                                @foreach($jurusan as $j)
                                <option value="{{ $j->id }}">{{ $j->jurusan }}</option>
                                @endforeach
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
                                <col span="1" style="width: 40%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 10%;">
                                <col span="1" style="width: 10%;">
                            </colgroup>
                            <thead class="text-center thead-bg">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
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