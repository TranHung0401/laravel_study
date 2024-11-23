<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

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
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/san-pham',[HomeController::class,'product'])->name('product');

// Nguoi dung

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class,'index']);
});