<?php

$reserbath_domain = env('RESERBATH_DOMAIN');
Route::domain($reserbath_domain)->group(function () {
    Route::group(['as' => 'www.', 'namespace' => 'Www'], function () {
        Route::get('{all}', 'HomeController@index')->where('all', '^((?!auth).)*');
    });
});

Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
    Route::get('login/{provider}', 'Auth\SocialController@redirectToProvider');
    Route::get('{provider}/callback', 'Auth\SocialController@handleProviderCallback');
});

Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});
