<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item; 
use PayPal\Api\ItemList; 
use PayPal\Api\Payer; 
use PayPal\Api\Payment; 
use PayPal\Api\RedirectUrls; 
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use Andrew\PaypalIPN\PaypalIPNListener;
use Log;
use App\Order;
class PayPalTestController extends Controller
{
    public function index(){

    	if(!(\Store::isLoggedIn())){
 			return redirect()->route('store.login');
    	}

    	$order = new Order;
        $sid = \App\Server::all()[0]->id;
    	$commands = "{ \"".$sid."\": [ \"bc %player% has just donated!\",\"give %player% diamond\"] }";
		$commands = str_replace("%player%", \Store::username(), $commands);

		$order->username = \Store::username();
		$order->commands =  $commands;
		$order->total = rand(0, 15).".".rand(0, 99);;
		$order->save();

    	Log::info("Sending to paypal");
		return view("PayPalTest")->with('order',$order);
    }

    public function exce(){

    }



public function paypalIpn()
{
    Log::info("New IPN Recived now checking agesnt the paypal server!");
    $ipn = new PaypalIPNListener();
    $ipn->use_sandbox = true;

    $verified = $ipn->processIpn();


    $report = $ipn->getTextReport();
   
	Log::info($report);

    if ($verified) {
            Log::info("Payment verified agenst payapl and inserted to orders table to the database.");
            $ids = explode('|', $ipn->getPostData()['custom']);

             $order = \App\Order::find($ipn->getPostData()['item_number']);
             $order->txid = $ipn->getPostData()['txn_id'];
             $order->gateway = "paypal";
            
             if($ipn->getPostData()['payment_status'] == "Completed"){
             $order->status = "payment_received";
             $commands = json_decode($order->commands,true);
			foreach($commands as $cmdIndex => $cmdValue){
                    if($cmdIndex == -1){
                        foreach(\App\Server::all() as $srv){
                            $srv->runCommands($cmdValue);
                        }
                    }else{
                        $srv = \App\Server::find($cmdIndex);
                        if($srv != null){
                            $srv->runCommands($cmdValue);
                        }
                    }
					
			}
            $order->postdata = json_encode($ipn->getPostData());
			$order->status = "processed";
			$order->save();
            $order->orderNotification();
        }
    } else {
        Log::info("Some thing went wrong in the payment !");
    }
}
    	    	
}
