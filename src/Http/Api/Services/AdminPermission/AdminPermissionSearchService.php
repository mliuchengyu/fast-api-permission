<?php

namespace Fast\Api\Permission\Http\Api\Services\AdminPermission;

use Fast\Api\Permission\Http\Api\Base\AbstractSearchService;
use Fast\Api\Permission\Repository\Contract\AdminPermissionRepository;
use Fast\Api\Permission\Repository\Criteria\AdminPermissionSearchCriteria;
use Fast\Api\Permission\Requests\AdminPermission\SearchAdminPermissionRequest;

class AdminPermissionSearchService extends AbstractSearchService
{
    /**
     * @var SearchAdminPermissionRequest
     */
    protected $request;
    /**
     * @var AdminPermissionRepository
     */
    protected $repository;

    public function __construct(SearchAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }


    protected function getSearchCriteriaClassName(): string
    {
        return AdminPermissionSearchCriteria::class;
    }

    protected function getOrConditionFields(): array
    {
        return [
            'name'
        ];
    }

    protected function getAndConditionFields(): array
    {
        return ['parent_id'];
    }
}
