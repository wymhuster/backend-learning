<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class BuyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('authBySession');

    }

    public function show()
    {
        return view('myUser/buy');
    }

    /**
     * @param \Illuminate\Http\Request request('goods_id', 'quantity', 'receipt_id')
     * @return json or redirect
     */
    public function goodsBuy(Request $request)
    {   
        $user_id = base64_decode(Cookie::get('user_id'));
        if ($request->has(['goods_id', 'quantity', 'receipt_id'])) {
            #找出要购买物品的库存和价格
            $goods = DB::table('goods')->where('id', $request->input('goods_id'))
            ->select('number_stock', 'price')->first();
            $num = $goods->number_stock-$request->input('quantity');
            $is_exist = DB::table('receipt')->where('user_id', $user_id)->where('id', $request->input('receipt_id'))->exists();
            #判断库存是否足够
            if ($num > 0 and $is_exist == true) {
                #修改数据库库存
                DB::table('goods')->where('id', $request->input('goods_id'))->decrement('number_stock', $request->input('quantity'));
                #取出对应收货地址的信息
                $addr = DB::table('receipt')->where('id', $request->input('receipt_id'))->select('address', 'nickname', 'telephone_number')->first();
                #插入订单信息q
                $order_id = DB::table('order')->insertGetId([
                    'user_id' => $user_id,
                    'address' => $addr->address,
                    'nickname' => $addr->nickname,
                    'telephone_number' => $addr->telephone_number,
                ]);
                #DB::insert('insert into order (user_id, address, nickname, telephone_number) values (?, ?, ?, ?)', [$user_id, $addr->address, $addr->nickname, $addr->telephone_number]);
                $orderitem_id = DB::table('orderitem')->insertGetId([
                    'order_id' => $order_id,
                    'goods_id' => $request->input('goods_id'),
                    'quantity' => $request->input('quantity'),
                    'price' => $goods->price,
                ]);
                return ResponseHelper::getInstance()->jsonResponse(200, ['order_id' => $order_id, 'orderitem_id' => $orderitem_id]);
            } elseif ($num <= 0) {
                return ResponseHelper::getInstance()->jsonResponse(403, ['error' => 'not enough']);
            } else {
                return ResponseHelper::getInstance()->jsonResponse(403, ['error' => 'this adderss does not belong to you']);
            }
        } else {
            return back();
        }
    }
}
