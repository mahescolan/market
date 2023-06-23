<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\registerController;



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
Route::get('user/register',[registerController::class,'register'])->name('user.register');
Route::post('user/register',[registerController::class,'regstore'])->name('user.regstore');
Route::get('user/login',[registerController::class,'login'])->name('user.login');
Route::post('user/Login_in',[registerController::class,'Login_in'])->name('user.Login_in');
Route::get('user/logout', [registerController::class, 'logout'])->name('user.logout');
Route::get('user/dashboard',[registerController::class,'dashboard'])->name('user.dashboard');



Route::middleware('auth')->group(function(){

Route::resource('category',categoryController::class);
Route::resource('products', ProductsController::class);

});

