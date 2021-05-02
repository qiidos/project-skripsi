@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/daftar_siswa" style="color: #6da0d3; text-decoration: none;">Siswa</a></li>
            <li class="breadcrumb-item"><a href="/siswa/detail/{{ $poin->siswa->id }}" style="color: #6da0d3; text-decoration: none;">Detail Siswa {{ $poin->siswa->nama }}</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Edit Poin Pelanggaran {{ $poin->siswa->nama }}</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>EDIT POIN</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>EDIT POIN PELANGGARAN</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/siswa/detail/proses_edit/{{ $poin->id }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="pelanggaran_edit"><strong>Pelanggaran yang Dilakukan</strong></label>
                                <input type="text" class="form-control" placeholder="Masukkan pelanggaran yang dilakukan" name="pelanggaran_edit" id="pelanggaran_edit" value="{{ $poin->jenis_pelanggaran }}">

                                @if($errors->has('pelanggaran_edit'))
                                <div class=" text-danger">
                                    {{ $errors->first('pelanggaran_edit')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="kategori_edit"><strong>Kategori</strong></label>
                                <select id="kategori_edit" name="kategori_edit" class="form-control" required>
                                    @if($poin->kategori == 'Ringan')
                                    <option selected>Ringan</option>
                                    <option>Sedang</option>
                                    <option>Berat</option>
                                    @elseif($poin->kategori == 'Sedang')
                                    <option>Ringan</option>
                                    <option selected>Sedang</option>
                                    <option>Berat</option>
                                    @elseif($poin->kategori == 'Berat')
                                    <option>Ringan</option>
                                    <option>Sedang</option>
                                    <option selected>Berat</option>
                                    @endif
                                </select>
                                @if($errors->has('kategori_edit'))
                                <div class="text-danger">
                                    {{ $errors->first('kategori_edit')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="jumlah_poine_edit"><strong>Jumlah Poin</strong></label>
                                <input type="number" name="jumlah_poin_edit" placeholder="Jumlah penambahan poin" class="form-control" id="jumlah_poin_edit" value="{{ $poin->poin }}">

                                @if($errors->has('jumlah_poin_edit'))
                                <div class="text-danger">
                                    {{ $errors->first('jumlah_poin_edit')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggal_edit"><strong>Tanggal</strong></label>
                                <div class="input-group">
                                    <div class="input-group-append date_append">
                                        <span class="input-group-text"><i class="fa fa-calendar-alt" id="calendar"></i></span>
                                    </div>
                                    <input type="text" name="tanggal_edit" class="form-control date_edit" id="tanggal_edit" placeholder="DD-MM-YYYY" value="{{ $tanggal }}">
                                </div>

                                @if($errors->has('tanggal_edit'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal_edit')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <div class="d-flexx d-flex justify-content-end pt-sm-2 pb-sm-1">
                                    <div>
                                        <a href="/siswa/detail/{{ $poin->siswa->id }}" method="post" class="btn btn-custom btn-secondary text-light button-block" id="kembali" type="button">Kembali</a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-custom btn-primary text-light button-block" id="mit" data-toggle="modal" data-target="#myModal">Submit</button>
                                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content rounded-0">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>KONFIRMASI EDIT POIN!</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin mengedit pelanggaran pada siswa bernama <strong>{{ $poin->siswa->nama }}</strong> sesuai dengan hasil yang telah dimasukkan?
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