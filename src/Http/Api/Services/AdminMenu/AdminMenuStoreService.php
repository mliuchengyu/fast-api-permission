<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminMenu;

use Fast\Api\Permission\Repository\Contract\AdminMenuRepository;
use Fast\Api\Permission\Requests\AdminMenu\StoreAdminMenuRequest;

class AdminMenuStoreService
{
    /**
     * @var StoreAdminMenuRequest
     */
    protected $request;
    /**
     * @var AdminMenuRepository
     */
    protected $repository;

    public function __construct(StoreAdminMenuRequest $request, AdminMenuRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {
        $this->request->validated();
        $menu = $this->repository->create($this->request->except('roles'));
        $menu->roles()->attach($this->request->input('roles'));
        return $menu;
    }
}
