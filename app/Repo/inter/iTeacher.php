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

    /**
     * 插入一条教师记录
     * @param $data
     * @return mixed
     */
    function insert($data);

    /**
     * 查找满足条件的教师列表
     * @param null $keyword
     * @return mixed
     */
    function getTeacherList($keyword = null);

    /**
     * 删除教师
     * @param $id
     * @return mixed
     */
    function del($id);
}