<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilaies';

    public function siswa()
    {
        return $this->hasMany('App\Siswa');
    }
}
