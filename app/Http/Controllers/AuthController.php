<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessage;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('session')) {
            $username = $request->session()->get('session');
            $pengguna = Pengguna::where('username', $username)->first();
            if ($pengguna != null && $pengguna->status->status == "Guru") {
                return redirect('/daftar_siswa');
            } else if ($pengguna != null && $pengguna->status->status == "Siswa") {
                $siswa = $pengguna->siswa()->first();
                return redirect('/info_poin/' . $siswa->id);
            }
        } else {
            $request->session()->forget('nama');
            $request->session()->forget('log_email');
            $request->session()->forget('log_kode');
            $request->session()->forget('log_reset_password');
            return redirect('/masuk');
        }
    }

    public function masuk(Request $request)
    {
        if ($request->session()->has('session')) {
            $username = $request->session()->get('session');
            $pengguna = Pengguna::where('username', $username)->first();
            if ($pengguna != null && $pengguna->status->status == "Guru") {
                return redirect('/daftar_siswa');
            } else if ($pengguna != null && $pengguna->status->status == "Siswa") {
                $siswa = $pengguna->siswa()->first();
                return redirect('/info_poin/' . $siswa->id);
            }
        } else {
            $request->session()->forget('nama');
            $request->session()->forget('log_email');
            $request->session()->forget('log_kode');
            $request->session()->forget('log_reset_password');
            return view('/auth/masuk');
        }
    }

    public function prosesMasuk(Request $request)
    {
        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!'
        ];

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ], $messages);

        $username = $request->input('username');
        $password = $request->input('password');

        $pengguna = Pengguna::where('username', $username)->first();

        if ($pengguna != null && $pengguna->status->status == "Guru") {
            if (Hash::check($password, $pengguna->password) || $pengguna->password == $password) {
                $request->session()->put('session', $pengguna->username);
                $request->session()->put('nama', $pengguna->nama);
                return redirect('/daftar_siswa');
            } else {
                $request->session()->flash('password_salah', 'Password yang dimasukkan salah!');
                return redirect('/masuk');
            }
        } else if ($pengguna != null && $pengguna->status->status == "Siswa") {
            if (Hash::check($password, $pengguna->password) || $pengguna->password == $password) {
                // $siswa = $pengguna->siswa()->first();
                $siswa = getSiswaByNis($username);
                $request->session()->put('session', $pengguna->username);
                $request->session()->put('nama', $pengguna->nama);
                return redirect('/info_poin/' . $siswa->id);
            } else {
                $request->session()->flash('password_salah', 'Password yang dimasukkan salah!');
                return redirect('/masuk');
            }
        } else {
            $request->session()->flash('username_salah', 'Username tidak terdaftar!');
            return redirect('/masuk');
        }
    }

    public function verifikasi_email(Request $request)
    {
        $request->session()->put('log_email', 'log_verifikasi_email');
        if ($request->session()->has('session')) {
            $username = $request->session()->get('session');
            $pengguna = Pengguna::where('username', $username)->first();
            if ($pengguna != null && $pengguna->status->status == "Guru") {
                return redirect('/daftar_siswa');
            } else if ($pengguna != null && $pengguna->status->status == "Siswa") {
                $siswa = $pengguna->siswa()->first();
                return redirect('/info_poin/' . $siswa->id);
            }
        } else if ($request->session()->has('log_email')) {
            return view('/auth/verifikasi_email');
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesVerifikasiEmail(Request $request)
    {
        $faker = Faker::create('id_ID');

        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!',
            'email' => 'Format pengisian :attribute harus sesuai dengan format email (@ dan .)'
        ];

        $this->validate($request, [
            'email' => 'required|email'
        ], $messages);

        $email = $request->input('email');
        $pengguna = Pengguna::where('email', $email)->first();

        if ($pengguna != null) {
            $nama = $pengguna->nama;
            $kode = Crypt::encryptString($faker->numerify('######'));
            $pengguna->update([
                'token' => $kode
            ]);
            Notification::route('mail', $pengguna->email)->notify(new newMessage($nama));
            $request->session()->put('log_kode', $email);
            $request->session()->flash('email_terkirim', 'Kode telah terkirim, silahkan periksa alamat email untuk melihat kode konfirmasi!');
            return redirect('/verifikasi_email/verifikasi_kode');
        } else {
            $request->session()->flash('email_salah', 'Email tidak terdaftar atau salah');
            return redirect('/verifikasi_email');
        }
    }

    public function verifikasi_kode(Request $request)
    {
        if ($request->session()->has('session')) {
            $username = $request->session()->get('session');
            $pengguna = Pengguna::where('username', $username)->first();
            if ($pengguna != null && $pengguna->status->status == "Guru") {
                return redirect('/daftar_siswa');
            } else if ($pengguna != null && $pengguna->status->status == "Siswa") {
                $siswa = $pengguna->siswa()->first();
                return redirect('/info_poin/' . $siswa->id);
            }
        } else if ($request->session()->has('log_kode')) {
            return view('/auth/verifikasi_kode');
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesVerifikasiKode(Request $request)
    {
        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!',
            'numeric' => ':attribute harus berupa angka!'
        ];

        $this->validate($request, [
            'kode' => 'required|numeric'
        ], $messages);

        $kode = $request->input('kode');

        $email = $request->session()->get('log_kode');

        $pengguna = Pengguna::where('email', $email)->first();
        $token = $pengguna->token;
        $dekrip_token = Crypt::decryptString($token);
        $pengguna->token = $dekrip_token;
        $pengguna->save();

        if ($pengguna != null && $pengguna->token == $kode) {
            $enkrip_token = Crypt::encryptString($pengguna->token);
            $pengguna->token = $enkrip_token;
            $pengguna->save();

            $request->session()->flash('kode_sesuai', 'Kode sesuai, silahkan masukkan password yang baru!');
            $request->session()->put('log_reset_password', 'log_reset_password');
            return redirect('/reset_password');
        } else {
            $enkrip_token = Crypt::encryptString($pengguna->token);
            $pengguna->token = $enkrip_token;
            $pengguna->save();

            $request->session()->flash('kode_salah', 'Kode tidak sesuai!');
            return redirect('/verifikasi_email/verifikasi_kode');
        }
    }

    public function reset_password(Request $request)
    {
        if ($request->session()->has('session')) {
            $username = $request->session()->get('session');
            $pengguna = Pengguna::where('username', $username)->first();
            if ($pengguna != null && $pengguna->status->status == "Guru") {
                return redirect('/daftar_siswa');
            } else if ($pengguna != null && $pengguna->status->status == "Siswa") {
                $siswa = $pengguna->siswa()->first();
                return redirect('/info_poin/' . $siswa->id);
            }
        } else if ($request->session()->has('log_reset_password')) {
            return view('/auth/reset_password');
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesResetPassword(Request $request)
    {
        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!',
            'min' => ':attribute minimal harus mempunyai :min karakter!',
            'regex' => ':attribute harus terdiri dari huruf dan diakhiri dengan angka serta tanpa spasi',
            'same' => 'Konfirmasi password harus sesuai dengan password baru!',
            'alpha_num' => ':attribute tidak boleh menggunakan spesial karakter (titik, @, #, dsb)'
        ];

        $this->validate($request, [
            'password_baru' => 'required|required_with:konfirmasi_password|min:6|regex:/^[A-Za-z\.]+[0-9\d\.]+$/|alpha_num',
            'konfirmasi_password' => 'required|same:password_baru'
        ], $messages);

        $email = $request->session()->get('log_kode');
        $password_baru = $request->input('password_baru');

        Pengguna::where('email', $email)->update([
            'password' => Hash::make($password_baru)
        ]);
        $request->session()->flash('reset_password_berhasil', 'Reset Password berhasil, silahkan masuk dengan menggunakan password baru!');
        return redirect('/masuk');
    }

    public function ubah_password(Request $request)
    {
        if ($request->session()->has('session')) {
            $username = $request->session()->get('session');

            $pengguna = Pengguna::where('username', $username)->first();

            if ($pengguna != null && $pengguna->status->status == "Guru") {
                return view('/content/ubah_password', ['pengguna' => $pengguna]);
            } else if ($pengguna != null &&  $pengguna->status->status == "Siswa") {
                $siswa = getSiswaByNis($username);
                return view('/content/ubah_password_siswa', compact('pengguna', 'siswa'));
            }
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesUbahPassword(Request $request, $id)
    {
        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!',
            'min' => ':attribute minimal harus mempunyai :min karakter!',
            'regex' => ':attribute harus terdiri dari huruf dan diakhiri dengan angka serta tanpa spasi',
            'same' => 'Konfirmasi password harus sesuai dengan password baru!',
            'alpha_num' => ':attribute tidak boleh menggunakan spesial karakter (titik, @, #, dsb)'
        ];

        $this->validate($request, [
            'password_baru' => 'required|required_with:konfirmasi_password|min:6|regex:/^[A-Za-z\.]+[0-9\d\.]+$/|alpha_num',
            'konfirmasi_password' => 'required|same:password_baru'
        ], $messages);

        $konfirmasi_password = $request->input('konfirmasi_password');

        $pengguna = Pengguna::where('id', $id)->first();

        if ($pengguna != null) {
            $pengguna->password = Hash::make($konfirmasi_password);
            $pengguna->save();
            $request->session()->flash('ubah_password_berhasil', 'Perubahan password berhasil, anda dapat masuk menggunakan password yang baru!');
            $request->session()->forget('session');
            return redirect('/masuk');
        }
    }

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
                    $request->session()->flash('email_ada', 'Email telah terdaftar.');
                    return redirect('/tambah_akun_siswa');
                }
            } else {
                $request->session()->flash('nis_salah', 'NIS salah atau sudah terdaftar.');
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
            return redirect('/kelola_siswa');
        } else {
            $request->session()->flash('akun_ada', 'Tambah akun gagal. Akun kemungkinan sudah terdaftar, silahkan hubungi guru!');
            return redirect('/tambah_akun_siswa');
        }
    }

    public function prosesKeluar(Request $request)
    {
        $request->session()->forget('session');
        $request->session()->forget('nama');
        return redirect('/masuk');
    }
}
