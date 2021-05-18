<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'penggunas';

    protected $fillable = ['username', 'status_id', 'nama', 'password', 'email', 'token'];

    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id', 'id');
    }

    // public function siswa()
    // {
    //     return $this->belongsTo('App\Siswa', 'nis', 'username');
    // }
}
