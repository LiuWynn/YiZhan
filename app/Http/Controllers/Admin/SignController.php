<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use App\Repo\SignRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignController extends Controller
{
    /**
     * @var SignRepo
     */
    private $signRepo;

    public function __construct(SignRepo $signRepo)
    {
        $this->middleware('jwt.auth');
        $this->signRepo = $signRepo;
    }

    public function getList(Request $request)
    {
        $keywords = $request->all();
        if ($result = $this->signRepo->getSignList($keywords))
            return $this->respond(true, ['data' => $result, 'total' => count($result)]);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_SELECT_ERR, '暂无数据');
    }

    public function delSign(Request $request)
    {
        $sid = $request->get('sid');
        if ($this->signRepo->del($sid))
            return $this->respond(true, ['message' => '删除成功']);
        else
            return $this->respond(false, null,
                ErrorCode::SQL_DELETE_ERR, '删除失败，请稍后重试');
    }
}
