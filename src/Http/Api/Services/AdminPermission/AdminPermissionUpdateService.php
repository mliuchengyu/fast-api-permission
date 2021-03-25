<?php

namespace Edu\Permission\Http\Api\Services\AdminPermission;

use Edu\Permission\Repository\Contract\AdminPermissionRepository;
use Edu\Permission\Requests\AdminPermission\UpdateAdminPermissionRequest;

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
