<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
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
            Route::get('/create-distributor', [AdminController::class, 'createDistributorForm'])->name('create-distributor');
            Route::get('/{id}/update-distributor', [AdminController::class, 'updateDistributorForm'])->name('update-distributor');
            Route::get('/{id}/delete-distributor', [AdminController::class, 'deleteDistributor'])->name('delete-distributor');

            Route::get('/book', [AdminController::class, 'book'])->name('book');
            Route::get('/create-book', [AdminController::class, 'createBookForm'])->name('create-book');
            Route::get('/{id}/update-book', [AdminController::class, 'updateBookForm'])->name('update-book');
            Route::get('/{id}/delete-book', [AdminController::class, 'deleteBook'])->name('delete-book');

            Route::get('/supply', [AdminController::class, 'supply'])->name('supply');

            Route::post('/distributor', [AdminController::class, 'createDistributor'])->name('distributor');
            Route::patch('/distributor', [AdminController::class, 'updateDistributor'])->name('distributor');

            Route::post('/book', [AdminController::class, 'createBook'])->name('book');
            Route::patch('/book', [AdminController::class, 'updateBook'])->name('book');
        });
        Route::prefix('/report')->group(function(){
            Route::get('/', [AdminController::class, 'report'])->name('input');
            Route::get('/books', [AdminController::class, 'allBooks'])->name('books');
            Route::get('/books-by-writer', [AdminController::class, 'booksByWriterForm'])->name('books-by-writer');
            Route::post('/books-by-writer', [AdminController::class, 'booksByWriter'])->name('books-by-writer');
            Route::get('/popular-books', [AdminController::class, 'popularBooks'])->name('input');
            Route::get('/unpopular-books', [AdminController::class, 'unpopularBooks'])->name('input');
            Route::get('/books-supply', [AdminController::class, 'getSupply'])->name('books-supply');
            Route::post('/books-supply', [AdminController::class, 'supplyByDate'])->name('books-supply');
            Route::get('/books-supply-filter', [AdminController::class, 'filterByDistributorPage'])->name('boooks-supply-filter');
            Route::post('/books-supply-filter', [AdminController::class, 'filterByDistributor'])->name('books-supply-filter');
        });
    });
});

Route::group(['middleware' => ['auth','checkroles:KASIR']], function(){
    Route::prefix('/cashier')->group(function(){

        Route::prefix('/transaction')->group(function(){
            Route::get('/', [CashierController::class, 'transaction'])->name('transaction');
            Route::get('/view-transaction/{bookId}', [CashierController::class, 'viewTransaction'])->name('view-transaction');
            Route::post('/view-transaction/{bookId}', [CashierController::class, 'createTempTransaction'])->name('create-temp-transaction');   
            Route::post('/view-transaction/{bookId}/create', [CashierController::class, 'createTransaction'])->name('create-transaction'); 
            Route::get('/view-transaction/print/{receipt}', [CashierController::class, 'printTransaction'])->name('print-transaction'); 
        });

        Route::prefix('/report')->group(function(){
            Route::get('/', [CashierController::class, 'report'])->name('report');
            Route::get('/print-invoice', [CashierController::class, 'invoice'])->name('print-invoice');
            Route::post('/print-invoice', [CashierController::class, 'selectInvoice'])->name('print-invoice');
            Route::get('/all-transactions', [CashierController::class, 'transactions'])->name('all-transactions');
        });
    });
});

Route::group(['middleware' => ['auth','checkroles:MANAGER']], function(){
    Route::prefix('/manager')->group(function(){

        Route::prefix('/report')->group(function(){
            Route::get('/', [ManagerController::class, 'report'])->name('report');

            Route::get('/supply-by-distributor', [ManagerController::class, 'bookSupplyByDistributor'])->name('supply-by-distributor');
            Route::post('/supply-by-distributor', [ManagerController::class, 'filterByDistributor'])->name('supply-by-distributor');
            Route::get('/supply', [ManagerController::class, 'bookSupply'])->name('supply');
            Route::post('/supply', [ManagerController::class, 'supplyByDate'])->name('supply');
            Route::get('/books-data', [ManagerController::class, 'booksData'])->name('books-data');
            Route::get('/books-by-writer', [ManagerController::class, 'booksWriter'])->name('books-by-writer');
            Route::post('/books-by-writer', [ManagerController::class, 'booksByWriter'])->name('books-by-writer');
            Route::get('/popular-books', [ManagerController::class, 'popularBooks'])->name('popular-books');
            Route::get('/unpopular-books', [ManagerController::class, 'unpopularBooks'])->name('unpopular-books');

            Route::get('/invoice', [ManagerController::class, 'invoice'])->name('invoice');
            Route::post('/invoice', [ManagerController::class, 'selectInvoice'])->name('print-invoice');
            Route::get('/invoice/{receipt}', [CashierController::class, 'printTransaction'])->name('print-transaction'); 
            Route::get('/transactions', [ManagerController::class, 'transactions'])->name('all-transactions');

            Route::get('/{id}/update-book', [ManagerController::class, 'updateBookForm'])->name('update-book');
            Route::get('/{id}/delete-book', [ManagerController::class, 'deleteBook'])->name('delete-book');
            Route::patch('/book', [AdminController::class, 'updateBook'])->name('book');
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