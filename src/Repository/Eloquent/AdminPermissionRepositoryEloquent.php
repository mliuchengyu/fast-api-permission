<?php

namespace Fast\Api\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Fast\Api\Permission\Repository\Contract\AdminPermissionRepository;
use Fast\Api\Permission\Models\AdminPermission;

/**
 * Class AdminPermissionRepositoryEloquent.
 *
 * @package namespace Fast\Api\Permission\Repository\Eloquent
 */
class AdminPermissionRepositoryEloquent extends BaseRepository implements AdminPermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminPermission::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
