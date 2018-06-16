<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.pages.settings.index');
    }
    public function paymentsIndex(){
        return view('admin.pages.settings.payments.index');
    }

    public function paymentsSave(){
        \Setting::set("paypal_email", Request("paypalemail"));
        \Setting::save();
        session()->flash('good', 'Settings saved');
        return redirect()->back();
    }

    public function save(){
    	\Setting::set("home_title", Request("title"));
    	\Setting::set("home_desc", Request("desc"));
    	\Setting::save();
    	session()->flash('good', 'Settings saved');
    	return redirect()->back();
    }

    public function showPterodactyl(){
        return view('admin.pages.settings.pterodactyl.index');
    }

    public function savePterodactyl(){

        if(Request("ptero_link")!= null){
            \Setting::set("pterodactyl_link", Request("ptero_link"));
        }
        if(Request("ptero_key")!= null){
            \Setting::set("pterodactyl_appkey", Request("ptero_key"));
        }
        if(Request("ptero_appkey")!= null){
            \Setting::set("pterodactyl_appkey", Request("ptero_appkey"));
        }

        session()->flash('good', 'Your settings have been saved');
        return redirect()->back();
    }

    public function magicPterodactyl(){
//         foreach $arr[data] as $server

// id = $server["attributes"]; 
// name = $server["name"]; 
$link = \Setting::get("pterodactyl_link")."application/servers";
$authorization= "Authorization: Bearer ".\Setting::get('pterodactyl_appkey');

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>$authorization."\r\n" .
              "Accept: application/vnd.pterodactyl.v1+json\r\n" .
              "Content-Type: application/json\r\n"
  )
);
$context = stream_context_create($opts);
$result = file_get_contents($link, false, $context);

        foreach(json_decode($result,true)["data"] as $server){
            $srv = new \App\Server;
            $srv->name = $server["attributes"]["name"];
            $srv->ptero_id = $server["attributes"]["identifier"];
            $srv->type="pterodactyl";
            $srv->api_key= sha1(\Hash::make($server["attributes"]["name"]));
            $srv->save();
        }
        session()->flash('good', 'MinePoS found '.count(\App\Server::all()).' servers they have been added to your store');
        return redirect()->back();

    }




}
