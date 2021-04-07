<?php

namespace Fast\Api\Permission\Http\Api\Middleware;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class RbacAuthenticate
{
    use Helpers;
    public const OPERATIONS = ['is', 'isnt', 'can'];

    // 'middleware' => [':$level,$roleOrPermission']
    // 'middleware' => ['rbac.auth:can,permission.store']
    public function handle(Request $request, \Closure $next, $level, $roleOrPermission)
    {
        if (!in_array($level, self::OPERATIONS)) {
            $this->response->error('Invalid Rbac Level', 404);
        }
        if ('is' == $level) {
            // 按角色区分
            if ($request->user()->hasRole($roleOrPermission)) {
                return $next($request);
            }
        } elseif ('isnt' == $level) {
            // 按角色区分，取反
            if (!$request->user()->hasRole($roleOrPermission)) {
                return $next($request);
            }
        } else {
            // 按权限区分
            if ($request->user()->canDo($roleOrPermission)) {
                return $next($request);
            }
        }
        $this->response->error($this->getErrMessage($roleOrPermission), 403);
    }

    protected function getErrMessage($roleOrPermission)
    {
        return "该页面或者操作涉及权限：【slug：" . $roleOrPermission . "】，但是你未获得此权限，可能会造成部分功能无法使用或者操作被终止，请联系管理员解决。";
    }
}
