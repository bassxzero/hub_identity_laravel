<?php

namespace HubIdentity\Providers;

use HubIdentity\Services\HubIdentityGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use HubIdentity\Providers\HubIdentityUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('hub-identity-users', function ($app, array $config) {
            return new HubIdentityUserProvider();
        });

        Auth::extend('hub-identity', function ($app, $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
            return $app->make(
                HubIdentityGuard::class,
                [
                    'name' => 'hubidentity',
                    'provider' => app()->make(HubIdentityUserProvider::class)
                ]
            );
        });
    }
}
