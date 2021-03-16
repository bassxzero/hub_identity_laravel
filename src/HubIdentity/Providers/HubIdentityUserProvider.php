<?php

namespace HubIdentity\Providers;

use HubIdentity\Models\HubIdentityUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Http;


class HubIdentityUserProvider implements UserProvider
{

    public function __construct()
    {

    }

    public function retrieveById($identifier) {

        $url = config('hubidentity.url') . '/api/v1/users/' . $identifier;

        $response = Http::withHeaders(
            [
                'x-api-key' => config('hubidentity.private_key')
            ]
        )->get($url);

        $body_json = $response->json();

        $tempUser = new HubIdentityUser();
        $tempUser->uid = $body_json['uid'];

        return $tempUser;
    }

    public function retrieveByToken($identifier, $token) {

    }

    public function updateRememberToken(Authenticatable $user, $token) {

    }

    public function retrieveByCredentials(array $credentials) {

    }

    public function validateCredentials(Authenticatable $user, array $credentials) {

    }
}

