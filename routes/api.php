<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([ 'middleware' => 'api','prefix' => '/v1', 'as' => 'api.'], function () {

    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

    Route::resource('teams', 'TeamsController', ['except' => ['create', 'edit']]);
    Route::get('teams/{id}/with-players', 'TeamsController@getWithPlayers');
    Route::resource('teams.players', 'PlayersController', ['except' => ['create', 'edit']]);
});

