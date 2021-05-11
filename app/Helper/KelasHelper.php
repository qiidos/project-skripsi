<?php

use App\Kelas;
use App\Kategori;
use App\Siswa;

function getKelasNameByKelasId($kelas_id)
{
    $kelas = Kelas::find($kelas_id);
    $tingkat = $kelas->kelasGrup->tingkat;
    $jurusan = $kelas->kelas;
    return "$tingkat - $jurusan";
}

function getKelasByTingkat($tingkat)
{
    $kelas = Kelas::join('kelas_grups', 'kelas.kelas_grup_id', '=', 'kelas_grups.id');
    $kelas = $kelas->select('kelas_grups.tingkat', 'kelas.kelas', 'kelas.id')->where('kelas_grups.tingkat', $tingkat)->get();
    return $kelas;
}

function getSiswaByNis($nis)
{
    $siswa = Siswa::where('nis', $nis)->first();
    return $siswa;
}

function getKategori()
{
    $kategori = Kategori::get();
    return $kategori;
}

function getDataSiswa($id)
{
    $siswa = Siswa::where('id', $id)->first();
    return $siswa;
}
