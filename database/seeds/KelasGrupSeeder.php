<?php

use Illuminate\Database\Seeder;
use App\KelasGrup;

class KelasGrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = ['Teknik Komputer Jaringan', 'Pemasaran', 'Multimedia', 'Kimia Industri', 'Akuntansi'];
        for ($j = 0; $j < count($jurusan); $j++) {
            // $angkatan = 2019;
            for ($i = 10; $i <= 12; $i++) {
                KelasGrup::insert([
                    'tingkat' => $i,
                    'jurusan' => $jurusan[$j],
                    // 'islulus' => 0
                    // 'angkatan' => $angkatan
                ]);
                // $angkatan--;
            }
        }
    }
}
