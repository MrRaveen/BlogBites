<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritterRequest extends Model
{
    protected $table = 'writterRequest';
    protected $primaryKey = 'writterRequestID';
    public $timestamps = false;

    protected $fillable = ['requestSatus', 'userID'];

    public function user()
    {
        return $this->belongsTo(BlogUser::class, 'userID', 'userID');
    }
}
