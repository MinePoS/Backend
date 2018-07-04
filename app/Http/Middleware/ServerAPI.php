<?php

namespace App\Http\Middleware;

use Closure;

class ServerAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = request("apikey");
        if($key == null){
            return response()->json(array("error"=>"no apikey given"));
        }
        $server = \App\Server::where('api_key', $key)->first();
        if($server == null || $server->enabled == false){
            return response()->json(array("success"=>false,"error"=>"server not found"));
        }
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $server->last_used = $current_time;
        $server->save();
        $request->attributes->add(['server' => $server]);
        return $next($request);
    }
}
