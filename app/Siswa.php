<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['nilai_id', 'nis', 'nama', 'jenis_kelamin', 'jurusan', 'kelas'];

    public function poin()
    {
        return $this->hasMany('App\Poin', 'siswa_id', 'id');
    }

    public function nilai()
    {
        return $this->hasOne('App\Nilai', 'id', 'nilai_id');
    }

    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna');
    }

    public function motivasi()
    {
        return $this->hasOne('App\Motivasi', 'siswa_id', 'id');
    }
}
