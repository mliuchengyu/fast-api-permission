<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminPermission;

use Fast\Api\Permission\Repository\Contract\AdminPermissionRepository;
use Fast\Api\Permission\Requests\AdminPermission\UpdateAdminPermissionRequest;

class AdminPermissionUpdateService
{
    /**
     * @var UpdateAdminPermissionRequest
     */
    protected $request;
    /**
     * @var AdminPermissionRepository
     */
    protected $repository;

    public function __construct(UpdateAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        return $this->repository->update($this->request->input(), $id);
    }
}
