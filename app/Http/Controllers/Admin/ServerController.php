<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Server;
use \Validator;
use Illuminate\Support\Facades\Input;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$this->authorize('list-servers');
    	return view("admin.servers.index")->with(["servers"=>\App\Server::all()]);
    }

    public function create(){
    	$this->authorize('create-servers');

    	return view("admin.servers.form",["server"=> new Server]);
    }


    public function store(){
    	$this->authorize('create-servers');
		$rules = ["name"=>"required"];

    	$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return redirect()->back()->withErrors($validator);
	    }

	    $name = Request("name");
	    $enabled = (Request("enabled") != null);
$server = new Server;
	    $server->name = $name;
	    $server->enabled = $enabled;
	    $server->api_key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));;
	    $server->save();
    	return redirect()->route("admin.servers.index")->with(["good"=> "Server '$name' created"]);
    }

    public function edit(Server $server){
    	$this->authorize('edit-servers');
    	return view("admin.servers.form",["server"=> $server]);
    }

    public function update(Server $server){
		$this->authorize('edit-servers');

    	$rules = ["name"=>"required"];

    	$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return redirect()->back()->withErrors($validator);
	    }

	    $name = Request("name");
	    $enabled = (Request("enabled") != null);

	    $server->name = $name;
	    $server->enabled = $enabled;
	    $server->save();
    	return redirect()->route("admin.servers.index")->with(["good"=> "Server '$name' edited"]);
    	
    }

    public function delete(Server $server){
    	$servername = $server->name;
    	$this->authorize('delete-servers');
    	$server->delete();
    	return redirect()->route('admin.servers.index')->with(["good"=> "Server '$servername' deleted"]);
    	//admin.servers.delete

    }

    public function rekey(Server $server){
    	$this->authorize('rekey-servers');

	    $server->api_key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));;
	    $server->save();
    	return redirect()->route('admin.servers.index')->with(["good"=> "Server '$server->name' re-keyed","swal"=>"$server->name has had the api key changed. This process will have disconnected the linked server from the daemon"]);


    }
}
