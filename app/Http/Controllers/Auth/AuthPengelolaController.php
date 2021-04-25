<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthPengelolaController extends Controller
{
    public function login(Request $request){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $request->email;
            $password = $request->password;
            try {
                $auth = Auth::guard('pengelola')->attempt([
                    'email' => $email,
                    'password' => $password
                ]);
            }catch (\Exception $e){
                $message = $e->getMessage();
                return Redirect::route('get.loginPengelola')->with('error', $message);
            }
            if ($auth){
                $checkRole = Auth::guard('pengelola')->user();
                if ($checkRole->hasRole('admin')){
                    echo "Dashboard Admin";
                }elseif ($checkRole->hasRole('kesiswaan')){
                    return Redirect::route('get.dashboardKesiswaan');
                }elseif ($checkRole->hasRole('toolman')){
                    echo "Dashboard Toolman";
                }
            }else{
                $message = 'Anda Bukan Pengelola';
                return Redirect::route('get.loginPengelola')->with('error', $message);
            }
        }else{
            $title = 'Login Pengelola';
            return view('auth.loginPengelola', [
                'title' => $title
            ]);
        }
    }
}
