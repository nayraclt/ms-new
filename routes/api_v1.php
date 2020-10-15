<?php


$router->group(
    [
        'prefix' => 'api/v1/customers',
        'middleware' => 'json_response'
    ], function ($router) {
            $router->get('/', 'CustomerController@all');
            $router->get('/{id}', 'CustomerController@get');
            $router->post('/', 'CustomerController@add');
            $router->put('/{id}', 'CustomerController@update');
            $router->patch('/{id}', 'CustomerController@update');
            $router->delete('/{id}', 'CustomerController@remove');
        }
);
