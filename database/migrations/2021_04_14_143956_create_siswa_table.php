<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id_siswa');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('kewarganegaraan');
            $table->string('golongan_darah')->nullable();
            $table->unsignedBigInteger('nomor_KK')->nullable();
            $table->unsignedBigInteger('NIK')->nullable();
            $table->string('foto_KK')->nullable();
            $table->string('NISN')->nullable();
            $table->string('asal_sekolah');
            $table->string('NIS')->nullable();
            $table->string('tahun_ajaran');
            $table->string('tahun_lulus')->nullable();
            $table->string('no_hp')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_akta_lahir')->nullable();
            $table->string('foto_akta_lahir')->nullable();
            $table->string('no_ijasah')->nullable();
            $table->string('foto_ijasah')->nullable();
            $table->string('foto_siswa_awal')->nullable();
            $table->string('foto_siswa_ijasah')->nullable();
            $table->tinyInteger('status_siswa');
            $table->string('foto_surat')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah')->nullable();
            $table->string('no_hp_ayah')->unique()->nullable();
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu')->nullable();
            $table->string('no_hp_ibu')->unique()->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->string('no_hp_wali')->nullable();
            $table->string('dinding')->nullable();
            $table->string('lantai')->nullable();
            $table->string('atap')->nullable();
            $table->string('foto_tampak_depan')->nullable();
            $table->string('foto_tampak_belakang')->nullable();
            $table->string('foto_tampak_samping')->nullable();
            $table->string('foto_tampak_dalam')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')
                ->references('id_kelas')
                ->on('kelas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
