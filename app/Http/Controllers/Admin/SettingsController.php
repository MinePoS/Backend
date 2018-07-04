<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

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

    public function saveToS(){
        \Setting::set("tos_title", Request("title"));
        \Setting::set("tos_desc", Request("desc"));
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
            \Setting::save();
        }
        if(Request("ptero_key")!= null){
            \Setting::set("pterodactyl_key", Request("ptero_key"));
            \Setting::save();

        }

// 
        session()->flash('good', 'Your settings have been saved');
        return redirect()->back();
    }

    public function showDiscord(){
        return view('admin.pages.settings.discord.index');
    }
public function testDiscord(){
    $orderlink = \Setting::get("DISCORD_ORDER_WEBHOOK");
    $adminlink = \Setting::get("DISCORD_LOGIN_WEBHOOK");
            
$embed = new Embed();
$embed->color("1376020");
$embed->description('Discord Webook test called from MinePoS admin panel');

if($orderlink != null){
    (new Client($orderlink))->embed($embed)->send();
}
if($adminlink != null){
    (new Client($adminlink))->embed($embed)->send();
}
    session()->flash('good', 'Discord test complete please check discord and verify the messages have been sent');
        return redirect()->back();
}
    public function saveDiscord(){

        \Setting::set("DISCORD_LOGIN_ENABLED", (Request("admin_enabled") != null));
        \Setting::save();

        \Setting::set("DISCORD_ORDER_ENABLED", (Request("order_enabled") != null));
        \Setting::save();
        
        if(Request("admin_link")!= null){
            \Setting::set("DISCORD_LOGIN_WEBHOOK", Request("admin_link"));
            \Setting::save();
        }
        if(Request("admin_link")!= null){
            \Setting::set("DISCORD_ORDER_WEBHOOK", Request("order_link"));
            \Setting::save();
        }
        session()->flash('good', 'Your settings have been saved');
        return redirect()->back();
        //DISCORD_LOGIN_WEBHOOK
    }

    public function magicPterodactyl(){
//         foreach $arr[data] as $server

// id = $server["attributes"]; 
// name = $server["name"]; 
$link = \Setting::get("pterodactyl_link")."client";
$authorization= "Authorization: Bearer ".\Setting::get('pterodactyl_key');

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
            if( $server["object"] == "server" ){
                $srv = new \App\Server;
                $srv->name = $server["attributes"]["name"];
                $srv->ptero_id = $server["attributes"]["identifier"];
                $srv->type="pterodactyl";
                $srv->api_key= sha1(\Hash::make($server["attributes"]["name"]));
                $srv->save();
            }
        }
        session()->flash('good', 'MinePoS found '.count(\App\Server::all()).' servers they have been added to your store');
        return redirect()->back();

    }

public function viewUpdate(){
    return view('admin.pages.settings.update.index');
}

public function doUpdate(){
    if(\Updater::isNewVersionAvailable(\Updater::getVersionInstalled("v",""))){
        \Updater::update();
        session()->flash('good', 'MinePoS has been updated');
        return view('admin.pages.dashboard');
    }else{
        session()->flash('bad', 'MinePoS is already up-to-date');
        return view('admin.pages.dashboard');
    }
    
}


}
