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

	public static function getHead($size){
		return "<img src=\"https://visage.surgeplay.com/head/".$size."/".Request()->session()->get('uuid')."\" size=\"".$size."\" align=\"left\" >";
	}
}

?>