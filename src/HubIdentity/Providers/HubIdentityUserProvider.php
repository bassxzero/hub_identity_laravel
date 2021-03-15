<?php

namespace HubIdentity\Providers;

use App\Models\HubIdentityUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Http;


class HubIdentityUserProvider implements UserProvider
{


    public function __construct()
    {
    }


    public function retrieveById($identifier) {

        $url = env('HUBIDENTITY_URL') . '/api/v1/users/' . $identifier;

        $response = Http::withHeaders(
            [
                'x-api-key' => env('HUBIDENTITY_PRIVATE')
            ]
        )->get($url);

        $body_json = $response->json();

        $t = new HubIdentityUser();
        $t->uid = $body_json['uid'];

        return $t;
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

