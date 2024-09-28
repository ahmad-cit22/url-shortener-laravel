<?php

use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/url/shorten', [UrlController::class, 'shortenApi'])->name('api.url.shorten');
Route::get('/url/{shortUrl}', [UrlController::class, 'getOriginalUrlApi'])->name('api.url.original');
Route::delete('/url/delete/{id}', [UrlController::class, 'deleteApi'])->name('api.url.delete');
Route::get('/urls', [UrlController::class, 'listUrlsApi'])->name('api.url.list');
