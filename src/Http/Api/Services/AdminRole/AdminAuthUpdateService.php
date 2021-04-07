<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminRole;

use Fast\Api\Permission\Models\AdminRole;
use Fast\Api\Permission\Repository\Contract\AdminRoleRepository;
use Fast\Api\Permission\Repository\Contract\AdminUserRepository;
use Fast\Api\Permission\Requests\AdminRole\AuthAdminRoleRequest;
use Fast\Api\Permission\Requests\AdminRole\UpdateAdminRoleRequest;

class AdminAuthUpdateService
{
    /**
     * @var UpdateAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminUserRepository
     */
    protected $repository;

    public function __construct(AuthAdminRoleRequest $request,AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        $model = new AdminRole();
        $role = $model::query()->where('id','=',$id)->first();
        $role->permissions()->detach();
        $role->permissions()->attach($this->request->input('permissions'));
        return $role;
    }
}
