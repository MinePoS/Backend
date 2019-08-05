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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getQueue',function(){
	$key = \Request()->input("key");
	$server = \App\Server::where("api_key", $key)->where("enabled",true)->where("type",'plugin')->get();
	if($server->count() >0){
		$server = $server->first();
	}else{
		return "invalid key";
	}
	$cmds = \App\QueuedCommand::where("server_id",$server->id)->get();
	$data = array();
	foreach($cmds as $command){
		//echo("sending");
		//$command->resend();
		$sc = $command->getSocketCommand();
		array_push($data, $sc);
	}
	echo("DONE");
	\App\SocketClient::daemonSendMultiple($data);
});

Route::get('/commandDone/{command}',function(\App\QueuedCommand $command){
$key = \Request()->input("key");
	$server = \App\Server::where("api_key", $key)->where("enabled",true)->where("type",'plugin')->get();
	if($server->count() >0){
		$server = $server->first();
	}else{
		return "invalid key";
	}
	Log::info("Commands Ran");
	$command->delete();
});

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