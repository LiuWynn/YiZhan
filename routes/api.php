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
 * 后台路由
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
    // 修改密码
    Route::put('edit-password', 'AuthController@editPassword');
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
    Route::post('teacher/upload-avatar', 'FileController@uploadTeacherAvatar');
    // 上传教师作品
    Route::post('teacher/upload-work', 'FileController@uploadTeacherWork');
    // 添加教师
    Route::post('teacher/add-teacher', 'TeacherController@create');
    // 获取教师列表
    Route::post('teacher/list', 'TeacherController@getList');
    // 删除教师
    Route::delete('teacher/del-teacher', 'TeacherController@delTeacher');
    // 根据 id 获取教师信息
    Route::get('teacher/get/{id}', 'TeacherController@getTeacher');
    // 根据 id 修改教师信息
    Route::put('teacher/edit', 'TeacherController@editTeacher');
    // 添加校友
    Route::post('student/add-student', 'StudentController@create');
    // 上传学生头像
    Route::post('student/upload-avatar', 'FileController@uploadStudentAvatar');
    // 上传学生作品集
    Route::post('student/upload-work', 'FileController@uploadStudentWork');
    // 获取学生列表
    Route::post('student/list', 'StudentController@getList');
    // 根据 id 获取学员信息
    Route::get('student/get/{id}', 'StudentController@getStudent');
    // 根据 id 修改学员信息
    Route::put('student/edit', 'StudentController@editStudent');
    // 删除学员
    Route::delete('student/del-student', 'StudentController@delStudent');
    // 获取报名者列表
    Route::post('sign/list', 'SignController@getList');
    // 删除报名者
    Route::delete('sign/del-sign','SignController@delSign');
    // 获取站点首页图片等信息
    Route::post('site/get', 'SiteController@get');
    // 上传站点首页轮播图
    Route::post('site/upload-pics', 'FileController@uploadHomePic');
    // 修改站点首页轮播图
    Route::put('site/set', 'SiteController@set');
    // 获取站点配置信息
    Route::post('site/conf', 'SiteController@getConf');
    // 修改站点配置信息
    Route::put('site/edit-conf', 'SiteController@editConf');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

/*
 * 前台路由
 * */
Route::group([
    'namespace' => 'Home',
    'prefix' => 'home'
], function () {
    // 添加保名信息
    Route::post('sign/add-sign', 'SignController@create');
});