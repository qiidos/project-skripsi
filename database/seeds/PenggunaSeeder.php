<?php

use Illuminate\Database\Seeder;
use App\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username = ['admin1', 'admin2', '95864303', '14540010', '419392974'];
        $nama = ['Admin 1', 'Admin 2', 'Alika Agustina', 'Kasim Cawisono Nainggolan', 'Clara Nasyiah'];
        $password = ['admin123', 'admin456', 'alika000', 'kasim000', 'clara000'];
        $email = ['emailnya.sodiq@gmail.com', 'sodiq.private@gmail.com', 'sodiq.jobseeker@gmail.com', 'sodiq.gamebot@gmail.com', 'clara@gmail.com'];
        for ($h = 0; $h < 2; $h++) {
            Pengguna::insert([
                'status_id' => 1,
                'username' => $username[$h],
                'nama' => $nama[$h],
                'password' => Hash::make($password[$h]),
                'email' => $email[$h]
            ]);
        }
        for ($q = 2; $q < 5; $q++) {
            Pengguna::insert([
                'status_id' => 2,
                'username' => $username[$q],
                'nama' => $nama[$q],
                'password' => Hash::make($password[$q]),
                'email' => $email[$q]
            ]);
        }
    }
}
