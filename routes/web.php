<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\createBlogController;
use App\Http\Controllers\BlogInteractionController;
use App\Http\Controllers\ViewDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BecomeWritterController;

// Atuth endpoints
Route::get('/socialite/{driver}',[SocialLoginController::class,'toProvider'])->where('driver','github|google');//route for social login
Route::get('/auth/{driver}/login',[SocialLoginController::class,'handleCallBack'])->where('driver','github|google');
//writter endpoints



Route::view('/', 'welcome');
Route::view('/dashboard2', 'dashboard')
    ->name('dashboard2');


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::get('dashboard', [ViewDashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
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
//FIXME: TEST
Route::post('/blog/{id}/comment', [BlogInteractionController::class, 'comment'])->name('blog.comment')->middleware('auth');
//remove comment
Route::delete('/blog/comment/{commentID}', [BlogInteractionController::class, 'deleteComment'])->name('blog.comment.delete');

//like the post (in profile)
Route::post('/blog/{id}/like', [BlogInteractionController::class, 'like'])->name('blog.like');
//like the post (in dashboard)
Route::post('/blog/{id}/Dashboardlike', [BlogInteractionController::class, 'DashboardPageLike'])->name('blog.DashboardLike');

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
//save posts
Route::post('/blog/{id}/save', [BlogInteractionController::class, 'toggleSave'])->name('blog.save')->middleware('auth');
use App\Http\Controllers\ViewSavedPostController;
//view saved posts
Route::get('/saved-posts', [ViewSavedPostController::class, 'index'])
    ->middleware(['auth'])
    ->name('saved.posts');
// logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
    //remove saved post
Route::delete('/saved-posts/{blogID}', [ViewSavedPostController::class, 'removeSave'])
    ->middleware(['auth'])
    ->name('blog.unsave');
//writer request
Route::middleware(['auth'])->group(function () {
    Route::get('/become-writer', [BecomeWritterController::class, 'index'])->name('writer.request.form');
    Route::post('/become-writer', [BecomeWritterController::class, 'store'])->name('writer.request.submit');
});
require __DIR__.'/auth.php';
