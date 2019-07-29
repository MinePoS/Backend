<?php
namespace App\Gateways;
use App\Order;

class Stripe extends Gateway{
	protected $order;

	public function __construct(){
		\Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
	}

	protected function name() {
        return "Stripe";
    }
	
	public function loadOrderData(){
		
	}

	public function requestPayment($token){
		if($this->order == null){
			return "";
		}
		if($this->order->status == "awaiting_payment"){
			$charge = \Stripe\Charge::create(['amount' => $this->order->cost*100, 'currency' => 'usd', 'source' => $token]);
			if($charge->status == "succeeded" && $charge->paid == true){
				$this->order->status = "paid";
				$this->order->save();
			}
			return $charge;
		}else{
			return false;
		}
	}

    public function processPayment($payment){
    	return("Payment Done: $payment");
    }
}