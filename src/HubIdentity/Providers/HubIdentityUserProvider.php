<?php

namespace HubIdentity\Providers;

use HubIdentity\Models\HubIdentityUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use GuzzleHttp\Client;


class HubIdentityUserProvider implements UserProvider
{

    public function __construct()
    {

    }

    public function retrieveById($identifier) {

        $url = config('hubidentity.url') . '/api/v1/users/' . $identifier;

        $client = new Client();

        $response = $client->request('GET', $url, [
            'headers' => [
                'x-api-key' => config('hubidentity.private_key')
            ]
        ]);

        $body = $response->getBody();

        $string_body = $body->getContents();

        $body_json = json_decode($string_body, true);

        $tempUser = new HubIdentityUser();
        $tempUser->uid = $body_json['uid'];

        return $tempUser;
    }

    public function retrieveByToken($identifier, $token) {
        // Not used
    }

    public function updateRememberToken(Authenticatable $user, $token) {
        // Not used
    }

    public function retrieveByCredentials(array $credentials) {
        // Not used
    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        // Not used
    }
}

