<?php

namespace App\Http\Controllers\Admin;

use App\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// d
class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::paginate(15);
        return view('admin.pages.server.index')->with(["servers"=>$servers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.server.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enabled = false;
        if(request("enabled") !== null){
            $enabled = true;
        }

        $server = new Server;
        $server->name = request("name");
        $server->enabled = $enabled;
        $server->api_key = sha1(\Hash::make(request("name")));
        $server->type = request("srvType");
        $server->ptero_id = request("srvID");
        $server->http_server_ip = request("httpSrvIP");
        $server->save();
        return redirect()->route('admin.servers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        return view('admin.pages.server.edit')->with(['server'=>$server]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        $enabled = false;
        if(request("enabled") !== null){
            $enabled = true;
        }

        $server->name = request("name");
        $server->enabled = $enabled;
        $server->api_key = sha1(\Hash::make(request("name")));
        $server->type = request("srvType");
        $server->http_server_ip = request("httpSrvIP");
        $server->ptero_id = request("srvID");
        $server->save();
        
        session()->flash('good', 'Server updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function delete(Server $server)
    {
        return view('admin.pages.server.delete')->with(['server'=>$server]);
    }
    
    public function destroy(Server $server)
    {
        $server->delete();
        session()->flash('good', 'Server deleted');
        return redirect()->route('admin.servers');
    }
}
