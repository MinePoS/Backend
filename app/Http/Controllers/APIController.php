<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
