<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show($blogID)
    {
        $blog = Blog::with(['owner', 'category', 'tags'])->findOrFail($blogID);
        return view('blogs.show', compact('blog'));
    }
}

