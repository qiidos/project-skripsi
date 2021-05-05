@extends('master')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-navbar rounded-0 breadcrumb-margin-top p-md-3">
        <div class="container item-bread">
            <li class="breadcrumb-item"><a href="/daftar_siswa" style="color: #6da0d3; text-decoration: none;">Siswa</a></li>
            <li class="breadcrumb-item active text-light" aria-current="page">Detail Siswa {{ $siswa->nama }}</li>
        </div>
    </ol>
</nav>
<div class="container-fluid mt-sm-2 card-margin">
    <div class="row">
        <div class="col-md-4 top-margin">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>DATA SISWA</strong></div>
                </div>
                <div class="card-body cardbody-bg">
                    <section name="biodata_siswa">
                        <!-- Biodata -->
                        <input type="text" name="id" class="form-control" id="id" value="{{ $siswa->id }}" hidden>
                        <div class="row p-sm-3 justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center top-margin-content pb-3">
                                    <h4><strong>PROFIL SISWA</strong></h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless border shadow rounded">
                                        <colgroup>
                                            <col span="1" style="width: 45%;">
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 50%;">
                                        </colgroup>
                                        <tbody>
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
                                                <td>{{ $siswa->kelas }} {{ $siswa->jurusan }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Predikat Tingkah Laku</strong></td>
                                                <td><strong>:</strong></td>
                                                <td><strong>{{ $siswa->nilai->nilai }} - {{ $siswa->nilai->predikat }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-black">
                    </section>
                    <section name="motivasi">
                        <div class="row px-sm-3 mt-4 justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center top-margin-content pb-3">
                                    <h4><strong>MOTIVASI DAN PENGUATAN</strong></h4>
                                </div>
                                <form action="/siswa/detail/motivasi/{{ $siswa->id }}">
                                    <div class="form-group">
                                        @if ($message = Session::get('motivasi_simpan'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if ($message = Session::get('motivasi_sama'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if($siswa->motivasi == null)
                                        <textarea class="form-control shadow" name="motivasi" id="textarea" style="height:200px" placeholder="Masukkan teks..." disabled></textarea>
                                        @else
                                        <textarea class="form-control shadow" name="motivasi" id="textarea" style="height:200px" placeholder="Masukkan teks..." disabled>{{ $siswa->motivasi->motivasi }}</textarea>
                                        @endif
                                        @if($errors->has('motivasi'))
                                        <div class="text-danger">
                                            {{ $errors->first('motivasi')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="d-flex style-me justify-content-end">
                                        <div>
                                            <button class="btn btn-warning" id="edit" type="button">Edit</button>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary ml-sm-3 style-btn" id="simpan" type="submit" disabled>Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><small id="note" class="form-text text-muted"><strong>CATATAN: </strong></small></td>
                                                <td><small id="note" class="form-text text-muted">Motivasi dan Penguatan harap diisi sebelum melakukan pencetakan poin pelanggaran siswa!</small></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <hr class="hr-black">
                    <section name="opsi">
                        <div class="row mt-2 justify-content-center">
                            <div class="col">
                                <div class="form-group text-center">
                                    <a href="/siswa/detail/tambah_poin/{{ $siswa->id }}" class="btn btn-block btn-warning" id="tambah">Tambah Poin Pelanggaran</a>
                                </div>
                                <div class="form-group text-center">
                                    <a href="/siswa/detail/cetak_poin/{{ $siswa->id }}" target="_blank" class="btn btn-block text-light btn-primary">Cetak Poin Pelanggaran</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-8 top-margin-2">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>DATA POIN</strong></div>
                </div>
                <div class="card-body cardbody-bg">
                    <div class="row mt-md-2 justify-content-start">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kategori"><strong>Kategori</strong></label>
                                <select id="kategori" name="kategori" class="form-control">
                                    <option value="0" selected>Pilih Kategori</option>
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9 mb-md-2">
                            <small class="form-text text-muted padcat pt-md-5 float-right"><strong>CATATAN: Poin pelanggaran diurutkan berdasarkan dari tanggal terbaru ketika poin ditambahkan.</strong></small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            @if ($message = Session::get('hapus_poin'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            @if ($message = Session::get('tambah_poin'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            @if ($message = Session::get('edit_poin'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            @if ($message = Session::get('edit_poin_tetap'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            @if ($message = Session::get('gagal_hapus'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover shadow thead-margin display nowrap" style="width: 100%;" id="tabeldetail">
                                    <colgroup>
                                        <col span="1" style="width: 5%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 50%;">
                                        <col span="1" style="width: 25%;">
                                        <col span="1" style="width: 5%;">
                                        <col span="1" style="width: 5%;">
                                    </colgroup>
                                    <thead class="text-center thead-bg">
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Pelanggaran</th>
                                            <th>Kategori</th>
                                            <th>Poin</th>
                                            <th>OPSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align:center">TOTAL POIN</th>
                                            <th style="text-align:center"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal fade" id="myModal_hapus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content rounded-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>KONFIRMASI HAPUS POIN!</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin akan menghapus poin pelanggaran tersebut?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="#" type="button" class="btn btn-primary text-light ml-3 submit_hapus" id="submit_hapus" value="">Submit</a>
                                    </div>
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