<?php
namespace Fast\Api\Permission\Http\Api\Services\AdminUser;
use Fast\Api\Permission\Repository\Contract\AdminUserRepository;
use Fast\Api\Permission\Requests\AdminUser\StoreAdminUserRequest;

class AdminUserStoreService
{
    /**
     *@var StoreAdminUserRequest $request
     */
    protected $request;

    /**
     *@var AdminUserRepository $repository
     */
    protected $repository;

    public function __construct(StoreAdminUserRequest $request, AdminUserRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {
        $this->request->validated();
        $user = $this->repository->create($this->request->except('rolesIds'));
        $user->roles()->attach($this->request->input('rolesIds'));
        return $user;
    }
}
