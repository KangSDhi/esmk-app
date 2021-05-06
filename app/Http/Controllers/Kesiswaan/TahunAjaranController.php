<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TahunAjaranController extends Controller
{
    public function index(){
        $title = "Tahun Ajaran";

        $query = TahunAjaran::all();

        if (request()->ajax()){
            return DataTables::of($query)
                ->addIndexColumn()
                ->toJson();
        }

        return view('kesiswaan.tahunAjaranKesiswaan', [
            "title" => $title
        ]);
    }
}
