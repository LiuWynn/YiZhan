<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $table = 'sign';

    /**
     * 设置主键
     * @var string
     */
    public $primaryKey = 'sid';

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
