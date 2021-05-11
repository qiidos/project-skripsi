<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function tambah_akun(Request $request)
    {
        if ($request->session()->has('session')) {
            return view('/content/tambah_akun_siswa');
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesTambahAkun(Request $request)
    {
        if ($request->session()->has('session')) {
            $messages = [
                'required' => 'Silahkan :attribute diisi terlebih dahulu!',
                'min' => ':attribute minimal harus mempunyai :min karakter!',
                'regex' => ':attribute harus terdiri dari huruf dan diakhiri dengan angka serta tanpa spasi',
                'same' => 'Konfirmasi password harus sesuai dengan password baru!',
                'alpha_num' => ':attribute tidak boleh menggunakan spesial karakter (titik, @, #, dsb)',
                'email' => 'Format pengisian :attribute harus sesuai dengan format email (@ dan .)'
            ];

            $this->validate($request, [
                'nis' => 'required',
                'email' => 'required|email',
                'password_baru' => 'required|required_with:konfirmasi_password|min:6|regex:/^[A-Za-z\.]+[0-9\d\.]+$/|alpha_num',
                'konfirmasi_password' => 'required|same:password_baru'
            ], $messages);

            $mail = $request->email;
            $pw = $request->password_baru;
            $siswa = getSiswaByNis($request->nis);
            $username = Pengguna::where('username', $request->nis)->first();
            $email = Pengguna::select('email')->where('email', $mail)->first();

            if ($siswa != null && $username == null) {
                if ($email == null) {
                    return view('/content/konfirmasi_akun', compact('siswa', 'mail', 'pw'));
                } else {
                    $request->session()->flash('email_ada', 'Email telah terdaftar, silahkan hubungi pihak guru!');
                    return redirect('/tambah_akun_siswa');
                }
            } else {
                $request->session()->flash('nis_salah', 'NIS salah atau sudah terdaftar!');
                return redirect('/tambah_akun_siswa');
            }
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesKonfirmasiAkun(Request $request)
    {
        $pengguna = Pengguna::where('username', $request->nis)->first();

        if (empty($pengguna)) {
            Pengguna::create([
                'username' => $request->nis,
                'status_id' => 2,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'email' => $request->email
            ]);
            $request->session()->flash('tambah_akun_berhasil', 'Berhasil menambahkan akun siswa.');
            return redirect('/tambah_akun_siswa');
        } else {
            $request->session()->flash('akun_ada', 'Tambah akun gagal. Akun kemungkinan sudah terdaftar, silahkan hubungi guru!');
            return redirect('/tambah_akun_siswa');
        }
    }
}
