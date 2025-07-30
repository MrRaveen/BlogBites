<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class BlogUser extends Authenticatable
{
    use HasRoles;
    protected $table = 'blogUsers';
    protected $primaryKey = 'userID';
    public $timestamps = false;
    protected $guard_name = 'web';
    protected $fillable = [
        'userName', 'email', 'providerType', 'oAuthID','profileImage'
    ];
    //get profile image
public function getProfileImageAttribute($value)
{
    //TODO: ADD AN IMAGE
    return $value ?: asset('images/default-profile.png');
}
//get user ID
   public function getAuthIdentifierName()
    {
        return 'userID';
    }
//get user name
    public function getNameAttribute()
    {
        return $this->userName;
    }
//get email
    public function getEmailAttribute($value)
    {
        return $value;
    }
    // Relationships
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'ownerID', 'userID');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'userID', 'userID');
    }

    public function likes()
    {
        return $this->hasMany(BlogLike::class, 'userID', 'userID');
    }

    public function savedBlogs()
    {
        return $this->hasMany(SavedBlog::class, 'userID', 'userID');
    }

    public function updateRequests()
    {
        return $this->hasMany(UpdateBlogRequest::class, 'userID', 'userID');
    }

    public function approvedUpdates()
    {
        return $this->hasMany(UpdateBlogRequest::class, 'approvedBy', 'userID');
    }

    public function writerRequests()
    {
        return $this->hasMany(WritterRequest::class, 'userID', 'userID');
    }

    public function approvals()
    {
        return $this->hasMany(BlogApprovedHistory::class, 'adminID', 'userID');
    }
}
