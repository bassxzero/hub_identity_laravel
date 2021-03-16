<?php

namespace HubIdentity\Providers;

use HubIdentity\Providers\HubIdentityUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use HubIdentity\Middleware\HubIdentityAuthenticate;
use HubIdentity\Services\HubIdentityGuard;

class HubIdentityServiceProvider extends ServiceProvider
{

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        HubIdentityUserProvider::class => HubIdentityUserProvider::class
    ];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

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


        Auth::provider('hubidentity-user', function ($app, array $config) {
            return app()->make(HubIdentityUserProvider::class);
        });

        Auth::extend('hubidentity', function ($app, $name, array $config) {
            return $app->make(
                HubIdentityGuard::class,
                [
                    'name' => $name,
                    'provider' => app()->make(HubIdentityUserProvider::class)
                ]
            );
        });
    }
}
