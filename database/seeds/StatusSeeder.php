<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['Guru', 'Siswa'];
        for ($i = 0; $i <= 1; $i++) {
            Status::insert([
                'status' => $status[$i],
            ]);
        }
    }
}
