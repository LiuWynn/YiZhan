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

    /**
     * 获取学生列表
     * @param $keywords
     * @return mixed
     */
    function getStudentList($keywords = null);

    /**
     * 根据 id 查询学员
     * @param $id
     * @return mixed
     */
    function get($id);

    /**
     * 根据 id 修改学员
     * @param $sid
     * @param $data
     * @return mixed
     */
    function edit($sid, $data);

    /**
     * 删除学员
     * @param $sid
     * @return mixed
     */
    function del($sid);

    /**
     * 统计学员总数
     * @return mixed
     */
    function total();
}