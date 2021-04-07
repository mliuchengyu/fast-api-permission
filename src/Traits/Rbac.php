<?php
namespace Fast\Api\Permission\Traits;
trait Rbac
{
    public function hacRole($role)
    {
        $roles = $this->roleSlugs();// 用户角色
        $rolesArr = explode('|', $role);// 前端传的角色
        return !empty(array_intersect($rolesArr, $roles)); // 取交集
    }

    public function canDo($permission)
    {
        // $operation = 权限API——middleware的 【permission.destroy】 slugs
        $roles = $this->roles()->get();
        $permissions = []; // 用户当前所具备的所有权限
        foreach ($roles as $role){
            $permissions = array_merge($permissions, $role->permissionSlugs());
        }
        $permissions = array_unique($permissions); // 去重复，权限
        $permissionAry = explode('|', $permission);
        return !empty(array_intersect($permissionAry, $permissions)); // 取交集
    }
}
