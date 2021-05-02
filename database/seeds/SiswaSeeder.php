<?php

use Illuminate\Database\Seeder;
use App\Siswa;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            Siswa::insert([
                'nis' => $faker->numerify('#########'),
                'nama' => $faker->name,
                'jenis_kelamin' => 'Laki-Laki',
                'jurusan' => 'Pemasaran 3',
                'kelas' => $faker->numberBetween(10, 12),
                'total_poin' => 0,
                'predikat' => 'Amat Baik',
                'nilai' => 'A',
                'deskripsi' => null
            ]);
        }
    }
}
