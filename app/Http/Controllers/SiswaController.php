<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Siswa;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    public function getKelasByTingkat($tingkat)
    {
        return getKelasByTingkat($tingkat);
    }

    public function prosesLihatDaftarSiswa(Request $request)
    {
        if ($request->session()->has('session')) {
            if ($request->ajax()) {
                if (!empty($request->kelas)) {
                    $data = Siswa::select('id', 'kelas_id', 'nis', 'nama')
                        ->where('kelas_id', $request->kelas)->orderBy('kelas_id', 'asc')->get();
                } else {
                    $data = Siswa::orderBy('kelas_id', 'asc')->get();
                }
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('opsi', function ($data) {
                        $btn = '<a href="/siswa/detail/' . $data->id . '" class="btn btn-warning my-sm-1">Detail</a>';
                        return $btn;
                    })
                    ->rawColumns(['opsi'])
                    ->editColumn('kelas', function ($data) {
                        return getKelasNameByKelasId($data->kelas_id);
                    })
                    ->editColumn('total_poin', function ($data) {
                        $total_poin = $data->poin()->sum('poin');
                        return $total_poin;
                    })
                    ->make(true);
            }
            $siswa = Siswa::get();
            return view('/content/daftar_siswa', compact('siswa'));
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesDetailSiswa(Request $request, $id)
    {
        if ($request->session()->has('session')) {

            $siswa = Siswa::where('id', $id)->first();
            $total_poin = $siswa->poin()->sum('poin');
            $kategori = getKategori();

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
            $kategori = getKategori();
            return view('/content/info_poin', compact('siswa', 'kategori'));
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
                };
                $error = join(", ", $fail);
                $request->session()->flash('tipe_salah', 'Terdapat tipe data yang salah!');
                return view('/content/import_data_siswa', compact('error'));
            }
        } catch (\Throwable $th) {
            $request->session()->flash('format_gagal', 'File harus diisi dan gunakan format yang telah disediakan!');
            return redirect('/import_siswa');
        }
    }
}
