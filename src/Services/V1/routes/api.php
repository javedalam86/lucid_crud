<?php

/*
|--------------------------------------------------------------------------
| Service - API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Prefix: /api/v1
Route::group(['prefix' => 'v1'], function() {

    Route::post('/login', 'UserController@POST_login');
    Route::post('/oauth/token', 'UserController@POST_oauth_token');
    Route::post('/oauth/token-refresh', 'UserController@POST_oauth_refresh_token');



    // The controllers live in src/Services/V1/Http/Controllers
    // Route::get('/', 'UserController@index');

    // Route::get('/', function() {
    //     return response()->json(['path' => '/api/v1']);
    // });
    
    // Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::group(['prefix' => 'users'], function() {
     Route::get('/', 'UserController@index');
     Route::post('/create', 'UserController@create'); 
     Route::get('/view/{id}', 'UserController@show');
     Route::put('/{id}/update', 'UserController@update');
     Route::delete('/{id}/delete', 'UserController@destroy');

    });

});

