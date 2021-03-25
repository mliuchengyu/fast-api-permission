<?php

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Redirector;

class AdminUserSeeder extends Seeder
{

    protected $roles = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->boot();
        $this->createPermissions();
        $rolesId = $this->createRoles($this->roles);
        $this->createAuthPermission($rolesId);
        $this->createUsers($this->roles);
        $this->createMenus($this->roles);
    }

    /*创建权限树*/
    protected function createPermissions($parent_id = null, $requestPayloads = null)
    {
        $requestPayloads = $requestPayloads ?? $this->getPermissionRequestPayloads();
        array_map(function ($item) use ($parent_id) {
            if ($parent_id) {
                $item['parent_id'] = $parent_id;
            }
            $children = null;
            if (isset($item['children'])) {
                $children = $item['children'];
                unset($item['children']);
            }

            $this->prepareWith($item);
            try {
                $service = app()->make(\Fast\Api\Http\Api\Services\AdminPermission\AdminPermissionStoreService::class);
                $permission = $service->save();
            }catch ( \Illuminate\Validation\ValidationException $exception){
                dd($exception->errors());
            }
            array_push($this->roles, $permission->id);
            if ($children) {
                $this->createPermissions($permission->id, $children);
            }
        }, $requestPayloads);
    }

    /*创建角色*/
    protected function createRoles($permissions = [])
    {
        $requestPayloads = $this->getRoleRequestPayloads();
        return array_map(function ($item) use ($permissions) {
            $this->prepareWith($item);
            try {
                $service = app()->make(\Fast\Api\Http\Api\Services\AdminRole\AdminRoleStoreService::class);
                $role = $service->save();
            }catch ( \Illuminate\Validation\ValidationException $exception){
                dd($exception->errors());
            }
            return $role->id;
        }, $requestPayloads);
    }

    /*创建用户*/
    protected function createUsers($roles = [])
    {
        $requestPayloads = $this->getUserRequestPayloads();
        array_map(function ($item) use ($roles) {
            $item['rolesIds'] = $roles;
            $this->prepareWith($item);
            try {
                $service = app()->make(\Fast\Api\Http\Api\Services\AdminUser\AdminUserStoreService::class);
                $service->save();
            }catch ( \Illuminate\Validation\ValidationException $exception){
                dd($exception->errors());
            }
        }, $requestPayloads);
    }

    /*角色权限授权*/
    protected function createAuthPermission($rolesId)
    {
        $item['permissions'] = $this->roles;
        $this->prepareWith($item);
        $service = app()->make(\Fast\Api\Http\Api\Services\AdminRole\AdminAuthUpdateService::class);
        $service->update($rolesId);
    }

    /*创建菜单*/
    protected function createMenus($roles = [], $parent_id = null, $requestPayloads = null)
    {
        $requestPayloads = $requestPayloads ?? $this->getMenuRequestPayloads();
        array_map(function ($item) use ($roles, $parent_id) {
            $item['roles'] = $roles;
            if ($parent_id) {
                $item['parent_id'] = $parent_id;
            }
            $children = null;
            if (isset($item['children'])) {
                $children = $item['children'];
                unset($item['children']);
            }
            $this->prepareWith($item);
            $service = app()->make(\Fast\Api\Http\Api\Services\AdminMenu\AdminMenuStoreService::class);
            $menu = $service->save();
            if ($children) {
                $this->createMenus($roles, $menu->id, $children);
            }
        }, $requestPayloads);
    }

    protected function boot()
    {
        app()->afterResolving(ValidatesWhenResolved::class, function ($resolved) {
            $resolved->validateResolved();
        });
    }

    protected function prepareWith($item)
    {
        app()->resolving(FormRequest::class, function ($request, $app) use ($item) {
            $request = FormRequest::createFrom($app['request'], $request);
            $request->initialize($item);
            $request->setContainer($app)->setRedirector($app->make(Redirector::class));
        });
    }

    protected function getUserRequestPayloads()
    {
        return $requestPayloads = [
            [
                'username' => 'admin',
                'password' => '123123',
                'avatar'=> 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80',
                'name' => '管理员',
                'mobile' => '18142830406',
                'remark' => 'system init'
            ],
            [
                'username' => 'test',
                'password' => '123123',
                'avatar'=> 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80',
                'name' => '测试账号',
                'mobile' => '18142830406',
                'remark' => 'system init'
            ]
        ];
    }

    protected function getRoleRequestPayloads()
    {
        return $requestPayloads = [
            [
                'name' => '初始化管理员',
                'slug' => 'admin',
                'description' => 'system init'
            ],
            [
                'name' => '初始化测试账号',
                'slug' => 'test',
                'description' => 'system init'
            ]
        ];
    }

    protected function getPermissionRequestPayloads()
    {
        return $requestPayloads = [
            [
                'name' => '系统管理',
                'slug' => '系统管理',
                'description' => 'system init',
                'children' => [
                    [
                        'name' => '系统设置',
                        'slug' => '/系统设置',
                        'description' => 'system init',
                        'children' => [
                            [
                                'name' => '用户管理',
                                'slug' => '/user',
                                'description' => 'system init',
                                'children'=>[
                                    [
                                        'name' => '添加',
                                        'slug' => 'user.store',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '删除',
                                        'slug' => 'user.destroy',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '修改',
                                        'slug' => 'user.update',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '详情',
                                        'slug' => 'user.show',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '列表',
                                        'slug' => 'user.index',
                                        'description' => 'system init'
                                    ]
                                ]
                            ],
                            [
                                'name' => '角色管理',
                                'slug' => '/role',
                                'description' => 'system init',
                                'children'=>[
                                    [
                                        'name' => '添加',
                                        'slug' => 'role.store',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '删除',
                                        'slug' => 'role.destroy',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '修改',
                                        'slug' => 'role.update',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '详情',
                                        'slug' => 'role.show',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '列表',
                                        'slug' => 'role.index',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '授权',
                                        'slug' => 'role.apply',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '用户',
                                        'slug' => 'role.nodes',
                                        'description' => 'system init'
                                    ]
                                ]
                            ],
                            [
                                'name' => '权限管理',
                                'slug' => '权限管理',
                                'description' => 'system init',
                                'children'=>[
                                    [
                                        'name' => '添加',
                                        'slug' => 'permission.store',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '删除',
                                        'slug' => 'permission.destroy',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '修改',
                                        'slug' => 'permission.update',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '详情',
                                        'slug' => 'permission.show',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '列表',
                                        'slug' => 'permission.index',
                                        'description' => 'system init'
                                    ]
                                ]
                            ],
                            [
                                'name' => '菜单管理',
                                'slug' => '菜单管理',
                                'description' => 'system init',
                                'children'=>[
                                    [
                                        'name' => '添加',
                                        'slug' => 'menu.store',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '删除',
                                        'slug' => 'menu.destroy',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '修改',
                                        'slug' => 'menu.update',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '详情',
                                        'slug' => 'menu.show',
                                        'description' => 'system init'
                                    ],
                                    [
                                        'name' => '列表',
                                        'slug' => 'menu.index',
                                        'description' => 'system init'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    protected function getMenuRequestPayloads()
    {
        return $requestPayloads = [
            [
                'title' => '权限管理',
                'path' => '/permission',
                'children' => [
                    [
                        'title' => '用户管理',
                        'path' => 'users',
                    ],
                    [
                        'title' => '权限管理',
                        'path' => 'permission',
                    ],
                    [
                        'title' => '角色管理',
                        'path' => 'role',
                    ],
                    [
                        'title' => '菜单管理',
                        'path' => 'menus',
                    ]
                ]
            ],
        ];
    }
}
