<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use App\Repo\TeacherRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    private $teacherRepo;

    public function __construct(TeacherRepo $teacherRepo)
    {
        // 添加 token 验证的中间件
        $this->middleware('jwt.auth');
        $this->teacherRepo = $teacherRepo;
    }

    /**
     * 获取添加图片时的限制信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function limit()
    {
        $limit = config('image');
        if ($limit)
            return $this->respond(true, $limit);
        else
            return $this->respond(false, null,
                ErrorCode::FILE_READ_FAIL, '配置文件读取失败');
    }

    public function create(Request $request)
    {
        $params = $request->all();
        // 组合插入数据
        $data['name'] = $params['name'];
        $data['email'] = $params['email'];
        if (isset($params['password'])) // 如果没有设置密码，则默认123456
            $data['password'] = bcrypt($params['password']);
        else
            $data['password'] = bcrypt(123456);
        $data['phone'] = $params['phone'];
        $data['qq'] = $params['qq'];
        $data['weixin'] = $params['weixin'];
        $data['job'] = $params['job'];
        if (count($params['roles']) == 1) // 拼接roles
            $data['roles'] = $params['roles'][0];
        else
            $data['roles'] = $params['roles'][0] . ',' . $params['roles'][1];
        $data['project'] = $params['project'];
        $data['intro'] = $params['intro'];
        $data['avatar'] = $params['avatar'];

        $works = $params['works'];
        for ($i = 0; $i < count($works); $i++) {
            if ($i == 0)
                $data['works'][$i] = $works[$i];
            $data['works'][$i] = $works[$i];
        }
        $data['works'] = json_encode($data['works']);
        if ($this->teacherRepo->insert($data))
            return $this->respond(true, array('message' => '添加成功'));
        else
            return $this->respond(false, null,
                ErrorCode::SQL_INSERT_ERR, '添加失败，请稍后重试');
    }

    public function getList(Request $request)
    {
        $keywords = $request->all();
        if ($result = $this->teacherRepo->getTeacherList($keywords))
            return $this->respond(true, ['data' => $result, 'total' => count($result)]);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_SELECT_ERR, '暂无数据');
    }

    public function delTeacher(Request $request)
    {
        $tid = $request->get('tid');
        if ($this->teacherRepo->del($tid))
            return $this->respond(true, ['message' => '删除成功']);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_DELETE_ERR, '删除失败，请稍后重试');
    }

    public function getTeacher($id) {
        if ($result = $this->teacherRepo->get($id))
            return $this->respond(true, $result);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_SELECT_ERR, '查无此人信息，请稍后重试');
    }

    public function editTeacher(Request $request) {
        $tid = $request->get('tid');
        $params = $request->except('tid');
        // 组合插入数据
        $data['name'] = $params['name'];
        $data['email'] = $params['email'];
        if (isset($params['password'])) // 如果没有设置密码，则不修改密码
            $data['password'] = bcrypt($params['password']);
        $data['phone'] = $params['phone'];
        $data['qq'] = $params['qq'];
        $data['weixin'] = $params['weixin'];
        $data['job'] = $params['job'];
        if (count($params['roles']) == 1) // 拼接roles
            $data['roles'] = $params['roles'][0];
        else
            $data['roles'] = $params['roles'][0] . ',' . $params['roles'][1];
        $data['project'] = $params['project'];
        $data['intro'] = $params['intro'];
        $data['avatar'] = $params['avatar'];

        $works = $params['works'];
        for ($i = 0; $i < count($works); $i++) {
            if ($i == 0)
                $data['works'][$i] = $works[$i];
            $data['works'][$i] = $works[$i];
        }
        $data['works'] = json_encode($data['works']);
        if ($this->teacherRepo->edit($tid, $data))
            return $this->respond(true, ['message' => '数据更新成功']);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_UPDATE_ERR, '数据更新失败，请稍后重试');
    }
}
