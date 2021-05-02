<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    protected $table = "poin";

    protected $fillable = ['siswa_id', 'kategori', 'jenis_pelanggaran', 'poin', 'tanggal'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }
}
