<?php
namespace App\Gateways;
use App\Order;

class PayPal extends Gateway{
	protected $order;

	protected function name() {
        return "PayPal";
    }
	
	public function loadOrderData(){

	}

    public function processPayment($payment){
    	return("Payment Done: $payment");
    }

    public function requestPayment($request){

}
}