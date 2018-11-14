<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderItem extends Model
{
    //
    protected $table = 'orderitem';
    public $timestamps = false;
    private static $instance = null;

    public static function model()
    {
        if (self::$instance == null) {
            return self::$instance = new OrderItem();
        }
        return self::$instance;
    }

    public function insert($order_id, $goods_id, $quantity, $price)
    {
        $orderitem_id = DB::table($this->table)->insertGetId([
            'order_id' => $order_id,
            'goods_id' => $goods_id,
            'quantity' => $quantity,
            'price' => $price,
        ]);
        return $orderitem_id;
    }

    public function getAllByUserId($user_id)
    {
        $result = DB::table($this->table)->leftJoin('goods', 'goods.id', '=', 'orderitem.goods_id')
        ->join('order', 'orderitem.order_id', '=', 'order.id')
        ->where('order.user_id', $user_id)
        ->select('orderitem.order_id', 'goods.goods_name', 'orderitem.quantity', 'orderitem.price', DB::raw('convert(orderitem.quantity*orderitem.price,decimal(10,2)) as total'))
        ->orderBy('orderitem.order_id')->orderBy('goods.goods_name')->get();
        return $result;
    }
}
