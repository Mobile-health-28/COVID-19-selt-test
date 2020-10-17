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

Route::group(['middleware' => ['cors', 'json.response'],'namespace'=>'App\Http\Controllers\Auth'], function () {

    // ...

    // public routes
    Route::post('/login', 'ApiAuthController@login')->name('login.api');
    Route::post('/register','ApiAuthController@register')->name('register.api');
    Route::post('/logout', 'ApiAuthController@logout')->name('logout.api');
    Route::get('/detail', 'ApiAuthController@getByToken')->name('profile.api');
    // ...

});
