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
    Route::get('/persona', [GeneralController::class, 'getPersona'])->name('persona');

    Route::get('admin', [AdminController::class, 'showAdmin'])->name('admin');
    Route::get('admin/user', [AdminController::class, 'showUsers'])->name('admin.user');
    Route::get('admin/category', [AdminController::class, 'showCategory'])->name('admin.category');
    Route::get('admin/product', [AdminController::class, 'showProduct'])->name('admin.product');
    Route::post('admin', [AdminController::class, 'setFields'])->name('set-fields');

    Route::resource('product', ProductController::class);

    Route::post('product', [ProductController::class, 'index'])->name('set-filter');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');


});

Route::get('/register', [AuthController::class, 'register',])->name('reg');
Route::post('/register', [AuthController::class, 'authorization',])->name('register');

Route::get('/login', [AuthController::class, 'sign_in'])->name('sign_in');
Route::post('/login', [AuthController::class, 'login',])->name('login');

Route::get('/logout', [AuthController::class, 'logout',])->name('logout');
