<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTagsContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\SavedBlog;
use Illuminate\Support\Facades\Storage;
use App\Models\BlogLike;


class CreateBlogController extends Controller
{
    public function create()
    {
        return view('createBlog', [
            'allCategories' => BlogCategory::all(),
            'allTags' => BlogTagsContainer::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'categoryID' => 'required|exists:blogCategory,categoryID',
            'tags' => 'array|nullable'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('blog-images', 'public') : null;

        $blog = Blog::create([
    'title' => $validated['title'],
    'slug' => Str::slug($validated['title']) . '-' . uniqid(),
    'content' => $validated['content'],
    'imageURL' => $imagePath,
    'categoryID' => $validated['categoryID'],
    'ownerID' => Auth::id(),
    'blogStatus' => 'PENDING',
    'lastUpdatedDate' => now(),
]);

        if ($request->filled('tags')) {
            $blog->tags()->sync($validated['tags']);
        }
        Cache::forget('bloguser_profile_' . Auth::id());
        return redirect()->route('dashboard')->with('success', 'Blog created successfully!');
    }

//     public function profile()
// {
//     //FIXME: TEST
//     $likedBlogIDs = BlogLike::where('userID', Auth::id())->pluck('blogID')->toArray();
//     $user = BlogUser::withCount('blogs')->with(['blogs' => function ($q) {
//         $q->latest()->withCount('likes')->with('tags')->with('category')->withCount('likes');
//     }])->findOrFail(Auth::id());

//     //FIXME: TEST
//     // return view('profile', ['profile' => $user]);
//     return view('profile', ['profile' => $user, 'likedBlogIDs' => $likedBlogIDs]);

// }
public function profile()
{
    $user = BlogUser::withCount('blogs')->with(['blogs' => function ($q) {
        $q->latest()
          ->withCount('likes') // count likes
          ->with('tags')
          ->with('category');
    }])->findOrFail(Auth::id());

    // 🆕 Get liked blog IDs for the current user
    $likedBlogIDs = BlogLike::where('userID', Auth::id())->pluck('blogID')->toArray();

    return view('profile', [
        'profile' => $user,
        'likedBlogIDs' => $likedBlogIDs
    ]);
}
public function show($slug)
{
    $blog = Cache::remember("blog:{$slug}", now()->addMinutes(10), function () use ($slug) {
    return Blog::with(['owner', 'tags', 'category', 'comments.user', 'likes'])
               ->where('slug', $slug)
               ->firstOrFail();
});
    return view('profile', compact('blog'));
}

public function showSingleFun($slug)
{
    // Cache key
    $cacheKey = 'blog_slug_' . $slug;

    // Try to get from cache
    $blog = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($slug) {
        return Blog::where('slug', $slug)
            ->where('blogStatus', 'APPROVED')
            ->with([
                'owner:userID,userName',
                'category:categoryID,categoryName',
                'tags:tagID,tagName',
                'comments.user:userID,userName',
                'likes',
                'savedByUsers'
            ])
            ->withCount('likes')
            ->firstOrFail();
    });

    return view('viewBlog', compact('blog'));
}
  public function viewSavedPosts()
{
    $userId = Auth::id();

    $savedPosts = SavedBlog::with([
        'blog.owner:userID,userName',
        'blog.category:categoryID,categoryName',
        'blog.tags:tagID,tagName',
        'blog.likes',
    ])
    ->where('userID', $userId)
    ->get()
    ->pluck('blog'); // only get the blog objects

    return view('viewSavedPosts', compact('savedPosts'));
}

public function edit($blogID)
{
    $blog = Blog::where('blogID', $blogID)->where('ownerID', Auth::id())->firstOrFail();
    $allCategories = BlogCategory::all();
    $allTags = BlogTagsContainer::all();

    return view('editBlog', compact('blog', 'allCategories', 'allTags'));
}

public function update(Request $request, $blogID)
{
    $blog = Blog::where('blogID', $blogID)->where('ownerID', Auth::id())->firstOrFail();

    $validated = $request->validate([
        'title' => 'required|max:60',
        'content' => 'required',
        'image' => 'nullable|image|max:2048',
        'categoryID' => 'required|exists:blogCategory,categoryID',
        'tags' => 'array|nullable'
    ]);

    // Handle new image
    if ($request->hasFile('image')) {
        if ($blog->imageURL) {
            Storage::disk('public')->delete($blog->imageURL);
        }
        $imagePath = $request->file('image')->store('blog-images', 'public');
        $blog->imageURL = $imagePath;
    }

    $blog->update([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'categoryID' => $validated['categoryID'],
        'lastUpdatedDate' => now()
    ]);

    if ($request->filled('tags')) {
        $blog->tags()->sync($validated['tags']);
    }

    return redirect()->route('profile')->with('success', 'Blog updated!');
}

public function destroy($blogID)
{
    $blog = Blog::where('blogID', $blogID)->where('ownerID', Auth::id())->firstOrFail();

    if ($blog->imageURL) {
        Storage::disk('public')->delete($blog->imageURL);
    }

    $blog->delete();
    Cache::forget('bloguser_profile_' . Auth::id());
    return redirect()->route('profile')->with('success', 'Blog deleted!');
}

}
