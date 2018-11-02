<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;

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
		#判断录入商品的用户是否拥有要录入商品的商铺
		$is_exist = DB::table('shop')->where('shop_name', $request->input('shop_name'))->where('user_id', $user_id)->exists();
		if ($validator->fails()) {
			return redirect()->action('User\GoodsInsertController@show')->withErrors($validator)->withInput();
		} elseif ($is_exist != true) {
			return redirect()->action('User\GoodsInsertController@show')->withInput()->withErrors(['此商店不存在']);
		}
		#取出要录入商品的商铺ID
		$shop_id = DB::table('shop')->where('shop_name', $request->input('shop_name'))->where('user_id', $user_id)->select('id')->first()->id;
		$goods_id = DB::table('goods')->insertGetId(['goods_name' => $request->input('goods_name'), 'price' => floatval($request->input('price')), 'number_stock' => intval($request->input('number_stock')), 'shop_id' => $shop_id]);
		return ResponseHelper::getInstance()->jsonResponse(200, ['goods_id' => $goods_id]);
	}
}
