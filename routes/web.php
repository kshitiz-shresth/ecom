<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubSubCategoryController;
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
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('sub-sub-category',SubSubCategoryController::class);
});
