<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function get()
    {
        if ($pics = config('homepage'))
            return $this->respond(true, $pics);
        else
            return $this->respond(false, null,
                ErrorCode::FILE_READ_FAIL, '信息获取失败');
    }

    public function set(Request $request)
    {
        $pics = $request->all();
        $path = base_path() . '\config\homepage.php';
        $str = "<?php\nreturn " . var_export($pics, true) . ";";
        if (file_put_contents($path, $str))
            return $this->respond(true, ['message' => '操作成功']);
        else
            return $this->respond(false, null, ErrorCode::UPDATE_FAIL, '更新失败，请稍后重试');
    }

    public function getConf()
    {
        if ($conf = config('site'))
            return $this->respond(true, $conf);
        else
            return $this->respond(false, null,
                ErrorCode::FILE_READ_FAIL, '信息获取失败');
    }

    public function editConf(Request $request)
    {
        $conf = $request->all();
        $path = base_path() . '\config\site.php';
        $str = "<?php\nreturn " . var_export($conf, true) . ";";
        if (file_put_contents($path, $str))
            return $this->respond(true, ['message' => '操作成功']);
        else
            return $this->respond(false, null, ErrorCode::UPDATE_FAIL, '更新失败，请稍后重试');
    }
}
