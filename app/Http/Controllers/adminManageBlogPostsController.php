<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class AdminManageBlogPostsController extends Controller
{
    // public function index()
    // {
    //     $blogs = Blog::with(['owner', 'category'])->get();
    //     return view('adminManageBlogPostView', compact('blogs'));
    // }
public function index()
   {
    $blogs = Cache::remember('admin_blogs', now()->addMinutes(10), function () {
        return Blog::with(['owner', 'category'])->get();
    });

    return view('adminManageBlogPostView', compact('blogs'));
  }

    public function edit($blogID)
    {
        $blog = Blog::with(['tags', 'category'])->findOrFail($blogID);
        $categories = BlogCategory::all();
        return view('adminEditBlogPostView', compact('blog', 'categories'));
    }

    public function update(Request $request, $blogID)
    {
        $blog = Blog::findOrFail($blogID);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'categoryID' => 'required|exists:blogCategory,categoryID',
        ]);

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->categoryID = $request->categoryID;
        $blog->lastUpdatedDate = now();

        if ($request->hasFile('image')) {
            if ($blog->imageURL && Storage::exists($blog->imageURL)) {
                Storage::delete($blog->imageURL);
            }

            // $imagePath = $request->file('image')->store('public/blog-images');
            if ($request->hasFile('image')) {
    if ($blog->imageURL && Storage::exists('public/' . $blog->imageURL)) {
        Storage::delete('public/' . $blog->imageURL);
    }

    // $image = $request->file('image');
    // $filename = uniqid() . '.' . $image->getClientOriginalExtension();

    // $resizedImage = Image::make($image)->resize(800, 450)->encode(); // Resize for optimization
    // Storage::put("public/blog-images/{$filename}", $resizedImage);

    // $blog->imageURL = "blog-images/{$filename}";
     $image = $request->file('image');
$filename = uniqid('blog_') . '.' . $image->getClientOriginalExtension();
Storage::disk('public')->putFileAs('blog-images', $image, $filename);
$imagePath = "blog-images/$filename";
}
            $blog->imageURL = str_replace('public/', '', $imagePath);
        }

        $blog->save();
        Cache::forget('admin_blogs');
        return redirect()->route('admin.manage.posts')->with('success', 'Blog updated successfully.');
    }

    public function destroy($blogID)
    {
        $blog = Blog::findOrFail($blogID);

        if ($blog->imageURL && Storage::exists($blog->imageURL)) {
            Storage::delete($blog->imageURL);
        }

        $blog->delete();
        Cache::forget('admin_blogs');
        return back()->with('success', 'Blog deleted successfully.');
    }

    public function toggleStatus($blogID)
    {
        $blog = Blog::findOrFail($blogID);
        $blog->blogStatus = $blog->blogStatus === 'published' ? 'unpublished' : 'published';
        $blog->save();

        return back()->with('success', 'Blog status updated.');
    }
}
