<?php

Route::group([
    'prefix' => '/entree',
    'namespace' => 'LearnKit\Entree\Http\Controllers',
    'middleware' => 'web',
], function () {
    Route::get('login', 'Authenticate@login');

    Route::post('acs', 'Authenticate@acs');

    Route::get('sp/metadata', 'Metadata@sp');
});