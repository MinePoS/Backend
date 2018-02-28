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


Route::get('api','APIController@checkConnection');

Route::post('login','HomeController@login')->name("store.login");
Route::get('logout','HomeController@logout')->name("store.logout");
Route::get('/', 'HomeController@index')->name("store.index");

$adminPrefix = Setting::get('admin.url', 'admin');
if(Request::is($adminPrefix.'/*') || Request::is($adminPrefix.'/') || Request::is($adminPrefix))
{
    	require(__DIR__.'/admin/web.php');
	
}
