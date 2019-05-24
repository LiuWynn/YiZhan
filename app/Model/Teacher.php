<?php

namespace App\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

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
