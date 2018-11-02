<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;

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
            #查询该商品是否存在
            $is_exist = DB::table('goods')->join('shop', 'shop.id', '=', 'goods.shop_id')
            ->where('shop.user_id', $user_id)
            ->where('goods.is_deleted', 1)->exists();
            if ($is_exist == true) {
                #更新库存
                DB::table('goods')->where('id', intval($request->input('goods_id')))->update(['number_stock' => intval($request->input('new_num_stock'))]);
                return ResponseHelper::getInstance()->jsonResponse(200);
            }
            else {
                return ResponseHelper::getInstance()->jsonResponse(403, ['error' => 'this goods dose not exist']);;
            }
        } else {
            return back();
        }
    }
}
