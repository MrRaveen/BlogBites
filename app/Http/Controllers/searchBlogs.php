<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class searchBlogs extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');

    $blogs = Blog::with(['owner', 'category', 'tags'])
        ->where('title', 'like', '%' . $query . '%')
        ->orWhereHas('owner', function ($q) use ($query) {
            $q->where('userName', 'like', '%' . $query . '%');
        })
        ->orWhereHas('category', function ($q) use ($query) {
            $q->where('categoryName', 'like', '%' . $query . '%');
        })
        ->orWhereHas('tags', function ($q) use ($query) {
            $q->where('tagName', 'like', '%' . $query . '%');
        })
        ->get();

    return view('searchResults', compact('blogs', 'query'));
}

}
