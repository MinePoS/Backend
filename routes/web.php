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
    return view('welcome');
});

Route::get('api','APIController@checkConnection');

if(Request::is('admin/*') || Request::is('admin/') || Request::is('admin'))
{
    	require(__DIR__.'/admin/web.php');
	
}
