<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$reserbath_domain = env('RESERBATH_DOMAIN');
Route::domain($reserbath_domain)->group(function () {
    Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
        Route::resource('reservations', 'ReservationsController');
        // Route::get('/reservations', 'ReservationsController@index');
        // Route::get('/reservations/{reservation}', 'ReservationsController@show');
        // Route::get('/reservations/{reservation}/edit', 'ReservationsController@edit');

        // Route::post('/reservations', 'ReservationsController@store');
        // Route::put('/reservations', 'ReservationsController@update');

        // Route::get('{all}', 'HomeController@index')->where('all', '^((?!auth).)*');
    });
});