<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Siswa;
use App\Pengguna;
use App\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    public function prosesLihatDaftarSiswa(Request $request)
    {
        if ($request->session()->has('session')) {
            if ($request->ajax()) {
                if (!empty($request->jurusan) && !empty($request->kelas)) {
                    $data = Siswa::select('id', 'nama', 'kelas', 'jurusan')
                        ->where('jurusan', $request->jurusan)->where('kelas', $request->kelas)->orderBy('kelas', 'asc')->get();
                } else if (!empty($request->kelas) && empty($request->jurusan)) {
                    $data = Siswa::select('id', 'nama', 'kelas', 'jurusan')->where('kelas', $request->kelas)->orderBy('jurusan', 'asc')->get();
                } else if (empty($request->kelas) && !empty($request->jurusan)) {
                    $data = Siswa::select('id', 'nama', 'kelas', 'jurusan')->where('jurusan', $request->jurusan)->orderBy('kelas', 'asc')->get();
                } else {
                    $data = Siswa::orderBy('kelas', 'asc')->get();
                }
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('opsi', function ($data) {
                        $btn = '<a href="/siswa/detail/' . $data->id . '" class="btn btn-warning my-sm-1">Detail</a>';
                        return $btn;
                    })
                    ->rawColumns(['opsi'])
                    ->editColumn('total_poin', function ($data) {
                        $total_poin = $data->poin()->sum('poin');
                        return $total_poin;
                    })
                    ->make(true);
            }
            $siswa = Siswa::orderBy('kelas', 'asc')->get();
            $kelas = Siswa::select('kelas')->groupBy('kelas')->orderBy('kelas', 'asc')->get();
            $jurusan = Siswa::select('jurusan')->groupBy('jurusan')->orderBy('jurusan', 'asc')->get();
            return view('/content/daftar_siswa', compact('siswa', 'jurusan', 'kelas'));
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesDetailSiswa(Request $request, $id)
    {
        if ($request->session()->has('session')) {

            $siswa = Siswa::where('id', $id)->first();
            $total_poin = $siswa->poin()->sum('poin');
            $kategori = Kategori::get();

            if ($total_poin == 0) {
                $siswa->update([
                    'nilai_id' => 1
                ]);
            } else if ($total_poin > 0 && $total_poin <= 25) {
                $siswa->update([
                    'nilai_id' => 2
                ]);
            } else if ($total_poin > 25 && $total_poin <= 50) {
                $siswa->update([
                    'nilai_id' => 3
                ]);
            } else if ($total_poin > 50 && $total_poin <= 75) {
                $siswa->update([
                    'nilai_id' => 4
                ]);
            } else if ($total_poin > 75) {
                $siswa->update([
                    'nilai_id' => 5
                ]);
            }

            return view('/content/detail_siswa', compact('siswa', 'kategori'));
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesDetailPoin(Request $request)
    {
        $siswa = Siswa::where('id', $request->id)->first();
        if ($request->ajax()) {
            if (!empty($request->kategori)) {
                $data = $siswa->poin()->select('id', 'siswa_id', 'kategori_id', 'jenis_pelanggaran', 'poin', 'tanggal')
                    ->where('kategori_id', $request->kategori)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            } else {
                $data = $siswa->poin()->select('id', 'siswa_id', 'kategori_id', 'jenis_pelanggaran', 'poin', 'tanggal')
                    ->orderBy('tanggal', 'desc')
                    ->get();
            }
            return DataTables::of($data)
                ->editColumn('tanggal', function ($data) {
                    return Carbon::parse($data->tanggal)->format('d M Y');
                })
                ->editColumn('kategori', function ($data) {
                    $kategori = $data->kategori->kategori;
                    return $kategori;
                })
                ->make(true);
        }
    }

    public function prosesInfoPoin(Request $request, $id)
    {
        if ($request->session()->has('session')) {
            $siswa = Siswa::where('id', $id)->first();
            return view('/content/info_poin', compact('siswa'));
        }
    }

    public function motivasi(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $motivasi = $siswa->motivasi()->first();
        if ($motivasi == null && $request->motivasi != "") {
            $siswa->motivasi()->create([
                'siswa_id' => $id,
                'motivasi' => $request->motivasi
            ]);
        } else if ($request->motivasi == "" && $motivasi != null) {
            $motivasi->delete();
        } else if ($motivasi == null && $request->motivasi == "") {
            $request->session()->flash('motivasi_sama', 'Tidak ada data yang diubah.');
            return redirect('/siswa/detail/' . $id);
        } else if ($motivasi->motivasi == $request->motivasi && $motivasi != null) {
            $request->session()->flash('motivasi_sama', 'Tidak ada data yang diubah.');
            return redirect('/siswa/detail/' . $id);
        } else if ($motivasi != null) {
            $motivasi->motivasi = $request->motivasi;
            $motivasi->save();
        }
        $request->session()->flash('motivasi_simpan', 'Berhasil menyimpan motivasi dan penguatan!');
        return redirect('/siswa/detail/' . $id);
    }


    public function kelola_siswa(Request $request)
    {
        if ($request->session()->has('session')) {
            return view('/content/kelola_siswa');
        } else {
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
            $siswa = Siswa::where('nis', $request->nis)->first();
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

    public function import_siswa(Request $request)
    {
        if ($request->session()->has('session')) {
            return view('/content/import_data_siswa');
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesImportSiswa(Request $request)
    {
        try {
            $catchSiswa = (Excel::toArray(new SiswaImport, $request->file('data_siswa')));
            $nis = [];
            $collapse = \Illuminate\Support\Arr::collapse($catchSiswa);
            foreach ($collapse as $c) {
                $nis[] = $c['nis'];
            };

            $siswa = Siswa::whereIn('nis', $nis)->get();

            if (count($siswa)) {
                $request->session()->flash('siswa_dup', 'Tambah data gagal, terdapat data yang sama dengan data siswa sebanyak ' . count($siswa) . ' siswa!');
                return view('/content/import_data_siswa', compact('siswa'));
            };

            try {
                Excel::import(new SiswaImport, $request->file('data_siswa'));
                $request->session()->flash('data_siswa_sukses', 'Berhasil menambahkan data siswa sebanyak ' . count($nis) . ' siswa.');
                return redirect('/daftar_siswa');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                $fail = [];
                foreach ($failures as $failure) {
                    $row = $failure->row();
                    $col = $failure->attribute();
                    $fail[] = '[baris:' . $row . ', kolom:' . $col . ']';
                }
                $error = join(", ", $fail);
                $request->session()->flash('tipe_salah', 'Terdapat tipe data yang salah!');
                return view('/content/import_data_siswa', compact('error'));
            }
        } catch (\Throwable $th) {
            $request->session()->flash('format_gagal', 'File harus diisi dan harus sesuai format yang telah disediakan!');
            return redirect('/import_siswa');
        }
    }
}
