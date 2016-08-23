<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', ['as' => 'user.profile.get', 'uses' => 'UserController@getProfile']);
	Route::get('/event/create', ['as' => 'user.event.create.get', 'uses' => 'EventController@getCreateEvent']);
	Route::post('/event/create', ['as' => 'user.event.create.post', 'uses' => 'EventController@postCreateEvent']);
	Route::get('/event/joined', ['as' => 'user.event.joined.get', 'uses' => 'EventController@getJoinedEvents']);
	Route::get('/event/history', ['as' => 'user.event.history.get', 'uses' => 'EventController@getHistory']);
	Route::get('/event/{id}', ['as' => 'user.event.get', 'uses' => 'EventController@getEvent']);
	Route::get('/event/{id}/unjoin', ['as' => 'user.event.unjoin.get', 'uses' => 'EventController@getUnjoinEvent']);
	Route::get('/event/{id}/join', ['as' => 'user.event.join.get', 'uses' => 'EventController@getJoinEvent']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
	Route::post('/interest', ['as' => 'api.interest.post', 'uses' => 'ApiController@addInterest']);
	Route::post('/interest/delete', ['as' => 'api.interest.delete.post', 'uses' => 'ApiController@deleteInterest']);
	Route::post('/user/image', ['as' => 'api.user.image.post', 'uses' => 'ApiController@addImage']);
	Route::post('event/{id}/comment', ['as' => 'api.comment.post', 'uses' => 'ApiController@postComment']);
});

// Authentication routes...
Route::get('/login', ['as' => 'auth.login.get', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login',['as' => 'auth.login.post', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout',['as' => 'auth.logout.get', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('/register',['as' => 'auth.register.get', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('/register',['as' => 'auth.register.post', 'uses' => 'Auth\AuthController@postRegister']);