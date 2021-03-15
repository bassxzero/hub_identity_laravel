<?php

use Illuminate\Support\Facades\Route;
use HubIdentity\Controllers\HubIdentityController;


Route::get('/sessions/create', HubIdentityController::class . '@sessionCreate')->name('session-create');


