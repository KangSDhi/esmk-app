<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController as Home;
use App\Http\Controllers\Auth\AuthPengelolaController as AuthPengelola;
use App\Http\Controllers\Kesiswaan\KesiswaanController as Kesiswaan;

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

Route::middleware('guest')->group(function (){
    // home routing
    Route::get('/', [Home::class, 'index'])->name('get.home');
    // login pengelola routing
    Route::get('/login-pengelola', [AuthPengelola::class, 'login'])->name('get.loginPengelola');
    Route::post('/login-pengelola', [AuthPengelola::class, 'login'])->name('post.loginPengelola');
});

Route::middleware(['auth:pengelola', 'role:kesiswaan'])->group(function (){
    Route::get('/dashboard/kesiswaan', [Kesiswaan::class, 'index'])->name('get.dashboardKesiswaan');
});
