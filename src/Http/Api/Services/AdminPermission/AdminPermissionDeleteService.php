<?php

namespace Edu\Permission\Http\Api\Services\AdminPermission;

use Edu\Permission\Repository\Contract\AdminPermissionRepository;
use Edu\Permission\Requests\AdminPermission\DeleteAdminPermissionRequest;

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
