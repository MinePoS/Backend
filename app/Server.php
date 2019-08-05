<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
	protected $fillable = ['*'];

public static function getAllEnabled(){
	return Server::where("enabled",1)->get();
}
	public function sendQueuedCommand($cmd){
		\App\SocketClient::daemonSend($this->getSocketCommand($cmd));
	}

	public function getSocketCommand($cmd){
		$tosend = array("send_to"=>$this->api_key,"action"=>"command","command"=>$cmd->command,"queued_id"=>"$cmd->id");
		if($cmd->need_player_online && $cmd->player_id != null){
			$player = $cmd->getPlayer();
			$tosend["player"] = $this->format_uuid($player->uuid);
		}
		return json_encode($tosend);
	} 
	
	public function sendCommand($command){
		$tosend = array("send_to"=>$this->api_key,"action"=>"command","command"=>$command);
		\App\SocketClient::daemonSend(json_encode($tosend));
	}

	public function sendCommandNeedPlayer($command,\App\Player $player){
		$tosend = array("send_to"=>$this->api_key,"action"=>"command","command"=>$command,"player"=>$this->format_uuid($player->uuid));
		\App\SocketClient::daemonSend(json_encode($tosend));
	}

    public static function fromAPIKEY($key){
    	return Server::where("api_key",$key)->where("enabled", true)->where('type','plugin')->get();
    }

    function format_uuid($uuid) {
    $uuid = $this->minify_uuid($uuid);
    if (is_string($uuid)) {
        return substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
    }
    return false;
}
function minify_uuid($uuid) {
    if (is_string($uuid)) {
        $minified = str_replace('-', '', $uuid);
        if (strlen($minified) === 32) {
            return $minified;
        }
    }
    return false;
}
}
