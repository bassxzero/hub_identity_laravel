<?php

return [

    // Base url of hubidentity server E.G
    'url' => env('HUBIDENTITY_URL', 'https://stage-identity.hubsynch.com'),

    // This is not used yet
    'version' => env('HUBIDENTITY_VERSION', 'v1'),

    // public key for your hubidentity client service
    'public_key' => env('HUBIDENTITY_PUBLIC'),

    // private key for your hubidentity client service
    'private_key' => env('HUBIDENTITY_PRIVATE'),

    // The URL a successfully authenticated user should be directed to after authentication at HubIdentity.
    'redirect_url' => env('HUBIDENTITY_REDIRECT_URL', '/sessions/create'),

];
