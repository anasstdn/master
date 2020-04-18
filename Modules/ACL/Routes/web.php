<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('acl')->group(function() {
    Route::get('/', 'ACLController@index');
});

Route::prefix('user')->group(function() {
    Route::get('/', 'UserController@index');
    Route::get('/create',['as' => 'user.create', 'uses' => 'UserController@create']);
    Route::match(['get','post'],'/send-data','UserController@sendData');
	Route::match(['get', 'post'],'/check-username','UserController@checkUsername');
	Route::match(['get', 'post'],'/check-email','UserController@checkEmail');
	Route::match(['get', 'post'],'/get-data','UserController@getData');
	Route::match(['get', 'post'],'/{id}/edit','UserController@edit');
	Route::match(['get', 'post'],'/{id}/reset','UserController@reset');
	Route::delete('/{id}', 'UserController@destroy');
});
