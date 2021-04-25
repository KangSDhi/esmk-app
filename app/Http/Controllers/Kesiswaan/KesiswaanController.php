<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KesiswaanController extends Controller
{
    public function index(){
        $title = 'Dashboard Kesiswaan';
        return view('kesiswaan.dashboardKesiswaan', [
            'title' => $title
        ]);
    }
}
