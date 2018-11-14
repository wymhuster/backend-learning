<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckLoginBySession
{
    /**
     * Handle an incoming request.
     * 通过session和cookie检查登录，如果不通过重定向到登录界面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $val = session('user_check', 'default');
        $cookie = Cookie::get('user_check', 'default');
        if ($val ===  'default' or $cookie === 'default' or $val !== $cookie) {
            return redirect()->action('User\LoginController@show');
        } 
        return $next($request);
    }
}
