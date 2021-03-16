<?php

use Illuminate\Support\Facades\Route;
use HubIdentity\Controllers\HubIdentityController;


Route::group(['middleware' => 'web'], function () {
    // This route needs the web middleware group or at least needs to run the StartSession middleware
    Route::get(
        config('hubidentity.redirect_url'),
        [HubIdentityController::class,  'sessionCreate']
    )->name('hubidentity-session-create');

    Route::get(
        '/hubidentity-login',
        [HubIdentityController::class,  'login']
    )->name('hubidentity-login');

    Route::get(
        '/hubidentity-logout',
        [HubIdentityController::class,  'logout']
    )->name('hubidentity-logout');
});


