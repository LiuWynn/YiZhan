<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-5-25
 * Time: 16:29
 */

namespace App\Enums;


use Psy\Command\ListCommand\ClassEnumerator;

final class ErrorCode extends ClassEnumerator
{
    const UNAUTHORIZED = 401;  // 授权失败
    const UPDATE_FAIL  = 10001;  // 更新失败
    const SIZE_EXCEED_LIMIT = 10002; // 文件大小超出限制
    const FILE_VALID_FAIL = 10003; // 上传文件不合法
    const FILE_READ_FAIL = 10004; // 配置文件读取失败
    const SQL_INSERT_ERR = 10005; // 数据插入失败
    const SQL_SELECT_ERR = 10006; // 数据查询失败
    const SQL_DELETE_ERR = 10007; // 数据删除失败
}