<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KelasGrupSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(NilaiSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(PenggunaSeeder::class);
    }
}
