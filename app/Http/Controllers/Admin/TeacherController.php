<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function __construct()
    {
        // 添加 token 验证的中间件
        $this->middleware('jwt.auth');
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
        return $request->all();
    }
}
