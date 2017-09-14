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
//Route::get('/test', function()
//{
//    dd(phpinfo());
//
//});


Route::group(array('middleware' => ['auth']), function()
{
    Route::get('/{color?}', 'RouteController@routes');
    Route::get('/route/{id}', 'RouteController@route');
    Route::post('/rateRoute/{id}', 'RatingController@rateRoute');
    Route::get('/download/wall', 'RouteController@downloadWall');
    Route::get('/downloadRoute/{id}', 'RouteController@downloadRoute');
    Route::post('/store/route', 'RouteController@storeRoute') ;
    Route::get('/create/route', 'RouteController@createRoute');

    Route::group(array('middleware' => ['isAdmin']), function()
    {
        Route::get('/approve/{id}', 'RouteController@approve');
        Route::get('/hide/{id}', 'RouteController@hide');
        Route::get('/delete/{id}', 'RouteController@delete');
    });
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
