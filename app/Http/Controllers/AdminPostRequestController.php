<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class AdminPostRequestController extends Controller
{
    public function index()
    {
        $pendingBlogs = Blog::with('owner', 'category')
            ->where('blogStatus', 'pending')
            ->get();

        return view('adminViewPostRequests', compact('pendingBlogs'));
    }

    public function approve($blogID)
    {
        $blog = Blog::findOrFail($blogID);
        $blog->blogStatus = 'approved';
        $blog->save();

        return redirect()->back()->with('success', 'Blog approved.');
    }

    public function reject($blogID)
    {
        $blog = Blog::findOrFail($blogID);
        $blog->blogStatus = 'rejected';
        $blog->save();

        return redirect()->back()->with('error', 'Blog rejected.');
    }
}

