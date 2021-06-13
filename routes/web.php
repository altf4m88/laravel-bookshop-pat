<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PasswordController;
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
    return redirect('login');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
// Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Grup
Route::group(['middleware' => ['auth','checkroles:ADMIN']], function(){

    Route::prefix('/admin')->group(function(){

        Route::prefix('/input')->group(function(){
            Route::get('/', [AdminController::class, 'input'])->name('input');
            Route::get('/distributor', [AdminController::class, 'distributor'])->name('distributor');
            Route::get('/book', [AdminController::class, 'book'])->name('book');
            Route::get('/supply', [AdminController::class, 'supply'])->name('supply');
        });
        Route::get('/laporan', [AdminController::class, 'report'])->name('input');
    });
});

Route::group(['middleware' => ['auth','checkroles:KASIR']], function(){
    // Route::get('/pageInputBuku', [HomeController::class, 'pageInputBuku'])->name('pageInputBuku');
    // Route::get('/pageInputDistributor', [HomeController::class, 'pageInputDistributor'])->name('pageInputDistributor');
});

Route::group(['middleware' => ['auth','checkroles:MANAGER']], function(){
    Route::prefix('/manager')->group(function(){

        Route::prefix('/laporan')->group(function(){
            Route::get('/', [ManagerController::class, 'report'])->name('report');
            Route::get('/invoice', [ManagerController::class, 'invoice'])->name('invoice');
            Route::get('/all-sales', [ManagerController::class, 'allSales'])->name('all-sales');
            Route::get('/supply-by-distributor', [ManagerController::class, 'bookSupplyByDistributor'])->name('supply-by-distributor');
            Route::get('/supply', [ManagerController::class, 'bookSupply'])->name('supply');
            Route::get('/books-data', [ManagerController::class, 'booksData'])->name('books-data');
            Route::get('/books-by-writer', [ManagerController::class, 'booksWriter'])->name('books-by-writer');
            Route::get('/popular-books', [ManagerController::class, 'popularBooks'])->name('popular-books');
            Route::get('/unpopular-books', [ManagerController::class, 'unpopularBooks'])->name('unpopular-books');
            Route::get('/sales-by-date', [ManagerController::class, 'salesByDate'])->name('sales-by-date');
        });

        Route::get('/user', [ManagerController::class, 'user'])->name('user');
        Route::get('/setting', [ManagerController::class, 'setting'])->name('setting');

        Route::post('/create-user', [ManagerController::class, 'createUser'])->name('create-user');
        Route::patch('/update-profile', [ManagerController::class, 'updateProfile'])->name('update-profile');
    });
});

Route::group(['middleware' => ['auth','checkroles:ADMIN,KASIR,MANAGER']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/update-password', [PasswordController::class, 'changePassword'])->name('update-password');
    Route::patch('/update-password', [PasswordController::class, 'updatePassword'])->name('update-password');
});