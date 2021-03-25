<?php

namespace Fast\Api\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Fast\Api\Permission\Repository\Contract\AdminRoleRepository;
use Fast\Api\Permission\Models\AdminRole;

/**
 * Class AdminRoleRepositoryEloquent.
 *
 * @package namespace Fast\Api\Permission\Repository\Eloquent
 */
class AdminRoleRepositoryEloquent extends BaseRepository implements AdminRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRole::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
