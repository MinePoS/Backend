<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\QueuedCommand;

class Order extends Model
{

	public function getPlayer(){
		return \App\Player::find($this->player_id);
	}

    public function PaymentProvider(){
    	return \App::make($this->payment_gateway)->loadOrder($this);
    }

    public static function lastProcessed($num)
    {
    	return \App\Order::where("status","paid")->orWhere("status","fulfilled")->orderBy('created_at', 'desc')->take($num)->get();
    }

    public function commandsLeft(){
        return QueuedCommand::where('order_id', $this->id);
    }

    public function getHead(){
    	return \Store::getHeadCustom($this->getPlayer()->uuid,64);
    }
    public function getUsername(){
    	return $this->getPlayer()->username;
    }

    public function getStatusLabel(){
        //
//['awaiting_payment', 'paid', 'fulfilled', 'refunded', 'charge_back', 'deleted']
        switch ($this->status) {
            case "awaiting_payment":
                return '<span class="label label-warning">Awaiting Payment</span> ';
                break;
            case "paid":
                return '<span class="label label-success">Paid</span> ';
                break;
            case "fulfilled":
                return '<span class="label label-success">Completed</span> ';
                break;
            case "refunded":
                return '<span class="label label-primary">Refunded</span> ';
                break;
            case "charge_back":
                return '<span class="label label-danger">Charged Back</span> ';
                break;
            case "deleted":
                return '<span class="label label-primary">Deleted</span> ';
                break;
            default:
                return '<span class="label label-danger">You shouldnt see this</span> ';
        } 
    }
}
