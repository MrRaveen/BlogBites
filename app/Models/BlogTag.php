<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $table = 'blogTags';
    protected $primaryKey = 'blogTagID';
    public $timestamps = false;

    protected $fillable = ['tagID', 'blogID'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogID', 'blogID');
    }

    public function tag()
    {
        return $this->belongsTo(BlogTagsContainer::class, 'tagID', 'tagID');
    }
}
