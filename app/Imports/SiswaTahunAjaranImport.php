<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaTahunAjaranImport implements ToCollection, WithHeadingRow
{
    public function __construct($tahun_ajaran)
    {
        $this->tahun_ajaran = $tahun_ajaran;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row){
            $queryWhereKelas = DB::table("kelas")
                ->where("tingkat", $row["tingkat"])
                ->where("kelas", $row["kelas"])
                ->get();
            $queryWhereAlamat = DB::table("provinsi")
                ->join("kabupaten", "provinsi.id_provinsi", "kabupaten.provinsi_id")
                ->join("kecamatan", "kabupaten.id_kabupaten", "kecamatan.kabupaten_id")
                ->where("nama_provinsi", $row["provinsi_kk"])
                ->where("nama_kabupaten", $row["kabupaten_kk"])
                ->where("nama_kecamatan", $row["kecamatan_kk"])
                ->select("id_kecamatan")
                ->get();
            if (count($queryWhereKelas) != 0 && count($queryWhereAlamat) != 0){
                try {
                    DB::beginTransaction();
                    $queryGetIdSiswa = Siswa::insertGetId([
                        "nama_lengkap" => $row["nama_lengkap"],
                        "kelas_id" => $queryWhereKelas[0]->id_kelas,
                        "tempat_lahir" => $row["tempat_lahir"],
                        "tanggal_lahir" => $row["tanggal_lahir"],
                        "jenis_kelamin" => $row["jenis_kelamin"],
                        "agama" => $row["agama"],
                        "kewarganegaraan" => $row["kewarganegaraan"],
                        "golongan_darah" => $row["golongan_darah"],
                        "nomor_KK" => $row["nomor_kk"],
                        "NIK" => $row["nik"],
                        "foto_KK" => null,
                        "NISN" => $row["nisn"],
                        "asal_sekolah" => $row["asal_sekolah"],
                        "NIS" => $row["nis"],
                        "tahun_ajaran" => $this->tahun_ajaran,
                        "tahun_lulus" => null,
                        "no_hp" => $row["no_handphone"],
                        "email" => $row["e_mail"],
                        "password" => null,
                        "no_akta_lahir" => null,
                        "foto_akta_lahir" => null,
                        "no_ijasah" => null,
                        "foto_ijasah" => null,
                        "foto_siswa_awal" => null,
                        "foto_siswa_ijasah" => null,
                        "status_siswa" => 1,
                        "foto_surat" => null,
                        "nomor_surat" => null,
                        "tanggal_surat" => null,
                        "nama_ayah" => $row["nama_ayah"],
                        "pekerjaan_ayah" => $row["pekerjaan_ayah"],
                        "penghasilan_ayah" => $row["penghasilan_ayah"],
                        "no_hp_ayah" => $row["no_handphone_ayah"],
                        "nama_ibu" => $row["nama_ibu"],
                        "pekerjaan_ibu" => $row["pekerjaan_ibu"],
                        "penghasilan_ibu" => $row["penghasilan_ibu"],
                        "no_hp_ibu" => $row["no_handphone_ibu"],
                        "nama_wali" => $row["nama_wali"],
                        "pekerjaan_wali" => $row["pekerjaan_wali"],
                        "penghasilan_wali" => $row["penghasilan_wali"],
                        "no_hp_wali" => $row["no_handphone_wali"]
                    ]);

                    DB::table("alamat_siswa")->insert([
                        "siswa_id" => $queryGetIdSiswa,
                        "tipe_alamat" => 1,
                        "kecamatan_id" => $queryWhereAlamat[0]->id_kecamatan,
                        "desa" => $row["desa_kelurahan"],
                        "alamat" => $row["alamat"],
                        "RT" => $row["rt"],
                        "RW" => $row["rw"],
                        "kode_pos" => $row["kode_pos"]
                    ]);
                    DB::commit();
                }catch (\Exception $e){
                    DB::rollBack();
                }
            }
        }
    }
}
