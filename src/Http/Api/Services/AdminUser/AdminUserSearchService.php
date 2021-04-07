<?php
namespace Fast\Api\Permission\Http\Api\Services\AdminUser;

use Fast\Api\Permission\Http\Api\Base\AbstractSearchService;
use Fast\Api\Permission\Repository\Contract\AdminUserRepository;
use Fast\Api\Permission\Repository\Criteria\AdminUserSearchCriteria;
use Fast\Api\Permission\Requests\AdminUser\SearchAdminUserRequest;

class AdminUserSearchService extends AbstractSearchService
{
    /**
     *@var SearchAdminUserRequest $request
     */
    protected $request;

    /**
     *@var AdminUserRepository $repository
     */
    protected $repository;

    public function __construct(SearchAdminUserRequest $request, AdminUserRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    protected function getSearchCriteriaClassName(): string
    {
        return AdminUserSearchCriteria::class;
    }

    protected function getOrConditionFields(): array
    {
        return [
            'username',
            'name'
        ];
    }

    protected function getAndConditionFields(): array
    {
        return [];
    }
}
