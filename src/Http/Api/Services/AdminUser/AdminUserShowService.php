<?php
namespace Edu\Permission\Http\Api\Services\AdminUser;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Requests\AdminUser\ShowAdminUserRequest;

class AdminUserShowService
{
    /**
     *@var ShowAdminUserRequest $request
     */
    protected $request;

    /**
     *@var AdminUserRepository $repository
     */
    protected $repository;

    public function __construct(ShowAdminUserRequest $request, AdminUserRepository $repository)
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
