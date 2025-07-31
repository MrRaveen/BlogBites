<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function __invoke()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();
    }

    public function render()
    {
        return view('livewire.actions.logout');
    }
}

