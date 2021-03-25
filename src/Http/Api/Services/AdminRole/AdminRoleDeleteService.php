<?php

namespace Edu\Permission\Http\Api\Services\AdminRole;

use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Requests\AdminUser\DeleteAdminUserRequest;

class AdminRoleDeleteService
{
    /**
     * @var DeleteAdminUserRequest
     */
    protected $request;
    /**
     * @var AdminRoleRepository
     */
    protected $repository;

    public function __construct(DeleteAdminUserRequest $request, AdminRoleRepository $repository)
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
