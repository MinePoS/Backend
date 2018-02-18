<?php
Route::get('/admin', 'Admin\Dashboard@showDashboard');

Route::group(['prefix' => 'admin'], function () {
	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	Route::get('dashboard', 'Admin\Dashboard@showDashboard')->name('admin.dashboard');
	Route::get('403','Admin\ErrorController@forbiddenResponse')->name('admin.errors.403');

Route::get('servers','Admin\ServerController@index')->middleware('permission:list servers')->name('admin.servers');
Route::get('servers/new','Admin\ServerController@index')->middleware('permission:create server')->name('admin.server.new');

Route::get('users','Admin\UserController@index')->middleware('permission:list users')->name('admin.users');

Route::get('perms','Admin\PermissionController@index')->middleware('permission:list permissions')->name('admin.perms');
Route::post('perms','Admin\PermissionController@updaterole')->middleware('permission:assign perms to roles');

});