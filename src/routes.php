<?php

use Zhuzhichao\LaravelDbDict\Controllers\DictController;

Route::group([
    'prefix' => 'laravel-db-dict',
    'middleware' => 'web',
], function () {
    Route::get('/', [
        'uses' => DictController::class.'@index',
        'as'   => 'db-dict::index'
    ]);
    Route::put('column/{id}', [
        'uses' => DictController::class.'@update',
        'as'   => 'db-dict::column.update'
    ]);
});