<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-5-26
 * Time: 21:23
 * 小工具类（包含一些小方法）
 */

namespace App\Repo\inter;


interface iKits
{
    /**
     * 根据用户角色分配权限
     *
     * @param string $roles
     * @return mixed
     */
    function dispatchPermissions($roles);

    /**
     * Byte转化成MB
     * @param $Byte
     * @return mixed
     */
    function toMB($Byte);

    /**
     * 处理上传的图片
     *
     * @param $savePath
     * @param $filePath
     * @param $img
     * @param $type
     * @param $role
     * @return mixed
     */
    function uploadImg($savePath, $filePath, $img, $type, $role);
}