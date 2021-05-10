<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class TahunAjaranController extends Controller
{
    public function index(){
        $title = "Tahun Ajaran";

        $query = TahunAjaran::all();

        if (request()->ajax() && $_SERVER["REQUEST_METHOD"] == "POST"){
            return DataTables::of($query)
                ->editColumn('updated_at', function($query){
                    return $query->updated_at->tz('Asia/Jakarta')->format('Y/m/d H:i:s');
                })
                ->addColumn('aksi', 'kesiswaan.component.datatablesTahunAjaran')
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('kesiswaan.tahunAjaranKesiswaan', [
            "title" => $title
        ]);
    }

    public function detail($tahun_ajaran = null){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (request()->ajax()){
                $tahunAjaran = request()->_tahun_ajaran;
                $query = Siswa::join('kelas', 'siswa.kelas_id', 'kelas.id_kelas')
                            ->where('tahun_ajaran', $tahunAjaran)
                            ->select('nama_lengkap', 'tingkat', 'kelas', 'NIS', 'NISN')
                            ->get();

                return DataTables::of($query)
                    ->addColumn('aksi', 'kesiswaan.component.datatablesTahunAjaranDetail')
                    ->rawColumns(['aksi'])
                    ->addIndexColumn()
                    ->toJson();
            }
        }else{
            $tahunAjaran = Crypt::decrypt($tahun_ajaran);
            return view('kesiswaan.detailTahunAjaranKesiswaan', [
                "tahun_ajaran" => $tahunAjaran
            ]);
        }

    }
}
