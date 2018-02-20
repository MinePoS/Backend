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
	Route::get('users/new','Admin\UserController@create')->middleware('permission:list users')->name('admin.users.new');
	Route::get('users/{user}','Admin\UserController@edit')->middleware('permission:view users')->name('admin.users.view');
	Route::post('users/{user}','Admin\UserController@update')->middleware('permission:edit user')->name('admin.users.edit');

	Route::get('roles','Admin\RoleController@index')->middleware('permission:view roles')->name('admin.roles');

	Route::get('roles/new','Admin\RoleController@create')->middleware('permission:create new role')->name('admin.roles.new');
	Route::post('roles/new','Admin\RoleController@store')->middleware('permission:create new role');

	Route::get('roles/{role}/delete','Admin\RoleController@destroy')->middleware('permission:delete roles')->name('admin.roles.delete');

	Route::get('roles/{role}','Admin\RoleController@show')->middleware('permission:view roles')->name('admin.roles.view');
	Route::post('roles/{role}','Admin\RoleController@update')->middleware('permission:edit roles');

});