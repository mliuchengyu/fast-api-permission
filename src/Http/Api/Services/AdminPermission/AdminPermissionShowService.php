<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminPermission;

use Fast\Api\Permission\Repository\Contract\AdminPermissionRepository;
use Fast\Api\Permission\Requests\AdminPermission\ShowAdminPermissionRequest;

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
