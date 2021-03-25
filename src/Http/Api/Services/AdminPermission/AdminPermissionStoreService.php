<?php

namespace Edu\Permission\Http\Api\Services\AdminPermission;

use Edu\Permission\Repository\Contract\AdminPermissionRepository;
use Edu\Permission\Requests\AdminPermission\StoreAdminPermissionRequest;

class AdminPermissionStoreService
{
    /**
     * @var StoreAdminPermissionRequest
     */
    protected $request;
    /**
     * @var AdminPermissionRepository
     */
    protected $repository;

    public function __construct(StoreAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {
        $this->request->validated();
        return $this->repository->create($this->request->input());
    }
}
