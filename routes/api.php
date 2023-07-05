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

/**
 * create api endpoint for login
 */
Route::post('login', 'Api\AuthController@login');

/**
 * create api endpoint for register
 */
Route::post('register', 'Api\AuthController@register');

/**
 * create api endpoint for logout
 */
Route::middleware('mobile')->get('logout', 'Api\AuthController@logout');