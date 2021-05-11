<?php

use Illuminate\Database\Seeder;
use App\Siswa;
use App\Kelas;
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
        $kelas = Kelas::select('id')->get();

        for ($j = 0; $j < count($kelas); $j++) {
            for ($i = 1; $i <= 7; $i++) {
                Siswa::insert([
                    'kelas_id' => $kelas[$j]['id'],
                    'nilai_id' => 1,
                    'nis' => $faker->numerify('#########'),
                    'nama' => $faker->name
                ]);
            }
        }
    }
}
