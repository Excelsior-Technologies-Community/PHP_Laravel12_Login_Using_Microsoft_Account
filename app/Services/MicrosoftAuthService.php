<?php

namespace App\Services;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\LoginHistory;
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

            LoginHistory::create([

                'user_id' => $user->id,

                'provider' => 'Microsoft',

                'ip_address' => request()->ip(),

                'browser' => request()->header('User-Agent'),

                'device' => php_uname('n'),

                'login_at' => now()

            ]);

            return redirect()
                ->route('dashboard');
        } catch (\Exception $e) {


            return redirect()
                ->route('login')
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }

    private function findOrCreateUser($microsoftUser)
    {


        $user = User::where(
            'email',
            $microsoftUser->getEmail()
        )->first();



        if (!$user) {


            $user = User::create([

                'name' => $microsoftUser->getName(),

                'email' => $microsoftUser->getEmail(),

                'microsoft_id' => $microsoftUser->getId(),

                'avatar' => $microsoftUser->getAvatar(),

                'timezone' => config('app.timezone'),

                'last_synced_at' => now(),

                'password' => Hash::make(uniqid()),

                'email_verified_at' => now()

            ]);
        } else {


            $user->update([


                'name' => $microsoftUser->getName(),

                'microsoft_id' => $microsoftUser->getId(),

                'avatar' => $microsoftUser->getAvatar(),

                'timezone' => config('app.timezone'),

                'last_synced_at' => now()


            ]);
        }


        return $user;
    }
}
