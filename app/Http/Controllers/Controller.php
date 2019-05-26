<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get response after request some resource
     *
     * @param $isOk
     * @param $result
     * @param null $errorCode
     * @param null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($isOk, $result, $errorCode = null, $msg = null)
    {
        $response = array(
            'success' => $isOk,
            'result' => $result,
            'error' => [
                'code' => $errorCode,
                'msg' => $msg
            ]
        );
        return response()->json($response);
    }

    /**
     * Get the token array structure.
     *
     * @param $isOk
     * @param $result
     * @param $token
     * @param null $errorCode
     * @param null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($isOk, $result, $token, $errorCode = null, $msg = null)
    {
        $response = array(
            'success' => $isOk,
            'result' => $result,
            'error' => [
                'code' => $errorCode,
                'msg' => $msg
            ]
        );
        $response['result']['token'] = $token;
        return response()->json($response);
    }
}
