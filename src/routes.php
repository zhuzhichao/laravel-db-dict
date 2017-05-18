<?php

use Zhuzhichao\LaravelDbDict\Controllers\DictController;

Route::group([
    'prefix'     => 'laravel-db-dict',
], function () {
    Route::get('/', [
        'uses' => DictController::class.'@index',
        'as'   => 'db-dict::index'
    ]);
    Route::put('column/{id}', [
        'uses' => DictController::class.'@updateColumn',
        'as'   => 'db-dict::column.update'
    ]);
    Route::put('table/{id}', [
        'uses' => DictController::class.'@updateTable',
        'as'   => 'db-dict::table.update'
    ]);
    Route::post('db-dict-sync', [
        'uses' => DictController::class.'@postDictSync',
        'as'   => 'db-dict::db-dict-sync'
    ]);
});