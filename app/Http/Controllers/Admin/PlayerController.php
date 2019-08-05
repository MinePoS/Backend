<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;
use \Validator;
use Illuminate\Support\Facades\Input;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$this->authorize('list-players');
    	$players = Player::orderBy('id','DESC')->paginate(15);
    	return view('admin.players.index',["players"=>$players]);
    }

    public function unban(Player $player){
    	$this->authorize('unban-players');
    	if(!$player->isBanned()){
    		\Session::flash("bad", "$player->username is not banned");
    		return redirect()->back();
    	}
    	$player->unban();
    	\Session::flash("good", "$player->username has been unbanned and can now login to the store");
    	return redirect()->back();
    }

    public function show(Player $player){
    	return view('admin.players.show',["player"=>$player]);
    }

    public function ban(Player $player){
    	$this->authorize('ban-players');
    	return view('admin.players.ban',["player"=>$player]);
    }

    public function addBan(Player $player){
    	$this->authorize('ban-players');

    	if($player->isBanned()){
    		\Session::flash("bad", "$player->username is already banned");
    		return redirect()->back();
    	}

		$rules = ["Reason"=>['required', 'string', 'min:16']];
    	$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return redirect()->back()->withErrors($validator);
	    }

	    $player->ban(["comment"=>Request('Reason')]);
		\Session::flash("good", "$player->username has been banned and can no longer login to the store");
	    return redirect()->route('admin.players.index');
    }
}
