<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KesiswaanController extends Controller
{
    public function index(){
        $title = 'Dashboard Kesiswaan';
        $jumlahSiswaAktif = Siswa::count();
        $jumlahLakiLaki = Siswa::where('jenis_kelamin', 'laki-laki')->count();
        $jumlahPerempuan = Siswa::where('jenis_kelamin', 'perempuan')->count();
        $jumlahSiswaGender = Siswa::select('jenis_kelamin', DB::raw('count(*) as jumlah'))->groupBy('jenis_kelamin')->get();
        return view('kesiswaan.dashboardKesiswaan', [
            'title' => $title,
            'jumlah_siswa_aktif' => $jumlahSiswaAktif,
            'jumlah_siswa_laki_laki' => $jumlahLakiLaki,
            'jumlah_siswa_perempuan' => $jumlahPerempuan,
            'jumlah_siswa_gender' => $jumlahSiswaGender
        ]);
    }
}
