<?php

$adminPrefix = Setting::get('admin.url', 'admin');

Route::get('/'.$adminPrefix, 'Admin\Dashboard@showDashboard');

Route::group(['prefix' => $adminPrefix], function () {
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

	Route::post('DieAndDump', 'Admin\Dashboard@dd')->name('admin.dd');
	
	Route::get('403','Admin\ErrorController@forbiddenResponse')->name('admin.errors.403');

	Route::get('products','Admin\ProductController@index')->middleware('permission:list product')->name('admin.products');
	Route::get('products/new','Admin\ProductController@create')->middleware('permission:create product')->name('admin.products.new');
	Route::post('products/new','Admin\ProductController@store')->middleware('permission:create product')->name('admin.products.new');
	Route::get('products/{server}','Admin\ProductController@edit')->middleware('permission:create product')->name('admin.products.edit');
	
	Route::get('servers','Admin\ServerController@index')->middleware('permission:list servers')->name('admin.servers');
	Route::get('servers/new','Admin\ServerController@create')->middleware('permission:create server')->name('admin.server.new');
	Route::post('servers/new','Admin\ServerController@store')->middleware('permission:create server');
	
	Route::get('servers/{server}','Admin\ServerController@edit')->middleware('permission:view server')->name('admin.server.edit');
	Route::post('servers/{server}','Admin\ServerController@update')->middleware('permission:view server');
	
	Route::get('servers/{server}/delete','Admin\ServerController@delete')->middleware('permission:delete server')->name('admin.server.delete');
	Route::delete('servers/{server}/delete','Admin\ServerController@destroy')->middleware('permission:delete server')->name('admin.server.delete');

	Route::get('users','Admin\UserController@index')->middleware('permission:list users')->name('admin.users');
	Route::get('users/new','Admin\UserController@create')->middleware('permission:create user')->name('admin.users.new');
	Route::post('users/new','Admin\UserController@store')->middleware('permission:create user')->name('admin.users.new');
	Route::get('users/{user}','Admin\UserController@edit')->middleware('permission:view users')->name('admin.users.view');
	Route::post('users/{user}','Admin\UserController@update')->middleware('permission:edit user')->name('admin.users.edit');
	Route::get('users/{user}/delete','Admin\UserController@destroy')->middleware('permission:delete user')->name('admin.users.delete');

	Route::get('roles','Admin\RoleController@index')->middleware('permission:view roles')->name('admin.roles');
	Route::get('roles/new','Admin\RoleController@create')->middleware('permission:create new role')->name('admin.roles.new');
	Route::post('roles/new','Admin\RoleController@store')->middleware('permission:create new role');
	Route::get('roles/{role}/delete','Admin\RoleController@destroy')->middleware('permission:delete roles')->name('admin.roles.delete');
	Route::get('roles/{role}','Admin\RoleController@show')->middleware('permission:view roles')->name('admin.roles.view');
	Route::post('roles/{role}','Admin\RoleController@update')->middleware('permission:edit roles');

	Route::get('catagories','Admin\CategoryController@index')->middleware('permission:list category')->name('admin.Categories');
	
	Route::get('catagories/new','Admin\CategoryController@create')->middleware('permission:create category')->name('admin.Categories.new');
	Route::post('catagories/new','Admin\CategoryController@store')->middleware('permission:create category');
	Route::get('catagories/{category}/delete','Admin\CategoryController@destroy')->name('admin.Categories.delete');
	Route::get('catagories/{category}/edit','Admin\CategoryController@edit')->name('admin.Categories.edit');
	Route::post('catagories/{category}/edit','Admin\CategoryController@update')->name('admin.Categories.edit');
	
	Route::get('catagories/{category}','Admin\CategoryController@show')->middleware('permission:view category')->name('admin.Categories.view');
	Route::post('catagories/{category}','Admin\CategoryController@update')->middleware('permission:edit category');

	Route::get('orders','Admin\OrderController@index')->middleware('permission:list order')->name('admin.order');


	Route::get('settings','Admin\SettingsController@index')->middleware('permission:edit settings')->name("admin.settings");
	
	Route::get('settings/payments','Admin\SettingsController@paymentsIndex')->middleware('permission:edit settings')->name("admin.settings.payments");

	Route::post('settings/payments','Admin\SettingsController@paymentsSave')->middleware('permission:edit settings')->name("admin.settings.payments.save");
	
	Route::get('settings/pterodactyl','Admin\SettingsController@showPterodactyl')->middleware('permission:edit settings')->name("admin.settings.pterodactyl");
	Route::post('settings/pterodactyl','Admin\SettingsController@savePterodactyl')->middleware('permission:edit settings')->name("admin.settings.pterodactyl");

	Route::get('settings/discord','Admin\SettingsController@showDiscord')->middleware('permission:edit settings')->name("admin.settings.discord");
	Route::post('settings/discord','Admin\SettingsController@saveDiscord')->middleware('permission:edit settings')->name("admin.settings.discord");
	Route::post('settings/discord','Admin\SettingsController@testDiscord')->middleware('permission:edit settings')->name("admin.settings.discord.test");

	Route::post('settings/pterodactyl/setup','Admin\SettingsController@magicPterodactyl')->middleware('permission:edit settings')->name("admin.settings.pterodactyl.setup");
	
	Route::post('settings/savetos','Admin\SettingsController@saveToS')->middleware('permission:edit settings')->name("admin.settings.savetos");


	Route::post('settings/update','Admin\SettingsController@save')->middleware('permission:edit settings')->name("admin.settings.save");
	Route::get('settings/theme','Admin\Settings\ThemeController@index')->middleware('permission:edit settings')->name("admin.settings.theme");
	Route::get('settings/theme/set/{themeName}','Admin\Settings\ThemeController@set')->middleware('permission:edit settings')->name("admin.settings.theme.set");
	Route::get('settings/theme/upload','Admin\Settings\ThemeController@uploadform')->middleware('permission:edit settings')->name("admin.settings.theme.upload");
	Route::POST('settings/theme/upload','Admin\Settings\ThemeController@upload')->middleware('permission:edit settings')->name("admin.settings.theme.upload");
});