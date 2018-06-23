<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;
use \Setting;
class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
   
    public function onUserLogout($event)
    {
        
    }

    public function onUserLogin($event)
    {
        if(Setting::get('DISCORD_LOGIN_ENABLED', false)){
                    $ip = \Request::ip();
        if(env('APP_DEBUG', false)){
            $ip = preg_replace('/[0-9]+/', '*', $ip);
        }
            $webhook = Setting::get('DISCORD_LOGIN_WEBHOOK');

            $webhook = new Client($webhook);
            $embed = new Embed();
            $embed->color("1376020");
            $embed->description($event->user->name.' has just logged in to the panel from the ip `'.$ip.'`');
            $webhook->embed($embed)->send();
        }
    }

    public function onUserFailed($event)
    {
        $name = $event->credentials['email'];
        if($event->user != null){
            $name = $event->user->name;
        }
        $ip = \Request::ip();
        if(env('APP_DEBUG', false)){
            $ip = preg_replace('/[0-9]+/', '*', $ip);
        }
        if(env('DISCORD_LOGIN_FAILED_ENABLED', false)){
            $webhook = env('DISCORD_LOGIN_WEBHOOK');

            $webhook = new Client($webhook);
            $embed = new Embed();
            $embed->color("16716820");
            $embed->description('Failed login attepmt for `'.$name.'` from the ip `'.$ip.'`');
            $webhook->embed($embed)->send();
        }
    }
}
