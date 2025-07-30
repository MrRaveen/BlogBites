<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateBlogRequest extends Model
{
    protected $table = 'updateBlogRequest';
    protected $primaryKey = 'updateRequestID';
    public $timestamps = false;

    protected $fillable = ['title', 'content', 'imageURL', 'categoryID', 'approvedBy', 'userID', 'blogID', 'requestStatus'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogID', 'blogID');
    }

    public function user()
    {
        return $this->belongsTo(BlogUser::class, 'userID', 'userID');
    }

    public function approver()
    {
        return $this->belongsTo(BlogUser::class, 'approvedBy', 'userID');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'categoryID', 'categoryID');
    }
}
