<?php

namespace Edu\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Edu\Permission\Repository\Contract\AdminMenuRepository;
use Edu\Permission\Models\AdminMenu;

/**
 * Class AdminMenuRepositoryEloquent.
 *
 * @package namespace Edu\Permission\Repository\Eloquent
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
