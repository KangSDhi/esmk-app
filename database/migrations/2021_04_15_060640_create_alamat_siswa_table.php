<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat_siswa', function (Blueprint $table) {
            $table->bigIncrements('id_alamat');
            $table->unsignedBigInteger('siswa_id');
            $table->integer('tipe_alamat');
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('desa');
            $table->text('alamat');
            $table->string('RT');
            $table->string('RW');
            $table->integer('kode_pos');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('no_hp_alamat')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')
                ->references('id_siswa')
                ->on('siswa')
                ->onDelete('cascade');

            $table->foreign('kecamatan_id')
                ->references('id_kecamatan')
                ->on('kecamatan')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat_siswa');
    }
}
