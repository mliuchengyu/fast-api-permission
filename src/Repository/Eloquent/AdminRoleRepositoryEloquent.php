<?php

namespace Edu\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Edu\Permission\Repository\Contract\AdminRoleRepository;
use Edu\Permission\Models\AdminRole;

/**
 * Class AdminRoleRepositoryEloquent.
 *
 * @package namespace Edu\Permission\Repository\Eloquent
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
