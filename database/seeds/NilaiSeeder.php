<?php

use Illuminate\Database\Seeder;
use App\Nilai;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $huruf = ['A', 'B', 'C', 'D', 'E'];
        $predikat = ['Amat Baik', 'Baik', 'Cukup', 'Kurang', 'Amat Kurang'];
        for ($h = 0; $h < count($huruf); $h++) {
            Nilai::insert([
                'nilai' => $huruf[$h],
                'predikat' => $predikat[$h]
            ]);
        }
    }
}
