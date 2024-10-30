<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', [BukuController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });
   

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', [
        'name' => 'Yusuf Catur Saputro',
        'email' => 'yusuf@gmail.com'
    ]);
});

// Route::get('/posts', [PostController::class, 'index']);

Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/create', [BukuController::class, 'create'])->name('create');
Route::post('/buku', [BukuController::class, 'store'])->name('store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('destroy');
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('edit');
Route::post('/buku/{id}', [BukuController::class, 'update'])->name('update');
Route::get('/buku/search',[BukuController::class, 'search'])->name('search');

