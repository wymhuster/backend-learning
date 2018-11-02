<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    //
    /**
     * 展示登录界面
     */
    public function show()
    {
        return view('myUser/login');
    }

    /**
     * 进行登录检验
     * @param \Illuminate\Http\Request request('name', 'password')
     * @return  json  or redirect  
     */
    public function check(Request $request)
    {
        $name = $request->input('name');
        $password = md5($request->input('password'));
        #判断此用户在数据库中是否存在
        $result = DB::table('user')->where('name', $name)->where('password', $password)->exists();
        if ($result == true) {
            #取出该用户的id，将信息传入cookie中，用以保存登录信息
            $id = DB::table('user')->where('name', $name)->where('password', $password)->select('id')->first();
            $this->addSession();
            $this->addCookie('user_id', $id->id);
            return ResponseHelper::getInstance()->jsonResponse(200, ['user_id' => $id->id]);
        } else {
            return redirect()->action('User\LoginController@show')->withErrors('密码错误');
        }
    }

    /**
     * 添加Cookie
     */
    public function addCookie($key, $val, $min=60)
    {
        return Cookie::queue($key, base64_encode($val), $min);
    }

    /**
     * 添加session
     */
    public function addSession($key='user_check', $cookieMin=60, $num =40)
    {
        $randstr = '';
        for ($i = 0; $i < $num; $i++) {
            $randstr .= chr(mt_rand(33, 126));
        }
        session([$key => $randstr]);
        Cookie::queue($key, $randstr, $cookieMin);
    }
}
