<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Log;

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

            $player = null;
            if(\App\Player::where('uuid',$arr['id'])->count() == 0){
                $player = new \App\Player;
                $player->username = $arr["name"];
                $player->uuid = $arr["id"];
                $player->save();
            }else{
                $player = \App\Player::where('uuid',$arr['id'])->get()->first();
            }

            if($player->isBanned()){
                $ban = $player->bans()->get()->last();
                \Session::flash("error-model","This player has been banned from access the store. Reason: $ban->comment");
                return redirect()->back();
            }

            session(['username' => $arr["name"]]);
            session(['uuid' => $arr["id"]]);
            session(['player' => $player]);
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
        $products = array();
        $productObjs = array();
        
         foreach(\Cart::content() as $item){
             $product = \App\Product::find($item->id);
             array_push( $products, $item->id );
             array_push( $productObjs, $product);
        
            $commandTmp = $product->commands;
            $commandTmp = str_replace("{username}", \Store::username(), $commandTmp);
            $commandTmp = str_replace("%username%", \Store::username(), $commandTmp);
            $commandTmp = str_replace("%name%", \Store::username(), $commandTmp);

            $commandTmp = json_decode($commandTmp, true);

            $i = 0;
            while($i != $item->qty){
                    foreach($commandTmp as $cmdIndex => $cmdValue){
                        if(($cmdIndex == -1) || (\App\Server::find($cmdIndex) != null)){
                        if(!(isset($commands[$cmdIndex]))){
                            $commands[$cmdIndex] = array();
                        }
                        foreach($cmdValue as $cmd){
                            array_push($commands[$cmdIndex] , $cmd);
                        }
                    }
                }
                $i++;
            }
        }
       // $commands = json_encode($commands,true);

        if(\Request("tos") == null ){
             return redirect()->back();
        }
        if(\Request("gateway") == null ){
             return redirect()->back();
        }
        $gateway = Request("gateway");
        $player_id = 0;
        if(\App\Player::where("username",\Store::username())->count() > 0){
            $player_id = \App\Player::where("username",\Store::username())->get()[0]->id;
        }else{
            $p = new \App\Player;
            $p->username = \Store::username();
            $p->uuid = \Store::uuid();
            $p->save();
            $player_id = $p->id;
        }
        if($gateway == "paypal"){

            return redirect()->back()->with(["error-model","PayPal Gateway has not yet been added to MinePoS"]);
        }else if($gateway == "stripe"){
        $email = Request("email");
        $name = Request("name");

            Log::info("Stripe Order Placed!");
            $order = new Order;
            $order->player_id = $player_id;
            $order->order_data =  json_encode(array("commands"=>$commands,"products"=>json_encode($products),"email"=>$email,"name"=>$name));
            $order->status =  "awaiting_payment";
            $order->payment_gateway = "\App\Gateways\Stripe";
            //die($commands);
            $order->cost = \Cart::subtotal();
            $order->save();

            $payment = $order->PaymentProvider()->requestPayment($_POST["PAYMENT_INTENT_ID"]);

            if($payment != false && $payment->paid == true){
                $player = \App\Player::find($player_id);

               // \App\QueuedCommand::sendCommandWithPlayer(\App\Server::find(1),"give $player->username diamond 1",$player,true,$order->id);
                
                //\App\QueuedCommand::sendCommand(\App\Server::find(1),"bc Thank you $player->username for donating!",$order->id);

                foreach($commands as $serverid => $commandList){
                    if($serverid == -1){
                        $servers = \App\Server::getAllEnabled();
                        foreach($servers as $server){
                            foreach($commandList as $command){
                                \App\QueuedCommand::sendCommandWithPlayer($server,$command,$player,true,$order->id);
                            }
                        }
                    }else{
                        $server = \App\Server::find($serverid);
                        foreach($commandList as $command){
                                \App\QueuedCommand::sendCommandWithPlayer($server,$command,$player,true,$order->id);
                        }
                    }
                }

                \Cart::destroy();

                foreach($productObjs as $product){
                    $product->sold = $product->sold + 1;
                    $product->save();
                }
                return redirect()->route("store.paymentdone");
            }else{
                dd("FAILED!");
            }
        }else{
             return redirect()->back();
        }
        
    }

    public function setCurrency($currency){
        if(is_integer($currency)){
            if(\App\VirtualCurrency::find($currency) != null){
                Request()->session()->put('currency', $currency);
            }
        }else{
             Request()->session()->put('currency', $currency);
        }
        
        return redirect()->back();
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
