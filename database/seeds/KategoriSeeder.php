<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = ['Ringan', 'Sedang', 'Berat'];
        for ($i = 0; $i <= 2; $i++) {
            Kategori::insert([
                'kategori' => $kategori[$i],
            ]);
        }
    }
}
