<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blogComments';
    protected $primaryKey = 'commentID';
    public $timestamps = false;

    protected $fillable = ['commentDescription', 'userID', 'blogID'];

    public function user()
    {
        return $this->belongsTo(BlogUser::class, 'userID', 'userID');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogID', 'blogID');
    }
}
