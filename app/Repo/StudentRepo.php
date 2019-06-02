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

    function getStudentList($keywords = null)
    {
        return $this->student
            ->where(function ($query) use ($keywords) {
                if (isset($keywords['name']))
                    $query->where('name', 'like', '%' . $keywords['name'] . '%');
                if (isset($keywords['company']))
                    $query->where('company', 'like', '%' . $keywords['company'] . '%');
                if (isset($keywords['major']))
                    $query->where('major', 'like', '%' . $keywords['major'] . '%');
            })
            ->select('sid', 'name', 'education', 'profession',
                'salary', 'position', 'company', 'major')
            ->get();
    }

    function get($id)
    {
        return $this->student
            ->where('sid', $id)
            ->select('sid', 'name', 'education', 'profession', 'salary',
                'position', 'company', 'major', 'intro', 'avatar', 'works')
            ->first();
    }

    function edit($sid, $data)
    {
        return $this->student
            ->where('sid', $sid)
            ->update($data);
    }

    function del($sid)
    {
        return $this->student
            ->where('sid', $sid)
            ->delete();
    }


}