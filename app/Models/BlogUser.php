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
        'userName', 'email', 'providerType', 'oAuthID'
    ];
}
