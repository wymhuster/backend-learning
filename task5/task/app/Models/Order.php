<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $table = 'order';
    public $timestamps = false;
    private static $instance = null;

    public static function model()
    {
        if (self::$instance == null) {
            return self::$instance = new Order();
        }
        return self::$instance;
    }

    public function insert($user_id, $addr)
    {
        $order_id = DB::table($this->table)->insertGetId([
            'user_id' => $user_id,
            'address' => $addr->address,
            'nickname' => $addr->nickname,
            'telephone_number' => $addr->telephone_number,
        ]);
        return $order_id;
    }
    
}
