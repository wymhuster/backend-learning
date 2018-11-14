<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Receipt extends Model
{
    protected $table = 'receipt';
    public $timestamps = false;
    private static $instance = null;

    public static function model()
    {
        if (self::$instance == null) {
            return self::$instance = new Receipt();
        }
        return self::$instance;
    }

    public function getReceiptById($id)
    {
        $addr = DB::table($this->table)->where('id', $id)->select('address', 'nickname', 'telephone_number')->first();
        return $addr;
    }
}
