<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * 获取招班动态
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function info() {
        $admissionInfo = config('admission');
        return $this->respond(true, $admissionInfo);
    }

    public function editInfo(Request $request) {
        $admissionInfo = $request->all();
        $path = base_path() . '\config\admission.php';
        $str = "<?php\nreturn " . var_export($admissionInfo, true) . ";";
        if (file_put_contents($path, $str))
            return $this->respond(true, ['message' => '操作成功']);
        else
            return $this->respond(false, null, ErrorCode::UPDATE_FAIL, '更新失败，请稍后重试');
    }
}
