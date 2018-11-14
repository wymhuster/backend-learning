<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Goods;

class StoreManageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('authBySession');
    }

    public function show()
    {
        return view('myUser/storeManage');
    }

    /**
     * 库存管理
     * @param \Illuminate\Http\Request request('goods_id', 'new_num_stock')
     * @return json or redirect
     */
    public function storeManage(Request $request)
    {
        if ($request->has(['goods_id', 'new_num_stock'])) {
            $user_id = base64_decode($request->cookie('user_id'));
            #查询该商品是否属于对应的用户
            $is_exist = Goods::model()->isExist($user_id, intval($request->input('goods_id')));
            #return ResponseHelper::getInstance()->jsonResponse(0,$is_exist);
            if ($is_exist == true) {
                #更新库存
                Goods::model()->updateStock(intval($request->input('goods_id')), intval($request->input('new_num_stock')));
                return ResponseHelper::getInstance()->jsonResponse(0);
            }
            else {
                return ResponseHelper::getInstance()->jsonResponse(1, ['error' => 'this goods dose not exist']);;
            }
        } else {
            return back();
        }
    }
}
