<?php

namespace App\Http\Controllers\Home;

use App\Enums\ErrorCode;
use App\Repo\SignRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignController extends Controller
{
    /**
     * @var SignRepo 操作类
     */
    private $signRepo;

    public function __construct(SignRepo $signRepo)
    {
        $this->signRepo = $signRepo;
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['time'] = time();
        if ($this->signRepo->insert($data))
            return $this->respond(true, array('message' => '添加成功'));
        else
            return $this->respond(false, null,
                ErrorCode::SQL_INSERT_ERR, '添加失败，请稍后重试');
    }
}
