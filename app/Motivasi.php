<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivasi extends Model
{
    protected $table = "motivasies";

    protected $fillable = ['siswa_id', 'motivasi'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'id');
    }
}
