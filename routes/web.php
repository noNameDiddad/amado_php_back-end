<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [GeneralController::class, 'showProduct',])->name('main');

Route::middleware('auth')->group(function () {
    Route::get('/persona', [GeneralController::class, 'getPersonaData'])->name('persona');

    Route::prefix('admin')->middleware('can:is-admin,\App\Models\User')->group(function () {
        Route::get('/', [AdminController::class, 'showAdmin'])->name('admin');
        Route::get('user', [AdminController::class, 'showUsers'])->name('admin.user');
        Route::get('category', [AdminController::class, 'showCategory'])->name('admin.category');
        Route::get('product', [AdminController::class, 'showProduct'])->name('admin.product');
        Route::post('/', [AdminController::class, 'setFields'])->name('set-fields');
    });
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store')->middleware('can:is-admin,\App\Models\User');
    Route::get('product/{id}/take', [ProductController::class, 'takeProduct'])->name('user_product_add');
});

Route::resource('product', ProductController::class);
Route::post('product', [ProductController::class, 'index'])->name('set-filter');

Route::get('/register', [AuthController::class, 'sign_up',])->name('sign_up');
Route::post('/register', [AuthController::class, 'register',])->name('register');

Route::get('/login', [AuthController::class, 'sign_in'])->name('sign_in');
Route::post('/login', [AuthController::class, 'login',])->name('login');

Route::get('/logout', [AuthController::class, 'logout',])->name('logout');

