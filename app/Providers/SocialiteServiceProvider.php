<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use App\Providers\MicrosoftSocialiteProvider;

class SocialiteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $socialite = $this->app->make(Factory::class);
        
        $socialite->extend('microsoft', function ($app) use ($socialite) {
            $config = $app['config']['services.microsoft'];
            
            return $socialite->buildProvider(MicrosoftSocialiteProvider::class, $config);
        });
    }
}