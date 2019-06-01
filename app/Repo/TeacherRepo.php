<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-5-25
 * Time: 15:57
 */

namespace App\Repo;


use App\Model\Teacher;
use App\Repo\inter\iTeacher;
use Illuminate\Support\Facades\Validator;

class TeacherRepo implements iTeacher
{
    /**
     * @var Teacher
     */
    private $teacher;

    /**
     * 依赖注入
     * TeacherRepo constructor.
     * @param Teacher $teacher
     */
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    function validateLogin($data)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        $messages = array(
            'email.required' => '登录邮箱为空',
            'email.email' => '邮箱格式错误，请检查',
            'password.required' => '密码为空'
        );
        return Validator::make($data, $rules, $messages);
    }

    function insert($data)
    {
        return $this->teacher->insert($data);
    }

    function getTeacherList($keywords = null)
    {

        return $this->teacher
            ->where(function($query) use ($keywords) {
                if (isset($keywords['name']))
                    $query->where('name', 'like', '%'.$keywords['name'].'%');
                if (isset($keywords['email']))
                    $query->where('email', $keywords['email']);
                if (isset($keywords['phone']))
                    $query->where('phone', $keywords['phone']);
            })
            ->select('tid', 'name', 'email', 'phone', 'qq', 'weixin', 'job', 'roles')
            ->get();
    }

    function del($id)
    {
        return $this->teacher
            ->where('tid', $id)
            ->delete();
    }

    function get($id)
    {
        return $this->teacher
            ->where('tid', $id)
            ->select('tid', 'name', 'email', 'phone', 'qq', 'weixin',
                'job', 'intro', 'project', 'avatar', 'works', 'roles')
            ->first();
    }

    function edit($id, $data)
    {
        return $this->teacher
            ->where('tid', $id)
            ->update($data);
    }


}