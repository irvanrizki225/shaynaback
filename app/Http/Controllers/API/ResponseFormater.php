<?php

namespace App\Http\Controllers\API;

class ResponseFormater
{

    protected static $response = [
    'Meta' => [
        'code' => 200,
        'status' => 'success',
        'message' => null
    ],
    'data' => null
    ];

    public static function success($data=null,$message=null)
    {
        self::$response['Meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['Meta']['code']);
    }

    public static function error($data=null, $message=null, $code=null)
    {
        self::$response['Meta']['status'] = 'error';
        self::$response['Meta']['code'] = $code;
        self::$response['Meta']['message'] = $message;
        self::$response['data'] = 'data';

        return response()->json(self::$response, self::$response['Meta']['code']);
    }

}