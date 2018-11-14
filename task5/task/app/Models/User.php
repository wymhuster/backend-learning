<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class User extends Model
{
    //
    protected $table = 'user';
    public $timestamps = false;
    private static $instance = null;

    public static function model()
    {
        if (self::$instance == null) {
            return self::$instance = new User();
        }
        return self::$instance;
    }

    public function insert($data)
    {
        $user_id = DB::table($this->table)->insertGetId([
            'name' => $data['name'], 
            'password' => md5($data['password']), 
            'telephone_number' => $data['telephone_number'], 
            'birthday' => $data['birthday'], 
            'province' => $data['province'],
            'gender' => $data['gender']
        ]);
        return $user_id;  
    }

    public function getIdByNameAndPassword($name, $password)
    {
        $id = DB::table($this->table)->where('name', $name)->where('password', $password)->select('id')->first();
        return $id;
    }
}
