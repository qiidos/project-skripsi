<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";

    public function siswa()
    {
        return $this->hasMany('App\Siswa');
    }

    public function kelasGrup()
    {
        return $this->belongsTo('App\KelasGrup', 'kelas_grup_id');
    }
}
