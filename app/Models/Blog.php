<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'blogID';
    public $timestamps = false;

    protected $fillable = ['title', 'content', 'imageURL', 'categoryID', 'ownerID', 'blogStatus', 'lastUpdatedDate'];

    public function owner()
    {
        return $this->belongsTo(BlogUser::class, 'ownerID', 'userID');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'categoryID', 'categoryID');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blogID', 'blogID');
    }

    public function likes()
    {
        return $this->hasMany(BlogLike::class, 'blogID', 'blogID');
    }

    public function savedByUsers()
    {
        return $this->hasMany(SavedBlog::class, 'blogID', 'blogID');
    }

    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'blogID', 'blogID');
    }

    public function updateRequests()
    {
        return $this->hasMany(UpdateBlogRequest::class, 'blogID', 'blogID');
    }

    public function approvals()
    {
        return $this->hasMany(BlogApprovedHistory::class, 'blogID', 'blogID');
    }
}
