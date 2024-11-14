<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/',[AuthController::class,'login'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/registerUser',[AuthController::class,'registerUser'])->name('registerUser');
Route::post('/loginUser',[AuthController::class,'loginUser'])->name('loginUser');


Route::middleware(['auth'])->group(function () {
  // these are crud routes
Route::get('/index',[AuthController::class,'index'])->name('index');
Route::get('/createPost',[AuthController::class,'createPost'])->name('createPost');
Route::post('/storePost',[AuthController::class,'storePost'])->name('storePost');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

});
