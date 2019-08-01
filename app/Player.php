<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

class Player extends Model implements BannableContract
{
    use Bannable;
    protected $fillable = ["*"];

    public function orders(){
    	return \App\Order::where('player_id',$this->id);
    }
}
