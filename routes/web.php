<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HoaController as AdminHoaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HoaController;
use App\Http\Middleware\CheckAuth;
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

Route::get('/home',[HoaController::class, 'index'])->name('hoas.index');
Route::get('/detail/{id}',[HoaController::class, 'detail'])->name('hoas.detail');
Route::get('/category/{id}',[HoaController::class, 'listSP'])->name('hoas.listSP');


// category
Route::get('/category/{id}', [HoaController::class, 'listSP'])->name('category.index');


//Login, register, logout
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');



Route::middleware(['auth', CheckAuth::class])->prefix('/admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('admin');
    Route::resource('categories',  CategoryController::class);
    Route::get('categories/{category}/products', [CategoryController::class, 'products'])->name('categories.products');
    Route::resource('products', AdminHoaController::class);
    Route::get('products/{hoa}/products', [HoaController::class, 'products'])->name('products.products');
    Route::resource('users', UserController::class);
    Route::resource('admin', DashboardController::class);
});

