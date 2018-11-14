<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shop extends Model
{
    //
    protected $table = 'shop';
    public $timestamps = false;
    private static $instance = null;

    public static function model()
    {
        if (self::$instance == null) {
            return self::$instance = new Shop();
        }
        return self::$instance;
    }

    public function getIdByNameAndUserId($name, $user_id)
    {
        $shop_id = DB::table($this->table)->where('shop_name',$name)->where('user_id', $user_id)->select('id')->first();
        if (isset($shop_id)) {
            return $shop_id->id;
        } 
        return 0;
    }

}
