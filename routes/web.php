<?php

$reserbath_domain = env('RESERBATH_DOMAIN');
Route::domain($reserbath_domain)->group(function () {
    Route::group(['as' => 'www.', 'namespace' => 'Www'], function () {
        // Route::get('/', 'HomeController@index')->name('index');
        Route::get('{all}', 'HomeController@index')->where('all', '^((?!auth).)*');
        // Route::get('/{any?}', 'HomeController@index')->where('any', '.*');
        // Route::resource('reservations', 'ReservationsController');
    });
});

Route::group(['prefix' => 'auth'], function () {
  Auth::routes();
});
