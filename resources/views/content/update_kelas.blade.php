@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/kelola_siswa" style="color: #6da0d3; text-decoration: none;">Kelola Siswa</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Update Kelas</li>
        </div>
    </ol>
</nav>

<div class="container mt-sm-2 card-margin">
    <div class="row">
        <div class="col-md-12 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>DAFTAR KELAS</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>DAFTAR KELAS</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mt-md-2 thead-margin shadow" style="width:100%" id="tabelkelas">
                            <colgroup>
                                <col span="1" style="width: 10%;">
                                <col span="1" style="width: 45%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 10%;">
                                <col span="1" style="width: 20%;">
                            </colgroup>
                            <thead class="text-center thead-bg">
                                <tr>
                                    <th>No.</th>
                                    <th class="text-center">Kelas</th>
                                    <th>Angkatan</th>
                                    <th>Status</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="myModal_updatekelas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><strong>KONFIRMASI UPDATE KELAS!</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin akan menaikkan kelas tersebut?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="#" type="button" class="btn btn-primary text-light ml-3 submit_updatekelas" id="submit_updatekelas" value="">Submit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection