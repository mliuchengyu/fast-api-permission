<?php

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    // 验证码
    $api->any("captcha", function(){
        return response()->json(['status_code' => '200', 'message' => 'created succeed', 'url' => app('captcha')->create('default', true)]);
    });

    // 系统登录
    $api->post('login', '\Fast\Api\Permission\Http\Api\Controllers\AuthController@login');
    // API 文档，登录
    $api->post('apidoc', '\Fast\Api\Permission\Http\Api\Controllers\AuthController@apidoc');
    // 权限节点
    $api->get('permissions/node', '\Fast\Api\Permission\Http\Api\Controllers\AdminPermissionController@nodes');
    // 菜单节点
    $api->get('menus/node', '\Fast\Api\Permission\Http\Api\Controllers\AdminMenuController@nodes');
    // 菜单
    $api->get('menus', '\Fast\Api\Permission\Http\Api\Controllers\AdminMenuController@index');

    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        // 权限列表
        $api->get('permissions', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminPermissionController@index',
            'middleware' => ['rbac.auth:can,permission.index']
        ]);
        // 添加权限
        $api->post('permissions', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminPermissionController@store',
            'middleware' => ['rbac.auth:can,permission.store']
        ]);
        // 删除权限
        $api->delete('permissions/{permission}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminPermissionController@destroy',
            'middleware' => ['rbac.auth:can,permission.destroy']
        ]);
        // 更新权限
        $api->put('permissions/{permission}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminPermissionController@update',
            'middleware' => ['rbac.auth:can,permission.update']
        ]);
        // 权限详情
        $api->get('permissions/{permission}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminPermissionController@show',
            'middleware' => ['rbac.auth:can,permission.show']
        ]);
        // 系统用户列表
        $api->get('users', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminUserController@index',
            'middleware' => ['rbac.auth:can,user.index']
        ]);
        // 添加系统用户
        $api->post('users', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminUserController@store',
            'middleware' => ['rbac.auth:can,user.store']
        ]);
        // 更新系统用户
        $api->put('users/{user}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminUserController@update',
            'middleware' => ['rbac.auth:can,user.update']
        ]);
        // 系统用户信息
        $api->get('users/{user}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminUserController@show',
            'middleware' => ['rbac.auth:can,user.show']
        ]);
        // 删除系统用户
        $api->delete('users/{user}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminUserController@destroy',
            'middleware' => ['rbac.auth:can,user.destroy']
        ]);

        //菜单相关
        $api->post('menus', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminMenuController@store',
            'middleware' => ['rbac.auth:can,menu.store']
        ]);
        // 添加菜单
        $api->put('menus/{menu}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminMenuController@update',
            'middleware' => ['rbac.auth:can,menu.update']
        ]);
        // 菜单信息
        $api->get('menus/{menu}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminMenuController@show',
            'middleware' => ['rbac.auth:can,menu.show']
        ]);
        // 删除菜单
        $api->delete('menus/{menu}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminMenuController@destroy',
            'middleware' => ['rbac.auth:can,menu.destroy']
        ]);

        //角色相关
        $api->post('roles', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminRoleController@store',
            'middleware' => ['rbac.auth:can,role.store']
        ]);
        // 角色授权
        $api->post('roles/apply/{role}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminRoleController@apply',
            'middleware' => ['rbac.auth:can,role.apply']
        ]);
        // 更新角色
        $api->put('roles/{role}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminRoleController@update',
            'middleware' => ['rbac.auth:can,role.update']
        ]);
        // 角色列表
        $api->get('roles', [
            'uses' => '\Fast\Api\Http\Api\Controllers\AdminRoleController@index',
            'middleware' => ['rbac.auth:can,role.index']
        ]);
        // 角色信息
        $api->get('roles/{role}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminRoleController@show',
            'middleware' => ['rbac.auth:can,role.show']
        ]);
        // 角色用户
        $api->get('roles_users', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminRoleController@nodes',
            'middleware' => ['rbac.auth:can,role.nodes']
        ]);
        // 删除角色
        $api->delete('roles/{role}', [
            'uses' => '\Fast\Api\Permission\Http\Api\Controllers\AdminRoleController@destroy',
            'middleware' => ['rbac.auth:can,role.destroy']
        ]);
        // 退出登录
        $api->post('logout', '\Fast\Api\Permission\Http\Api\Controllers\AuthController@logout');
        // 当前登录用户信息
        $api->get('user-info', '\Fast\Api\Permission\Http\Api\Controllers\AuthController@getUserInfo');
    });
});


