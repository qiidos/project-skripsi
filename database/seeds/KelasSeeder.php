<?php

use Illuminate\Database\Seeder;
use App\KelasGrup;
use App\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas_grup = KelasGrup::select('id', 'jurusan')->get();
        for ($kg = 1; $kg <= count($kelas_grup); $kg++) {
            for ($i = 1; $i <= 3; $i++) {
                Kelas::insert([
                    'kelas_grup_id' => $kg,
                    'kelas' => $kelas_grup[$kg - 1]['jurusan'] . " " . $i
                ]);
            }
        }
    }
}
