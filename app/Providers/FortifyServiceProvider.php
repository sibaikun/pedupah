<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            $userModel = config('auth.providers.users.model');
            $user = (new $userModel)::where('email', $request->email)->first();

            if ($user && \Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // Redirect setelah login
        Fortify::redirects([
            'login' => function () {
                $user = auth()->user();

                if ($user->its_admin == 1) {
                    return '/admin/dashboard';
                }

                return '/dashboard';
            }
        ]);
    }
}
