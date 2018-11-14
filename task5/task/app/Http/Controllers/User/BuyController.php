<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Cookie;
use App\Models\Goods;
use App\Models\Receipt;
use App\Models\Order;
use App\Models\OrderItem;

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
            #获取对应商品的价格和库存
            $goods = Goods::model()->getPriceAndStockById($request->input('goods_id'));
            $num = $goods->number_stock-$request->input('quantity');
            #获取收获信息
            $addr = Receipt::model()->getReceiptById($request->input('receipt_id'));
            if ($num > 0 and isset($addr)) {
                #修改数据库库存
                Goods::model()->deStockById($request->input('goods_id'), $request->input('quantity'));
                #插入订单信息
                $order_id = Order::model()->insert($user_id, $addr);
                $orderitem_id = OrderItem::model()->insert($order_id, $request->input('goods_id'), $request->input('quantity'), $goods->price);
                return ResponseHelper::getInstance()->jsonResponse(0, ['order_id' => $order_id, 'orderitem_id' => $orderitem_id]);
            } elseif ($num <= 0) {
                return ResponseHelper::getInstance()->jsonResponse(1, ['error' => 'not enough']);
            } else {
                return ResponseHelper::getInstance()->jsonResponse(1, ['error' => 'this adderss does not belong to you']);
            }
        } else {
            return back();
        }
    }
}
