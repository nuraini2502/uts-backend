<?php

use App\Models\News;
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

    # membuat method get
    Route::get('/news', [NewsController::class, 'index']);

    # menambahkan resource news
    # membuat method post
    Route::post('/news', [NewsController::class, 'store']);

    # mendapatkan detail resource news
    # membuat method get
    Route::get('/news/{id}', [NewsController::class, 'show']);

    # mempebaruhi resource news
    # membuat method put
    Route::put('/news/{id}', [NewsController::class, 'edit']);

    # menghapus resource news
    # membuat method delete
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    # membuat method get search
    Route::get('/news/search/{title}', [NewsController::class, 'search']);

    # membuat method untuk mendapatkan data sport
    Route::get('/news/categoty/sport', [NewsController::class, 'sport']);

    # membuat method untuk mendapatkan data finance
    Route::get('/news/categoty/finance', [NewsController::class, 'finance']);

    # membuat method untuk mendapatkan data automotive
    Route::get('/news/category/automotive', [NewsController::class, 'automotive']);
});