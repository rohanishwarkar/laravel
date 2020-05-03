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
// Route::resource('/products','ProductController');
Route::post('/registerr','authcon@registerr');
Route::post('/loginn','authcon@loginn');
Route::middleware('auth:api')->get('/products','ProductController@index');

// Email Verification Routes...
Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');