<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\VirtualCurrency;
use \App\CurrencyWallet;
use \App\CurrencyUser;
use \App\VirtualTransaction;

class APIController extends Controller
{
	public function __construct()
    {
        $this->middleware('serverapi');
    }
    
    function checkConnection(){
    	$server= \Request::get('server');
    	return(array("success"=>true,"name"=>$server->name));
    }

    function getCategory(){
    	$server= \Request::get('server');
    	return(array("success"=>true,"name"=>$server->name));
    }

    function getCurrencies(){
        $server= \Request::get('server');
        $data = array();
        $data["data"] = array();
        $data["name"] = $server->name;
        foreach(VirtualCurrency::all() as $c){
            $tmp = array(
                "id"=>$c->id,
                "name"=>$c->name,
                "worth"=>$c->worth
            );
            array_push($data["data"], $tmp);
        }

        $data["success"] = true;
        return $data;
    }

    function getCurrenciesForUser(){
        $server= \Request::get('server');
        $ident = Request("ident");
        $game = Request("game");
        
        $data = array();
        
        $userRes = CurrencyUser::getOrMake($game,$ident);
        $userRes->validate();

        $data["data"] = $userRes->getCurrenies();


        $data["name"] = $server->name;
        $data["success"] = true;
        return $data;
    }

    function removeCurrencyForUser(){
 $server= \Request::get('server');
        $ident = Request("ident");
        $game = Request("game");
        $cid = Request("cid");
        $amt = Request("amt");
        $reason = Request("reason");
        
        $data = array();
        
        $userRes = CurrencyUser::getOrMake($game,$ident);
        
        \Store::removeVirtualCurrency($userRes->id,$cid,$amt,$server->name." API Call.",$reason);

        $data["data"] = $userRes->getCurrenies();


        $data["name"] = $server->name;
        $data["success"] = true;
        return $data;
        
    }

     function addCurrencyForUser(){
 $server= \Request::get('server');
        $ident = Request("ident");
        $game = Request("game");
        $cid = Request("cid");
        $amt = Request("amt");
        $reason = Request("reason");
        

        $data = array();
        
        $userRes = CurrencyUser::getOrMake($game,$ident);
        
        \Store::addVirtualCurrency($userRes->id,$cid,$amt,$server->name." API Call.",$reason);

        $data["data"] = $userRes->getCurrenies();


        $data["name"] = $server->name;
        $data["success"] = true;
        return $data;
        
    }
}

