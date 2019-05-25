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

}