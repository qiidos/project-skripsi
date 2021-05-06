@extends('master_siswa')

@section('content')
<div class="container-fluid mt-sm-5 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-8 top-margin-2">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>DATA POIN SISWA</strong></div>
                </div>
                <div class="card-body cardbody-bg">
                    <section name="biodata_siswa">
                        <input type="text" name="id" class="form-control" id="id" value="{{ $siswa->id }}" hidden>
                        <div class="row p-sm-3 justify-content-center">
                            <div class="col-md-8">
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
                                                <td>{{ $siswa->kelas->kelas }} {{ $siswa->jurusan->jurusan }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Predikat Tingkah Laku</strong></td>
                                                <td><strong>:</strong></td>
                                                <td><strong>{{ $siswa->nilai->nilai }} - {{ $siswa->nilai->predikat }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Motivasi dari Guru</strong></td>
                                                <td><strong>:</strong></td>
                                                @if(empty($siswa->motivasi))
                                                <td>Belum terdapat pesan atau motivasi dari Guru.</td>
                                                @else
                                                <td>{{ $siswa->motivasi->motivasi }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-black">
                    </section>
                    <div class="text-center top-margin-content pb-3">
                        <h4><strong>POIN PELANGGARAN SISWA</strong></h4>
                    </div>
                    <div class="row mt-sm-1 justify-content-start">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kategori"><strong>Kategori</strong></label>
                                <select id="kategori" name="kategori" class="form-control">
                                    <option value="0" selected>Pilih Kategori</option>
                                    <option value="Ringan">Ringan</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Berat">Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9 mb-md-2">
                            <small class="form-text text-muted padcat pt-md-5 float-right"><strong>CATATAN: Poin pelanggaran diurutkan berdasarkan dari tanggal terbaru ketika poin ditambahkan.</strong></small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover shadow thead-margin display nowrap" style="width: 100%;" id="infopoin">
                                    <colgroup>
                                        <col span="1" style="width: 5%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 55%;">
                                        <col span="1" style="width: 25%;">
                                        <col span="1" style="width: 5%;">
                                    </colgroup>
                                    <thead class="text-center thead-bg">
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Pelanggaran</th>
                                            <th>Kategori</th>
                                            <th>Poin</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align:center">TOTAL POIN</th>
                                            <th style="text-align:center"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection