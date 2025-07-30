<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    protected $table = 'blogLikes';
    protected $primaryKey = 'likeID';
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
