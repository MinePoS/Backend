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

Route::get('/','APIController@checkConnection');
Route::get('/get-currencies','APIController@getCurrencies');
Route::get('/get-currencies-for-user','APIController@getCurrenciesForUser');
Route::get('/add-currencies-for-user','APIController@addCurrencyForUser');
Route::get('/remove-currencies-for-user','APIController@removeCurrencyForUser');