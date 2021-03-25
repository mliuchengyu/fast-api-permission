<?php
namespace Edu\Permission\Http\Api\Services\AdminUser;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Requests\AdminUser\UpdateAdminUserRequest;

class AdminUserUpdateService
{
    /**
     *@var UpdateAdminUserRequest $request
     */
    protected $request;

    /**
     *@var AdminUserRepository $repository
     */
    protected $repository;

    public function __construct(UpdateAdminUserRequest $request, AdminUserRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        $user = $this->repository->update($this->request->except('rolesIds'), $id);
        $user->roles()->detach();
        $user->roles()->attach($this->request->input('rolesIds'));
        return $user;
    }
}
