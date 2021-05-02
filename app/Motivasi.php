<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivasi extends Model
{
    protected $table = "motivasi";

    protected $fillable = ['siswa_id', 'motivasi'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }
}
