<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-5-25
 * Time: 15:56
 */

namespace App\Repo\inter;


interface iTeacher
{
    /**
     * 校验登录数据格式
     * @param $data
     * @return mixed
     */
    function validateLogin($data);
}