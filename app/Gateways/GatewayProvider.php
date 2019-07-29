<?php
namespace App\Gateways;
use App\Order;

class GatewayProvider{
	public static $providers;

	public static function addProvider($class, $name){
		if(GatewayProvider::$providers == null){
			GatewayProvider::$providers = array();
		}
		GatewayProvider::$providers[$name]= $class;
	}

	public static function getProvider($name){
		return GatewayProvider::$providers[$name];
	}

}