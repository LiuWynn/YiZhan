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
     * @param string $roles
     * @return mixed
     */
    function dispatchPermissions($roles);
}