<?php

use App\Http\Controllers\BukuController;
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