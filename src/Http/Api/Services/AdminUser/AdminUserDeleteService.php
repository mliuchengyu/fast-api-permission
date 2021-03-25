<?php
namespace Edu\Permission\Http\Api\Services\AdminUser;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Requests\AdminUser\DeleteAdminUserRequest;

class AdminUserDeleteService
{
    /**
     *@var DeleteAdminUserRequest $request
     */
    protected $request;

    /**
     *@var AdminUserRepository $repository
     */
    protected $repository;

    public function __construct(DeleteAdminUserRequest $request, AdminUserRepository $repository)
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
