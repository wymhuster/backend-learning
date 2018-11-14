<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseHelper;
use App\Models\User;

class RegisterController extends Controller
{
    //
    /**
     * 显示注册界面
     */
    public function show()
    {
        return view('myUser/register');
    }

    /**
     * 对注册信息进行验证后再将信息写入数据库
     * @param \Illuminate\Http\Request request('name', 'password', 'telephone_number', 'birthday', 'province', 'gender')
     * @return json or redirect
     */
    public function register(Request $request)
    {
        #使用Validator对表单信息进行验证
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:user,name',
            'password' => 'required|min:6',
            'telephone_number' => 'required|unique:user,telephone_number',
            'birthday' => 'required|date',
            'province' => 'required', 
            'gender' => 'required|regex:~[01]~',
        ]);
        #若验证失败重定向到注册界面
        if ($validator->fails()) {
            return redirect()->action('User\RegisterController@show')->withInput($request->except('password'))->withErrors($validator);
        }
        #插入用户数据
        $user_id = User::model()->insert($request->all());
        return ResponseHelper::getInstance()->jsonResponse(0, ['user_id' => $user_id]);
    }
}
