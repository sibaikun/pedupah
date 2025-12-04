<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class LoginSuccessListener
{
    public function handle(Login $event): void
    {
        $user = $event->user;

        session()->put('redirect_to', 
            $user->its_admin == 1 
                ? route('admin.dashboard') 
                : route('dashboard')
        );
    }
}