<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinsi')->insert([
            [
                "id_provinsi" => "11",
                "nama_provinsi" => "ACEH",
            ],
            [
                "id_provinsi" => "12",
                "nama_provinsi" => "SUMATERA UTARA",
            ],
            [
                "id_provinsi" => "13",
                "nama_provinsi" => "SUMATERA BARAT",
            ],
            [
                "id_provinsi" => "14",
                "nama_provinsi" => "RIAU",
            ],
            [
                "id_provinsi" => "15",
                "nama_provinsi" => "JAMBI",
            ],
            [
                "id_provinsi" => "16",
                "nama_provinsi" => "SUMATERA SELATAN",
            ],
            [
                "id_provinsi" => "17",
                "nama_provinsi" => "BENGKULU",
            ],
            [
                "id_provinsi" => "18",
                "nama_provinsi" => "LAMPUNG",
            ],
            [
                "id_provinsi" => "19",
                "nama_provinsi" => "KEPULAUAN BANGKA BELITUNG",
            ],
            [
                "id_provinsi" => "21",
                "nama_provinsi" => "KEPULAUAN RIAU",
            ],
            [
                "id_provinsi" => "31",
                "nama_provinsi" => "DKI JAKARTA",
            ],
            [
                "id_provinsi" => "32",
                "nama_provinsi" => "JAWA BARAT",
            ],
            [
                "id_provinsi" => "33",
                "nama_provinsi" => "JAWA TENGAH",
            ],
            [
                "id_provinsi" => "34",
                "nama_provinsi" => "DI YOGYAKARTA",
            ],
            [
                "id_provinsi" => "35",
                "nama_provinsi" => "JAWA TIMUR",
            ],
            [
                "id_provinsi" => "36",
                "nama_provinsi" => "BANTEN",
            ],
            [
                "id_provinsi" => "51",
                "nama_provinsi" => "BALI",
            ],
            [
                "id_provinsi" => "52",
                "nama_provinsi" => "NUSA TENGGARA BARAT",
            ],
            [
                "id_provinsi" => "53",
                "nama_provinsi" => "NUSA TENGGARA TIMUR",
            ],
            [
                "id_provinsi" => "61",
                "nama_provinsi" => "KALIMANTAN BARAT",
            ],
            [
                "id_provinsi" => "62",
                "nama_provinsi" => "KALIMANTAN TENGAH",
            ],
            [
                "id_provinsi" => "63",
                "nama_provinsi" => "KALIMANTAN SELATAN",
            ],
            [
                "id_provinsi" => "64",
                "nama_provinsi" => "KALIMANTAN TIMUR",
            ],
            [
                "id_provinsi" => "65",
                "nama_provinsi" => "KALIMANTAN UTARA",
            ],
            [
                "id_provinsi" => "71",
                "nama_provinsi" => "SULAWESI UTARA",
            ],
            [
                "id_provinsi" => "72",
                "nama_provinsi" => "SULAWESI TENGAH",
            ],
            [
                "id_provinsi" => "73",
                "nama_provinsi" => "SULAWESI SELATAN",
            ],
            [
                "id_provinsi" => "74",
                "nama_provinsi" => "SULAWESI TENGGARA",
            ],
            [
                "id_provinsi" => "75",
                "nama_provinsi" => "GORONTALO",
            ],
            [
                "id_provinsi" => "76",
                "nama_provinsi" => "SULAWESI BARAT",
            ],
            [
                "id_provinsi" => "81",
                "nama_provinsi" => "MALUKU",
            ],
            [
                "id_provinsi" => "82",
                "nama_provinsi" => "MALUKU UTARA",
            ],
            [
                "id_provinsi" => "91",
                "nama_provinsi" => "PAPUA BARAT",
            ],
            [
                "id_provinsi" => "94",
                "nama_provinsi" => "PAPUA",
            ],
        ]);
    }
}
