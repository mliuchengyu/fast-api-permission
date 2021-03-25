<?php

namespace Edu\Permission\Http\Api\Services\AdminMenu;

use Edu\Permission\Repository\Contract\AdminMenuRepository;
use Edu\Permission\Requests\AdminMenu\DeleteAdminMenuRequest;

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
