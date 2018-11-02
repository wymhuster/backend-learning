<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseHelper;

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
            'gender' => 'regex:~[01]~',
        ]);
        #若验证失败重定向到注册界面
        if ($validator->fails()) {
            return redirect()->action('User\RegisterController@show')->withInput($request->except('password'))->withErrors($validator);
        }
        $name = $request->input('name');
        $password = md5($request->input('password'));
        $telephone_number = $request->input('telephone_number');
        $birthday = $request->input('birthday');
        $province = $request->input('province');
        $gender = $request->input('gender');
        #向数据库插入数据
        #DB::insert('insert into user (name, password, telephone_number, birthday, province, gender) values (?, ?, ?, ?, ?, ?)', [$name, $password, $telephone_number, $birthday, $province, $gender]);
        $user_id = DB::table('user')->insertGetId([
            'name' => $name, 
            'password' => $password, 
            'telephone_number' => $telephone_number, 
            'birthday' => $birthday, 
            'province' => $province,
            'gender' => $gender
            ]);
        return ResponseHelper::getInstance()->jsonResponse(200, ['user_id'=>$user_id]);
    }
}
