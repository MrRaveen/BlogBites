<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\createBlogController;
use App\Http\Controllers\BlogInteractionController;

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

    //create blogs part
Route::get('/create-blog', [createBlogController::class, 'create'])->name('blog.create');
Route::post('/create-blog', [createBlogController::class, 'store'])->name('blog.store');

//post loading
Route::get('/blog/{slug}', [createBlogController::class, 'show'])->name('blog.show');
//single post loading
Route::get('/blogSingle/{slug}', [createBlogController::class, 'showSingleFun'])->name('showSingleBlogsEndpoint');

//like the post
Route::post('/blog/{id}/like', [BlogInteractionController::class, 'like'])->name('blog.like');

Route::get('/saved-posts', [CreateBlogController::class, 'viewSavedPosts'])
    ->middleware(['auth']) // restrict to logged-in users
    ->name('saved.posts');

    //update sections
// Edit blog form
Route::get('/blog/{blogID}/edit', [CreateBlogController::class, 'edit'])->name('blog.edit')->middleware(['auth']);

// Update blog
Route::put('/blog/{blogID}', [CreateBlogController::class, 'update'])->name('blog.update')->middleware(['auth']);

// Delete blog
Route::delete('/blog/{blogID}', [CreateBlogController::class, 'destroy'])->name('blog.delete')->middleware(['auth']);

require __DIR__.'/auth.php';
