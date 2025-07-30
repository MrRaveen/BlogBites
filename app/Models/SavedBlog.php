<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedBlog extends Model
{
    protected $table = 'savedBlogs';
    protected $primaryKey = 'savedBlogID';
    public $timestamps = false;

    protected $fillable = ['userID', 'blogID'];

    public function user()
    {
        return $this->belongsTo(BlogUser::class, 'userID', 'userID');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogID', 'blogID');
    }
}
