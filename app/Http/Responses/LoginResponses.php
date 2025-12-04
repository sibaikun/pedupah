<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Debug
        \Log::info('=== CustomLoginResponse CALLED ===');
        \Log::info('User Data:', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'its_admin' => $user->its_admin,
            'type' => gettype($user->its_admin)
        ]);

        // Konversi ke integer untuk memastikan
        $isAdmin = (int) $user->its_admin;

        if ($isAdmin === 1) {
            \Log::info('✅ Redirecting to ADMIN dashboard');
            return redirect()->route('admin.dashboard');
        }

        \Log::info('✅ Redirecting to USER dashboard');
        return redirect()->route('dashboard');
    }
}