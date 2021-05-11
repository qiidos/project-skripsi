<?php

use Illuminate\Database\Seeder;
use App\Pengguna;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username = ['admin1', 'admin2'];
        $nama = ['Admin 1', 'Admin 2'];
        $password = ['admin123', 'admin456'];
        $email = ['emailnya.sodiq@gmail.com', 'sodiq.private@gmail.com'];
        for ($h = 0; $h <= 1; $h++) {
            Pengguna::insert([
                'status_id' => 1,
                'username' => $username[$h],
                'nama' => $nama[$h],
                'password' => $password[$h],
                'email' => $email[$h],
                'token' => ''
            ]);
        }
    }
}
