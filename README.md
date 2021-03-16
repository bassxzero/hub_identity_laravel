# HubIdentityLaravel

An Laravel Package designed to make implementing HubIdentity authentication easy and fast.
In order to use this package you need to have an account with [HubIdentity](https://stage-identity.hubsynch.com/)

Currently this is only for [Hivelocity](https://www.hivelocity.co.jp/) uses. If you have a
commercial interest please contact the Package Manager Erin Boeger through linkedIn or Github or
through [Hivelocity](https://www.hivelocity.co.jp/contact/).

## Installation

The package can be installed by adding the following to your `composer.json`:

```composer
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/bassxzero/hub_identity_laravel.git"
    }
  ],
  "require": {
    "bassxzero/hub_identity_laravel": "0.0.*"
  }
}
```

Then run `composer update`
## Setup

Publish the default config file

```php
php artisan vendor:publish --provider="HubIdentity\Providers\HubIdentityServiceProvider"
```

Add the `hubidentity` guard to your `auth.conf`

```php
'guards' => [        
        'hubidentity' => [
            'driver' => 'hubidentity',
            'provider' => 'hubidentity-user',
        ],        
    ],
```

Add the following variables to your environment in `.env`

```php
HUBIDENTITY_URL=https://stage-identity.hubsynch.com
HUBIDENTITY_PUBLIC=pub_<your hubidentity service's public key>
HUBIDENTITY_PRIVATE=prv_<your hubidentity service's private key>
HUBIDENTITY_REDIRECT_URL=<your hubidentity service's redirect url>
```



## Example usage


Require a user must be logged in by adding the `auth.hubidentity` middleware to a route.

```php
Route::get('/secure', 'SecureController@displaySecureContent')
    ->name('secure')
    ->middleware('auth.hubidentity');
```


Access the authenticated user with the Auth facade.

```php
echo Auth::user()->uid;
```
