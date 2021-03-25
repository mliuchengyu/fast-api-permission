<?php

namespace Edu\Permission\Http\Api\Services\AdminRole;

use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Requests\AdminRole\StoreAdminRoleRequest;

class AdminRoleStoreService
{
    /**
     * @var StoreAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminRoleRepository
     */
    protected $repository;

    public function __construct(StoreAdminRoleRequest $request, AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {
        $this->request->validated();
        $role = $this->repository->create($this->request->input());
        return $role;
    }
}
