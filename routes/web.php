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

Route::get('/', function () {
    // return view('welcome');
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

Auth::routes(['verify'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::post('/settings', 'SettingController@store')->name('settings.store');
});

Route::get('activity/load-data', 'ActivityLogController@loadData');
Route::get('activity/get-data', 'ActivityLogController@getData');
Route::resource('activity', 'ActivityLogController');
Route::delete('activity/{id}/restore', 'ActivityLogController@restore');
