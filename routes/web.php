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

//Auth0 mise en place
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    //$router->group(['prefix' => 'api/v1', 'middleware' => 'auth'], function () use ($router) {
        $router->get('family', ['uses' => 'FamilyController@showAll']);
        $router->get('family/{id}', ['uses' => 'FamilyController@showOne']);
        $router->post('family', ['uses' => 'FamilyController@create']);
        $router->delete('family/{id}', ['uses' => 'FamilyController@delete']);
        $router->put('family/{id}', ['uses' => 'FamilyController@update']);
        $router->patch('family/{id}', ['uses' => 'FamilyController@update']);
    
        $router->get('user', ['uses' => 'UserController@showAll']);
        $router->get('user/birthdayOfDay', ['uses' => 'UserController@birthdayOfDay']);
        $router->get('user/birthdayOfMonth', ['uses' => 'UserController@birthdayOfMonth']);
        $router->get('user/family/{id}', ['uses' => 'UserController@getByFamily']);
        $router->get('user/{id}', ['uses' => 'UserController@showOne']);
        $router->post('user', ['uses' => 'UserController@create']);
        $router->delete('user/{id}', ['uses' => 'UserController@delete']);
        $router->put('user/{id}', ['uses' => 'UserController@update']);
        $router->patch('user/{id}', ['uses' => 'UserController@update']);
    
        $router->get('package', ['uses' => 'PackageController@showAll']);
        $router->get('package/{id}', ['uses' => 'PackageController@showOne']);
        $router->post('package', ['uses' => 'PackageController@create']);
        $router->delete('package/{id}', ['uses' => 'PackageController@delete']);
        $router->put('package/{id}', ['uses' => 'PackageController@update']);
        $router->patch('package/{id}', ['uses' => 'PackageController@update']);
    
        $router->get('subscription', ['uses' => 'SubscriptionController@showAll']);
        $router->get('subscription/{id}', ['uses' => 'SubscriptionController@showOne']);
        $router->get('subscription/package/{id}', ['uses' => 'SubscriptionController@getByPackage']);
        $router->get('subscription/package/{id}/end/{year}', ['uses' => 'SubscriptionController@getByPackage']);
        $router->post('subscription', ['uses' => 'SubscriptionController@create']);
        $router->delete('subscription/{id}', ['uses' => 'SubscriptionController@delete']);
        $router->put('subscription/{id}', ['uses' => 'SubscriptionController@update']);
        $router->patch('subscription/{id}', ['uses' => 'SubscriptionController@update']);
    
        $router->get('game/filter', ['uses' => 'GameController@filter']);
        $router->get('game', ['uses' => 'GameController@showAll']);
        $router->get('game/{id}', ['uses' => 'GameController@showOne']);
        $router->post('game', ['uses' => 'GameController@create']);
        $router->delete('game/{id}', ['uses' => 'GameController@delete']);
        $router->put('game/{id}', ['uses' => 'GameController@update']);
        $router->patch('game/{id}', ['uses' => 'GameController@update']);

        $router->get('image/avatar/{filename}', ['uses' => 'ImageController@displayAvatar']);
        $router->get('image/logo/{filename}', ['uses' => 'ImageController@displayLogo']);
    });