<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-6-3
 * Time: 20:09
 */

namespace App\Repo\inter;


interface iSign
{
    /**
     * 添加保名者
     * @param $data
     * @return mixed
     */
    function insert($data);

    /**
     * 获取报名者列表，可根据条件搜索
     * @param null $keywords
     * @return mixed
     */
    function getSignList($keywords = null);

    /**
     * 根据 id 删除报名者
     * @param $id
     * @return mixed
     */
    function del($id);

}