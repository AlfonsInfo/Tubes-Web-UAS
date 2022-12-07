<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spamas', function (Blueprint $table) {
            $table->id('id_spama');
            $table->string('nama_kegiatan');
            $table->string('penyelenggara');
            $table->string('deskripsi_kegiatan');
            $table->date('tanggal');

            //Foreign Key ke Database Mahasiswa
            $table->unsignedBigInteger('npm');
            $table->foreign('npm')->references('npm')->on('mahasiswas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spamas');
    }
};
