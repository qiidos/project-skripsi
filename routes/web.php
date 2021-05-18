<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'AuthController@index');

//Auth
Route::get('/masuk', 'AuthController@masuk');
Route::post('/proses_masuk', 'AuthController@prosesMasuk');
Route::get('/verifikasi_email', 'AuthController@verifikasi_email');
Route::post('/verifikasi_email/proses_verifikasi_email', 'AuthController@prosesVerifikasiEmail');
Route::get('/verifikasi_email/verifikasi_kode', 'AuthController@verifikasi_kode');
Route::post('/verifikasi_email/verifikasi_kode/proses_verifikasi_kode', 'AuthController@prosesVerifikasiKode');
Route::get('/reset_password', 'AuthController@reset_password');
Route::post('/reset_password/proses_reset_password', 'AuthController@prosesResetPassword');
Route::get('/ubah_password', 'AuthController@ubah_password');
Route::get('/ubah_password_siswa', 'AuthController@ubah_password_siswa');
Route::post('/ubah_password/proses_ubah_password/{id}', 'AuthController@prosesUbahPassword');
Route::get('/keluar', 'AuthController@prosesKeluar');

//Core
Route::get('/data_kelas/{tingkat}', 'SiswaController@getKelasByTingkat');
Route::get('/daftar_siswa', 'SiswaController@prosesLihatDaftarSiswa')->name('siswa.home');
Route::get('/siswa/detail/{id}', 'SiswaController@prosesDetailSiswa');
Route::get('/info_poin/{id}', 'SiswaController@ProsesInfoPoin');
Route::get('/siswa/detail_poin', 'SiswaController@prosesDetailPoin')->name('poin.siswa');
Route::get('/siswa/detail/motivasi/{id}', 'SiswaController@prosesTambahMotivasi');
Route::get('/siswa/detail/tambah_poin/{id}', 'PoinController@tambah_poin');
Route::post('/siswa/detail/proses_tambah/{id}', 'PoinController@prosesTambahPoin');
Route::get('/siswa/detail/edit_poin/{id}', 'PoinController@edit_poin');
Route::post('/siswa/detail/proses_edit/{id}', 'PoinController@prosesEditPoin');
Route::get('/siswa/detail/hapus_poin/{id}', 'PoinController@prosesHapusPoin');
Route::get('/kelola_siswa', 'SiswaController@kelola_siswa');
Route::get('/import_siswa', 'SiswaController@import_siswa');
Route::post('/import_siswa/proses_import', 'SiswaController@prosesImportSiswa');
Route::get('/update_kelas', 'SiswaController@update_kelas')->name('kelasgrup.kelas');
Route::get('/update_kelas/proses_update/{id}', 'SiswaController@prosesUpdateKelas');

// TambahAkun
Route::get('/tambah_akun_siswa', 'AuthController@tambah_akun');
Route::post('/tambah_akun_siswa/proses_tambah_akun', 'AuthController@prosesTambahAkun');
Route::post('/tambah_akun_siswa/proses_konfirmasi_akun', 'AuthController@prosesKonfirmasiAkun');

// CetakPoin
Route::get('/siswa/detail/cetak_poin/{id}', 'PoinController@prosesCetakPoin');

//File TXT
Route::get('/siswa/keterangan', 'SiswaController@put');
