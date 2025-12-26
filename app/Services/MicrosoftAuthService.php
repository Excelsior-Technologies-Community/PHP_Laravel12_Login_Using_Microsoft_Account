<?php

namespace App\Services;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MicrosoftAuthService
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();
            
            $user = $this->findOrCreateUser($microsoftUser);
            
            Auth::login($user, true);
            
            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Microsoft login failed: ' . $e->getMessage()]);
        }
    }

    private function findOrCreateUser($microsoftUser)
    {
        $user = User::where('email', $microsoftUser->getEmail())->first();
        
        if (!$user) {
            $user = User::create([
                'name' => $microsoftUser->getName(),
                'email' => $microsoftUser->getEmail(),
                'microsoft_id' => $microsoftUser->getId(),
                'password' => Hash::make(uniqid()),
                'email_verified_at' => now(), // Microsoft emails are verified
            ]);
        } else {
            $user->update([
                'microsoft_id' => $microsoftUser->getId(),
                'name' => $microsoftUser->getName(),
            ]);
        }
        
        return $user;
    }
}