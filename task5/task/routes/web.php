<?php

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user/register', 'User\RegisterController@show');

Route::post('user/store', 'User\RegisterController@register');

Route::get('user/login', 'User\LoginController@show');

Route::post('user/logincheck', 'User\LoginController@check');

Route::get('user/order/search', 'User\SearchController@orderSearch');

Route::get('user/goods/buy', 'User\BuyController@show');

Route::post('user/goods/buy/store', 'User\BuyController@goodsBuy');

Route::get('goods/searchall', 'User\SearchController@goodsSearchAll');

Route::get('user/shop/goods/manage', 'User\StoreManageController@show');

Route::post('user/shop/goods/manage/store', 'User\StoreManageController@storeManage');

Route::get('user/shop/goods/insert', 'User\GoodsInsertController@show');

Route::post('user/shop/goods/insert/store', 'User\GoodsInsertController@store');

Route::get('clear', function () {
    session()->flush();
    Cookie::queue(Cookie::forget('user_id'));
    return 'success';
}); 
