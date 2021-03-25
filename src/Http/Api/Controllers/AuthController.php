<?php
namespace Edu\Permission\Http\Api\Controllers;

use Edu\Permission\Http\Api\Base\Controller;
use Edu\Permission\Transformers\AdminUserTransformers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function apidoc(Request $request)
    {
        $request->validate([
            'username'=> ['required'],
            'password'=> ['required'],
        ]);
        $credentials = $request->only('username','password');
        $token = $this->guard()->setTTL(env('JWT_EXPIRR_IN'))->attempt($credentials);
        if ($token){
            return setcookie('swagger-token', $token);
        }
        return $this->response->error('账号或密码错误，请重新输入！', 401);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=> ['required'],
            'password'=> ['required'],
            'key' => ['required'],
            'captcha' => ['required'],
        ]);
        $validator = validator()->make(request()->all(), [
            'key' => ['required'],
            'captcha'=> ['required','captcha_api:'.request()->input('key')]
        ]);
        if ($validator->fails()) {
            return $this->response->error('验证码错误！', 422);
        }
        $credentials = $request->only('username','password');
        $token = $this->guard()->setTTL(env('JWT_EXPIRR_IN'))->attempt($credentials);
        if ($token){
            return $this->respondWithToken($token);
        }
        return $this->response->error('账号或密码错误，请重新输入！', 422);
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'token'=> $token,
            'token_type'=> 'bearer',
            'expire_in'=> $this->guard()->factory()->getTTl() * 60
        ]);
    }

    public function getUserInfo()
    {
        return $this->response->item($this->guard()->user(), new AdminUserTransformers());
    }

    public function logout()
    {
        $this->guard()->logout();
    }

    protected function guard()
    {
        return \Auth::guard();
    }
}
