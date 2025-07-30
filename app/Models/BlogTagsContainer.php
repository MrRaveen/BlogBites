<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTagsContainer extends Model
{
    protected $table = 'blogTagsContainer';
    protected $primaryKey = 'tagID';
    public $timestamps = false;

    protected $fillable = ['tagName', 'tagDescription'];

    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'tagID', 'tagID');
    }
}
