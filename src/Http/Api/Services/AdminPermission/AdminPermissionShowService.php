<?php

namespace Edu\Permission\Http\Api\Services\AdminPermission;

use Edu\Permission\Repository\Contract\AdminPermissionRepository;
use Edu\Permission\Requests\AdminPermission\ShowAdminPermissionRequest;

class AdminPermissionShowService
{
    /**
     * @var ShowAdminPermissionRequest
     */
    protected $request;
    /**
     * @var AdminRoleRe
     */
    protected $repository;

    public function __construct(ShowAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function show($id)
    {
        $this->request->validated();
        return $this->repository->find($id);
    }
}
