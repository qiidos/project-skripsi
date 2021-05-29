@extends('master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/daftar_siswa" style="color: #6da0d3; text-decoration: none;">Siswa</a></li>
            <li class="breadcrumb-item"><a href="/siswa/detail/{{ $siswa->id }}" style="color: #6da0d3; text-decoration: none;">Detail Siswa {{ $siswa->nama }}</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Tambah Poin {{ $siswa->nama }}</li>
        </div>
    </ol>
</nav>
<div class="container mt-sm-2 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>TAMBAH POIN</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>TAMBAH POIN PELANGGARAN</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/siswa/detail/proses_tambah/{{ $siswa->id }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="pelanggaran"><strong>Pelanggaran yang Dilakukan</strong></label>
                                <input type="text" class="form-control" placeholder="Masukkan pelanggaran yang dilakukan" name="pelanggaran" id="pelanggaran" value="{{ old('pelanggaran') }}">

                                @if($errors->has('pelanggaran'))
                                <div class=" text-danger">
                                    {{ $errors->first('pelanggaran')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="kategori"><strong>Kategori</strong></label>
                                <select id="kategori" name="kategori" class="form-control" required>
                                    <option disabled selected>Pilih Kategori</option>
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('kategori'))
                                <div class="text-danger">
                                    {{ $errors->first('kategori')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="jumlah_poin"><strong>Jumlah Poin</strong></label>
                                <input type="number" name="jumlah_poin" placeholder="Jumlah penambahan poin" class="form-control" id="jumlah_poin" value="{{ old('jumlah_poin') }}">

                                @if($errors->has('jumlah_poin'))
                                <div class="text-danger">
                                    {{ $errors->first('jumlah_poin')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggal"><strong>Tanggal</strong></label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar-alt" id="calendar"></i></span>
                                    </div>
                                    <input type="text" name="tanggal" placeholder="DD-MM-YYYY" class="form-control date" id="date" value="{{ old('tanggal') }}">
                                </div>

                                @if($errors->has('tanggal'))
                                <div class="text-danger">
                                    {{ $errors->first('tanggal')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="tindak_lanjut"><strong>Tindak Lanjut/Penyelesaian</strong></label>
                                <textarea class="form-control shadow" name="tindak_lanjut" id="tindak_lanjut" style="height:100px" placeholder="Masukkan tindak lanjut dari pelanggaran yang telah dilakukan oleh siswa"></textarea>

                                @if($errors->has('tindak_lanjut'))
                                <div class=" text-danger">
                                    {{ $errors->first('tindak_lanjut')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <div class="d-flexx d-flex justify-content-end pt-sm-2 pb-sm-1">
                                    <div>
                                        <a href="/siswa/detail/{{ $siswa->id }}" method="post" class="btn btn-custom btn-secondary text-light button-block" id="kembali" type="button">Kembali</a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-custom btn-primary text-light button-block" id="mit" data-toggle="modal" data-target="#myModal">Submit</button>
                                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content rounded-0">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>KONFIRMASI TAMBAH POIN!</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menambahkan poin untuk siswa bernama <strong>{{ $siswa->nama }}</strong>?
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