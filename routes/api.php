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

Route::post('login', 'Admin\AuthController@login');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('home', 'Admin\AuthController@logado');
    Route::get('refresh', 'Admin\AuthController@refreshToken');
});
