<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/url/shorten', [UrlController::class, 'shorten'])->name('url.shorten');
Route::get('/url/{shortUrl}', [UrlController::class, 'redirect'])->name('url.redirect');

Route::middleware('auth')->group(function () {
    Route::post('/url/delete/{id}', [UrlController::class, 'delete'])->name('url.delete');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';
