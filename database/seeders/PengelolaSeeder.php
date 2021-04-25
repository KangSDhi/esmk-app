<?php

namespace Database\Seeders;

use App\Models\Pengelola;
use Illuminate\Database\Seeder;

class PengelolaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Pengelola::create([
            'nama_lengkap' => 'Sigit Boworaharjo',
            'email' => 'sigit@admin.test',
            'foto_pengelola' => null,
            'password' => bcrypt('qwerty'),
            'jurusan_id' => null
        ]);

        $admin->assignRole('admin');

        $kesiswaan = Pengelola::create([
            'nama_lengkap' => 'Sundoyo',
            'email' => 'sundoyo@kesiswaan.test',
            'foto_pengelola' => null,
            'password' => bcrypt('qwerty'),
            'jurusan_id' => null
        ]);

        $kesiswaan->assignRole('kesiswaan');
    }
}
