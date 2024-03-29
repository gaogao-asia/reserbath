<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('reservations', ReservationController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('users', UserController::class);
    $router->resource('rooms', RoomController::class);
});
