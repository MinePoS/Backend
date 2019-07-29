<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function PaymentProvider(){
    	return \App::make($this->payment_gateway)->loadOrder($this);
    }
}
