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

$router->post('/register', 'UserController@register_user');
$router->post('/login', 'UserController@login_users');

$router->get('/users', 'UserController@get_users');
$router->get('/name', 'UserController@get_name');
$router->get('/roles', 'UserController@get_roles');

$router->get('/search_user', 'UserController@search_user');
$router->put('/users/{id}', 'UserController@update_user');

$router->delete('/users/{id}', 'UserController@delete_user');

