<?php

namespace Edu\Permission\Http\Api\Services\AdminMenu;

use Edu\Permission\Http\Api\Base\AbstractSearchService;
use Edu\Permission\Repository\Contract\AdminMenuRepository;
use Edu\Permission\Repository\Criteria\AdminMenuSearchCriteria;
use Edu\Permission\Requests\AdminMenu\SearchAdminMenuRequest;

class AdminMenuSearchService extends AbstractSearchService
{
    /**
     * @var SearchAdminMenuRequest
     */
    protected $request;
    /**
     * @var AdminMenuRepository
     */
    protected $repository;

    public function __construct(SearchAdminMenuRequest $request, AdminMenuRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    protected function getSearchCriteriaClassName(): string
    {
        return AdminMenuSearchCriteria::class;
    }

    protected function getOrConditionFields(): array
    {
        return [
            'title'
        ];
    }

    protected function getAndConditionFields(): array
    {
        return ['parent_id'];
    }
}
