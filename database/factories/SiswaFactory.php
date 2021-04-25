<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kelas_id' => $this->faker->numberBetween(1,55),
            'nama_lengkap' => $this->faker->name,
            'tempat_lahir' => 'bojonegoro',
            'tanggal_lahir' => $this->faker->date('Y-m-d'),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'agama' => $this->faker->randomElement(['islam', 'kristen']),
            'kewarganegaraan' => 'indonesia',
            'golongan_darah' => $this->faker->randomElement(['o', 'a', 'b', 'ab']),
            'nomor_KK' => null,
            'NIK' => null,
            'NISN' => null,
            'asal_sekolah' => 'SMP Negeri 1 Bojonegoro',
            'NIS' => null,
            'tahun_ajaran' => '2019/2020',
            'tahun_lulus' => null,
            'no_hp' => null,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'no_akta_lahir' => null,
            'foto_akta_lahir' => null,
            'no_ijasah' => null,
            'foto_ijasah' => null,
            'foto_siswa_awal' => null,
            'foto_siswa_ijasah' => null,
            'status_siswa' => 1,
            'foto_surat' => null,
            'nomor_surat' => null,
            'tanggal_surat' => null,
            'nama_ayah' => $this->faker->firstName,
            'pekerjaan_ayah' => 'tani',
            'no_hp_ayah' => null,
            'nama_ibu' => $this->faker->firstName,
            'pekerjaan_ibu' => 'ibu rumah tangga',
            'penghasilan_ibu' => null,
            'no_hp_ibu' => null,
            'nama_wali' => null,
            'pekerjaan_wali' => null,
            'penghasilan_wali' => null,
            'no_hp_wali' => null,
            'dinding' => null,
            'lantai' => null,
            'atap' => null,
            'foto_tampak_depan' => null,
            'foto_tampak_belakang' => null,
            'foto_tampak_samping' => null,
            'foto_tampak_dalam' => null
        ];
    }
}
