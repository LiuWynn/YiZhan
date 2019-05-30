<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-5-26
 * Time: 21:26
 */

namespace App\Repo;


use App\Repo\inter\iKits;

class KitsRepo implements iKits
{
    /**
     * 分配权限
     * @param string $roles
     * @return array|mixed
     */
    function dispatchPermissions($roles)
    {

        if (strstr($roles, 'admin')) {  // 用户是管理员
            $permissions = array([
                'path' => '/admin/index'  // 首页
            ], [
                'path' => '/admin/company/intro',  // 公司简介
                'permission' => ['add', 'modify']
            ], [
                'path' => '/admin/company/info',  // 公司信息
                'permission' => ['add', 'modify']
            ], [
                'path' => '/admin/admission',  // 招班动态
                'permission' => ['add', 'modify']
            ], [
                'path' => '/admin/teacher/list',  // 教师列表
                'permission' => ['modify', 'delete']
            ], [
                'path' => '/admin/teacher/add',  // 添加教师
                'permission' => ['add']
            ], [
                'path' => '/admin/student/list',  // 校友列表
                'permission' => ['modify', 'delete']
            ], [
                'path' => '/admin/student/add',  // 添加校友
                'permission' => ['add']
            ], [
                'path' => '/admin/sign/list',  // 保名人列表
                'permission' => ['modify', 'delete']
            ], [
                'path' => '/admin/site/homepage', // 站点主页配置
                'permission' => ['add', 'modify']
            ], [
                'path' => '/admin/site/config',  // 站点配置信息
                'permission' => ['add', 'modify']
            ]);
        } else {  // 用户不是管理员
            $permissions = array([
                'path' => '/admin/index'  // 首页
            ], [
                'path' => '/admin/company/intro' // 公司简介
            ], [
                'path' => '/admin/company/info'  // 公司信息
            ], [
                'path' => '/admin/admission'  // 招班动态
            ], [
                'path' => '/admin/sign/list'  // 保名人列表
            ]);
        }
        return $permissions;
    }

    function toMB($Byte)
    {
        return round($Byte / (1024 * 1024), 2);
    }

    function uploadImg($savePath, $filePath, $img, $type)
    {
        // 生成唯一的文件名
        $ext = $img->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $ext;
        // 移动文件到指定目录
        $img->move($savePath . DIRECTORY_SEPARATOR . $filePath, $fileName);
        if ($type == 'avatar')
            $url = url('avatars/' . $filePath . '/' . $fileName);
        else
            $url = url('works/' . $filePath . '/' . $fileName);
        return array('name' => $img->getClientOriginalName(), 'url' => $url);
    }

}