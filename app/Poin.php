<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    protected $table = "poin";

    protected $fillable = ['siswa_id', 'kategori_id', 'jenis_pelanggaran', 'poin', 'tanggal'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }

    public function kategori()
    {
        return $this->hasOne('App\Kategori', 'id', 'kategori_id');
    }
}
