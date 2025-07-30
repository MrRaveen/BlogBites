<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTagsContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('dashboard')->with('success', 'Blog created successfully!');
    }
}
