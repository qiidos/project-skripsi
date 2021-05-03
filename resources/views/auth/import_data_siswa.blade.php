@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/kelola_siswa" style="color: #6da0d3; text-decoration: none;">Kelola Siswa</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Import Data Siswa</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 top-margin">
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
                    <div class="form-row mt-md-2 justify-content-center">
                        <div class="form-group col-md-12">
                            @if ($message = Session::get('format_gagal'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <form action="/import_siswa/proses_import" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <div class="d-flexx d-flex justify-content-center pb-sm-1">
                                            <div>
                                                <a href="{{url('/csv/data_siswa.csv')}}" download="template.csv" class="btn btn-success text-light button-block" type="button">Download Format CSV.</a>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-custom btn-primary text-light button-block" id="mit" data-toggle="modal" data-target="#myModal">Import</button>
                                                <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"><strong>IMPORT DATA SISWA</strong></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="file" name="data_siswa"></input>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary text-light ml-3">Import</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="/kelola_siswa" method="post" class="btn btn-custom btn-secondary text-light button-block" id="mit" type="button">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hr-black">
                                @if ($message = Session::get('siswa_dup'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="pb-2 text-center ">
                                        <h5><strong>DATA SISWA YANG SAMA</strong></h5>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center mx-1">
                                    <div class="table-responsive">
                                        <table class="table border shadow rounded">
                                            <colgroup>
                                                <col span="1" style="width: 20%;">
                                                <col span="1" style="width: 50%;">
                                                <col span="1" style="width: 30%;">
                                            </colgroup>
                                            <thead>
                                                <tr class="text-center">
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($siswa as $s)
                                                <tr class="text-center">
                                                    <td>{{ $s->nis }}</td>
                                                    <td>{{ $s->nama }}</td>
                                                    <td>{{ $s->kelas }} {{ $s->jurusan }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </td>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                @if ($message = Session::get('tipe_salah'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <div class="form-row justify-content-center mx-1">
                                    <p>Terdapat kesalahan pada {{ $error }}</p>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection