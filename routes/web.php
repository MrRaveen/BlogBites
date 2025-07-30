<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\createBlogController;

// Atuth endpoints
Route::get('/socialite/{driver}',[SocialLoginController::class,'toProvider'])->where('driver','github|google');//route for social login
Route::get('/auth/{driver}/login',[SocialLoginController::class,'handleCallBack'])->where('driver','github|google');
//writter endpoints



Route::view('/', 'welcome');
Route::view('/dashboard2', 'dashboard')
    ->name('dashboard2');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
//go to profile
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware(['auth'])
    ->name('profile');
//go to create blogs part
Route::get('/create-blog', [createBlogController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin|writter'])
    ->name('create.blog');
require __DIR__.'/auth.php';
