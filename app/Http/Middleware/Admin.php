<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $response = $next($request);
        if(session()->get('username') && session()->get('password')  ){
        return $response;
//            return $next($request);
        }else{
            return redirect('/')->with('errors','请先登录！');
        }
    }
}
