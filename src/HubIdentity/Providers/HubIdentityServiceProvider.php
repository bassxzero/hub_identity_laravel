<?php

namespace HubIdentity\Providers;

use Illuminate\Support\ServiceProvider;

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
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
