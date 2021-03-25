<?php

namespace Fast\Api\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Fast\Api\Permission\Repository\Contract\AdminMenuRepository;
use Fast\Api\Permission\Models\AdminMenu;

/**
 * Class AdminMenuRepositoryEloquent.
 *
 * @package namespace Fast\Api\Permission\Repository\Eloquent
 */
class AdminMenuRepositoryEloquent extends BaseRepository implements AdminMenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminMenu::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
