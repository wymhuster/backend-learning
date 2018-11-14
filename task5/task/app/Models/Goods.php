<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Goods extends Model
{
    //
    protected $table = 'goods';
    public $timestamps = false;
    private static $instance = null;

    public static function model()
    {
        if (self::$instance == null) {
            return self::$instance = new Goods();
        }
        return self::$instance;
    }

    public function insert($name, $price, $stock, $shop_id)
    {
        $goods_id = DB::table($this->table)->insertGetId([
            'goods_name' => $name, 
            'price' => $price, 
            'number_stock' => $stock, 
            'shop_id' => $shop_id
        ]);
        return $goods_id;
    }

    public function getPriceAndStockById($goods_id) 
    {
        $goods = DB::table($this->table)->where('id', $goods_id)
            ->select('number_stock', 'price')->first();
        return $goods;
    }

    public function deStockById($goods_id, $quantity)
    {
        DB::table($this->table)->where('id', $goods_id)->decrement('number_stock', $quantity);
        return 1;
    }

    public function getAll()
    {
        $result = DB::table('goods')->leftJoin('shop', 'shop.id', '=', 'goods.shop_id')
        ->where('goods.is_deleted', 1)
        ->select('goods.id', 'goods.goods_name', 'goods.price', 'shop.shop_name', DB::raw('goods.number_stock-goods.number_presale as num'))
        ->orderBy('shop.id')->orderBy('goods.goods_name')->get();
        return $result;
    }

    public function isExist($user_id, $goods_id)
    {
        $is_exist = DB::table($this->table)->join('shop', 'shop.id', '=', 'goods.shop_id')
        ->where('goods.id', $goods_id)
        ->where('shop.user_id', $user_id)
        ->where('goods.is_deleted', 1)->exists();
        return $is_exist;
    }

    public function updateStock($id, $new_stock)
    {
        DB::table('goods')->where('id', $id)->update(['number_stock' => $new_stock]);
        return 1;  
    }
}
