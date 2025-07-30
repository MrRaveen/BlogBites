<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

use App\Models\BlogUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class SocialLoginController extends Controller
{
    public function toProvider($driver){
        return Socialite::driver($driver)->redirect();
    }
    // public function handleCallBack($driver): RedirectResponse{
    //    return redirect()->route('dashboard2');
    // }
    public function handleCallBack($driver): RedirectResponse
    {
        $socialUser = Socialite::driver($driver)->user();
    $user = BlogUser::firstOrCreate([
        'email' => $socialUser->getEmail(),
    ], [
        'userName' => $socialUser->getName() ?? 'Unknown',
        'providerType' => strtoupper($driver),
        'oAuthID' => $socialUser->getId(),
    ]);

    // Assign default role if new
    if (!$user->hasAnyRole(['reader', 'admin', 'writter'])) {
        $user->assignRole('reader');
    }

    Auth::login($user); // logs in via Laravel's Auth

    return redirect()->route('dashboard'); // or wherever
   }
}
