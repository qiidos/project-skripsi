<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    protected $table = "poins";

    protected $fillable = ['siswa_id', 'kategori_id', 'jenis_pelanggaran', 'poin', 'tanggal'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id', 'id');
    }
}
