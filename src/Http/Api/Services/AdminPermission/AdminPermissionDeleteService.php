<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminPermission;

use Fast\Api\Permission\Repository\Contract\AdminPermissionRepository;
use Fast\Api\Permission\Requests\AdminPermission\DeleteAdminPermissionRequest;

class AdminPermissionDeleteService
{
    /**
     * @var DeleteAdminPermissionRequest
     */
    protected $request;
    /**
     * @var AdminPermissionRepository
     */
    protected $repository;

    public function __construct(DeleteAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $this->request->validated();
        return $this->repository->delete($id);
    }
}
