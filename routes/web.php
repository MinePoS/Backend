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
    	Route::get('/',function(){ return view('admin.dashboard');});
    	Route::get('/profile',"Admin\ProfileController@viewProfile")->name("admin.profile");
    });

    Route::get('/servers','Admin\ServerController@index')->name("admin.servers.index");
    Route::get('/servers/create','Admin\ServerController@create')->name("admin.servers.create");
    Route::post('/servers/create','Admin\ServerController@store')->name("admin.servers.store");
    Route::get('/servers/{server}/delete','Admin\ServerController@delete')->name("admin.servers.delete");
    Route::get('/servers/{server}/rekey','Admin\ServerController@rekey')->name("admin.servers.rekey");
    Route::get('/servers/{server}/edit','Admin\ServerController@edit')->name("admin.servers.edit");
    Route::post('/servers/{server}/edit','Admin\ServerController@update')->name("admin.servers.update");


    Route::get('/categories','Admin\CategoryController@index')->name("admin.categories.index");
    Route::get('/categories/create','Admin\CategoryController@create')->name("admin.categories.create");
    Route::post('/categories/create','Admin\CategoryController@store')->name("admin.categories.store");
    Route::get('/categories/{category}/delete','Admin\CategoryController@delete')->name("admin.categories.delete");
    Route::get('/categories/{category}/rekey','Admin\CategoryController@rekey')->name("admin.categories.rekey");
    Route::get('/categories/{category}/edit','Admin\CategoryController@edit')->name("admin.categories.edit");
    Route::post('/categories/{category}/edit','Admin\CategoryController@update')->name("admin.categories.update");

    Route::get('/players','Admin\PlayerController@index')->name('admin.players.index');
    Route::get('/players/{player}','Admin\PlayerController@show')->name('admin.players.show');
    Route::get('/players/{player}/unban','Admin\PlayerController@unban')->name('admin.players.unban');
    Route::get('/players/{player}/ban','Admin\PlayerController@ban')->name('admin.players.ban');
    Route::post('/players/{player}/ban','Admin\PlayerController@addBan')->name('admin.players.ban');

Route::get('/flash',function(){
	Session::flash("swal","Testing");
	Session::flash("good","Testing");
	Session::flash("bad","Testing");
	return Redirect()->route("admin.servers.index");
});

    Route::get('/permission-list', function(){
    	$perms = \Spatie\Permission\Models\Permission::all();
    	foreach ($perms as $perm) {
            $name = $perm->name;
            $bigName = str_replace("-", " ", $name);
            $bigName = ucfirst(strtolower($bigName));
    		echo("$bigName   :   $name <br>");
    	}
    });
});


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/checkapikey',function(){
	$name = \Request()->input('name');
	$key = \Request()->input('key');
	if($name == null || $key == null){
		return "deny";
	}

	if($key == env('WEBSITE_WEBSOCKET_APIKEY')){
		return env('WEBSITE_WEBSOCKET_NAME');
	}else{
		$server = \App\Server::fromAPIKEY($key);
		if(count($server) == 1){
			return $server[0]->name;
		}
		return "deny";
	}
});