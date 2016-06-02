<?php

use Zhuzhichao\LaravelDbDict\Controllers\DictController;

Route::group([
    'prefix'     => 'laravel-db-dict',
    //'middleware' => 'web',
    //'middleware' => config('laravel-sms.middleware', 'web'),
], function () {
    Route::get('/', DictController::class.'@index');
});