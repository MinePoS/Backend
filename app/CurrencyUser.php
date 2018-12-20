<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\CurrencyWallet;

class CurrencyUser extends Model
{
   public static function createNewUser($game, $ident, $wallet_id = null){
   	if($wallet_id == null){
   		$w = new CurrencyWallet;
   		$arr = array();
   		foreach(VirtualCurrency::all() as $c){
            $arr[$c->id] = 0;
        }
        $w->data = json_encode($arr);
        $w->save();
   		$wallet_id = $w->id;
   	}
   	$user = new CurrencyUser;
   	$user->ident = $ident;
   	$user->game = $game;
   	$user->wallet_id = $wallet_id;
   	$user->save();
   	return $user;
   }

   public static function getOrMake($game, $ident){
   		$res = CurrencyUser::where("ident", $ident)->where("game", $game)->limit(1)->get();
   		if($res->count() == 1){
   			return($res[0]);
   		}else{
   			return CurrencyUser::createNewUser($game,$ident);
   		}
   }

   public function validate(){
   	$w = CurrencyWallet::find($this->wallet_id);
   	$data = json_decode($w->data,true);
   	$dataNew = array();
   	foreach(VirtualCurrency::all() as $c){
   		if(isset( $data[$c->id] )){
   			$dataNew[$c->id] = $data[$c->id];
   		}else{
   			$dataNew[$c->id] = 0;
   		}
   	}
   	$w->data = json_encode($dataNew);
   	$w->save();
   }

   public function getCurrenies(){
   	$w = CurrencyWallet::find($this->wallet_id);
   	$data = json_decode($w->data,true);
   	$dataNew = array();
   
   	foreach(VirtualCurrency::all() as $c){
   		array_push($dataNew, array(
   			"id" => $c->id, 
   			"name" => $c->name, 
   			"value" => $data[$c->id], 
   		));
   	}
   	return $dataNew;
   }
}
