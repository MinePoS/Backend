<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use \App\VirtualCurrency;
use \App\CurrencyWallet;
use \App\CurrencyUser;
use \App\VirtualTransaction;
class Store
{
	public static function isLoggedIn(){
		return Request()->session()->has('username');
	}

	public static function username(){
		return Request()->session()->get('username');
	}

	public static function getHead($size){
		return "<img src=\"https://visage.surgeplay.com/head/".$size."/".Request()->session()->get('uuid')."\" size=\"".$size."\" align=\"left\" >";
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
	$number = \Store::changeToVirtual($number);
	// $number = "10";
	$number = \Store::moneyFormat($number);
	return $number;
}

public static function changeToVirtual($number){
	if(is_numeric(\Store::getCurrentCurency())){
			$c = VirtualCurrency::find(\Store::getCurrentCurency());
			if($c != null){
				return((1.00/$c->worth) * $number);

			}
		}
		return($number);
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
 
	public static function removeVirtualCurrency($user_id,$currency_id,$amount,$cause,$reason){
		// CurrencyWallet::find()
		$c = VirtualCurrency::find($currency_id);
		if($c == null){ return false; }

		$u = CurrencyUser::find($user_id);
		if($u == null){ return false; }
		
		$wallet = CurrencyWallet::find($u->wallet_id);
		if($wallet == null){ return false; }

		$data = json_decode($wallet->data, true);

		if(! isset($data[$currency_id]) ){
			$data[$currency_id] = 0;
		}

		if($data[$currency_id] >= $amount){
			$dataSafe = $data;
			$data[$currency_id] = intval($data[$currency_id]) - intval($amount);

			$t = new VirtualTransaction;
			
			$t->user_id = $user_id;
			$t->before = json_encode($dataSafe);
			$t->after = json_encode($data);
			$t->currency_id = $currency_id;
			$t->cause = $cause;
			$t->reason = $reason;

			$t->save();

			$wallet->data = json_encode($data);
			$wallet->save();

			return true;
		}else{
			return false;
		}
	}

public static function addVirtualCurrency($user_id,$currency_id,$amount,$cause,$reason){
		// CurrencyWallet::find()
		$c = VirtualCurrency::find($currency_id);
		if($c == null){ return false; }

		$u = CurrencyUser::find($user_id);
		if($u == null){ return false; }
		
		$wallet = CurrencyWallet::find($u->wallet_id);
		if($wallet == null){ return false; }

		$data = json_decode($wallet->data, true);

		if(! isset($data[$currency_id]) ){
			$data[$currency_id] = 0;
		}

		$dataSafe = $data;
			$data[$currency_id] = intval($data[$currency_id]) + intval($amount);

			$t = new VirtualTransaction;
			
			$t->user_id = $user_id;
			$t->before = json_encode($dataSafe);
			$t->after = json_encode($data);
			$t->currency_id = $currency_id;
			$t->cause = $cause;
			$t->reason = $reason;

			$t->save();
$wallet->data = json_encode($data);
			$wallet->save();
			
			return true;
		
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