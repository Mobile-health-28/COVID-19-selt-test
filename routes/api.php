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

Route::group(['middleware' => ['api'],'namespace'=>'App\Http\Controllers\Auth'], function () {

    // public routes
    Route::post('/login', 'ApiAuthController@login')->name('login.api');
    Route::post('/register','ApiAuthController@register')->name('register.api');
    Route::post('/logout', 'ApiAuthController@logout')->name('logout.api');
    Route::get('/user/{id}', 'ApiAuthController@getByToken')->name('profile.api');
    // ...

});
Route::group(['middleware' => ['auth:api'],'namespace'=>'App\Http\Controllers\Auth'], function () {

    Route::get('/user/{id}', 'ApiAuthController@getByToken')->name('profile.api');
    Route::get('/users', 'ApiAuthController@getUsers')->name('users.api');
  

});
Route::group(['middleware' => [ 'auth:api'],'namespace'=>'App\Http\Controllers\api\v1'], function () {

   Route::resource('question', 'CovidTestQuestionController');
   Route::post('/questions/create', 'CovidTestQuestionController@loaFromJson')->name('import.api');
   Route::post('/questions/{id}/choices', 'CovidTestQuestionController@addChoices')->name('addChoice.api');
   Route::get('/questions/{id}', 'CovidTestQuestionController@getByQuestionId')->name('getQuestion.api');

   Route::resource('selftest', 'CovidTestController');

   Route::post('/questions/endtest/{id}', 'CovidTestController@endSession')->name('endTest.api');
   Route::post('/questions/answers', 'CovidTestController@sendAnswers')->name('senAswers.api');
   Route::post('/questions/{id}/answer', 'CovidTestController@sendAnswer')->name('endTest.api');

});