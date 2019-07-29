<?php
namespace App\Gateways;
use App\Order;
abstract class Gateway{
	abstract protected function name();

	abstract public function loadOrderData();
	abstract public function requestPayment($request);
	abstract public function processPayment($payment);
	
	public function loadOrder(Order $_order){
    	$this->order = $_order;
    	$this->loadOrderData();
    	return $this;
    }

    public function getOrder(){
    	return $this->order;
    }
	public function getName(){
    	return $this->name();
    }
}