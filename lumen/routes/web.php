<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    // dd(app('config')->get('database'));
    return $router->app->version();
});

$router->get('user/{id}/profile', ['as' => 'profile', function ($id) {
    $url = route('profile', ['id' => 1]);
    dd($url);
}]);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/post/{id}', function (Request $request, $id) {
        dd($id);
    });

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });
});