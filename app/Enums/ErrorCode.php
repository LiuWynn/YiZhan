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
}