<?php

namespace Edu\Permission\Http\Api\Services\AdminMenu;

use Edu\Permission\Repository\Contract\AdminMenuRepository;
use Edu\Permission\Requests\AdminMenu\UpdateAdminMenuRequest;

class AdminMenuUpdateService
{
    /**
     * @var UpdateAdminMenuRequest
     */
    protected $request;
    /**
     * @var AdminMenuRepository
     */
    protected $repository;

    public function __construct(UpdateAdminMenuRequest $request, AdminMenuRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        $menu= $this->repository->update($this->request->input(), $id);
        $menu->roles()->detach();
        $menu->roles()->attach($this->request->input('roles'));
        return $menu;
    }
}
