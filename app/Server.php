<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    public function runCommand($command, $uuid=null, $orderid = null){
    	if($this->type == "plugin"){

            $cmd = new \App\CommandQueue;
            $cmd->server_id = $this->id;
            $cmd->command = $command;
            $cmd->save();

            $base_link = $this->http_server_ip."/runcommand";
            $curl = curl_init();
            $b64command = base64_encode($command);
            $curlURL = $base_link."?command=".$b64command."&QueueID=".$cmd->id;
            if($uuid != null){
                $curlURL = $curlURL."&uuid=".$uuid;
            }
            if($orderid != null){
                $curlURL = $curlURL."&orderid=".$orderid;
            }
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $curlURL,
                CURLOPT_HTTPHEADER => array( 
                    "MINEPOS_AUTH: $this->api_key",
                ),                                       
            ));
            $result = curl_exec($curl);
            curl_close($curl);

            if($result == ""){
                Log::info("[$this->name] Command Ran: $command");
                return true;
            }else{
                return false;
            }

    		return $cmd;
    	
        }elseif($this->type == "pterodactyl"){

    		$base_link = \Setting::get('pterodactyl_link')."client/servers/".$this->ptero_id."/command";
			$authorization= "Authorization: Bearer ".\Setting::get('pterodactyl_key');

		    $curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $base_link."?".http_build_query(array('command'=>$command)),
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
				Log::info("ERROR: $result");
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
