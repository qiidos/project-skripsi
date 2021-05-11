<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "kategories";

    public function poin()
    {
        return $this->hasMany('App\Poin');
    }
}
