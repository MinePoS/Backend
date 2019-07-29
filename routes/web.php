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


Route::get('/stripe', function () {
    return view("StripeTest");
});

Route::post('/charge', function () {
    //dd($_POST["stripeToken"]);
    dd(\App\Order::all()->last()->PaymentProvider()->requestPayment($_POST["stripeToken"]));
});


Route::group(['prefix' => 'admin'], function () {
    
});

Route::group(['prefix' => 'admin'], function () {
	Auth::routes(["register" => false]);
	Route::group(['middleware'=>"auth"], function () {
    	Route::get('/dashboard',function(){ return view('admin.dashboard');})->name("admin.dashboard");
    	Route::get('/profile',"Admin\ProfileController@viewProfile")->name("admin.profile");
    });
});


Route::get('/home', 'HomeController@index')->name('home');
