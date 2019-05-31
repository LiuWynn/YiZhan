<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::namespace('Admin')->middleware('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});*/

Route::post('/testapi', function () {
    dd(bcrypt(123456));
});


/*
 * 路由前会自动加上 /api/
 * 如 'login' 路由 的 api 为 /api/admin/login
 * */
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {
    // 登录验证
    Route::post('login', 'AuthController@login');
    // 用户信息
    Route::post('user-info', 'AuthController@userInfo');
    // 刷新token
    Route::post('refresh-token', 'AuthController@refreshToken');
    // 获取公司信息
    Route::post('company/info', 'CompanyController@companyInfo');
    // 更新公司信息
    Route::put('company/edit-info', 'CompanyController@editInfo');
    // 获取公司介绍
    Route::post('company/intro', 'CompanyController@intro');
    // 更新公司介绍
    Route::put('company/edit-intro', 'CompanyController@editIntro');
    // 获取招班动态
    Route::post('admission/info', 'AdmissionController@info');
    // 更新招办动态
    Route::put('admission/edit-info', 'AdmissionController@editInfo');
    // 获取添加教师页配置信息
    Route::get('teacher/limit', 'TeacherController@limit');
    // 上传教师头像
    Route::post('teacher/upload-avatar', 'FileController@uploadAvatar');
    // 上传教师作品
    Route::post('teacher/upload-work', 'FileController@uploadWork');
    // 添加教师
    Route::post('teacher/add-teacher', 'TeacherController@create');
    // 获取教师列表
    Route::post('teacher/list', 'TeacherController@getList');
    // 删除教师
    Route::delete('teacher/del-teacher', 'TeacherController@delTeacher');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});