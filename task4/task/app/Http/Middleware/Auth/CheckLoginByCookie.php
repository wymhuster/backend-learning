<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckLoginByCookie
{
    /**
     * Handle an incoming request.
     * 通过cookie检查登录，如果不通过，重定向到登录界面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cookie = $request->cookie('user_id', 'default');
        $cookie_decode = base64_decode($cookie);
        $is_exist = DB::table('user')->where('id', $cookie_decode)->exists();
        if ($cookie === 'default' ) {
            return redirect()->action('User\LoginController@show');
        }
        return $next($request);
    }
}
