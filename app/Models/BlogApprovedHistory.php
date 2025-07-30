<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogApprovedHistory extends Model
{
    protected $table = 'blogApprovedHistory';
    protected $primaryKey = 'approvedHistoryID';
    public $timestamps = false;

    protected $fillable = ['adminID', 'blogID'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogID', 'blogID');
    }

    public function admin()
    {
        return $this->belongsTo(BlogUser::class, 'adminID', 'userID');
    }
}
