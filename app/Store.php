<?php
namespace App\Helpers;
use Illuminate\Http\Request;

class Store
{
	public static function isLoggedIn(){
		return Request()->session()->has('username');
	}

	public static function username(){
		return Request()->session()->get('username');
	}

	public static function uuid(){
		return Request()->session()->get('uuid');
	}

	public static function getHead($size){
		return "<img src=\"https://visage.surgeplay.com/head/".$size."/".Request()->session()->get('uuid')."\" size=\"".$size."\" align=\"left\" >";
	}
	public static function getHeadCustom($uuid,$size){
		//return ("https://visage.surgeplay.com/head/".$size."/".$uuid);
		return (" https://crafatar.com/renders/head/$uuid?size=$size");
	}

	public static function homeTitle(){
		return \Setting::get("home_title","Home");
	}
	public static function homeDesc(){
		return \Setting::get("home_desc","default home thing");
	}
	public static function showContent(){
		$loggedin = \Store::isLoggedIn();
		$isRoot = \Request::is('/');
		return($loggedin || $isRoot);
	}

public static function convertAndFormat($number){
	//$number = \Store::changeToVirtual($number);
	// $number = "10";
	$number = \Store::moneyFormat($number);
	return $number;
}


	public static function moneyFormat($number){
		//$number = "2";
		return number_format($number, 2, '.', ',');
	}

	public static function getCurrentCurency(){
		$currency = Request()->session()->get('currency');
		if($currency == null || $currency == ""){
			Request()->session()->put('currency', "USD");
			$currency = "USD";
		}
		return $currency;
	}

	public static function getCurrentCurencyString(){
		if(is_numeric(\Store::getCurrentCurency())){
			$c = VirtualCurrency::find(\Store::getCurrentCurency());
			if($c != null){
				return $c->name;
			}else{
				return "unknown";
			}
		}else{
			return \Store::getCurrentCurency();
		}
	}

	public static function isMore($transaction){
		return (json_decode($transaction->before,true)[$transaction->currency_id] < json_decode($transaction->after,true)[$transaction->currency_id]);
	}

	public static function getChange($transaction){
		$more = \Store::isMore($transaction);
		$s = "";
		if($more){
			$s = "+".(json_decode($transaction->after,true)[$transaction->currency_id] - json_decode($transaction->before,true)[$transaction->currency_id]);
		}else{
			$s = "-".(json_decode($transaction->before,true)[$transaction->currency_id] - json_decode($transaction->after,true)[$transaction->currency_id]);
		}
			return $s;


	}

}

?>