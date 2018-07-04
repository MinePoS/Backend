<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Order;
use Log;

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

    public function showCategory(Category $category){
        return view('category')->with(['category'=>$category]);
    }

    public function paymentDone(){
         return view('paymentDone');
    }

    public function addProduct(\App\Product $product){
        \Cart::add($product->id, $product->name, 1, $product->price);
        return redirect()->route('store.index');
    }
    public function viewCart(){
        // dd(\Cart::content());
        return view('cart');
    }
    public function clearCart(){
        \Cart::destroy();
        return redirect()->route('store.viewcart');
    }

    public function checkout(){

        $commands = array();
        foreach(\Cart::content() as $item){
            $product = \App\Product::find($item->id);
            $commandTmp = $product->commands;
            $commandTmp = str_replace("{username}", \Store::username(), $commandTmp);
            $commandTmp = json_decode($commandTmp, true);

            $i = 0;
            while($i != $item->qty){
                foreach($commandTmp as $cmdIndex => $cmdValue){
                    if(!(isset($commands[$cmdIndex]))){
                        $commands[$cmdIndex] = array();
                    }
                    foreach($cmdValue as $cmd){
                    array_push($commands[$cmdIndex] , $cmd);

                    }
                }
                $i++;
            }
        }
        $commands = json_encode($commands,true);

        if(\Request("tos") == null ){
             return redirect()->back();
        }
        if(\Request("gateway") == null ){
             return redirect()->back();
        }
        $gateway = Request("gateway");
        if($gateway == "paypal"){
            $order = new Order;
            $order->username = \Store::username();
            $order->commands =  $commands;
            //die($commands);
            $order->total = \Cart::subtotal();
            $order->save();

            Log::info("Sending to paypal");
            \Cart::destroy();
            return view("SendToPayPal")->with('order',$order);
        }else{
             return redirect()->back();
        }
        
    }

    public function viewCheckout(){
        if(\Cart::count() == 0){
            return redirect()->route('store.viewcart');
        }
        return view('checkout');
    }
    public function testPoint(){

    }
}
