<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('authBySession')->only('orderSearch');
    }

    /**
     * 订单查询
     * @param \Illuminate\Http\Request request()
     * @return json
     */
    public function orderSearch(Request $request)
    {
        $cookie = $request->cookie('user_id', 'default');
        $id = base64_decode($cookie);
        $is_exist = DB::table('user')->where('id', $id)->exists();
        if ($id === 'default' or $is_exist !==  true) {
            return redirect()->route('loginview');
        }
        $result = DB::table('orderitem')->leftJoin('goods', 'goods.id', '=', 'orderitem.goods_id')
        ->join('order', 'orderitem.order_id', '=', 'order.id')
        ->where('order.user_id', $id)
        ->select('orderitem.order_id', 'goods.goods_name', 'orderitem.quantity', 'orderitem.price', DB::raw('convert(orderitem.quantity*orderitem.price,decimal(10,2)) as total'))
        ->orderBy('orderitem.order_id')->orderBy('goods.goods_name')->get();
        return ResponseHelper::getInstance()->jsonResponse(200, $result);
    }

    /**
     * 商品查询
     * @param \Illuminate\Http\Request request
     * @return json
     */
    public function goodsSearchAll(Request $request)
    {
        $result = DB::table('goods')->leftJoin('shop', 'shop.id', '=', 'goods.shop_id')
        ->where('goods.is_deleted', 1)
        ->select('goods.id', 'goods.goods_name', 'goods.price', 'shop.shop_name', DB::raw('goods.number_stock-goods.number_presale as num'))
        ->orderBy('shop.id')->orderBy('goods.goods_name')->get();
        return ResponseHelper::getInstance()->jsonResponse(200, $result);   
    }
}
