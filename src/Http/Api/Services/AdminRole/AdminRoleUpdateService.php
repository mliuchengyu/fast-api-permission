<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminRole;

use Fast\Api\Permission\Repository\Contract\AdminRoleRepository;
use Fast\Api\Permission\Repository\Contract\AdminUserRepository;
use Fast\Api\Permission\Requests\AdminRole\UpdateAdminRoleRequest;

class AdminRoleUpdateService
{
    /**
     * @var UpdateAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminUserRepository
     */
    protected $repository;

    public function __construct(UpdateAdminRoleRequest $request, AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        $role = $this->repository->update($this->request->input(), $id);
        return $role;
    }
}
