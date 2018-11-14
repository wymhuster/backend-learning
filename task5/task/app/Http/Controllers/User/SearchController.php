<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Goods;

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
        #查询订单信息
        $result = OrderItem::model()->getAllByUserId($id);
        if ($id === 'default' or !isset($result)) {
            return redirect()->route('loginview');
        }
        return ResponseHelper::getInstance()->jsonResponse(0, $result);
    }

    /**
     * 商品查询
     * @param \Illuminate\Http\Request request
     * @return json
     */
    public function goodsSearchAll(Request $request)
    {   
        #查询所有商品
        $result = Goods::model()->getAll();
        return ResponseHelper::getInstance()->jsonResponse(0, $result);   
    }
}
