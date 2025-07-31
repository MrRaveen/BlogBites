<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogLike;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogInteractionController extends Controller
{
    public function like($id)
{
    $userId = Auth::id();

    // Check if blog exists
    $blog = Blog::findOrFail($id);

    // Check if already liked
    $existingLike = BlogLike::where('userID', $userId)
        ->where('blogID', $id)
        ->first();

    if ($existingLike) {
        // Unlike
        $existingLike->delete();
        $message = 'Like removed.';
    } else {
        // Like
        BlogLike::create([
            'userID' => $userId,
            'blogID' => $id
        ]);
        $message = 'Blog liked!';
    }

   return redirect()->route('profile')->with('success', $message);
}
}
