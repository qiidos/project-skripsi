@extends('master_siswa')

@section('content')
<div class="container mt-sm-5 card-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 top-margin-2">
            <div class="card">
                <div class="card-header bg-navbar align-middle rounded-0">
                    <div class="text-light"><strong>UBAH PASSWORD</strong></div>
                </div>
                <div class="card-header">
                    <div class="form-row mt-md-3 justify-content-center">
                        <div class="pb-2 top-margin-content text-center ">
                            <h4><strong>UBAH PASSWORD</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/ubah_password/proses_ubah_password/{{ $pengguna->id }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="password_baru"><strong>Password Baru</strong></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan password baru" value="{{ old('password_baru') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-btn"><button class="btn pw-baru border" type="button"><i class="fa fa-eye" id="mata-baru"></i></button></span>
                                    </div>
                                </div>
                                <small><strong>Catatan!</strong> Password baru harus terdiri dari huruf dan diakhiri dengan angka dengan minimal 6 karakter serta tidak boleh menggunakan spesial karakter (spasi,titik,dsb). (contoh: xxxxx123)</small>

                                @if($errors->has('password_baru'))
                                <div class=" text-danger">
                                    {{ $errors->first('password_baru')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <label for="konfirmasi_password"><strong>Konfirmasi Password</strong></label>
                                <div class="input-group">
                                    <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi password baru" value="{{ old('konfirmasi_password') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-btn"><button class="btn pw-konfir border" type="button"><i class="fa fa-eye" id="mata-konfir"></i></button></span>
                                    </div>
                                </div>

                                @if($errors->has('konfirmasi_password'))
                                <div class="text-danger">
                                    {{ $errors->first('konfirmasi_password')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-md-2 justify-content-center">
                            <div class="form-group col-md-7">
                                <div class="d-flexx d-flex justify-content-end pt-sm-2 pb-sm-1">
                                    <div>
                                        <a href="/info_poin/{{ $siswa->id }}" method="post" class="btn btn-custom btn-secondary text-light button-block" id="kembali" type="button">Kembali</a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-custom btn-primary text-light button-block" id="mit" data-toggle="modal" data-target="#myModal">Submit</button>
                                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>KONFIRMASI UBAH PASSWORD!</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan mengubah password <strong>{{ $pengguna->nama }}</strong>?
                                                        <small class="form-text text-muted"><strong>CATATAN: </strong>Jika perubahan password berhasil, anda akan langsung diarahkan ke halaman masuk!</small>
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