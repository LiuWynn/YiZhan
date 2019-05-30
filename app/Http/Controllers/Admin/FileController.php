<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use App\Repo\KitsRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    private $kitsRepo;

    public function __construct(KitsRepo $kitsRepo)
    {
        $this->kitsRepo = $kitsRepo;
    }

    /**
     * 上传教师头像
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(Request $request)
    {
        $avatar = $request->file('avatar');
        if ($avatar->isValid()) {  // 检测上传的文件是否合法
            $size = $avatar->getClientSize();
            $toMB = $this->kitsRepo->toMB($size);
            $avatar_max_size = config('image.AVATAR_MAX_SIZE');
            if ($toMB <= $avatar_max_size) {
                $savePath = public_path('avatars'); // D:\wamp64\www\YiZhan\public\avatars
                $filePath = date('Ymd');
                $result = $this->kitsRepo->uploadImg($savePath, $filePath, $avatar, 'avatar');
                return $this->respond(true, $result);
            } else {
                return $this->respond(false, null, ErrorCode::SIZE_EXCEED_LIMIT, '头像大小超过限制');
            }
        } else {
            return $this->respond(false, null, ErrorCode::FILE_VALID_FAIL, '头像上传不合法');
        }
    }

    public function uploadWork(Request $request)
    {
        $work = $request->file('work');
        if ($work->isValid()) {  // 检测上传的文件是否合法
            $size = $work->getClientSize();
            $toMB = $this->kitsRepo->toMB($size); // 转化成 MB
            $work_max_size = config('image.WORK_MAX_SIZE');
            if ($toMB <= $work_max_size) {
                $savePath = public_path('works');
                $filePath = date('Ymd');
                $result = $this->kitsRepo->uploadImg($savePath, $filePath, $work, 'works');
                return $this->respond(true, $result);
            } else {
                return $this->respond(false, null, ErrorCode::SIZE_EXCEED_LIMIT, '作品大小超过限制');
            }
        } else {
            return $this->respond(false, null, ErrorCode::FILE_VALID_FAIL, '作品上传不合法');
        }
    }
}
