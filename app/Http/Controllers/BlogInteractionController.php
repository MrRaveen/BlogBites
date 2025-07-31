<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogLike;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedBlog;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Cache;

class BlogInteractionController extends Controller
{
    public function toggleSave($id)
{
    $userId = Auth::id();

    $existing = SavedBlog::where('userID', $userId)
                         ->where('blogID', $id)
                         ->first();

    if ($existing) {
        $existing->delete();
        $message = 'Post removed from saved.';
    } else {
        SavedBlog::create([
            'userID' => $userId,
            'blogID' => $id
        ]);
        $message = 'Post saved.';
    }

    // Optional: Clear cache if saved posts are cached
    // Cache::forget('saved_posts_user_' . $userId);

    return back()->with('success', $message);
}
    public function deleteComment($commentID)
{
    $comment = BlogComment::findOrFail($commentID);

    // Only allow owner to delete
    if ($comment->userID !== Auth::id()) {
        return back()->with('error', 'Unauthorized.');
    }

    $comment->delete();
    Cache::flush();
    return back()->with('success', 'Comment deleted.');
}
    public function comment(Request $request, $id)
{
    $request->validate([
        'commentDescription' => 'required|string|max:500'
    ]);

    $blog = \App\Models\Blog::findOrFail($id);

    $blog->comments()->create([
        'userID' => Auth::id(),
        'commentDescription' => $request->commentDescription
    ]);
    Cache::flush();
    return back()->with('success', 'Comment added!');
}

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
   public function DashboardPageLike($id)
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
   return redirect()->route('dashboard')->with('success', $message);
}
}
