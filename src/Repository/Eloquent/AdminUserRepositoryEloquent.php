<?php

namespace Edu\Permission\Repository\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Edu\Permission\Repository\Contract\AdminUserRepository;
use Edu\Permission\Models\AdminUser;

/**
 * Class AdminUserRepositoryEloquent.
 *
 * @package namespace Edu\Permission\Repository\Eloquent
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
