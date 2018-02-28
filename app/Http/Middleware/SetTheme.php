<?php

namespace App\Http\Middleware;
use Igaster\LaravelTheme\Facades\Theme;
use anlutro\LaravelSettings\Facade as Setting;
use Closure;

class SetTheme
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
        $theme = Setting::get('theme', null);
        if($theme != null){
            if(Theme::exists($theme)){
                Theme::set($theme);
            }
        }

        return $next($request);
    }
}
