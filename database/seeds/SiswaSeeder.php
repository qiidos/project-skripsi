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
        $kelas_id = [10, 11, 1];
        $nis = ['95864303', '14540010', '419392974'];
        $nama = ['Alika Agustina', 'Kasim Cawisono Nainggolan', 'Clara Nasyiah'];
        $pengguna_id = [3, 4, 5];
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

        for ($o = 0; $o < count($nis); $o++) {
            Siswa::insert([
                'kelas_id' => $kelas_id[$o],
                'pengguna_id' => $pengguna_id[$o],
                'nilai_id' => 1,
                'nis' => $nis[$o],
                'nama' => $nama[$o]
            ]);
        }
    }
}
