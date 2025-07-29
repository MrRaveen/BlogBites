<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;

Route::get('/socialite/{driver}',[SocialLoginController::class,'toProvider'])->where('driver','github|google');//route for social login
Route::get('/auth/{driver}/login',[SocialLoginController::class,'handleCallBack'])->where('driver','github|google');

Route::view('/', 'welcome');
Route::view('/dashboard2', 'dashboard')
    ->name('dashboard2');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
