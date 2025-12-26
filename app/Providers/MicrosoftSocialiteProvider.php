<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class MicrosoftSocialiteProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopeSeparator = ' ';

    protected $scopes = [
        'openid',
        'profile',
        'email',
        'offline_access',
        'User.Read',
    ];

    protected function getAuthUrl($state)
    {
        $tenant = config('services.microsoft.tenant', 'common');
        
        return $this->buildAuthUrlFromBase(
            "https://login.microsoftonline.com/{$tenant}/oauth2/v2.0/authorize",
            $state
        );
    }

    protected function getTokenUrl()
    {
        $tenant = config('services.microsoft.tenant', 'common');
        
        return "https://login.microsoftonline.com/{$tenant}/oauth2/v2.0/token";
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://graph.microsoft.com/v1.0/me',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'name' => $user['displayName'],
            'email' => $user['mail'] ?? $user['userPrincipalName'],
            'avatar' => null,
        ]);
    }
}