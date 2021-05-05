<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "kategori";

    public function poin()
    {
        return $this->belongsTo('App\Poin');
    }
}
