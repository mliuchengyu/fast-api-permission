<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminMenu;

use Fast\Api\Permission\Repository\Contract\AdminMenuRepository;
use Fast\Api\Permission\Requests\AdminRole\ShowAdminRoleRequest;
use Fast\Api\Permission\Requests\AdminMenu\ShowAdminMenuRequest;

class AdminMenuShowService
{
    /**
     * @var ShowAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminMenuRepository
     */
    protected $repository;

    public function __construct(ShowAdminMenuRequest $request, AdminMenuRepository $repository)
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
