<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasGrup extends Model
{
    protected $table = 'kelas_grups';

    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'kelas_grup_id');
    }
}
