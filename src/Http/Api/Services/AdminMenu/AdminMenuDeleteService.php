<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminMenu;

use Fast\Api\Permission\Repository\Contract\AdminMenuRepository;
use Fast\Api\Permission\Requests\AdminMenu\DeleteAdminMenuRequest;

class AdminMenuDeleteService
{
    /**
     * @var DeleteAdminMenuRequest
     */
    protected $request;
    /**
     * @var AdminMenuRepository
     */
    protected $repository;

    public function __construct(DeleteAdminMenuRequest $request, AdminMenuRepository $repository)
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
