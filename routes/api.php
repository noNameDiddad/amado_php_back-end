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


Route::get('/register', [ApiController::class, 'registerToken'])->name('registerToken');

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('product')->middleware('auth:sanctum')->group(function () {
    Route::get('/all', [ApiController::class, 'getProductsAll'])->name('getProductsAll');
    Route::get('/news', [ApiController::class, 'getProductsNews'])->name('getProductsNews');
});
