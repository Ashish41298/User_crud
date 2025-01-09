<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserAuthController;
use App\Http\Middleware\Authuser;
use Illuminate\Support\Facades\Route;


Route::middleware([Authuser::class])->group(function(){

    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('/Dashboard', [UserAuthController::class,'Dashboard'])->name('Dashboard');
    Route::get('/logout',[UserAuthController::class,'logout'])->name('logout');
    Route::get('/edit/profile',[UserAuthController::class,'editprofile'])->name('editprofile');
    Route::put('/editprofiledata',[UserAuthController::class,'editprofiledata'])->name('editprofiledata');
    Route::resource('gallery', GalleryController::class);
});

Route::get('/login', [UserAuthController::class,'loginview'])->name('login');
Route::get('/register', [UserAuthController::class,'registerview'])->name('register');

Route::post('/logindata', [UserAuthController::class,'logindata'])->name('logindata');
Route::post('/registerdata', [UserAuthController::class,'registerdata'])->name('registerdata');


//