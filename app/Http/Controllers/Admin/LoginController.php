<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function loginHandle() {
        $response = [
            'success' => false,
            'error' => [
                'code' => 10005,
                'msg' => '这是登录验证方法'
            ]
        ];
        return $response;
    }
}
