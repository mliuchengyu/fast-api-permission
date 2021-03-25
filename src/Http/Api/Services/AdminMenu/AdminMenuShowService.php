<?php

namespace Edu\Permission\Http\Api\Services\AdminMenu;

use Edu\Permission\Repository\Contract\AdminMenuRepository;
use Edu\Permission\Requests\AdminRole\ShowAdminRoleRequest;
use Edu\Permission\Requests\AdminMenu\ShowAdminMenuRequest;

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
