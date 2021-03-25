<?php

namespace Edu\Permission\Http\Api\Services\AdminPermission;

use Edu\Permission\Http\Api\Base\AbstractSearchService;
use Edu\Permission\Repository\Contract\AdminPermissionRepository;
use Edu\Permission\Repository\Criteria\AdminPermissionSearchCriteria;
use Edu\Permission\Requests\AdminPermission\SearchAdminPermissionRequest;

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
