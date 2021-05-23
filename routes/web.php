<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Front\PageController;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::group(['prefix'=>'admin'],function(){
    Route::get('/',function(){
        return redirect(route('admin.login'));
    });
    Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
    Route::post('auth',[AdminLoginController::class,'auth'])->name('admin.auth');
    Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');
});


Route::group(['middleware'=>'admin_auth','prefix'=>'admin'], function () {
    Route::get('dashboard',[AdminLoginController::class,'dashboard'])->name('admin.dashboard');
    Route::post('order',[OrderController::class,'change'])->name('order.change');
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('sub-sub-category',SubSubCategoryController::class);
});

Route::group(['prefix'=>'category'],function(){
    Route::get('/{category_slug}',[PageController::class,'showCategory'])->name('category');
    Route::get('/{category_slug}/{sub_category_slug}',[PageController::class,'showSubCategory'])->name('category.subcategory');
    Route::get('/{category_slug}/{sub_category_slug}/{sub_sub_category_slug}',[PageController::class,'showSubSubCategory'])->name('category.subcategory.subcategory');
});

