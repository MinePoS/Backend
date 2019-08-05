<?php

namespace App\Observers;

use App\QueuedCommand;

class QueueObserver
{
	public function deleted(QueuedCommand $item){
   		$order = $item->getOrder();
   		$server = $item->getServer();

		if($order == null){
			return;
      	}

      	$orderData = json_decode($order->order_data,true);
      	
      	if($orderData->ranCommands == null){
      		$orderData->ranCommands = new arry();
      	}
		$ranCommands = $orderData->ranCommands;
      	$commandData = [
      		"command" => $item->command,
      		"server" => $server->name,
      		"ran_at" => \Carbon\Carbon::now(),
      	];

      	array_push($ranCommands, $commandData);

		$orderData->ranCommands = $ranCommands;

		$order->order_data = json_encode($orderData,true);

      	$left = $order->commandsLeft()->count();
      	if($left == 0){
      		$order->status = "fulfilled";
      	}

      	$order->save();
	}
}
