<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ErrorCode;
use App\Repo\KitsRepo;
use App\Repo\TeacherRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * @var TeacherRepo 对教师数据进行操作的对象
     */
    private $teacherRepo;

    /**
     * @var KitsRepo 小工具类
     */
    private $kitsRepo;

    /**
     * Create a new AuthController instance.
     * 要求附带email和password（数据来源users表）
     *
     * @return void
     */
    public function __construct(TeacherRepo $teacherRepo, KitsRepo $kitsRepo)
    {
        // 这里额外注意了：官方文档样例中只除外了『login』
        // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
        // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
        // 不过刷新一次作废
        $this->middleware('jwt.auth', ['except' => ['login']]);
        // 另外关于上面的中间件，官方文档写的是『auth:api』
        // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回

        $this->teacherRepo = $teacherRepo;
        $this->kitsRepo = $kitsRepo;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        // 从 request 中获取 email,password 信息，进行用户校验
        $credentials = request(['email', 'password']);
        // 校验成功则返回 token
        if (!$token = auth('api')->attempt($credentials)) {  // 用户登录验证失败
            return $this->respond(false, null, ErrorCode::UNAUTHORIZED, '登录授权失败');
        }
        return $this->respondWithToken(true, null, $token);
    }

    /**
     * Get user info and user's permissions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo()
    {
        $user = auth('api')->user();
        $result = array(
            'id' => $user->tid,
            'name' => $user->name,
            'roles' => $user->roles,
            'permissions' => $this->kitsRepo->dispatchPermissions($user->roles)
        );
        return $this->respond(true, $result);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        $token = auth('api')->refresh();
        return $this->respondWithToken(true, null, $token);
    }
}
