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

    public function companyInfo()
    {
        $companyInfo = config('company');
        return $this->respond(true, $companyInfo);
    }

    public function editInfo(Request $request)
    {
        $companyInfo = $request->all();
        $path = base_path() . '\config\company.php';
        $str = "<?php return " . var_export($companyInfo, true) . ";";
        if (file_put_contents($path, $str))
            return $this->respond(true, ['message' => '操作成功']);
        else
            return $this->respond(false, null, ErrorCode::UPDATE_FAIL, '更新失败，请稍后重试');

    }
}
