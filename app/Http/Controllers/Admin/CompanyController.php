<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * 获取公司基本信息
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function companyInfo()
    {
        $companyInfo = config('company');
        return $this->respond(true, $companyInfo);
    }

    /**
     * 更新公司基本信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editInfo(Request $request)
    {
        $companyInfo = $request->all();
        $path = base_path() . '\config\company.php';
        $str = "<?php\nreturn " . var_export($companyInfo, true) . ";";
        if (file_put_contents($path, $str))
            return $this->respond(true, ['message' => '操作成功']);
        else
            return $this->respond(false, null, ErrorCode::UPDATE_FAIL, '更新失败，请稍后重试');
    }

    /**
     * 获取公司介绍
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function intro()
    {
        $companyIntro = config('companyIntro');
        return $this->respond(true, $companyIntro);
    }


    public function editIntro(Request $request)
    {
        $companyIntro = $request->all();
        $path = base_path(). '\config\companyIntro.php';
        $str = "<?php\nreturn " . var_export($companyIntro, true) . ";";
        if (file_put_contents($path, $str))
            return $this->respond(true, ['message' => '操作成功']);
        else
            return $this->respond(false, null, ErrorCode::UPDATE_FAIL, '更新失败，请稍后重试');
    }
}
