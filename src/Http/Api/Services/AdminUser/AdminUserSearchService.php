<?php
namespace Edu\Permission\Http\Api\Services\AdminUser;

use Edu\Permission\Http\Api\Base\AbstractSearchService;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Repository\Criteria\AdminUserSearchCriteria;
use Edu\Permission\Requests\AdminUser\SearchAdminUserRequest;

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
