<?php

namespace Edu\Permission\Http\Api\Services\AdminRole;

use Edu\Permission\Models\AdminRole;
use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Requests\AdminRole\AuthAdminRoleRequest;
use Edu\Permission\Requests\AdminRole\UpdateAdminRoleRequest;

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
