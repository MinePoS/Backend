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

    function getCategories(){
        $server= \Request::get('server');
        return(array("success"=>true,"name"=>$server->name,"data"=>\App\Category::where("visible",1)->get()));
    }

    function getCategory(int $id){
    	$server = \Request::get('server');
        $c = \App\Category::find($id);
        if($c == null){
            return(array("success"=>false,"name"=>$server->name,"error"=>"No Category Exists with that ID"));
        }
    	return(array("success"=>true,"name"=>$server->name,"category"=>$c,"data"=>\App\Product::where('category_id',$id)->get()));
    }

    function getCurrencies(){
        $server= \Request::get('server');
        $data = array();
        $data["data"] = VirtualCurrency::all();
        $data["name"] = $server->name;
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

