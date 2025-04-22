<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;

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

// Front
Route::get('/', [FrontHomeController::class, 'index']);

Route::prefix('shop')->group(function() {
    Route::get('/product/{id}', [ShopController::class, 'show']);
    Route::post('/product/{id}', [ShopController::class, 'postComment']);
    Route::get('', [ShopController::class, 'index']);
    Route::get('/category/{categoryName}', [ShopController::class, 'category']);
});

Route::prefix('cart')->group(function() {
    Route::get('/',[CartController::class, 'index']);
    Route::get('add',[CartController::class, 'add']);
    Route::get('delete',[CartController::class, 'delete']);
    Route::get('destroy',[CartController::class, 'destroy']);
    Route::get('update',[CartController::class, 'update']);
});

Route::prefix('checkout')->group(function() {
    Route::get('',[CheckoutController::class, 'index']);
    Route::post('/',[CheckoutController::class, 'addOrder']);
    Route::get('/result',[CheckoutController::class, 'result']);
    Route::get('/vnPayCheck',[CheckoutController::class, 'vnPayCheck']);
});

Route::prefix('account')->group(function() {
    Route::get('/login',[AccountController::class, 'login']);
    Route::post('/login',[AccountController::class, 'checkLogin']);
    Route::get('/logout',[AccountController::class, 'logout']);
    Route::get('/register',[AccountController::class, 'register']);
    Route::post('/register',[AccountController::class, 'postRegister']);
    Route::prefix('my-order')->middleware('CheckMemberLogin')->group(function() {
        Route::get('',[AccountController::class,'myOrderIndex']);
        Route::get('/{id}',[AccountController::class,'myOrderShow']);
    });
});

// Admin

Route::prefix('admin')->middleware('CheckAdminLogin')->group(function(){
    Route::redirect('', 'admin/user', 301);

    Route::resource('/user', UserController::class);
    Route::resource('/category', ProductCategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/product/{product_id}/image', ProductImageController::class);
    Route::resource('/product/{product_id}/detail', ProductDetailController::class);

    Route::prefix('login')->withoutMiddleware('CheckAdminLogin')->group(function(){
        Route::get('',[AdminHomeController::class,'getLogin']);
        Route::post('',[AdminHomeController::class,'postLogin']);
    });

    Route::get('/logout',[AdminHomeController::class,'logout']);
});