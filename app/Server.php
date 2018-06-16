<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Server extends Model
{
    //
    protected $dates = [
        'last_used',
    ];

    public function runCommands($commands){
    	foreach($commands as $command){ 
    		$this->runCommand($command); 
    	}
    }
    public function runCommand($command){
    	if($this->type == "plugin"){
    		$cmd = new \App\CommandQueue;
    		$cmd->server_id = $this->id;
    		$cmd->command = $command;
    		$cmd->save();
    		return $cmd;
    	}elseif($this->type == "pterodactyl"){

    		$base_link = \Setting::get('pterodactyl_link')."client/servers/".$this->ptero_id."/command";
			$authorization= "Authorization: Bearer ".\Setting::get('pterodactyl_key');

		    $curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $base_link."?command=".$command,
			    CURLOPT_HTTPHEADER => array( 
			    	$authorization,
			    	"Accept: application/vnd.pterodactyl.v1+json",
			    	"Content-Type: application/json"
   				),
			    CURLOPT_POST => 1,
			    CURLOPT_CUSTOMREQUEST => "POST",                                                              
			));
			$result = curl_exec($curl);
			curl_close($curl);
			if($result == ""){
				Log::info("[$this->name] Command Ran: $command");
				return true;
			}else{
				return false;
			}
			
			// $cmd = new \App\CommandQueue;
   //  		$cmd->server_id = $this->id;
   //  		$cmd->command = $command;
   //  		$cmd->save();
   //  		return $cmd;   		
    		//return "Boom! Magic! did it work? no? huh... Maybe i should code it...";
    	}
    }
}
