<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Observers\QueueObserver;
class QueuedCommand extends Model
{
    
    

	public function getPlayer(){
		return \App\Player::find($this->player_id);
	}

    public function getOrder(){
        if($this->order_id == null){
            return null;
        }
        return \App\Order::find($this->order_id);
    }

	public function getServer(){
		return \App\Server::find($this->server_id);
	}

    public static function sendCommand($server, $command, $order_id = null){
    	$cmd = new QueuedCommand;
    	$cmd->server_id = $server->id;
    	$cmd->command = $command;
        $cmd->order_id = $order_id;
        
    	$cmd->save();

    	$server->sendQueuedCommand($cmd);
    }

    public static function sendCommandWithPlayer($server, $command, $player, $need_player_online,$order_id = null){
        $cmd = new QueuedCommand;
        $cmd->server_id = $server->id;
        $cmd->player_id = $player->id;
        $cmd->order_id = $order_id;
        $cmd->need_player_online = $need_player_online;
        $cmd->command = $command;
        $cmd->save();

        $server->sendQueuedCommand($cmd);
    }

    public function resend(){
        $server = \App\Server::find($this->server_id);
        $server->sendQueuedCommand($this);
    }

    public function getSocketCommand(){
        $server = \App\Server::find($this->server_id);
        return $server->getSocketCommand($this);
    } 
}
