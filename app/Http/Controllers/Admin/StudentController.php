<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use App\Repo\StudentRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    /**
     * @var StudentRepo 学员操作类
     */
    private $studentRepo;

    public function __construct(StudentRepo $studentRepo)
    {
        $this->middleware('jwt.auth');
        $this->studentRepo = $studentRepo;
    }

    public function create(Request $request)
    {
        $params = $request->all();
        // 组合插入数据
        $data['name'] = $params['name'];
        $data['education'] = $params['education'];

        $data['profession'] = $params['profession'];
        $data['major'] = $params['major'];
        $data['company'] = $params['company'];
        $data['position'] = $params['position'];

        $data['salary'] = $params['salary'];
        $data['intro'] = $params['intro'];
        $data['avatar'] = $params['avatar'];

        $works = $params['works'];
        for ($i = 0; $i < count($works); $i++) {
            if ($i == 0)
                $data['works'][$i] = $works[$i];
            $data['works'][$i] = $works[$i];
        }
        $data['works'] = json_encode($data['works']);
        if ($this->studentRepo->insert($data))
            return $this->respond(true, array('message' => '添加成功'));
        else
            return $this->respond(false, null,
                ErrorCode::SQL_INSERT_ERR, '添加失败，请稍后重试');
    }

    public function getList(Request $request)
    {
        $keywords = $request->all();
        if ($result = $this->studentRepo->getStudentList($keywords))
            return $this->respond(true, ['data' => $result, 'total' => count($result)]);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_SELECT_ERR, '暂无数据');
    }

    public function getStudent($id)
    {
        if ($result = $this->studentRepo->get($id))
            return $this->respond(true, $result);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_SELECT_ERR, '查无此人信息，请稍后重试');
    }

    public function editStudent(Request $request)
    {
        $sid = $request->get('sid');
        $params = $request->except('sid');
        // 组合插入数据
        $data['name'] = $params['name'];
        $data['education'] = $params['education'];

        $data['profession'] = $params['profession'];
        $data['major'] = $params['major'];
        $data['company'] = $params['company'];
        $data['position'] = $params['position'];

        $data['salary'] = $params['salary'];
        $data['intro'] = $params['intro'];
        $data['avatar'] = $params['avatar'];

        $works = $params['works'];
        for ($i = 0; $i < count($works); $i++) {
            if ($i == 0)
                $data['works'][$i] = $works[$i];
            $data['works'][$i] = $works[$i];
        }
        $data['works'] = json_encode($data['works']);
        if ($this->studentRepo->edit($sid, $data))
            return $this->respond(true, ['message' => '数据更新成功']);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_UPDATE_ERR, '数据更新失败，请稍后重试');
    }

    public function delStudent(Request $request)
    {
        $sid = $request->get('sid');
        if ($this->studentRepo->del($sid))
            return $this->respond(true, ['message' => '删除成功']);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_DELETE_ERR, '删除失败，请稍后重试');
    }
}
