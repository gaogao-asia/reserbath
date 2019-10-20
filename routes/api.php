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
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController', ['only' => ['index']]);
        Route::resource('rooms', 'RoomController');
    });
});