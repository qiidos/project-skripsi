<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poin;
use App\Siswa;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class PoinController extends Controller
{
    public function tambah_poin(Request $request, $id)
    {
        if ($request->session()->has('session')) {
            $siswa = Siswa::where('id', $id)->first();
            return view('/content/tambah_poin', ['siswa' => $siswa]);
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesTambahPoin(Request $request, $id)
    {
        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!',
            'not_in' => ':attribute harus lebih dari 0',
            'regex' => ':attribute tidak valid.'
        ];

        $this->validate($request, [
            'pelanggaran' => 'required',
            'jumlah_poin' => 'required|regex:/^[0-9\d\.]+$/|min:0|not_in:0',
            'tanggal' => 'required'
        ], $messages);

        if ($request->kategori == null) {
            $messages = [
                'required' => 'Silahkan :attribute dipilih terlebih dahulu!'
            ];
            $this->validate($request, [
                'kategori' => 'required'
            ], $messages);
        }

        Poin::create([
            'siswa_id' => $id,
            'jenis_pelanggaran' => $request->pelanggaran,
            'kategori' => $request->kategori,
            'poin' => $request->jumlah_poin,
            'tanggal' => Carbon::parse($request->tanggal)
        ]);

        $request->session()->flash('tambah_poin', 'Berhasil menambah pelanggaran "' . $request->pelanggaran . '" dengan jumlah poin "' . $request->jumlah_poin . '".');
        return redirect('/siswa/detail/' . $id);
    }

    public function edit_poin(Request $request, $id)
    {
        if ($request->session()->has('session')) {
            $poin = Poin::find($id);
            $tanggal = Carbon::parse($poin->tanggal)->format('d-m-Y');
            return view('/content/edit_poin', compact('poin', 'tanggal'));
        } else {
            return redirect('/masuk');
        }
    }

    public function prosesEditPoin(Request $request, $id)
    {
        $messages = [
            'required' => 'Silahkan :attribute diisi terlebih dahulu!',
            'not_in' => ':attribute harus lebih dari 0',
            'regex' => ':attribute tidak valid.'
        ];

        $this->validate($request, [
            'pelanggaran_edit' => 'required',
            'jumlah_poin_edit' => 'required|regex:/^[0-9\d\.]+$/|min:0|not_in:0',
            'tanggal_edit' => 'required'
        ], $messages);

        if ($request->kategori_edit == null) {
            $messages = [
                'required' => 'Silahkan :attribute dipilih terlebih dahulu!'
            ];
            $this->validate($request, [
                'kategori_edit' => 'required'
            ], $messages);
        }

        $poin = Poin::find($id);

        if ($poin->jenis_pelanggaran == $request->pelanggaran_edit && $poin->kategori == $request->kategori_edit && $poin->poin == $request->jumlah_poin_edit && Carbon::parse($poin->tanggal)->format('d-m-Y') == Carbon::parse($request->tanggal_edit)->format('d-m-Y')) {
            $request->session()->flash('edit_poin_tetap', 'Tidak ada data yang diubah!');
        } else {
            $request->session()->flash('edit_poin', 'Berhasil mempertbarui data poin pelanggaran!');
        }

        $poin->jenis_pelanggaran = $request->pelanggaran_edit;
        $poin->kategori = $request->kategori_edit;
        $poin->poin = $request->jumlah_poin_edit;
        $poin->tanggal = Carbon::parse($request->tanggal_edit);
        $poin->save();

        return redirect('/siswa/detail/' . $poin->siswa_id);
    }

    public function prosesHapusPoin(Request $request, $id)
    {
        $poin = Poin::find($id);
        if (!empty($poin)) {
            $request->session()->flash('hapus_poin', 'Berhasil menghapus poin pelanggaran "' . $poin->jenis_pelanggaran . '".');
            $poin->delete();
        } else {
            $request->session()->flash('gagal_hapus', 'Gagal hapus poin, kemungkinan poin pelanggaran sudah dihapus oleh Admin yang lain.');
        }
        return redirect()->back();
    }

    public function prosesCetakPoin($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $poin = $siswa->poin()->select('id', 'siswa_id', 'kategori', 'jenis_pelanggaran', 'poin', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        $pdf = PDF::loadview('/print/siswa_pdf', compact('siswa', 'poin'))->setPaper('a4', 'potrait');
        return $pdf->stream("Poin Pelanggaran-" . $siswa->nama . "-" . $siswa->kelas . "-" . $siswa->jurusan . ".pdf");
    }
}
