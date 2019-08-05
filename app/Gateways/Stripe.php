<?php
namespace App\Gateways;
use App\Order;

class Stripe extends Gateway{
	protected $order;

	public function __construct(){
		\Stripe\Stripe::setApiKey(\Setting::get('STRIPE_PRIVATE'));
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

		$email = json_decode($this->order->order_data,true)["email"];
		$items= json_decode(json_decode($this->order->order_data,true)["products"],true);
		$itemCount = count($items);
		$desc = "Minecraft Donation from: ".$this->order->getPlayer()->username." for ".$itemCount." item(s)";
		

		if($this->order->status == "awaiting_payment"){


		foreach($items as $item){
			$item = \App\Product::find($item);
			$desc = $desc."\r\n".$item->name;
		}

			// $charge = \Stripe\Charge::create([
			// 	'amount' => $this->order->cost*100,
			// 	'currency' => 'usd',
			// 	'source' => $token,
			// 	'description' => $desc,
			// 	'receipt_email' => $email,
			// ]);

			// $intent = \Stripe\PaymentIntent::retrieve(
		 //        $token
		 //     );
		 //      $intent->confirm();


			$charges = \Stripe\Charge::all([
			    'payment_intent' => $token,
			    'limit' => 1,
			]);

			$charge = $charges->data[0];
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