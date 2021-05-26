<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';

    protected $fillable = ['nilai_id', 'kelas_id', 'pengguna_id', 'nis', 'nama'];

    public function poin()
    {
        return $this->hasMany('App\Poin');
    }

    public function nilai()
    {
        return $this->belongsTo('App\Nilai', 'nilai_id', 'id');
    }

    public function motivasi()
    {
        return $this->hasOne('App\Motivasi');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo('App\Pengguna');
    }
}
