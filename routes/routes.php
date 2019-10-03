<?php

use Illuminate\Support\Facades\Route;

Route::post('unsubscribe', config('notification-options.controllerPath'))->name('unsubscribe');
