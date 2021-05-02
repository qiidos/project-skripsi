<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $fillable = ['username', 'nama', 'password', 'email', 'token'];

    public function status()
    {
        return $this->hasOne('App\Status', 'id', 'status_id');
    }

    public function siswa()
    {
        return $this->hasOne('App\Siswa', 'nis', 'username');
    }
}
