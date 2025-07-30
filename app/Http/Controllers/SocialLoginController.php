<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
class SocialLoginController extends Controller
{
    public function toProvider($driver){
        return Socialite::driver($driver)->redirect();
    }
    public function handleCallBack($driver): RedirectResponse{
       //return redirect()->route('dashboard2');
    }
}
