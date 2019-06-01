<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-6-2
 * Time: 0:31
 */

namespace App\Repo\inter;


interface iStudent
{
    /**
     * 添加学员
     * @param $data
     * @return mixed
     */
    function insert($data);
}