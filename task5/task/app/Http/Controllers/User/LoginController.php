<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

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
        $id = User::model()->getIdByNameAndPassword($name, $password);
        #判断此用户在数据库中是否存在
        if (isset($id)) {
            #取出该用户的id，将信息传入cookie中，用以保存登录信息
            $this->addSession();
            $this->addCookie('user_id', $id->id);
            return ResponseHelper::getInstance()->jsonResponse(0, ['user_id' => $id->id]);
        } else {
            return ResponseHelper::getInstance()->jsonResponse(1, ['error' => 'password is not current']);
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
