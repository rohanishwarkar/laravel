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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Auth::routes(['verify' => true]);
// Route::resource('/products','ProductController');
Route::post('/register','authcon@register');
Route::post('/login','authcon@login');
Route::middleware('auth:api')->get('/products','ProductController@index');