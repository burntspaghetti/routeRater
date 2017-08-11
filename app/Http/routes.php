<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(array('middleware' => ['auth']), function()
{
    Route::get('/', 'HomeController@home');
    Route::get('/route/{id}', 'RouteController@route');
    Route::post('/rateRoute/{id}', 'RatingController@rateRoute');
    Route::get('/downloadWall', 'RouteController@downloadWall');
    Route::get('/downloadRoute/{id}', 'RouteController@downloadRoute');
    Route::get('/editRequest/{creditRequestID}', 'RequestController@editRequest');
    Route::post('/storeRoute', 'RouteController@storeRoute') ;
    Route::get('/createRoute', 'RouteController@createRoute');
    Route::get('/approve/{id}', 'RouteController@approve');
    Route::get('/remove/{id}', 'RouteController@remove');
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
