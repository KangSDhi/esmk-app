<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController as Home;
use App\Http\Controllers\Auth\AuthPengelolaController as AuthPengelola;
use App\Http\Controllers\Auth\AuthSiswaController as AuthSiswa;
use App\Http\Controllers\Admin\AdminController as Admin;
use App\Http\Controllers\Kesiswaan\KesiswaanController as Kesiswaan;
use App\Http\Controllers\Kesiswaan\TahunAjaranController as TahunAjaranKesiswaan;
use App\Http\Controllers\Toolman\ToolmanController as Toolman;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest', 'cors'])->group(function (){
    // home routing
    Route::get('/', [Home::class, 'index'])->name('get.home');
    // login pengelola routing
    Route::get('/login-pengelola', [AuthPengelola::class, 'login'])->name('get.loginPengelola');
    Route::post('/login-pengelola', [AuthPengelola::class, 'login'])->name('post.loginPengelola');
    // login siswa routing
    Route::get('/login-siswa', [AuthSiswa::class, 'login'])->name('get.loginSiswa');
    Route::post('/login-siswa', [AuthSiswa::class, 'login'])->name('post.loginSiswa');
});

Route::middleware(['auth:pengelola', 'role:admin', 'cors'])->group(function (){
    Route::get('/dashboard/admin', [Admin::class, 'index'])->name('get.dashboardAdmin');
    Route::get('/dashboard/admin/logout', [AuthPengelola::class, 'logout'])->name('get.logoutAdmin');
});

Route::middleware(['auth:pengelola', 'role:kesiswaan', 'cors'])->group(function (){
    Route::get('/dashboard/kesiswaan', [Kesiswaan::class, 'index'])->name('get.dashboardKesiswaan');
    Route::get('/dashboard/kesiswaan/logout', [AuthPengelola::class, 'logout'])->name('get.logoutKesiswaan');
    Route::get('/dashboard/kesiswaan/tahun-ajaran', [TahunAjaranKesiswaan::class, 'index'])->name('get.tahunAjaranKesiswaan');
    Route::post('/dashboard/kesiswaan/tahun-ajaran', [TahunAjaranKesiswaan::class, 'index'])->name('post.tahunAjaranKesiswaan');
    Route::get('/dashboard/kesiswaan/tahun-ajaran/{tahun_ajaran}', [TahunAjaranKesiswaan::class, 'detail'])->name('get.tahunAjaranKesiswaanDetail');
    Route::post('/dashboard/kesiswaan/tahun-ajaran/post', [TahunAjaranKesiswaan::class, 'detail'])->name('post.tahunAjaranKesiswaanDetail');
    Route::post('/dashboard/kesiswaan/tahun-ajaran/store', [TahunAjaranKesiswaan::class, 'store'])->name('post.tahunAjaranKesiswaanStore');
    Route::post('/dashboard/kesiswaan/tahun-ajaran/destroy', [TahunAjaranKesiswaan::class, 'destroy'])->name('post.tahunAjaranKesiswaanDestroy');
    Route::post('/dashboard/kesiswaan/tahun-ajaran/import', [TahunAjaranKesiswaan::class, 'importSiswa'])->name('post.tahunAjaranKesiswaanImport');
});

Route::middleware(['auth:pengelola', 'role:toolman', 'cors'])->group(function (){
    Route::get('/dashboard/toolman', [Toolman::class, 'index'])->name('get.dashboardToolman');
    Route::get('/dashboard/toolman/logout', [AuthPengelola::class, 'logout'])->name('get.logoutToolman');
});
