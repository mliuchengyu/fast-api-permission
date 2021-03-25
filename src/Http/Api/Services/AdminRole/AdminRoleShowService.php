<?php

namespace Edu\Permission\Http\Api\Services\AdminRole;

use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Requests\AdminRole\ShowAdminRoleRequest;

class AdminRoleShowService
{
    /**
     * @var ShowAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminRoleRepository
     */
    protected $repository;

    public function __construct(ShowAdminRoleRequest $request, AdminRoleRepository $repository)
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
