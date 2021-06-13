<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
// Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Grup
Route::group(['middleware' => ['auth','checkroles:ADMIN']], function(){

    Route::prefix('/admin')->group(function(){
        Route::get('/input', [AdminController::class, 'input'])->name('input');
        Route::get('/laporan', [AdminController::class, 'report'])->name('input');
    });
    Route::get('/pageInputBuku', [HomeController::class, 'pageInputBuku'])->name('pageInputBuku');
    Route::get('/pageInputDistributor', [HomeController::class, 'pageInputDistributor'])->name('pageInputDistributor');
});

Route::group(['middleware' => ['auth','checkroles:KASIR']], function(){
    // Route::get('/pageInputBuku', [HomeController::class, 'pageInputBuku'])->name('pageInputBuku');
    // Route::get('/pageInputDistributor', [HomeController::class, 'pageInputDistributor'])->name('pageInputDistributor');
});

Route::group(['middleware' => ['auth','checkroles:MANAGER']], function(){
    Route::prefix('/manager')->group(function(){
        Route::get('/laporan', [ManagerController::class, 'report'])->name('report');
        Route::get('/user', [ManagerController::class, 'user'])->name('user');
        Route::get('/setting', [ManagerController::class, 'setting'])->name('setting');

        Route::post('/create-user', [ManagerController::class, 'createUser'])->name('create-user');
        Route::patch('/update-profile', [ManagerController::class, 'updateProfile'])->name('update-profile');
    });
});

Route::group(['middleware' => ['auth','checkroles:ADMIN,KASIR,MANAGER']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});