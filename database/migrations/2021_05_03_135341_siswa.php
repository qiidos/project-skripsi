<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Siswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kelas_id');
            $table->unsignedInteger('nilai_id')->default(1);
            $table->unsignedInteger('pengguna_id')->nullable()->unique();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('nilai_id')->references('id')->on('nilaies');
            $table->foreign('pengguna_id')->references('id')->on('penggunas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
