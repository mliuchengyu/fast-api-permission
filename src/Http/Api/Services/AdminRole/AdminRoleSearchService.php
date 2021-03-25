<?php

namespace Edu\Permission\Http\Api\Services\AdminRole;

use Edu\Permission\Http\Api\Base\AbstractSearchService;
use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Repository\Criteria\AdminRoleSearchCriteria;
use Edu\Permission\Requests\AdminRole\SearchAdminRoleRequest;

class AdminRoleSearchService extends AbstractSearchService
{
    /**
     * @var SearchAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminRoleRepository
     */
    protected $repository;

    public function __construct(SearchAdminRoleRequest $request, AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }


    protected function getSearchCriteriaClassName(): string
    {
        return AdminRoleSearchCriteria::class;
    }

    protected function getOrConditionFields(): array
    {
        return [
            'name'
        ];
    }

    protected function getAndConditionFields(): array
    {
        return [
            'name'
        ];
    }
}
