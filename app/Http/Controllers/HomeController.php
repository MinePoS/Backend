<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function login(){
    	$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.mojang.com/users/profiles/minecraft/".Request("username"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 
        if($httpcode == 200){
            $arr = json_decode($output,true);
            session(['username' => $arr["name"]]);
            session(['uuid' => $arr["id"]]);
        }

    	return redirect()->back();
    }
    public function logout(){
    	session()->forget('username');
    	return redirect()->back();
    }
}
