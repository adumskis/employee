<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->get('employees', ['uses' => 'EmployeesController@index']);
$router->get('employees/{id}', ['uses' => 'EmployeesController@show']);
$router->post('employees', ['uses' => 'EmployeesController@store']);
$router->put('employees/{id}', ['uses' => 'EmployeesController@update']);
$router->delete('employees/{id}', ['uses' => 'EmployeesController@remove']);
