<?php

namespace HubIdentity\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use HubIdentity\Providers\HubIdentityUserProvider;
use HubIdentity\Middleware\HubIdentityAuthenticate;
use HubIdentity\Services\HubIdentityGuard;

class HubIdentityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/hubidentity.php' => config_path('hubidentity.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');


        $this->app['router']->aliasMiddleware('auth.hubidentity', HubIdentityAuthenticate::class);


        Auth::provider('hub-identity-users', function ($app, array $config) {
            return new HubIdentityUserProvider();
        });

        Auth::extend('hub-identity', function ($app, $name, array $config) {
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
