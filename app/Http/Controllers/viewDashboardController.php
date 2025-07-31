<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogLike;
use Illuminate\Support\Facades\Auth;

class ViewDashboardController extends Controller
{

    public function index()
{
    $blogs = Blog::with([
        'owner:userID,userName',
        'category:categoryID,categoryName',
        'tags:tagID,tagName',
        'likes',
        'comments.user:userID,userName'
    ])
    ->withCount('likes', 'comments')
    ->where('blogStatus', 'APPROVED')
    ->orderByDesc('lastUpdatedDate')
    ->get();

    $likedBlogIDs = Auth::check()
        ? BlogLike::where('userID', Auth::id())->pluck('blogID')->toArray()
        : [];

    return view('dashboard', compact('blogs', 'likedBlogIDs'));
}

}

