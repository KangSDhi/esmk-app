<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request){
        $tahunAjaran = $request->tahun_ajaran;

        try {
            DB::beginTransaction();
            $model = new TahunAjaran;
            $model->tahun_ajaran = $tahunAjaran;
            $model->save();
            DB::commit();
            $status = true;
        }catch (\Exception $e){
            DB::rollBack();
            $status = false;
        }

        if ($status){
            return Response::json(['message' => "oke", 'status' => 200], 200);
        }else{
            return Response::json(['message' => "error", 'status' => 500], 500);
        }
    }

    public function destroy(Request $request){
        $id_tahun_ajaran = $request->id_tahun_ajaran;
        $tahun_ajaran = $request->tahun_ajaran;
        $query = Siswa::where('tahun_ajaran', $tahun_ajaran)->count();
        try{
            DB::beginTransaction();
            if ($query > 0){
                Siswa::where('tahun_ajaran', $tahun_ajaran)->delete();
                TahunAjaran::where('id_tahun_ajaran', $id_tahun_ajaran)->delete();
            }else{
                TahunAjaran::where('id_tahun_ajaran', $id_tahun_ajaran)->delete();
            }
            DB::commit();
            $status = true;
        }catch (\Exception $e){
            DB::rollBack();
            $status = false;
        }
        if ($status){
            return Response::json(["message" => "success", "status" => 200]);
        }else{
            return Response::json(["message" => "error", "status" => 500]);
        }
    }

    public function importSiswa(Request $request){
        $tahun_ajaran = $request->tahun_ajaran;
        $validator = Validator::make($request->all(), [
            'file_excel' => 'required|mimes:xls,xlsx'
        ],[
            'file_excel.required' => 'File Import Kosong!',
            'file_excel.mimes' => 'Ekstensi File Tidak Sesuai!'
        ]);
        if ($validator->fails()){
            return Redirect::route('get.tahunAjaranKesiswaanDetail', Crypt::encrypt($tahun_ajaran))->withErrors($validator);
        }else{
            return Redirect::route('get.tahunAjaranKesiswaanDetail', Crypt::encrypt($tahun_ajaran));
        }
    }
}
