<?php
/**
 * Created by PhpStorm.
 * User: zhangqianyi
 * Date: 2017/12/5
 * Time: 16:41
 */
namespace App\Helpers;

class ResponseHelper{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new ResponseHelper();
        }

        return self::$instance;
    }

    public function jsonResponse($errorCode, $result = array(), $msg = '', $extraInfo = array()){
        $response = response()->json([
            'errorCode' => $errorCode,
            'data' => $result,
            'msg' => $msg == '' ? config("errorCode.$errorCode", '') : $msg,
            'extraInfo' => $extraInfo,
        ]);
        return $response;
    }


    public function jsonWithCacheInfo($errorCode, $result = array(), $msg = '', $extraInfo = array()) {
        return $this->jsonResponse($errorCode, $result, $msg, $extraInfo)
            ->header('Cache-Control', 'public, max-age=3600');
    }
}