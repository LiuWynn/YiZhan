<?php
/**
 * Created by PhpStorm.
 * User: 26016
 * Date: 2019-6-2
 * Time: 0:31
 */

namespace App\Repo;


use App\Model\Student;
use App\Repo\inter\iStudent;

class StudentRepo implements iStudent
{
    /**
     * @var Student 学员数据模型
     */
    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    function insert($data)
    {
        return $this->student->insert($data);
    }

}