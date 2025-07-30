<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blogCategory';
    protected $primaryKey = 'categoryID';
    public $timestamps = false;

    protected $fillable = ['categoryName', 'typeDescription'];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'categoryID', 'categoryID');
    }

    public function updateRequests()
    {
        return $this->hasMany(UpdateBlogRequest::class, 'categoryID', 'categoryID');
    }
}
