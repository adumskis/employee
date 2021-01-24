<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('employees', ['uses' => 'EmployeesController@index']);
    $router->get('employees/{id}', ['uses' => 'EmployeesController@show']);
    $router->post('employees', ['uses' => 'EmployeesController@store']);
    $router->put('employees/{id}', ['uses' => 'EmployeesController@update']);
    $router->delete('employees/{id}', ['uses' => 'EmployeesController@remove']);
});
