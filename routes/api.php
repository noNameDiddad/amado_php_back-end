<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/token', [ApiController::class, 'createToken'])->name('createToken');
    Route::get('/', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('product')->middleware('auth:sanctum')->group(function () {
    Route::get('/all', [ApiController::class, 'getProductsAll'])->name('getProductsAll');
    Route::get('/news', [ApiController::class, 'getProductsNews'])->name('getProductsNews');
});
