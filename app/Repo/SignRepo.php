<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-6-3
 * Time: 20:09
 */

namespace App\Repo;


use App\Model\Sign;
use App\Repo\inter\iSign;

class SignRepo implements iSign
{
    /**
     * @var Sign 报名者数据模型
     */
    private $sign;

    public function __construct(Sign $sign)
    {
        $this->sign = $sign;
    }

    function insert($data)
    {
        return $this->sign->insert($data);
    }

    function getSignList($keywords = null)
    {
        return $this->sign
            ->where(function ($query) use ($keywords) {
                if (isset($keywords['name']))
                    $query->where('name', 'like', '%' . $keywords['name'] . '%');
                if (isset($keywords['phone']))
                    $query->where('phone', $keywords['phone']);
                if (isset($keywords['location']))
                    $query->where('location', 'like', '%' . $keywords['location'] . '%');
            })
            ->select('sid', 'name', 'age', 'phone', 'qq',
                'education', 'location', 'comment')
            ->get();
    }

    function del($id)
    {
        return $this->sign
            ->where('sid', $id)
            ->delete();
    }


}