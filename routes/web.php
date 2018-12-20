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
 



Route::post('login','HomeController@login')->name("store.login");
Route::get('login','HomeController@index')->name("store.login");
Route::get('logout','HomeController@logout')->name("store.logout");

Route::get('/', 'HomeController@index')->name("store.index");
Route::get('/setcurrency/{currency}', 'HomeController@setCurrency')->name("store.setcurrency");

Route::get('/category/{category}', 'HomeController@showCategory')->name("store.category");
Route::get('/product/{product}/add', 'HomeController@addProduct')->name("store.addproduct");
Route::get('/payment-complete', 'HomeController@paymentDone')->name("store.paymentdone");

// Route::get('/test', 'HomeController@testPoint');

Route::get('/cart', 'HomeController@viewCart')->name("store.viewcart");
Route::get('/cart/clear', 'HomeController@clearCart')->name("store.clearcart");

Route::get('/checkout', 'HomeController@viewCheckout')->name("store.viewcheckout");
Route::post('/checkout', 'HomeController@checkout')->name("store.checkout");


Route::get('paypal/','PayPalTestController@index')->name('paypal');
Route::get('paypal/ipn','PayPalTestController@paypalIpn')->name('paypal.ipn');
Route::post('paypal/ipn','PayPalTestController@paypalIpn')->name('paypal.ipn');

$adminPrefix = Setting::get('admin.url', 'admin');
if(Request::is($adminPrefix.'/*') || Request::is($adminPrefix.'/') || Request::is($adminPrefix))
{
    	require(__DIR__.'/admin/web.php');
	
}
