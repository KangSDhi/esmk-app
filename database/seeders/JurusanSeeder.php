<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            [
                'nama_jurusan' => 'Teknik Komputer & Jaringan'
            ],
            [
                'nama_jurusan' => 'Teknik Geomatika'
            ],
            [
                'nama_jurusan' => 'Desain Properti dan Informasi Bangunan'
            ],
            [
                'nama_jurusan' => 'Mekatronika'
            ],
            [
                'nama_jurusan' => 'Teknik Elektronika Industri'
            ],
            [
                'nama_jurusan' => 'Teknik Installasi dan Tenaga Listrik'
            ],
            [
                'nama_jurusan' => 'Kimia Industri'
            ],
            [
                'nama_jurusan' => 'Bisnis Konstruksi dan Properti'
            ],
            [
                'nama_jurusan' => 'Teknik Pengelasan'
            ],
            [
                'nama_jurusan' => 'Teknik Kendaraan Ringan Otomotif'
            ]
        ]);
    }
}
