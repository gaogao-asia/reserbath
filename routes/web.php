<?php

$reserbath_domain = env('RESERBATH_DOMAIN');
Route::domain($reserbath_domain)->group(function () {
    Route::group(['as' => 'www.', 'namespace' => 'Www'], function () {
        Route::get('/', 'HomeController@index');
        Route::resource('reservations', 'ReservationsController');
    });
});

Auth::routes();

