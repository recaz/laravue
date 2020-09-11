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

Route::apiResources(['user' => 'API\UserController']);
Route::get('profile', 'API\ProfileController@show');
Route::get('bio/{id}', 'API\ProfileController@showBio');
Route::get('bio', 'API\ProfileController@show');
Route::put('profile', 'API\ProfileController@update');
Route::get('findUser', 'API\UserController@search');
Route::get('findUser1', 'API\UserController@searchUser');