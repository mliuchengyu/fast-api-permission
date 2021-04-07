<?php

namespace Fast\Api\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Fast\Api\Permission\Repository\Contract\AdminUserRepository;
use Fast\Api\Permission\Models\AdminUser;

/**
 * Class AdminUserRepositoryEloquent.
 *
 * @package namespace Fast\Api\Permission\Repository\Eloquent
 */
class AdminUserRepositoryEloquent extends BaseRepository implements AdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUser::class;
    }
}
