<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $table = 'teacher';

    /**
     * 设置主键
     * @var string
     */
    public $primaryKey = 'tid';

    /**
     * 采用自增主键方案
     * @var bool
     */
    public $incrementing = true;

    /**
     * 不自动维护时间字段
     * @var bool
     */
    public $timestamps = false;
}
