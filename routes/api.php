<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'auth:api'],function(){
    Route::get('/show', 'Todos@show');
    Route::post('/add', "Todos@add");
    Route::post('/done', "Todos@done");
    Route::post('/del', "Todos@del");

});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', 'UsersController@login');
    Route::post('/register', 'UsersController@register');
    Route::get('/logout', 'UsersController@logout')->middleware('auth:api');
});
