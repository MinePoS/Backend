<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Observers\QueueObserver;
use \App\QueuedCommand;
use Illuminate\Support\Facades\Schema;
use Log;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \Stripe\Stripe::setApiKey(\Setting::get('STRIPE_PRIVATE'));

        QueuedCommand::deleted(function ($item) {
            $order = $item->getOrder();
            $server = $item->getServer();

            if($order == null){
                return;
            }

            $data = json_decode($order->order_data,true);
           
           if(!isset($data["ran_commands"])){
                $data["ran_commands"] = array();
            }

            $data2 = $data["ran_commands"];
            array_push($data2, [
                "command" => $item->command,
                "server" => $server->name,
                "time" => \Carbon\Carbon::now()
            ]);
            $data["ran_commands"] = $data2;
            $order->order_data = json_encode($data,true);

            $order->save();
            
            $left = $order->commandsLeft()->count();
            Log::info("Has $left commands left to run");
            if($left == 0){
                $order->status = "fulfilled";
            }

            $order->save();
        });
    }

}
