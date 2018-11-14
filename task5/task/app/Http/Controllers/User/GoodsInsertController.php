<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseHelper;
use App\Models\Shop;
use App\Models\Goods;

class GoodsInsertController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('authBySession');
    }

	/**
	 * 显示商品录入界面
	 */
    public function show()
    {
        return view('myUser/goodsInsert');
    }
		
	/**
	 * 对商品录入信息进行存储
	 * @param \Illimunate\Http\Request request('goods_name', 'price', 'number_stock', 'shop_name')
	 * @return json or redirect
	 */
    public function store(Request $request)
    {
		$user_id = base64_decode($request->cookie('user_id', 'default'));
		#使用Validator对表单信息进行验证
		$validator = Validator::make($request->all(), [
			'goods_name' => 'required',
			'price' => 'required|numeric',
			'number_stock' => 'required|numeric',
			'shop_name' => 'required',
		]);
		$shop_id = Shop::model()->getIdByNameAndUserId($request->input('shop_name'), $user_id);
		if ($validator->fails()) {
			return redirect()->action('User\GoodsInsertController@show')->withErrors($validator)->withInput();
		} elseif ($shop_id === 0) {
			return redirect()->action('User\GoodsInsertController@show')->withInput()->withErrors(['此商店不存在']);
        }
        #插入对应的货品信息
		$goods_id = Goods::model()->insert(
			$request->input('goods_name'),
			floatval($request->input('price')), 
			intval($request->input('number_stock')), 
			$shop_id
		);
		return ResponseHelper::getInstance()->jsonResponse(0, ['goods_id' => $goods_id]);
	}
}
