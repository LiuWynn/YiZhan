<?php

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

// 测试路由
Route::get('/testapi', function() {
//    header("Access-Control-Allow-Origin:*");
    $response = [
        'success' => false,
        'error' => [
            'code' => 10005,
            'msg' => '这是一个随便编的错误'
        ]
    ];
    return $response;
});

// 前端路由
Route::namespace('Home')->group(function () {
});

// 后端路由
Route::namespace('Admin')->prefix('api/admin')->group(function () {
//    Route::get('/login-handle', 'LoginController@loginHandle');
    Route::post('testpost', 'LoginController@testpost');
});