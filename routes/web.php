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

Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@showLogin']);
Route::get('/', function () { return Redirect::to('login'); });
Route::post('sign-in','Auth\LoginController@doLogin');

Route::middleware('auth')->get('info', ['as' => 'info', 'uses' => 'InfoController@showInfo']);
Route::middleware('auth')->post('info', ['as' => 'save-info', 'uses' => 'InfoController@saveInfo']);
Route::middleware('auth')->put('info/{id}', ['as' => 'save-info', 'uses' => 'InfoController@updateInfo']);

Route::middleware('auth')->get('logout', ['as' => 'logout', 'uses' => 'InfoController@doLogout']);