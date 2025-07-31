<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedBlog;


class ViewSavedPostController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $savedPosts = SavedBlog::with([
            'blog.owner:userID,userName',
            'blog.category:categoryID,categoryName',
            'blog.tags:tagID,tagName',
            'blog.likes'
        ])
        ->where('userID', $userId)
        ->get()
        ->pluck('blog');

        return view('viewSavedBlogPosts', compact('savedPosts'));
    }
    public function removeSave($blogID)
{
    $userId = Auth::id();

    SavedBlog::where('userID', $userId)
             ->where('blogID', $blogID)
             ->delete();

    return redirect()->back()->with('success', 'Post removed from saved.');
}
}

